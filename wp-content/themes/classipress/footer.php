<?php
/**
 * Generic Footer template.
 *
 * @package ClassiPress\Templates
 * @author  AppThemes
 * @since   ClassiPress 1.0
 */
global $cp_options;
?>
<div class="clr"></div>
<div class="footer row ">    
    <div class="footer_main_res">
        <div class="dotted">
            <?php // if (!dynamic_sidebar('sidebar_footer')) : ?> 
            <!-- no dynamic sidebar so don't do anything --> 
            <?php //endif; ?>
            <div class="clr"></div>
        </div>

        <?php cp_website_current_time(); ?>
        <div class="clr"></div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-0">
            <hr>

            <p class="text-center">كل الحقوق محفوظ </p>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-0">
                <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2  pull-right"><hr>
                    <div class="padding-bottom-10per">
                        <a href="/city/الرياض" class="city-head"> حراج الرياض</a>
                    </div>
                    <div class="padding-bottom-10per">
                        <a href="/city/الشرقيه" class="city-head"> حراج الشرقيه</a>
                    </div>
                    <div class="padding-bottom-10per">
                        <a href="/city/جده" class="city-head"> حراج جده</a>  
                    </div>
                    <div class="padding-bottom-10per">
                        <a href="/city/مكه" class="city-head">حراج مكه</a>
                    </div>
                    <div class="padding-bottom-10per">
                        <a href="/city/حائل" class="city-head">حراج حائل</a>  
                    </div>
                    <div class="padding-bottom-10per">
                        <a href="/city/القصيم" class="city-head"> حراج القصيم</a> 
                    </div>
                    <div class="padding-bottom-10per">
                        <a href="/city/أبها" class="city-head"> حراج أبها</a>   
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2 pull-right"><hr>
                    <div class="padding-bottom-10per">
                        <a href="/city/المدينة" class="city-head">حراج المدينة</a>
                    </div>
                    <div class="padding-bottom-10per">
                        <a href="/city/حفر الباطن" class="city-head"> حراج حفر الباطن</a>  
                    </div>
                    <div class="padding-bottom-10per">
                        <a href="/city/ينبع" class="city-head"> حراج ينبع</a>  
                    </div>
                    <div class="padding-bottom-10per">
                        <a href="/city/تبوك" class="city-head"> حراج تبوك</a>
                    </div>
                    <div class="padding-bottom-10per">
                        <a href="/city/نجران" class="city-head"> حراج نجران</a>
                    </div>
                    <div class="padding-bottom-10per">
                        <a href="/city/عرعر" class="city-head"> حراج عرعر</a>
                    </div>
                    <div class="padding-bottom-10per">
                        <a href="/city/الطايف" class="city-head"> حراج الطايف</a>
                    </div>
                    <div class="padding-bottom-10per">
                        <a href="/city/عرعر" class="city-head"> حراج عرعر</a>
                    </div>
                </div>
                <div class="clearfix visible-xs"></div>
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 pull-right font-16">
                    <hr>
                    <div class="padding-bottom-5per">
                        <a href="/commission">حساب عمولة الموقع</a>
                    </div>
                    <div class="padding-bottom-5per">
                        <a href="/member"> عضوية معارض السيارات و مكاتب العقار</a>
                    </div>
                    <div class="padding-bottom-5per">
                        <a href="/f"> <i class="star fa fa-star "> </i> الإعلانات المميزة</a>
                    </div>
                    <div class="padding-bottom-5per">
                        <a href="/n"> رسوم الخدمات المكررة</a>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 font-16"><hr>
                    <div class="padding-bottom-5">
                        <a href="<?php echo get_site_url(); ?>/contact">اتصل بنا</a>
                    </div>
<!--                    <div class="padding-bottom-5">
                        <a href="#">نظام الخصم</a>
                    </div>-->
<!--                    <div class="padding-bottom-5">
                        <a href="<?php echo get_site_url(); ?>/check-account">القائمة السوداء</a>
                    </div>-->
                    <div class="padding-bottom-5">
                        <a href="/notallowed">قائمة السلع والإعلانات الممنوعة</a>
                    </div>
                    <div class="padding-bottom-5">
                        <a href="/rules">معاهدة إستخدام الموقع</a>
                    </div>
                    <div class="padding-bottom-5">
                        <a href="/rating">نظام التقييم</a>
                    </div>
<!--                    <div class="padding-bottom-5">
                        <a href="http://montada.haraj.com.sa">الانتقال لمنتدى السيارات</a>
                    </div>-->
<!--                    <div class="padding-bottom-5">
                        <a href="/haraj-app.php"><i class="fa fa-android"></i> <i class="fa fa-apple"></i> <i class="fa fa-windows"> </i> تطبيق حراج</a>
                    </div>-->
                </div>
            </div>  
        </div>
    </div>
</div>
<!-- /footer -->
