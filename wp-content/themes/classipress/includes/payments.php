<?php
/**
 * Payment functions.
 *
 * @package ClassiPress\Payments
 * @author  AppThemes
 * @since   ClassiPress 3.3
 */


add_action( 'pending_to_publish', 'cp_payments_handle_moderated_transaction' );

add_action( 'appthemes_transaction_completed', 'cp_payments_handle_ad_listing_completed' );
add_action( 'appthemes_transaction_activated', 'cp_payments_handle_ad_listing_activated' );

add_action( 'appthemes_transaction_completed', 'cp_payments_handle_membership_completed' );
add_action( 'appthemes_transaction_activated', 'cp_payments_handle_membership_activated' );

add_action( 'appthemes_after_order_summary', 'cp_payments_display_order_summary_continue_button' );


/**
 * Activates ad listing order and redirects user to ad if moderation is disabled,
 * otherwise redirects user to order summary.
 *
 * @param object $order
 *
 * @return void
 */
function cp_payments_handle_ad_listing_completed( $order ) {
	global $cp_options;

	$ad_id = _cp_get_order_ad_id( $order );
	if ( ! $ad_id ) {
		return;
	}

	$order_url = $order->get_return_url();

	if ( ! $cp_options->moderate_ads ) {
		$order->activate();
		if ( ! is_admin() ) {
			if ( did_action( 'wp_head' ) ) {
				cp_js_redirect( $order_url );
			} else {
				wp_redirect( $order_url );
			}
		}
		return;
	} else {
		wp_update_post( array( 'ID' => $ad_id, 'post_status' => 'pending' ) );
		if ( ! is_admin() ) {
			if ( did_action( 'wp_head' ) ) {
				cp_js_redirect( $order_url );
			} else {
				wp_redirect( $order_url );
			}
		}
		return;
	}
}


/**
 * Activates membership order if has been completed.
 *
 * @param object $order
 *
 * @return void
 */
function cp_payments_handle_membership_completed( $order ) {
	$package = cp_get_membership_package_from_order( $order );

	if ( $package ) {
		$order->activate();
		if ( ! is_admin() ) {
			$order_url = $order->get_return_url();
			if ( did_action( 'wp_head' ) ) {
				cp_js_redirect( $order_url );
			} else {
				wp_redirect( $order_url );
			}
		}
	}

}


/**
 * Handles moderated transaction.
 *
 * @param object $post
 *
 * @return void
 */
function cp_payments_handle_moderated_transaction( $post ) {

	if ( $post->post_type != APP_POST_TYPE ) {
		return;
	}

	$order = appthemes_get_order_connected_to( $post->ID );
	if ( ! $order || $order->get_status() !== APPTHEMES_ORDER_COMPLETED ) {
		return;
	}

	add_action( 'save_post', 'cp_payments_activate_moderated_transaction', 11 );
}


/**
 * Activates moderated transaction.
 *
 * @param int $post_id
 *
 * @return void
 */
function cp_payments_activate_moderated_transaction( $post_id ) {

	if ( get_post_type( $post_id ) != APP_POST_TYPE ) {
		return;
	}

	$order = appthemes_get_order_connected_to( $post_id );
	if ( ! $order || $order->get_status() !== APPTHEMES_ORDER_COMPLETED ) {
		return;
	}

	$order->activate();

}


/**
 * Processes ad listing activation on order activation.
 *
 * @param object $order
 *
 * @return void
 */
function cp_payments_handle_ad_listing_activated( $order ) {
	global $cp_options;

	foreach ( $order->get_items( CP_ITEM_LISTING ) as $item ) {
		// update listing status
		$listing_args = array(
			'ID' => $item['post_id'],
			'post_status' => 'publish',
			'post_date' => current_time( 'mysql' ),
			'post_date_gmt' => current_time( 'mysql', 1 ),
		);
		$listing_id = wp_update_post( $listing_args );

		$ad_length = get_post_meta( $listing_id, 'cp_sys_ad_duration', true );
		if ( empty( $ad_length ) ) {
			$ad_length = $cp_options->prun_period;
		}

		$ad_expire_date = appthemes_mysql_date( current_time( 'mysql' ), $ad_length );
		update_post_meta( $listing_id, 'cp_sys_expire_date', $ad_expire_date );
	}

}


/**
 * Processes membership activation on order activation.
 *
 * @param object $order
 *
 * @return void
 */
function cp_payments_handle_membership_activated( $order ) {

	$user = get_user_by( 'id', $order->get_author() );
	$package = cp_get_membership_package_from_order( $order );

	if ( $package && $user ) {
		$processed = cp_update_user_membership( $user->ID, $package );
		if ( $processed ) {
			cp_owner_activated_membership_email( $user, $order );
		}
	}

}


/**
 * Returns associated listing ID for given order, false if not found.
 *
 * @param object $order
 *
 * @return int|bool
 */
function _cp_get_order_ad_id( $order ) {
	foreach ( $order->get_items( CP_ITEM_LISTING ) as $item ) {
		return $item['post_id'];
	}

	return false;
}


/**
 * Checks if payments are enabled on site.
 *
 * @param string $type
 *
 * @return bool
 */
function cp_payments_is_enabled( $type = 'listing' ) {
	global $cp_options;

	if ( ! current_theme_supports( 'app-payments' ) || ! current_theme_supports( 'app-price-format' ) ) {
		return false;
	}

	// check listing settings
	if ( $type == 'listing' ) {
		if ( ! $cp_options->charge_ads ) {
			return false;
		}

		if ( $cp_options->price_scheme == 'featured' && ! is_numeric( $cp_options->sys_feat_price ) ) {
			return false;
		}
	}

	// check membership settings
	if ( $type == 'membership' ) {
		if ( ! $cp_options->enable_membership_packs ) {
			return false;
		}
	}

	return true;
}


/**
 * Checks if post have some pending payment orders.
 *
 * @param int $post_id
 *
 * @return bool
 */
function cp_have_pending_payment( $post_id ) {

	if ( ! cp_payments_is_enabled() ) {
		return false;
	}

	$order = appthemes_get_order_connected_to( $post_id );
	if ( ! $order || ! in_array( $order->get_status(), array( APPTHEMES_ORDER_PENDING, APPTHEMES_ORDER_FAILED ) ) ) {
		return false;
	}

	return true;
}


/**
 * Returns url of order connected to given Post ID.
 *
 * @param int $post_id
 *
 * @return string
 */
function cp_get_order_permalink( $post_id ) {

	if ( ! cp_payments_is_enabled() ) {
		return;
	}

	$order = appthemes_get_order_connected_to( $post_id );
	if ( ! $order ) {
		return;
	}

	return appthemes_get_order_url( $order->get_id() );
}


/**
 * Displays Continue button on order summary page.
 *
 * @return void
 */
function cp_payments_display_order_summary_continue_button() {

	$url = '';
	$text = '';

	$step = _appthemes_get_step_from_query();
	if ( ! is_singular( APPTHEMES_ORDER_PTYPE ) && ( ! empty( $step ) && 'order-summary' !== $step ) ) {
		return;
	}

	$order = get_order();

	if ( $membership = cp_get_membership_package_from_order( $order ) ) {
		$package = cp_get_user_membership_package( $order->get_author() );

		if ( $package ) {
			$url = CP_ADD_NEW_URL;
			$text = __( 'Post an Ad', APP_TD );
		} else {
			$url = CP_DASHBOARD_URL;
			$text = __( 'Visit your dashboard', APP_TD );
		}

	} else if ( $listing_id = _cp_get_order_ad_id( $order ) ) {
		$url = get_permalink( $listing_id );
		$text = __( 'Continue to ad listing', APP_TD );
	}

	if ( $url && $text ) {
		if ( ! in_array( $order->get_status(), array( APPTHEMES_ORDER_PENDING, APPTHEMES_ORDER_FAILED ) ) ) {
			echo html( 'p', __( 'Your order has been completed.', APP_TD ) );
		}
		echo html( 'button', array( 'type' => 'submit', 'class' => 'btn_orange', 'onClick' => "location.href='" . $url . "';return false;" ), $text );
	}
}


/**
 * Displays the total cost per listing on the 1st step page.
 *
 * @return void
 */
function cp_cost_per_listing() {
	global $cp_options;

	// make sure we are charging for ads
	if ( ! cp_payments_is_enabled() ) {
		_e( 'Free', APP_TD );
		return;
	}

	// figure out which pricing scheme is set
	switch( $cp_options->price_scheme ) {

		case 'category':
			$cost_per_listing = __( 'Price depends on category', APP_TD );
			break;

		case 'single':
			$cost_per_listing = __( 'Price depends on ad package selected', APP_TD );
			break;

		case 'percentage':
			$cost_per_listing = sprintf( __( '%s of your ad listing price', APP_TD ), $cp_options->percent_per_ad . '%' );
			break;
		
		case 'featured':
			$cost_per_listing = __( 'Free listing unless featured.', APP_TD );
			break;

		default:
			// pricing structure must be free
			$cost_per_listing = __( 'Free', APP_TD );
			break;

	}

	echo $cost_per_listing;
}


/**
 * Calculates the ad listing fee.
 *
 * @param int $category_id
 * @param int $package_id
 * @param float $cp_price
 * @param string $price_curr
 *
 * @return float
 */
function cp_ad_listing_fee( $category_id, $package_id, $cp_price, $price_curr ) {
	global $cp_options;

	// make sure we are charging for ads
	if ( ! cp_payments_is_enabled() ) {
		return 0;
	}

	// now figure out which pricing scheme is set
	switch( $cp_options->price_scheme ) {

		case 'category':
			$prices = $cp_options->price_per_cat;
			$adlistingfee = ( isset( $prices[ $category_id ] ) ) ? (float) $prices[ $category_id ] : 0;
			break;

		case 'percentage':
			// grab the % and then put it into a workable number
			$ad_percentage = ( $cp_options->percent_per_ad * 0.01 );
			// calculate the ad cost. Ad listing price x percentage.
			$adlistingfee = ( appthemes_clean_price( $cp_price, 'float' ) * $ad_percentage );

			// can modify listing fee. example: apply currency conversion
			$adlistingfee = apply_filters( 'cp_percentage_listing_fee', $adlistingfee, $cp_price, $ad_percentage, $price_curr );
			break;

		case 'featured':
			// listing price is always free in this pricing schema
			$adlistingfee = 0;
			break;

		case 'single':
		default: // pricing model must be single ad packs

			$listing_package = cp_get_listing_package( $package_id );
			if ( $listing_package ) {
				$adlistingfee = $listing_package->price;
			} else {
				$adlistingfee = 0;
				//sprintf( __( 'ERROR: no ad packs found for ID %s.', APP_TD ), $package_id );
			}
			break;

	}

	// return the ad listing fee
	return $adlistingfee;
}


/**
 * Calculates the total ad cost.
 *
 * @param int $category_id
 * @param int $package_id
 * @param float $featuredprice
 * @param float $cp_price
 * @param string $cp_coupon (deprecated)
 * @param string $price_curr
 *
 * @return float
 */
function cp_calc_ad_cost( $category_id, $package_id, $featuredprice, $cp_price, $cp_coupon, $price_curr ) {

	if ( ! cp_payments_is_enabled() ) {
		return 0;
	}

	// check for deprecated argument
	if ( ! empty( $cp_coupon ) ) {
		_deprecated_argument( __FUNCTION__, '3.3' );
	}

	// calculate the listing fee price
	$adlistingfee = cp_ad_listing_fee( $category_id, $package_id, $cp_price, $price_curr );
	// calculate the total cost for the ad.
	$totalcost_out = $adlistingfee + $featuredprice;

	//set proper return format
	$totalcost_out = number_format( $totalcost_out, 2, '.', '' );	

	//if total cost is less then zero, then make the cost zero (free)
	if ( $totalcost_out < 0 ) {
		$totalcost_out = 0;
	}

	return $totalcost_out;
}


