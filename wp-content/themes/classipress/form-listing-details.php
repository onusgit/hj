<?php
/**
 * Listing Submit Details Template.
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

                    <div id="step1">

                        <h2 class="dotted"><?php _e('Submit Your Listing', APP_TD); ?></h2>

                        <img src="<?php echo appthemes_locate_template_uri('images/step1.gif'); ?>" alt="" class="stepimg" />

                        <?php //do_action( 'appthemes_notices' ); ?>
                        <span>بسم الله الرحمن الرحيم</span>
                        <span>قال الله تعالى " وَأَوْفُواْ بِعَهْدِ اللهِ إِذَا عَاهَدتُّمْ وَلاَ تَنقُضُواْ الأَيْمَانَ بَعْدَ تَوْكِيدِهَا وَقَدْ جَعَلْتُمُ اللهَ عَلَيْكُمْ كَفِيلاً " صدق الله العظيم</span>
                        <span>أتعهد وأقسم بالله أنا المعلن أن أدفع عمولة الموقع وهي 1% من قيمة السيارة في حالة بيعها عن طريق الموقع أو بسبب الموقع وأن هذه العموله هي أمانه في ذمتي. ملاحظة:عمولة الموقع هي على المعلن ولاتبرأ ذمة المعلن من </span>
                        <span>العمولة إلا في حال دفعها،ذمة المعلن لاتبرأ من العمولة بمجرد ذكر أن العمولة على المشتري في الإعلان</span>
                        <span>أتعهد أنا المعلن أن جميع المعلومات التي سوف أذكرها بالإعلان صحيحة وفي القسم الصحيح وأتعهد أن الصور التي سوف يتم عرضها هي صور حديثة لنفس السياره. وليست لسياره أخرى مشابهه</span>
                        <span>أتعهد انا المعلن أن أقوم بدفع العمولة خلال أقل من 10 أيام من تاريخ إستلام كامل سعر السلعه.</span>

                        <p class="dotted">&nbsp;</p>

                        <form name="mainform" id="mainform" class="form_step" action="<?php echo appthemes_get_step_url(); ?>" method="post" enctype="multipart/form-data">
                            <?php wp_nonce_field($action); ?>

                            <ol>
                                <li>
                                    <div class="labelwrapper"><label><?php _e('الفئة:', APP_TD); ?></label></div>
                                    <div class="text-left"><strong><?php echo $category->name; ?></strong>&nbsp;&nbsp;<small><a href="<?php echo $select_category_url; ?>"><?php _e('(تغيير)', APP_TD); ?></a></small></div>
                                </li>

                                <?php cp_show_form($category->term_id, $listing); ?>

                                <p class="btn1">
                                    <input type="submit" name="step1" id="step1" class="btn btn-success" value="<?php _e('المتابعة &rsaquo;&rsaquo;', APP_TD); ?>" />
                                </p>

                            </ol>

                            <input type="hidden" name="action" value="<?php echo esc_attr($action); ?>" />
                            <input type="hidden" name="ID" value="<?php echo esc_attr($listing->ID); ?>" />
                        </form>

                    </div>

                </div><!-- /shadowblock -->

            </div><!-- /shadowblock_out -->

            <div class="clr"></div>

        </div><!-- /content_res -->

    </div><!-- /content_botbg -->

</div><!-- /content -->
