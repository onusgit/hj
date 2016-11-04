<?php
/**
 * Free Listing Received Template.
 *
 * @package ClassiPress\Templates
 * @author  AppThemes
 * @since   ClassiPress 3.4
 */
?>


<div class="content">

	<div class="content_botbg">

		<div class="content_res">

			<div class="shadowblock_out">

				<div class="shadowblock">

					<div id="step3">

						<h2 class="dotted"><?php _e( 'تم نشر الإعلان بنجاح', APP_TD ); ?></h2>

						<img src="<?php echo appthemes_locate_template_uri( 'images/step3.gif' ); ?>" alt="" class="stepimg" />

						<?php //do_action( 'appthemes_notices' ); ?>
                                                <span>بسم الله الرحمن الرحيم</span>
                          <span>قال الله تعالى " وَأَوْفُواْ بِعَهْدِ اللهِ إِذَا عَاهَدتُّمْ وَلاَ تَنقُضُواْ الأَيْمَانَ بَعْدَ تَوْكِيدِهَا وَقَدْ جَعَلْتُمُ اللهَ عَلَيْكُمْ كَفِيلاً " صدق الله العظيم</span>
                          <span>أتعهد وأقسم بالله أنا المعلن أن أدفع عمولة الموقع وهي 1% من قيمة السيارة في حالة بيعها عن طريق الموقع أو بسبب الموقع وأن هذه العموله هي أمانه في ذمتي. ملاحظة:عمولة الموقع هي على المعلن ولاتبرأ ذمة المعلن من </span>
                          <span>العمولة إلا في حال دفعها،ذمة المعلن لاتبرأ من العمولة بمجرد ذكر أن العمولة على المشتري في الإعلان</span>
                          <span>أتعهد أنا المعلن أن جميع المعلومات التي سوف أذكرها بالإعلان صحيحة وفي القسم الصحيح وأتعهد أن الصور التي سوف يتم عرضها هي صور حديثة لنفس السياره. وليست لسياره أخرى مشابهه</span>
                          <span>أتعهد انا المعلن أن أقوم بدفع العمولة خلال أقل من 10 أيام من تاريخ إستلام كامل سعر السلعه.</span>
						<div class="thankyou">
						<?php
							if ( 'publish' == get_post_status( $listing->ID ) ) {

								echo html( 'h3', __( 'شكرا! تم نشر الإعلان وهو الان متاح على الموقع.', APP_TD ) );
								echo html( 'p', __( 'للتعديل قم بزيارة لوحة التحكم الخاصة بك.', APP_TD ) );
								echo html( 'a', array( 'href' => get_permalink( $listing->ID ) ), __( 'شاهد اعلانك من هنا.', APP_TD ) );

							} else {

								echo html( 'h3', __( 'Thank you! Your ad listing has been submitted for review.', APP_TD ) );
								echo html( 'p', __( 'You can check the status by viewing your dashboard.', APP_TD ) );
								echo html( 'a', array( 'href' => get_permalink( $listing->ID ) ), __( 'شاهد اعلانك من هنا.', APP_TD ) );

							}
						?>

						<?php do_action( 'cp_listing_form_end_free', $listing ); ?>
						</div>

					</div>

				</div><!-- /shadowblock -->

			</div><!-- /shadowblock_out -->

			<div class="clr"></div>

		</div><!-- /content_res -->

	</div><!-- /content_botbg -->

</div><!-- /content -->
