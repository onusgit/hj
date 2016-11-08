<?php
/**
 * Listing Submit Category Select Template.
 *
 * @package ClassiPress\Templates
 * @author  AppThemes
 * @since   ClassiPress 3.4
 */
?>
<!--<div class="listing-cat padding-20">

    <div id="step1">

        <h3 class=""><?php _e('»Post a new ad', APP_TD); ?></h3>

        <font class="">
        <?php _e('Do you want to advertise:', APP_TD); ?>
        </font>
        <label class="radio">
            <input type="radio" name="sec" value="3"> <a href="#" class="padding-right-25">
                <?php _e('Showing a car for sale or waiver', APP_TD); ?>
            </a>
        </label>
        <label class="radio padding-top-25">
            <input type="radio" name="sec" value="3"> <a href="#" class="padding-right-25">
               <?php _e('Showing a truck or heavy equipment for sale', APP_TD); ?>
            </a>
        </label>
        <label class="radio padding-top-25">
            <input type="radio" name="sec" value="3"> <a href="#" class="padding-right-25">
                <?php _e('Showing truck or equipment for rent', APP_TD); ?>
            </a>
        </label>
        <label class="radio padding-top-25">
            <input type="radio" name="sec" value="3"> <a href="#" class="padding-right-25">
                <?php _e('Showing tanks for sale', APP_TD); ?>
            </a>
        </label>
        <label class="radio padding-top-25">
            <input type="radio" name="sec" value="3"> <a href="#" class="padding-right-25">
                <?php _e('Showing spare parts or car services or accessories Cars For Sale', APP_TD); ?>
            </a>
        </label>
        <label class="radio padding-top-25">
            <input type="radio" name="sec" value="3"> <a href="#" class="padding-right-25">
                <?php _e('Showing Property for Sale', APP_TD); ?>
            </a>
        </label>
        <label class="radio padding-top-25">
            <input type="radio" name="sec" value="3"> <a href="#" class="padding-right-25">
                <?php _e('View Property for Rent', APP_TD); ?>
            </a>
        </label>
        <label class="radio padding-top-25">
            <input type="radio" name="sec" value="3"> <a href="#" class="padding-right-25">
                <?php _e('Showing commodity for sale - Vehicle not rated above', APP_TD); ?>
            </a>
        </label>
        <label class="radio padding-top-25">
            <input type="radio" name="sec" value="3"> <a href="#" class="padding-right-25">
                <?php _e('Order Brand', APP_TD); ?>
            </a>
        </label>
        <?php // do_action('appthemes_notices'); ?>
        <p class="dotted">&nbsp;</p>

        <form name="mainform" id="mainform" class="form_step" action="<?php echo appthemes_get_step_url(); ?>" method="post">
            <?php wp_nonce_field($action); ?>

            <ol>

                <li>
                    <div class="labelwrapper"><label><?php _e('Cost Per Listing:', APP_TD); ?></label></div>
                    <?php cp_cost_per_listing(); ?>
                    <div class="clr"></div>
                </li>

                <li>
                    <div class="labelwrapper"><label><?php _e('Select a Category:', APP_TD); ?></label></div>
                    <div id="ad-categories" style="display:block; margin-left:170px;">						
                        <div id="catlvl0">
                            <?php cp_dropdown_categories_prices(); ?>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                    <div id="ad-categories-footer" class="button-container1">
                        <input type="submit" name="getcat" id="getcat" class="btn btn-primary" value="<?php _e('continuation &rsaquo;&rsaquo;', APP_TD); ?>" />
                        <div id="chosenCategory"><input id="ad_cat_id" name="cat" type="input" value="-1" /></div>
                        <div style="clear:both;"></div>
                    </div>
                    <div style="clear:both;"></div>
                </li>

            </ol>

            <input type="hidden" name="action" value="<?php echo esc_attr($action); ?>" />
            <input type="hidden" name="ID" value="<?php echo esc_attr($listing->ID); ?>" />
        </form>

    </div>

</div> /shadowblock 



<div class="clr"></div>-->


<?php
/**
 * Listing Submit Category Select Template.
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

                        <h2 class="dotted"><?php _e('إرسال إعلانك', APP_TD); ?></h2>

                        <img src="<?php echo appthemes_locate_template_uri('images/step1.gif'); ?>" alt="" class="stepimg" />

                        <?php //do_action('appthemes_notices'); ?>
                          <span>بسم الله الرحمن الرحيم</span>
                          <span>قال الله تعالى " وَأَوْفُواْ بِعَهْدِ اللهِ إِذَا عَاهَدتُّمْ وَلاَ تَنقُضُواْ الأَيْمَانَ بَعْدَ تَوْكِيدِهَا وَقَدْ جَعَلْتُمُ اللهَ عَلَيْكُمْ كَفِيلاً " صدق الله العظيم</span>
                          <span>أتعهد وأقسم بالله أنا المعلن أن أدفع عمولة الموقع وهي 1% من قيمة السيارة في حالة بيعها عن طريق الموقع أو بسبب الموقع وأن هذه العموله هي أمانه في ذمتي. ملاحظة:عمولة الموقع هي على المعلن ولاتبرأ ذمة المعلن من </span>
                          <span>العمولة إلا في حال دفعها،ذمة المعلن لاتبرأ من العمولة بمجرد ذكر أن العمولة على المشتري في الإعلان</span>
                          <span>أتعهد أنا المعلن أن جميع المعلومات التي سوف أذكرها بالإعلان صحيحة وفي القسم الصحيح وأتعهد أن الصور التي سوف يتم عرضها هي صور حديثة لنفس السياره. وليست لسياره أخرى مشابهه</span>
                          <span>أتعهد انا المعلن أن أقوم بدفع العمولة خلال أقل من 10 أيام من تاريخ إستلام كامل سعر السلعه.</span>

                        <p class="dotted">&nbsp;</p>

                        <form name="mainform" id="mainform" class="form_step" action="<?php echo appthemes_get_step_url(); ?>" method="post">
                            <?php wp_nonce_field($action); ?>

                            <ol>
                                
                                <li>
                                    <div class="labelwrapper"><label><?php _e('اختر القسم', APP_TD); ?></label></div>
                                    <div id="ad-categories" style="display:block; margin-left:170px;">						
                                        <div id="catlvl0">
                                            <?php cp_dropdown_categories_prices(); ?>
                                            <div style="clear:both;"></div>
                                        </div>
                                    </div>
                                    <div id="ad-categories-footer" class="button-container">
                                        <input type="submit" name="getcat" id="getcat" class="btn btn-success" value="<?php _e('Go &rsaquo;&rsaquo;', APP_TD); ?>" />
                                        <div id="chosenCategory"><input id="ad_cat_id" name="cat" type="input" value="-1" /></div>
                                        <div style="clear:both;"></div>
                                    </div>
                                    <div style="clear:both;"></div>
                                </li>

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
