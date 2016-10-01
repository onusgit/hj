<?php

// include form values
require_once ('values.php');


/**
 * Setup admin menu pages for Form Layouts & Custom Fields.
 *
 * @return void
 */
function appthemes_admin_options() {

	add_submenu_page( 'app-dashboard', __( 'Form Layouts', APP_TD ), __('Form Layouts', APP_TD ), 'manage_options', 'layouts', 'cp_form_layouts' );
	add_submenu_page( 'app-dashboard', __( 'Custom Fields', APP_TD ), __( 'Custom Fields', APP_TD ), 'manage_options', 'fields', 'cp_custom_fields' );

	do_action( 'appthemes_add_submenu_page' );
}
add_action( 'admin_menu', 'appthemes_admin_options', 11 );


/**
 * Adds into admin head a column sorting JS.
 *
 * @return void
 */
function cp_ajax_sortable_js() {
?>
<script type="text/javascript" >
jQuery(document).ready(function($) {

	// Return a helper with preserved width of cells
	var fixHelper = function(e, ui) {
		ui.children().each(function() {
			jQuery(this).width(jQuery(this).width());
			//ui.placeholder.html('<!--[if IE]><td>&nbsp;</td><![endif]-->');
		});
		return ui;
	};

	jQuery("tbody.sortable").sortable({
		helper: fixHelper,
		opacity: 0.7,
		cursor: 'move',
		// connectWith: 'table.widefat tbody',
		placeholder: 'ui-placeholder',
		forcePlaceholderSize: true,
		items: 'tr',
		update: function() {
			var results = jQuery("tbody.sortable").sortable("toArray"); // pass in the array of row ids based off each tr css id

			var data = { // pass in the action
			action: 'cp_ajax_update',
			rowarray: results
			};

			jQuery("span#loading").html('<img src="<?php echo get_template_directory_uri(); ?>/images/ajax-loading.gif" />');
			jQuery.post(ajaxurl, data, function(theResponse){
				jQuery("span#loading").html(theResponse);
			});
		}
	}).disableSelection();


});

</script>
<?php
}
add_action( 'admin_head', 'cp_ajax_sortable_js' );


/**
 * Ajax callback to update positions of form fields.
 *
 * @return void
 */
function cp_ajax_sort_callback() {
	global $wpdb;

	$counter = 1;
	foreach ( $_POST['rowarray'] as $value ) {
		$wpdb->update( $wpdb->cp_ad_meta, array( 'field_pos' => $counter ), array( 'meta_id' => $value ) );
		$counter = $counter + 1;
	}
	die();
}
add_action( 'wp_ajax_cp_ajax_update', 'cp_ajax_sort_callback' );


/**
 * Creates the category checklist box.
 *
 * @param array $checkedcats
 * @param string $exclude (optional)
 *
 * @return string
 */
function cp_category_checklist( $checkedcats, $exclude = '' ) {

	$walker = new Walker_Category_Checklist;

	$args = array();

	if ( is_array( $checkedcats ) ) {
		$args['selected_cats'] = $checkedcats;
	} else {
		$args['selected_cats'] = array();
	}

	$args['popular_cats'] = array();
	$categories = get_categories( array(
		'hide_empty' => 0,
		'taxonomy' 	 => APP_TAX_CAT,
		'exclude' 	 => $exclude,
	) );

	return call_user_func_array( array( &$walker, 'walk' ), array( $categories, 0, $args ) );
}


/**
 * Returns a comma-separated list of categories IDs that should be excluded.
 *
 * @param int $id (optional)
 *
 * @return string
 */
function cp_exclude_cats( $id = null ) {
	global $wpdb;

	$output = array();

	if ( $id ) {
		$sql = $wpdb->prepare( "SELECT form_cats FROM $wpdb->cp_ad_forms WHERE id != %s", $id );
	} else {
		$sql = "SELECT form_cats FROM $wpdb->cp_ad_forms";
	}

	$records = $wpdb->get_results( $sql );

	if ( $records ) {
		foreach ( $records as $record ) {
			$output[] = implode( ',', unserialize( $record->form_cats ) );
		}
	}

	$exclude = cp_unique_str( ',', ( join( ',', $output ) ) );

	return $exclude;
}


/**
 * Returns a comma-separated list of categories links that match form categories.
 *
 * @param string $form_cats A comma-separated list of categories IDs
 *
 * @return string
 */
function cp_match_cats( $form_cats ) {
	$out = array();

	$terms = get_terms( APP_TAX_CAT, array( 'include' => $form_cats, 'hide_empty' => false ) );

	if ( $terms ) {
		foreach ( $terms as $term ) {
			$out[] = edit_term_link( $term->name, '', '', $term, false );
		}
	}

	return join( ', ', $out );
}


/**
 * Returns separated string filtered from duplicates.
 *
 * @param string $separator A separator used in string
 * @param string $str A separated string
 *
 * @return string
 */
function cp_unique_str( $separator, $str ) {
	$str_arr = explode( $separator, $str );
	$result = array_unique( $str_arr );
	$unique_str = implode( ',', $result );

	return $unique_str;
}


/**
 * Returns unique custom field name.
 *
 * @param string $name
 * @param string $table (optional)
 * @param bool $random (optional)
 *
 * @return string
 */
function cp_make_custom_name( $name, $table = '', $random = false ) {
	global $wpdb;
	$not_unique = false;

	$custom_name = appthemes_clean( $name );
	$custom_name = preg_replace( '/[^a-zA-Z0-9\s]/', '', $custom_name );
	if ( empty( $custom_name ) || $random ) {
		$custom_name = 'id_' . rand( 1, 1000 );
	}
	$custom_name = strtolower( substr( $custom_name, 0, 30 ) );
	$custom_name = 'cp_' . str_replace( ' ', '_', $custom_name );

	if ( $table == 'fields' ) {
		$not_unique = $wpdb->get_var( $wpdb->prepare( "SELECT field_name FROM $wpdb->cp_ad_fields WHERE field_name = %s", $custom_name ) );
	}

	if ( $table == 'forms' ) {
		$not_unique = $wpdb->get_var( $wpdb->prepare( "SELECT form_name FROM $wpdb->cp_ad_forms WHERE form_name = %s", $custom_name ) );
	}

	if ( $not_unique ) {
		return cp_make_custom_name( $name, $table, true );
	}

	return $custom_name;
}


/**
 * Deletes the custom form and the meta custom field data.
 *
 * @param int $form_id
 *
 * @return void
 */
function cp_delete_form( $form_id ) {
	global $wpdb;

	$wpdb->query( $wpdb->prepare( "DELETE FROM $wpdb->cp_ad_forms WHERE id = %s", $form_id ) );
	$wpdb->query( $wpdb->prepare( "DELETE FROM $wpdb->cp_ad_meta WHERE form_id = %s", $form_id ) );
}


/**
 * Displays admin formbuilder.
 *
 * @param array $form_fields
 *
 * @return void
 */
function cp_admin_formbuilder( $form_fields ) {
	global $wpdb;

	foreach ( $form_fields as $field ) :
	?>

		<tr class="even" id="<?php echo $field->meta_id; ?>"><!-- id needed for jquery sortable to work -->
			<td style="min-width:100px;"><?php echo esc_html( translate( $field->field_label, APP_TD ) ); ?></td>
			<td>

		<?php

		switch ( $field->field_type ) {

		case 'text box':
		?>

			<input name="<?php echo $field->field_name; ?>" type="text" style="min-width:200px;" value="" disabled />

		<?php
		break;

		case 'text area':

		?>

			<textarea rows="4" cols="23" disabled></textarea>

		<?php
		break;

		case 'radio':

			$options = explode( ',', $field->field_values );
			$options = array_map( 'trim', $options );
			foreach ( $options as $label ) {
			?>
				<input type="radio" name="radiobutton" value="" disabled />&nbsp;<?php echo $label; ?><br />

		<?php
			}
		break;

		case 'checkbox':

			$options = explode( ',', $field->field_values );
			$options = array_map( 'trim', $options );
			foreach ( $options as $label ) {
			?>
				<input type="checkbox" name="checkbox" value="" disabled />&nbsp;<?php echo $label; ?><br />

		<?php
			}
		break;

		default: // used for drop-downs, radio buttons, and checkboxes
		?>

			<select name="dropdown">

			<?php
			$options = explode( ',', $field->field_values );
			$options = array_map( 'trim', $options );

			foreach ( $options as $option ) {
			?>

				<option style="min-width:177px" value="<?php echo $option; ?>" disabled><?php echo $option; ?></option>

			<?php
			}
			?>

			</select>

		<?php

		} //end switch
		?>

			</td>

			<td style="text-align:center;">

			<?php
				// only show the advanced search checkbox for price, city, and zipcode since they display the sliders
				// all other text fields are not intended for advanced search use
				$ad_search = '';
				if ( $field->field_name == 'cp_price' || $field->field_name == 'cp_city' || $field->field_name == 'cp_zipcode' ) {
					$ad_search = '';
				} else if ( $field->field_perm == 1 ) {
					$ad_search = 'disabled="disabled"';
				}
				?>

				<input type="checkbox" name="<?php echo $field->meta_id; ?>[field_search]" id="" <?php if ( $field->field_search ) echo 'checked="yes"' ?> <?php if ( $field->field_search ) echo 'checked="yes"' ?> <?php echo $ad_search; ?> value="1" style="" />

			</td>

			<td style="text-align:center;">

				<input type="checkbox" name="<?php echo $field->meta_id; ?>[field_req]" id="" <?php if ( $field->field_req ) echo 'checked="yes"' ?> <?php if ( $field->field_req ) echo 'checked="yes"' ?> <?php if ( $field->field_perm == 1 ) echo 'disabled="disabled"'; ?> value="1" style="" />
				<?php if ($field->field_perm == 1) { ?>
					<input type="hidden" name="<?php echo $field->meta_id; ?>[field_req]" checked="yes" value="1" />
				<?php } ?>

			</td>

			<td style="text-align:center;">

				<input type="hidden" name="id[]" value="<?php echo $field->meta_id; ?>" />
				<input type="hidden" name="<?php echo $field->meta_id; ?>[id]" value="<?php echo $field->meta_id; ?>" />

				<?php if ( $field->field_perm == 1 ) { ?>
				<img src="<?php echo get_template_directory_uri(); ?>/images/remove-row-gray.png" alt="<?php _e( 'Cannot remove from layout', APP_TD ); ?>" title="<?php _e( 'Cannot remove from layout', APP_TD ); ?>" />
				<?php } else { ?>
				<a onclick="return confirmBeforeRemove();" href="?page=layouts&amp;action=formbuilder&amp;id=<?php echo $field->form_id; ?>&amp;del_id=<?php echo $field->meta_id; ?>&amp;title=<?php echo urlencode($_GET['title']) ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/remove-row.png" alt="<?php _e( 'Remove from layout', APP_TD ); ?>" title="<?php _e( 'Remove from layout', APP_TD ); ?>" /></a>
				<?php } ?>

			</td>
		</tr>

	<?php
	endforeach;

}


/**
 * Adds the default form fields when a form layout is created.
 *
 * @param int $form_id
 *
 * @return void
 */
function cp_add_core_fields( $form_id ) {
	global $wpdb;

	// check to see if any rows already exist for this form. If so, don't insert any data
	$wpdb->get_results( $wpdb->prepare( "SELECT form_id FROM $wpdb->cp_ad_meta WHERE form_id = %d", $form_id ) );
	if ( $wpdb->num_rows > 0 ) {
    return;
  }

	// get core fields
	$fields = $wpdb->get_results( "SELECT * FROM $wpdb->cp_ad_fields WHERE field_core = '1' ORDER BY field_id ASC" );

	if ( ! $fields ) {
		return;
	}

  $position = 1;

	foreach ( $fields as $field ) {

		$data = array(
			'form_id' => $form_id,
			'field_id' => $field->field_id,
			'field_req' => $field->field_req,
			'field_pos' => $position,
		);
		$insert = $wpdb->insert( $wpdb->cp_ad_meta, $data );

    $position++;
  }

}


/**
 * Creates a form for editing form layout or form field.
 *
 * @param array $options
 * @param string $cp_table
 * @param int $cp_id
 *
 * @return void
 */
function cp_admin_db_fields( $options, $cp_table, $cp_id ) {
	global $wpdb;

	// gat all the admin fields
	$results = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM ". $wpdb->prefix . $cp_table . " WHERE ". $cp_id ." = %d", $_GET['id'] ) );

	if ( ! $results ) {
		return;
	}

	$field_type = ( ! empty( $results->field_type ) ) ? $results->field_type : '';
	$field_perm = ( ! empty( $results->field_perm ) ) ? $results->field_perm : '';
?>

	<table class="widefat fixed" id="tblspacer" style="width:850px;">

<?php

	foreach ( $options as $value ) {

		if ( empty( $value['tip'] ) ) {
			$tooltip = '';
		} else {
			$tooltip = html( "img", array(
				'class' => 'tip-icon',
				'title' => __( 'Help', APP_TD ),
				'src' => appthemes_framework_image( 'help.png' )
			) );
			$tooltip .= html( "div class='tip-content'", $value['tip'] );
		}

		switch( $value['type'] ) {

			case 'title':
		?>
				<thead>
					<tr>
						<th scope="col" width="200px"><?php echo esc_html( $value['name'] ); ?></th>
						<th class="tip">&nbsp;</th>
						<th scope="col">&nbsp;</th>
					</tr>
				</thead>
		<?php
				break;

			case 'text':
				$args = array(
					'name' => $value['id'],
					'id' => $value['id'],
					'type' => $value['type'],
					'class' => array(),
					'style' => $value['css'],
					'value' => $results->$value['id'],
				);

				if ( ! empty( $value['req'] ) ) {
					$args['class'][] = 'required';
				}

				if ( ! empty( $value['altclass'] ) ) {
					$args['class'][] = $value['altclass'];
				}

				$args['class'] = implode( ' ', $args['class'] );

				if ( ! empty( $value['min'] ) ) {
					$args['minlength'] = $value['min'];
				}

				if ( $value['id'] == 'field_name' ) {
					$args['readonly'] = 'readonly';
				}
		?>
				<tr id="<?php echo esc_attr( $value['id'] ); ?>_row" <?php if ( $value['vis'] == '0' ) echo ' style="display:none;"'; ?>>
					<td class="titledesc"><?php echo esc_html( $value['name'] ); ?>:</td>
					<td class="tip"><?php echo $tooltip; ?></td>
					<td class="forminp"><?php echo html( 'input', $args ); ?><br /><small><?php echo $value['desc']; ?></small></td>
				</tr>
		<?php
				break;

			case 'select':
		?>
				<tr id="<?php echo $value['id']; ?>_row">
					<td class="titledesc"><?php echo esc_html( $value['name'] ); ?>:</td>
					<td class="tip"><?php echo $tooltip; ?></td>
					<td class="forminp">
						<select <?php if ( $value['js'] ) echo $value['js']; ?> <?php disabled( in_array( $field_perm, array( 1, 2 ) ) ); ?> name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" style="<?php echo $value['css']; ?>">

						<?php foreach ( $value['options'] as $key => $val ) { ?>
							<option value="<?php echo $key; ?>"<?php if ( isset( $results->$value['id'] ) && $results->$value['id'] == $key ) { selected( true ); $field_type_out = $field_type; } ?>><?php echo $val; ?></option>
						<?php } ?>

						</select><br />
						<small><?php echo $value['desc']; ?></small>
						<?php
							// have to submit this field as a hidden value if perms are 1 or 2 since the DISABLED option won't pass anything into the $_POST
							if ( in_array( $field_perm, array( 1, 2 ) ) ) {
								echo html( 'input', array( 'type' => 'hidden', 'name' => $value['id'], 'value' => $field_type_out ) );
							}
						?>
					</td>
				</tr>
		<?php
				break;

			case 'textarea':
		?>
				<tr id="<?php echo $value['id']; ?>_row"<?php if ( $value['id'] == 'field_values' ) { ?> style="display: none;" <?php } ?>>
					<td class="titledesc"><?php echo $value['name']; ?>:</td>
					<td class="tip"><?php echo $tooltip; ?></td>
					<td class="forminp"><textarea <?php if ( in_array( $field_perm, array( 1, 2 ) ) && ! in_array( $value['id'], array( 'field_tooltip', 'field_values' ) ) ) { ?>readonly="readonly"<?php } ?> name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" style="<?php echo $value['css']; ?>"><?php echo $results->$value['id']; ?></textarea>
					<br /><small><?php echo $value['desc']; ?></small></td>
				</tr>
		<?php
				break;

			case 'checkbox':
		?>
				<tr id="<?php echo $value['id']; ?>_row">
					<td class="titledesc"><?php echo esc_html( $value['name'] ); ?>:</td>
					<td class="tip"><?php echo $tooltip; ?></td>
					<td class="forminp"><input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="1" style="<?php echo $value['css']; ?>" <?php checked( ! empty( $results->$value['id'] ) ); ?> />
					<br /><small><?php echo $value['desc']; ?></small></td>
				</tr>
		<?php
				break;

			case 'cat_checklist':
		?>
				<tr id="<?php echo $value['id']; ?>_row">
					<td class="titledesc"><?php echo esc_html( $value['name'] ); ?>:</td>
					<td class="tip"><?php echo $tooltip; ?></td>
					<td class="forminp">
						<div id="form-categorydiv">
							<div class="tabs-panel" id="categories-all" style="<?php echo $value['css']; ?>">
								<ul class="list:category categorychecklist form-no-clear" id="categorychecklist">
									<?php echo cp_category_checklist( unserialize( $results->form_cats ), cp_exclude_cats( $results->id ) ); ?>
								</ul>
							</div>
							<a href="#" class="checkall"><?php _e( 'check all', APP_TD ); ?></a>
						</div>
						<br /><small><?php echo $value['desc']; ?></small>
					</td>
				</tr>
		<?php
				break;


		} // end switch

	} // endforeach

?>

	</table>

<?php
}


/**
 * Creates a form for adding new form layout or form field.
 *
 * @param array $options
 *
 * @return void
 */
function cp_admin_fields( $options ) {
	global $cp_options;
?>

	<div id="tabs-wrap">

<?php
	// first generate the page tabs
	$counter = 0;

	echo '<ul class="tabs">' . "\n";
	foreach ( $options as $value ) {
		if ( in_array( 'tab', $value ) ) {
			echo '<li><a href="#' . $value['type'] . $counter . '">' . $value['tabname'] . '</a></li>' . "\n";
			$counter++;
		}
	}
	echo '</ul>' . "\n\n";

	// now loop through all the options
	$counter = 0;
	$table_width = $cp_options->table_width;

	foreach ( $options as $value ) {

		if ( empty( $value['tip'] ) ) {
			$tooltip = '';
		} else {
			$tooltip = html( "img", array(
				'class' => 'tip-icon',
				'title' => __( 'Help', APP_TD ),
				'src' => appthemes_framework_image( 'help.png' )
			) );
			$tooltip .= html( "div class='tip-content'", $value['tip'] );
		}

		switch ( $value['type'] ) {

			case 'tab':
				echo '<div id="' . $value['type'] . $counter . '">' . "\n\n";
				echo '<table class="widefat fixed" style="width:' . $table_width . '; margin-bottom:20px;">' . "\n\n";
				break;

			case 'notab':
				echo '<table class="widefat fixed" style="width:' . $table_width . '; margin-bottom:20px;">' . "\n\n";
				break;

			case 'title':
		?>
				<thead>
					<tr>
						<th scope="col" width="200px"><?php echo esc_html( $value['name'] ); ?></th>
						<th class="tip">&nbsp;</th>
						<th scope="col"><?php if ( isset( $value['desc'] ) ) echo $value['desc']; ?>&nbsp;</th>
					</tr>
				</thead>
		<?php
				break;

			case 'text':
				// don't show the meta name field used by WP. This is automatically created by CP.
				if ( $value['id'] == 'field_name' )
					break;

				$args = array(
					'name' => $value['id'],
					'id' => $value['id'],
					'type' => $value['type'],
					'class' => array(),
					'style' => $value['css'],
					'value' => ( get_option( $value['id'] ) ) ? get_option( $value['id'] ) : $value['std'],
				);

				if ( ! empty( $value['req'] ) ) {
					$args['class'][] = 'required';
				}

				if ( ! empty( $value['altclass'] ) ) {
					$args['class'][] = $value['altclass'];
				}

				$args['class'] = implode( ' ', $args['class'] );

				if ( ! empty( $value['min'] ) ) {
					$args['minlength'] = $value['min'];
				}
		?>
				<tr <?php if ( $value['vis'] == '0' ) { ?>id="<?php if ( ! empty( $value['visid'] ) ) { echo $value['visid']; } else { echo 'field_values'; } ?>" style="display:none;"<?php } else { ?>id="<?php echo $value['id']; ?>_row"<?php } ?>>
					<td class="titledesc"><?php echo esc_html( $value['name'] ); ?>:</td>
					<td class="tip"><?php echo $tooltip; ?></td>
					<td class="forminp"><?php echo html( 'input', $args ); ?><br /><small><?php echo $value['desc']; ?></small></td>
				</tr>
		<?php
				break;

			case 'select':
		?>
				<tr id="<?php echo $value['id']; ?>_row">
					<td class="titledesc"><?php echo esc_html( $value['name'] ); ?>:</td>
					<td class="tip"><?php echo $tooltip; ?></td>
					<td class="forminp">
						<select <?php if ( !empty( $value['js'] ) ) echo $value['js']; ?> name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" style="<?php echo $value['css'] ?>"<?php if ( $value['req'] ) { ?> class="required"<?php } ?>>
						<?php foreach ( $value['options'] as $key => $val ) { ?>
							<option value="<?php echo $key; ?>" <?php selected( get_option( $value['id'] ) == $key ); ?>><?php echo $val; ?></option>
						<?php } ?>
						</select>
						<br /><small><?php echo $value['desc']; ?></small>
					</td>
				</tr>
		<?php
				break;

			case 'checkbox':
		?>
				<tr id="<?php echo $value['id']; ?>_row">
					<td class="titledesc"><?php echo esc_html( $value['name'] ); ?>:</td>
					<td class="tip"><?php echo $tooltip; ?></td>
					<td class="forminp">
						<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" style="<?php echo $value['css']; ?>" <?php checked( get_option( $value['id'] ) ); ?> />
						<br /><small><?php echo $value['desc']; ?></small>
					</td>
				</tr>
		<?php
				break;

			case 'textarea':
		?>
				<tr id="<?php echo $value['id']; ?>_row"<?php if ( $value['id'] == 'field_values' ) { ?> style="display: none;" <?php } ?>>
					<td class="titledesc"><?php echo esc_html( $value['name'] ); ?>:</td>
					<td class="tip"><?php echo $tooltip; ?></td>
					<td class="forminp">
						<textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" style="<?php echo $value['css']; ?>" <?php if ( $value['req'] ) { ?> class="required" <?php } ?><?php if ( $value['min'] ) { ?> minlength="<?php echo $value['min']; ?>"<?php } ?>><?php if ( get_option( $value['id'] ) ) echo stripslashes( get_option($value['id']) ); else echo $value['std']; ?></textarea>
						<br /><small><?php echo $value['desc']; ?></small>
					</td>
				</tr>
		<?php
				break;

			case 'cat_checklist':
		?>
				<tr id="<?php echo $value['id']; ?>_row">
					<td class="titledesc"><?php echo esc_html( $value['name'] ); ?>:</td>
					<td class="tip"><?php echo $tooltip; ?></td>
					<td class="forminp">
						<div id="form-categorydiv">
							<div class="tabs-panel" id="categories-all" style="<?php echo $value['css']; ?>">
								<ul class="list:category categorychecklist form-no-clear" id="categorychecklist">
									<?php $catcheck = cp_category_checklist( 0, cp_exclude_cats() ); ?>
									<?php if ( $catcheck ) echo $catcheck; else wp_die( '<p style="color:red;">' . __( 'All your categories are currently being used. You must remove at least one category from another form layout before you can continue.', APP_TD ) . '</p>' ); ?>
								</ul>
							</div>
							<a href="#" class="checkall"><?php _e( 'check all', APP_TD ); ?></a>
						</div>
						<br /><small><?php echo $value['desc']; ?></small>
					</td>
				</tr>
		<?php
				break;

			case 'logo':
		?>
				<tr id="<?php echo $value['id']; ?>_row">
					<td class="titledesc"><?php echo esc_html( $value['name'] ); ?></td>
					<td class="tip">&nbsp;</td>
					<td class="forminp">&nbsp;</td>
				</tr>
		<?php
				break;

			case 'tabend':
				echo '</table>' . "\n\n";
				echo '</div> <!-- #tab' . $counter . ' -->' . "\n\n";
				$counter++;
				break;

			case 'notabend':
				echo '</table>' . "\n\n";
				break;

		} // end switch

	} // end foreach
?>

	</div> <!-- #tabs-wrap -->

<?php
}


do_action( 'appthemes_add_submenu_page_content' );


/**
 * Handles form layouts admin page.
 *
 * @return void
 */
function cp_form_layouts() {
	global $options_new_form, $wpdb, $current_user;

	$current_user = wp_get_current_user();

	// check to prevent php "notice: undefined index" msg when php strict warnings is on
	if ( isset( $_GET['action'] ) ) $theswitch = $_GET['action']; else $theswitch ='';
	?>

	<script type="text/javascript">
	/* <![CDATA[ */
	/* initialize the form validation */
	jQuery(document).ready(function($) {
		$("#mainform").validate({errorClass: "invalid"});
	});
	/* ]]> */
	</script>

	<?php
	switch ( $theswitch ) {

		case 'addform':
		?>

			<div class="wrap">
				<div class="icon32" id="icon-themes"><br /></div>
				<h2><?php _e( 'New Form Layout', APP_TD ); ?></h2>

				<?php
				// check and make sure the form was submitted and the hidden fcheck id matches the cookie fcheck id
				if ( isset($_POST['submitted']) ) {

					if ( !isset($_POST['post_category']) )
						wp_die( '<p style="color:red;">' . __( 'Error: Please select at least one category.', APP_TD ) . " <a href='#' onclick='history.go(-1);return false;'>" . __( 'Go back', APP_TD ) . '</a></p>' );

					$data = array(
						'form_name' => cp_make_custom_name( $_POST['form_label'], 'forms' ),
						'form_label' => appthemes_clean( $_POST['form_label'] ),
						'form_desc' => appthemes_clean( $_POST['form_desc'] ),
						'form_cats' => serialize( $_POST['post_category'] ),
						'form_status' => appthemes_clean( $_POST['form_status'] ),
						'form_owner' => appthemes_clean( $_POST['form_owner'] ),
						'form_created' => current_time( 'mysql' ),
					);

					$insert = $wpdb->insert( $wpdb->cp_ad_forms, $data );

					if ( $insert ) {
					?>

						<p style="text-align:center;padding-top:50px;font-size:22px;"><?php _e( 'Creating your form.....', APP_TD ); ?><br /><br /><img src="<?php echo get_template_directory_uri(); ?>/images/loader.gif" alt="" /></p>
						<meta http-equiv="refresh" content="0; URL=?page=layouts">

					<?php
					} // end $insert

				} else {
				?>

            <form method="post" id="mainform" action="">

                <?php echo cp_admin_fields( $options_new_form ); ?>

                <p class="submit"><input class="btn button-primary" name="save" type="submit" value="<?php _e( 'Create New Form', APP_TD ); ?>" />&nbsp;&nbsp;&nbsp;
                <input class="btn button-secondary" name="cancel" type="button" onClick="location.href='?page=layouts'" value="<?php _e( 'Cancel', APP_TD ); ?>" /></p>
                <input name="submitted" type="hidden" value="yes" />
                <input name="form_owner" type="hidden" value="<?php echo $current_user->user_login; ?>" />

            </form>

        <?php
        } // end isset $_POST
        ?>

        </div><!-- end wrap -->

    <?php
    break;


		case 'editform':
		?>

			<div class="wrap">
				<div class="icon32" id="icon-themes"><br /></div>
				<h2><?php _e( 'Edit Form Properties', APP_TD ); ?></h2>

				<?php
				if ( isset( $_POST['submitted'] ) && $_POST['submitted'] == 'yes' ) {

					if ( ! isset( $_POST['post_category'] ) )
						wp_die( '<p style="color:red;">' . __( 'Error: Please select at least one category.', APP_TD ) . " <a href='#' onclick='history.go(-1);return false;'>" . __( 'Go back', APP_TD ) . '</a></p>' );


					$data = array(
						'form_label' => appthemes_clean($_POST['form_label']),
						'form_desc' => appthemes_clean($_POST['form_desc']),
						'form_cats' => serialize($_POST['post_category']),
						'form_status' => appthemes_clean($_POST['form_status']),
						'form_owner' => appthemes_clean($_POST['form_owner']),
						'form_modified' => current_time('mysql'),
					);

					$wpdb->update( $wpdb->cp_ad_forms, $data, array( 'id' => $_GET['id'] ) );

				?>

					<p style="text-align:center;padding-top:50px;font-size:22px;"><?php _e( 'Saving your changes.....', APP_TD ); ?><br /><br /><img src="<?php echo get_template_directory_uri(); ?>/images/loader.gif" alt="" /></p>
					<meta http-equiv="refresh" content="0; URL=?page=layouts">

				<?php
				} else {
				?>

            <form method="post" id="mainform" action="">

            <?php echo cp_admin_db_fields( $options_new_form, 'cp_ad_forms', 'id' ); ?>

                <p class="submit"><input class="btn button-primary" name="save" type="submit" value="<?php _e( 'Save changes', APP_TD ); ?>" />&nbsp;&nbsp;&nbsp;
                <input class="btn button-secondary" name="cancel" type="button" onClick="location.href='?page=layouts'" value="<?php _e( 'Cancel', APP_TD ); ?>" /></p>
                <input name="submitted" type="hidden" value="yes" />
                <input name="form_owner" type="hidden" value="<?php echo $current_user->user_login; ?>" />

            </form>

        <?php
        } // end isset $_POST
        ?>

        </div><!-- end wrap -->

    <?php
    break;


    /**
    * Form Builder Page
    * Where fields are added to form layouts
    */

		case 'formbuilder':
		?>

			<div class="wrap">
				<div class="icon32" id="icon-themes"><br /></div>
				<h2><?php _e( 'Edit Form Layout', APP_TD ); ?></h2>

				<?php
				// add fields to page layout on left side
				if ( isset( $_POST['field_id'] ) ) {

					// take selected checkbox array and loop through ids
					foreach ( $_POST['field_id'] as $value ) {

						$data = array(
							'form_id' => appthemes_clean( $_POST['form_id'] ),
							'field_id' => appthemes_clean( $value ),
							'field_pos' => '99',
						);

						$insert = $wpdb->insert( $wpdb->cp_ad_meta, $data );

					} // end foreach

				} // end $_POST



				// update form layout positions and required fields on left side.
				if ( isset( $_POST['formlayout'] ) ) {

					// loop through the post array and update the required checkbox and field position
					foreach ( $_POST as $key => $value ) :

						// since there's some $_POST values we don't want to process, only give us the
						// numeric ones which means it contains a meta_id and we want to update it
						if ( is_numeric($key) ) {

							// quick hack to prevent php "notice: undefined index:" msg when php strict warnings is on
							if ( ! isset( $value['field_req'] ) ) $value['field_req'] = '0';
							if ( ! isset( $value['field_search'] ) ) $value['field_search'] = '0';

							$data = array(
								'field_req' => appthemes_clean( $value['field_req'] ),
								'field_search' => appthemes_clean( $value['field_search'] ),
							);

							$wpdb->update( $wpdb->cp_ad_meta, $data, array( 'meta_id' => $key ) );

						} // end if_numeric

					endforeach; // end for each

					echo '<p class="info">' . __( 'Your changes have been saved.', APP_TD ) . '</p>';

				} // end isset $_POST


        // check to prevent php "notice: undefined index" msg when php strict warnings is on
        if ( isset( $_GET['del_id'] ) ) $theswitch = $_GET['del_id']; else $theswitch ='';


        // Remove items from form layout
        if ( $theswitch ) $wpdb->query( $wpdb->prepare( "DELETE FROM $wpdb->cp_ad_meta WHERE meta_id = %s", $_GET['del_id'] ) );


        //update the forms modified date
				$data = array(
					'form_modified' => current_time('mysql'),
				);

				$wpdb->update( $wpdb->cp_ad_forms, $data, array( 'id' => $_GET['id'] ) );
        ?>


        <table>
            <tr style="vertical-align:top;">
                <td style="width:800px;padding:0 20px 0 0;">


                <h3><?php _e( 'Form Name', APP_TD ); ?> - <?php echo ucfirst( urldecode( $_GET['title'] ) ); ?>&nbsp;&nbsp;&nbsp;&nbsp;<span id="loading"></span></h3>

                <form method="post" id="mainform" action="">

                    <table class="widefat">
                        <thead>
                            <tr>
                                <th scope="col" colspan="2"><?php _e( 'Form Preview', APP_TD ); ?></th>
								<th scope="col" style="width:75px;text-align:center;" title="<?php _e( 'Show field in the category refine search sidebar', APP_TD ); ?>"><?php _e( 'Advanced Search', APP_TD ); ?></th>
                                <th scope="col" style="width:75px;text-align:center;"><?php _e( 'Required', APP_TD ); ?></th>
                                <th scope="col" style="width:75px;text-align:center;"><?php _e( 'Remove', APP_TD ); ?></th>
                            </tr>
                        </thead>



                        <tbody class="sortable">

                        <?php

                            // If this is the first time this form is being customized then auto
                            // create the core fields and put in cp_meta db table
                            echo cp_add_core_fields( $_GET['id'] );

                            $form_fields = cp_get_custom_form_fields( $_GET['id'] );

                            if ( $form_fields ) {

                                echo cp_admin_formbuilder( $form_fields );

                            } else {

                        ?>

                        <tr>
                            <td colspan="5" style="text-align: center;"><p><br /><?php _e( 'No fields have been added to this form layout yet.', APP_TD ); ?><br /><br /></p></td>
                        </tr>

                        <?php
                            } // end $results
                            ?>

                        </tbody>

                    </table>

                    <p class="submit">
                        <input class="btn button-primary" name="save" type="submit" value="<?php _e( 'Save Changes', APP_TD ); ?>" />&nbsp;&nbsp;&nbsp;
                        <input class="btn button-secondary" name="cancel" type="button" onClick="location.href='?page=layouts'" value="<?php _e( 'Cancel', APP_TD ); ?>" />
                        <input name="formlayout" type="hidden" value="yes" />
                        <input name="form_owner" type="hidden" value="<?php $current_user->user_login; ?>" />
                    </p>
                </form>

                </td>
                <td>

                <h3><?php _e( 'Available Fields', APP_TD ); ?></h3>

                <form method="post" id="mainform" action="">


                <div class="fields-panel">

                    <table class="widefat">
                        <thead>
                            <tr>
                                <th style="" class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"/></th>
                                <th scope="col"><?php _e( 'Field Name', APP_TD ); ?></th>
                                <th scope="col"><?php _e( 'Type', APP_TD ); ?></th>
                            </tr>
                        </thead>


                        <tbody>

                        <?php
                        // Select all available fields not currently on the form layout.
                        // Also exclude any core fields since they cannot be removed from the layout.
                        $sql = $wpdb->prepare( "SELECT f.field_id,f.field_label,f.field_type "
                             . "FROM $wpdb->cp_ad_fields f "
                             . "WHERE f.field_id "
                             . "NOT IN (SELECT m.field_id "
                             . "FROM $wpdb->cp_ad_meta m "
                             . "WHERE m.form_id =  %s) "
                             . "AND f.field_perm <> '1'",
                             $_GET['id']);

                        $results = $wpdb->get_results( $sql );

                        if ( $results ) {

                            foreach ( $results as $result ) {
                        ?>

                        <tr class="even">
                            <th class="check-column" scope="row"><input type="checkbox" value="<?php echo $result->field_id; ?>" name="field_id[]"/></th>
                            <td><?php echo esc_html( translate( $result->field_label, APP_TD ) ); ?></td>
                            <td><?php echo $result->field_type; ?></td>
                        </tr>

                        <?php
                            } // end foreach

                        } else {
                        ?>

                        <tr>
                            <td colspan="4" style="text-align: center;"><p><br /><?php _e( 'No fields are available.', APP_TD ); ?><br /><br /></p></td>
                        </tr>

                        <?php
                        } // end $results
                        ?>

                        </tbody>

                    </table>

                </div>

                    <p class="submit"><input class="btn button-primary" name="save" type="submit" value="<?php _e( 'Add Fields to Form Layout', APP_TD ); ?>" /></p>
                        <input name="form_id" type="hidden" value="<?php echo $_GET['id']; ?>" />
                        <input name="submitted" type="hidden" value="yes" />


                </form>

                </td>
            </tr>
        </table>

    </div><!-- /wrap -->

    <?php

    break;



    case 'delete':

        // delete the form based on the form id
        cp_delete_form( $_GET['id'] );
        ?>
        <p style="text-align:center;padding-top:50px;font-size:22px;"><?php _e( 'Deleting form layout.....', APP_TD ); ?><br /><br /><img src="<?php echo get_template_directory_uri(); ?>/images/loader.gif" alt="" /></p>
        <meta http-equiv="refresh" content="0; URL=?page=layouts">

    <?php
    break;

    default:

        $results = $wpdb->get_results( "SELECT * FROM $wpdb->cp_ad_forms ORDER BY id desc" );

    ?>

        <div class="wrap">
        <div class="icon32" id="icon-themes"><br /></div>
        <h2><?php _e( 'Form Layouts', APP_TD ); ?>&nbsp;<a class="add-new-h2" href="?page=layouts&amp;action=addform"><?php _e( 'Add New', APP_TD ); ?></a></h2>

        <p class="admin-msg"><?php _e( 'Form layouts allow you to create your own custom ad submission forms. Each form is essentially a container for your fields and can be applied to one or all of your categories. If you do not create any form layouts, the default one will be used. To change the default form, create a new form layout and apply it to all categories.', APP_TD ); ?></p>

        <table id="tblspacer" class="widefat fixed">

            <thead>
                <tr>
                    <th scope="col" style="width:35px;">&nbsp;</th>
                    <th scope="col"><?php _e( 'Name', APP_TD ); ?></th>
                    <th scope="col"><?php _e( 'Description', APP_TD ); ?></th>
                    <th scope="col"><?php _e( 'Categories', APP_TD ); ?></th>
                    <th scope="col" style="width:150px;"><?php _e( 'Modified', APP_TD ); ?></th>
                    <th scope="col" style="width:75px;"><?php _e( 'Status', APP_TD ); ?></th>
                    <th scope="col" style="text-align:center;width:100px;"><?php _e( 'Actions', APP_TD ); ?></th>
                </tr>
            </thead>

            <?php
            if ( $results ) {
              $rowclass = '';
              $i=1;
            ?>

              <tbody id="list">

            <?php
                foreach ( $results as $result ) {

                $rowclass = 'even' == $rowclass ? 'alt' : 'even';
              ?>

                <tr class="<?php echo $rowclass; ?>">
                    <td style="padding-left:10px;"><?php echo $i; ?>.</td>
                    <td><a href="?page=layouts&amp;action=editform&amp;id=<?php echo $result->id; ?>"><strong><?php echo $result->form_label; ?></strong></a></td>
                    <td><?php echo $result->form_desc; ?></td>
                    <td><?php echo cp_match_cats( unserialize($result->form_cats) ); ?></td>
                    <td><?php echo appthemes_display_date( $result->form_modified ); ?> <?php _e( 'by', APP_TD ); ?> <?php echo $result->form_owner; ?></td>
                    <td><?php echo cp_get_status_i18n( $result->form_status ); ?></td>
                    <td style="text-align:center"><a href="?page=layouts&amp;action=formbuilder&amp;id=<?php echo $result->id; ?>&amp;title=<?php echo urlencode($result->form_label); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/layout_add.png" alt="<?php _e( 'Edit form layout', APP_TD ); ?>" title="<?php _e( 'Edit form layout', APP_TD ); ?>" /></a>&nbsp;&nbsp;&nbsp;
                        <a href="?page=layouts&amp;action=editform&amp;id=<?php echo $result->id; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/edit.png" alt="<?php _e( 'Edit form properties', APP_TD ); ?>" title="<?php _e( 'Edit form properties', APP_TD ); ?>" /></a>&nbsp;&nbsp;&nbsp;
                        <a onclick="return confirmBeforeDelete();" href="?page=layouts&amp;action=delete&amp;id=<?php echo $result->id; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/cross.png" alt="<?php _e( 'Delete form layout', APP_TD ); ?>" title="<?php _e( 'Delete form layout', APP_TD ); ?>" /></a></td>
                </tr>

              <?php

                $i++;

                } // end for each
              ?>

              </tbody>

            <?php

            } else {

            ?>

                <tr>
                    <td colspan="7"><?php _e( 'No form layouts found.', APP_TD ); ?></td>
                </tr>

            <?php
            } // end $results
            ?>

            </table>


        </div><!-- end wrap -->

    <?php
    } // end switch
    ?>
    <script type="text/javascript">
        /* <![CDATA[ */
            function confirmBeforeDelete() { return confirm("<?php _e( 'Are you sure you want to delete this?', APP_TD ); ?>"); }
            function confirmBeforeRemove() { return confirm("<?php _e( 'Are you sure you want to remove this?', APP_TD ); ?>"); }
        /* ]]> */
    </script>

<?php

} // end function


/**
 * Handles form fields admin page.
 *
 * @return void
 */
function cp_custom_fields() {
	global $options_new_field, $wpdb, $current_user;

	$current_user = wp_get_current_user();
	?>

	<!-- show/hide the dropdown field values tr -->
	<script type="text/javascript">
	/* <![CDATA[ */
		jQuery(document).ready(function() {
			jQuery("#mainform").validate({errorClass: "invalid"});
		});

		function show(o){
			if(o){switch(o.value){
				case 'drop-down': jQuery('#field_values_row').show(); jQuery('#field_min_length_row').hide(); break;
				case 'radio': jQuery('#field_values_row').show(); jQuery('#field_min_length_row').hide(); break;
				case 'checkbox': jQuery('#field_values_row').show(); jQuery('#field_min_length_row').hide(); break;
				case 'text box': jQuery('#field_min_length_row').show(); jQuery('#field_values_row').hide(); break;
				default: jQuery('#field_values_row').hide(); jQuery('#field_min_length_row').hide();
			}}
		}

		//show/hide immediately on document load
		jQuery(document).ready(function() {
			show(jQuery('#field_type').get(0));
		});

		//hide unwanted options for cp_currency field
		jQuery(document).ready(function() {
			var field_name = jQuery('#field_name').val();
			if(field_name == 'cp_currency'){
				jQuery("#field_type option[value='text box']").attr("disabled", "disabled");
				jQuery("#field_type option[value='text area']").attr("disabled", "disabled");
				jQuery("#field_type option[value='checkbox']").attr("disabled", "disabled");
			}
		});
	/* ]]> */
	</script>

	<?php

	$theswitch = ( isset( $_GET['action'] ) ) ? $_GET['action'] : '';

	switch ( $theswitch ) {

		case 'addfield':
		?>

			<div class="wrap">
				<div class="icon32" id="icon-themes"><br /></div>
				<h2><?php _e( 'New Custom Field', APP_TD ); ?></h2>

				<?php
				// check and make sure the form was submitted
				if ( isset( $_POST['submitted'] ) ) {

					$_POST['field_search'] = ''; // we aren't using this field so set it to blank for now to prevent notice

					$data = array(
						'field_name' => cp_make_custom_name( $_POST['field_label'], 'fields' ),
						'field_label' => appthemes_clean( $_POST['field_label'] ),
						'field_desc' => appthemes_clean( $_POST['field_desc'] ),
						'field_tooltip' => appthemes_clean( $_POST['field_tooltip'] ),
						'field_type' => appthemes_clean( $_POST['field_type'] ),
						'field_values' => appthemes_clean( $_POST['field_values'] ),
						'field_search' => appthemes_clean( $_POST['field_search'] ),
						'field_owner' => appthemes_clean( $_POST['field_owner'] ),
						'field_created' => current_time( 'mysql' ),
						'field_modified' => current_time( 'mysql' ),
					);

					$insert = $wpdb->insert( $wpdb->cp_ad_fields, $data );


					if ( $insert ) :
						do_action( 'cp_custom_fields', 'addfield', $wpdb->insert_id );
					?>

						<p style="text-align:center;padding-top:50px;font-size:22px;"><?php _e( 'Creating your field.....', APP_TD ); ?><br /><br /><img src="<?php echo get_template_directory_uri(); ?>/images/loader.gif" alt="" /></p>
						<meta http-equiv="refresh" content="0; URL=?page=fields">

					<?php
					endif;

					die;

				} else {
				?>

					<form method="post" id="mainform" action="">

						<?php cp_admin_fields( $options_new_field ); ?>

						<p class="submit"><input class="btn button-primary" name="save" type="submit" value="<?php _e( 'Create New Field', APP_TD ); ?>" />&nbsp;&nbsp;&nbsp;
						<input class="btn button-secondary" name="cancel" type="button" onClick="location.href='?page=fields'" value="<?php _e( 'Cancel', APP_TD ); ?>" /></p>
						<input name="submitted" type="hidden" value="yes" />
						<input name="field_owner" type="hidden" value="<?php echo $current_user->user_login; ?>" />

					</form>

				<?php } ?>

			</div><!-- end wrap -->

			<?php
			break;


		case 'editfield':
		?>

			<div class="wrap">
				<div class="icon32" id="icon-themes"><br /></div>
				<h2><?php _e( 'Edit Custom Field', APP_TD ); ?></h2>

				<?php
				if ( isset( $_POST['submitted'] ) && $_POST['submitted'] == 'yes' ) {

					$data = array(
						'field_name' => appthemes_clean( $_POST['field_name'] ),
						'field_label' => appthemes_clean( $_POST['field_label'] ),
						'field_desc' => appthemes_clean( $_POST['field_desc'] ),
						'field_tooltip' => esc_attr( appthemes_clean( $_POST['field_tooltip'] ) ),
						'field_type' => appthemes_clean( $_POST['field_type'] ),
						'field_values' => appthemes_clean( $_POST['field_values'] ),
						'field_min_length' => appthemes_clean( $_POST['field_min_length'] ),
						//'field_search' => appthemes_clean( $_POST['field_search'] ),
						'field_owner' => appthemes_clean( $_POST['field_owner'] ),
						'field_modified' => current_time( 'mysql' ),
					);

					$wpdb->update( $wpdb->cp_ad_fields, $data, array( 'field_id' => $_GET['id'] ) );
					do_action( 'cp_custom_fields', 'editfield', $_GET['id'] );
				?>

					<p style="text-align:center;padding-top:50px;font-size:22px;">
						<?php _e( 'Saving your changes.....', APP_TD ); ?><br /><br />
						<img src="<?php echo get_template_directory_uri(); ?>/images/loader.gif" alt="" />
					</p>
					<meta http-equiv="refresh" content="0; URL=?page=fields">

				<?php
				} else {
				?>


					<form method="post" id="mainform" action="">

						<?php cp_admin_db_fields( $options_new_field, 'cp_ad_fields', 'field_id' ); ?>

						<p class="submit">
							<input class="btn button-primary" name="save" type="submit" value="<?php _e( 'Save changes', APP_TD ); ?>" />&nbsp;&nbsp;&nbsp;
							<input class="btn button-secondary" name="cancel" type="button" onClick="location.href='?page=fields'" value="<?php _e( 'Cancel', APP_TD ); ?>" />
							<input name="submitted" type="hidden" value="yes" />
							<input name="field_owner" type="hidden" value="<?php echo $current_user->user_login; ?>" />
						</p>

					</form>

				<?php } ?>

			</div><!-- end wrap -->

			<?php
			break;


		case 'delete':

			// check and make sure this fields perms allow deletion
			$sql = $wpdb->prepare( "SELECT field_perm FROM $wpdb->cp_ad_fields WHERE field_id = %d LIMIT 1", $_GET['id'] );
			$results = $wpdb->get_row( $sql );

			// if it's not greater than zero, then delete it
			if ( ! ( $results->field_perm > 0 ) ) {
				do_action( 'cp_custom_fields', 'delete', $_GET['id'] );

				$delete = $wpdb->prepare( "DELETE FROM $wpdb->cp_ad_fields WHERE field_id = %d", $_GET['id'] );
				$wpdb->query( $delete );
			}
		?>
			<p style="text-align:center;padding-top:50px;font-size:22px;"><?php _e( 'Deleting custom field.....', APP_TD ); ?><br /><br /><img src="<?php echo get_template_directory_uri(); ?>/images/loader.gif" alt="" /></p>
			<meta http-equiv="refresh" content="0; URL=?page=fields">

			<?php
			break;


		// show the table of all custom fields
		default:

			$sql = "SELECT * FROM $wpdb->cp_ad_fields ORDER BY field_name desc";
			$results = $wpdb->get_results( $sql );
		?>

			<div class="wrap">
				<div class="icon32" id="icon-tools"><br /></div>
				<h2><?php _e( 'Custom Fields', APP_TD ); ?>&nbsp;<a class="add-new-h2" href="?page=fields&amp;action=addfield"><?php _e( 'Add New', APP_TD ); ?></a></h2>

				<p class="admin-msg"><?php _e( 'Custom fields allow you to customize your ad submission forms and collect more information. Each custom field needs to be added to a form layout in order to be visible on your website. You can create unlimited custom fields and each one can be used across multiple form layouts. It is highly recommended to NOT delete a custom field once it is being used on your ads because it could cause ad editing problems for your customers.', APP_TD ); ?></p>

				<table id="tblspacer" class="widefat fixed">

					<thead>
						<tr>
							<th scope="col" style="width:35px;">&nbsp;</th>
							<th scope="col"><?php _e( 'Name', APP_TD ); ?></th>
							<th scope="col" style="width:100px;"><?php _e( 'Type', APP_TD ); ?></th>
							<th scope="col"><?php _e( 'Description', APP_TD ); ?></th>
							<th scope="col" style="width:150px;"><?php _e( 'Modified', APP_TD ); ?></th>
							<th scope="col" style="text-align:center;width:100px;"><?php _e( 'Actions', APP_TD ); ?></th>
						</tr>
					</thead>

			<?php
				if ( $results ) {
			?>

					<tbody id="list">

				<?php
					$rowclass = '';
 					$i = 1;

					foreach ( $results as $result ) {
						$rowclass = ( 'even' == $rowclass ) ? 'alt' : 'even';
				?>

						<tr class="<?php echo $rowclass; ?>">
							<td style="padding-left:10px;"><?php echo $i; ?>.</td>
							<td><a href="?page=fields&amp;action=editfield&amp;id=<?php echo $result->field_id; ?>"><strong><?php echo esc_html( translate( $result->field_label, APP_TD ) ); ?></strong></a></td>
							<td><?php echo $result->field_type; ?></td>
							<td><?php echo esc_html( translate( $result->field_desc, APP_TD ) ); ?></td>
							<td><?php echo appthemes_display_date( $result->field_modified ); ?> <?php _e( 'by', APP_TD ); ?> <?php echo $result->field_owner; ?></td>
							<td style="text-align:center">

						<?php
							// show the correct edit options based on perms
							switch ( $result->field_perm ) {

								case '1': // core fields no editing
							?>

									<a href="?page=fields&amp;action=editfield&amp;id=<?php echo $result->field_id; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/edit.png" alt="" /></a>&nbsp;&nbsp;&nbsp;
									<img src="<?php echo get_template_directory_uri(); ?>/images/cross-grey.png" alt="" />

									<?php
									break;

								case '2': // core fields some editing
							?>

									<a href="?page=fields&amp;action=editfield&amp;id=<?php echo $result->field_id; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/edit.png" alt="" /></a>&nbsp;&nbsp;&nbsp;
									<img src="<?php echo get_template_directory_uri(); ?>/images/cross-grey.png" alt="" />

									<?php
									break;

								default: // regular fields full editing
									echo '<a href="?page=fields&amp;action=editfield&amp;id='. $result->field_id .'"><img src="'. get_template_directory_uri() .'/images/edit.png" alt="" /></a>&nbsp;&nbsp;&nbsp;';
									echo '<a onclick="return confirmBeforeDelete();" href="?page=fields&amp;action=delete&amp;id='. $result->field_id .'"><img src="'. get_template_directory_uri() .'/images/cross.png" alt="" /></a>';
									break;

							} // endswitch
						?>

							</td>
						</tr>

					<?php
						$i++;

					} // endforeach;
					?>

					</tbody>

				<?php
				} else {
				?>

					<tr>
						<td colspan="5"><?php _e( 'No custom fields found. This usually means your install script did not run correctly. Go back and try reactivating the theme again.', APP_TD ); ?></td>
					</tr>

				<?php } ?>

				</table>

			</div><!-- end wrap -->

	<?php } ?>


	<script type="text/javascript">
	/* <![CDATA[ */
		function confirmBeforeDelete() { return confirm("<?php _e( 'WARNING: Deleting this field will prevent any existing ads currently using this field from displaying the field value. Deleting fields is NOT recommended unless you do not have any existing ads using this field. Are you sure you want to delete this field?? (This cannot be undone)', APP_TD ); ?>"); }
	/* ]]> */
	</script>

<?php
}


/**
 * Deletes all the ClassiPress database tables.
 *
 * @return void
 */
function cp_delete_db_tables() {
	global $wpdb, $app_db_tables;

	echo '<p class="info">';

	foreach ( $app_db_tables as $key => $value ) {
		$sql = "DROP TABLE IF EXISTS " . $wpdb->prefix . $value;
		$wpdb->query( $sql );

		printf( __( "Table '%s' has been deleted.", APP_TD ), $value );
		echo '<br />';
	}

	echo '</p>';
}


/**
 * Deletes all the ClassiPress options.
 *
 * @return void
 */
function cp_delete_all_options() {
	global $wpdb;

	$wpdb->query( "DELETE FROM $wpdb->options WHERE option_name like 'cp_%'" );
	echo '<p class="info">' . __( 'All ClassiPress options have been deleted from the WordPress options table.', APP_TD ) . '</p>';
}


/**
 * Flushes the theme transients caches.
 *
 * @return string
 */
function cp_flush_all_cache() {
	global $app_transients;

	$output = '';

	foreach ( $app_transients as $key => $value ) {
		delete_transient( $value );
		$output .= sprintf( __( "ClassiPress '%s' cache has been flushed.", APP_TD ) . '<br />', $value );
	}

	return $output;
}

