<?php
/**
 * Template Name: home
 *
 * @package ClassiPress\Templates
 * @author  AppThemes
 * @since   ClassiPress 3.0
 */
$current_user = wp_get_current_user(); // grabs the user info and puts into vars
?>


<div class="content">
    <div class="col-md-9">
        <div class="main-content-area">
            <div class="nav-area">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">التسجيل بالموقع</a></li>
                    <li><a data-toggle="tab" href="#menu1">التسجيل بالموقع</a></li>
                    <li><a data-toggle="tab" href="#menu2">التسجيل بالموقع</a></li>
                    <li><a data-toggle="tab" href="#menu3">التسجيل بالموقع</a></li>
                    <li><a data-toggle="tab" href="#menu4">التسجيل بالموقع</a></li>
                </ul>
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <h3>التسجيل بالموقع</h3>
                        <p>التسجيل بالموقع</p>
                    </div>
                    <div id="menu1" class="tab-pane fade">
                        <h3>التسجيل بالموقع</h3>
                        <p>Some content in menu 1.</p>
                    </div>
                    <div id="menu2" class="tab-pane fade">
                        <h3>التسجيل بالموقع</h3>
                        <p>Some content in menu 2.</p>
                    </div>
                    <div id="menu3" class="tab-pane fade">
                        <h3>التسجيل بالموقع</h3>
                        <p>Some content in menu 2.</p>
                    </div>
                    <div id="menu4" class="tab-pane fade">
                        <h3>التسجيل بالموقع</h3>
                        <p>Some content in menu 2.</p>
                    </div>
                </div>
            </div>
            <?php echo do_shortcode("[pt_view id=b9aca17dnr]"); ?>
            <div class="grid-list">
                <div class="container padding-0">
                    <div class="list-grid-icon">
                        <div class="btn-group width-100per">
                            <button href="#" id="list" class="btn btn-primary">
                                <i class="fa fa-camera-retro  "></i>
                            </button> 
                            <button href="#" id="grid" class="btn btn-primary active">
                                <i class="fa fa-globe"></i>
                            </button>
                            <a href="<?php echo get_site_url(); ?>/login" class="btn btn-success btn-lg pull-right btn_add"> <i class="fa fa-plus "></i><font><font class=""> Post your ad with us</font></font></a>
                        </div>
                    </div>
                    <div id="products" class="row margin-0 list-group padding-top-4per">
                        <div class="item col-md-12 nav-hide list-group-item margin-0">
                            <div class="col-md-2 title_nav">Before</div>
                            <div class="col-md-2 title_nav">Declared</div>
                            <div class="col-md-2 title_nav">City</div>
                            <div class="col-md-6 title_nav">Offer</div>
                        </div>
                        <div class="item col-xs-4 col-lg-4 list-group-item">
                            <div class="thumbnail">
                                <img class="group list-group-image hide" src="http://placehold.it/400x250/000/fff" alt="" />
                                <div class="caption">
                                    <div class="group inner list-group-item-heading col-md-2">
                                        Product title</div>
                                    <div class="group inner list-group-item-heading col-md-2">
                                        Product title</div>
                                    <div class="group inner list-group-item-heading col-md-2">
                                        Product title</div>
                                    <div class="group inner list-group-item-text col-md-6">
                                        <a href="<?php echo get_site_url(); ?>/ads/my-first-classified-ad/">
                                            <i class="fa fa-camera-retro font-18 black pull-left"></i>
                                            <div class="offer">
                                                Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                                                sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>                       
                        <div class="item col-xs-4 col-lg-4 list-group-item">
                            <div class="thumbnail">
                                <img class="group list-group-image hide" src="http://placehold.it/400x250/000/fff" alt="" />
                                <div class="caption">
                                    <div class="group inner list-group-item-heading col-md-2">
                                        Product title</div>
                                    <div class="group inner list-group-item-heading col-md-2">
                                        Product title</div>
                                    <div class="group inner list-group-item-heading col-md-2">
                                        Product title</div>
                                    <div class="group inner list-group-item-text col-md-6">
                                        <a href="<?php echo get_site_url(); ?>/ads/my-first-classified-ad/">
                                            <i class="fa fa-camera-retro font-18 black pull-left"></i>
                                            <div class="offer">
                                                Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                                                sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>                       
                        <div class="item col-xs-4 col-lg-4 list-group-item">
                            <div class="thumbnail">
                                <img class="group list-group-image hide" src="http://placehold.it/400x250/000/fff" alt="" />
                                <div class="caption">
                                    <div class="group inner list-group-item-heading col-md-2">
                                        Product title</div>
                                    <div class="group inner list-group-item-heading col-md-2">
                                        Product title</div>
                                    <div class="group inner list-group-item-heading col-md-2">
                                        Product title</div>
                                    <div class="group inner list-group-item-text col-md-6">
                                        <a href="<?php echo get_site_url(); ?>/ads/my-first-classified-ad/">
                                            <i class="fa fa-camera-retro font-18 black pull-left"></i>
                                            <div class="offer">
                                                Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                                                sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>                       
                        <div class="item col-xs-4 col-lg-4 list-group-item">
                            <div class="thumbnail">
                                <img class="group list-group-image hide" src="http://placehold.it/400x250/000/fff" alt="" />
                                <div class="caption">
                                    <div class="group inner list-group-item-heading col-md-2">
                                        Product title</div>
                                    <div class="group inner list-group-item-heading col-md-2">
                                        Product title</div>
                                    <div class="group inner list-group-item-heading col-md-2">
                                        Product title</div>
                                    <div class="group inner list-group-item-text col-md-6">
                                        <a href="<?php echo get_site_url(); ?>/ads/my-first-classified-ad/">
                                            <i class="fa fa-camera-retro font-18 black pull-left"></i>
                                            <div class="offer">
                                                Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                                                sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>                       
                        <div class="item col-xs-4 col-lg-4 list-group-item">
                            <div class="thumbnail">
                                <img class="group list-group-image hide" src="http://placehold.it/400x250/000/fff" alt="" />
                                <div class="caption">
                                    <div class="group inner list-group-item-heading col-md-2">
                                        Product title</div>
                                    <div class="group inner list-group-item-heading col-md-2">
                                        Product title</div>
                                    <div class="group inner list-group-item-heading col-md-2">
                                        Product title</div>
                                    <div class="group inner list-group-item-text col-md-6">
                                        <a href="<?php echo get_site_url(); ?>/ads/my-first-classified-ad/">
                                            <i class="fa fa-camera-retro font-18 black pull-left"></i>
                                            <div class="offer">
                                                Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                                                sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>                       
                        <div class="item col-xs-4 col-lg-4 list-group-item">
                            <div class="thumbnail">
                                <img class="group list-group-image hide" src="http://placehold.it/400x250/000/fff" alt="" />
                                <div class="caption">
                                    <div class="group inner list-group-item-heading col-md-2">
                                        Product title</div>
                                    <div class="group inner list-group-item-heading col-md-2">
                                        Product title</div>
                                    <div class="group inner list-group-item-heading col-md-2">
                                        Product title</div>
                                    <div class="group inner list-group-item-text col-md-6">
                                        <a href="<?php echo get_site_url(); ?>/ads/my-first-classified-ad/">
                                            <i class="fa fa-camera-retro font-18 black pull-left"></i>
                                            <div class="offer">
                                                Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                                                sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>                       
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-xs-12  col-sm-3 col-md-3 col-lg-3 round-border bg-grey">
        <p class="moreoptions showhideside" style="display: none;width:30%;margin-right:10px">إظهار الخيارات</p>
        <div class="side-col  ">
            <form class="form-horizontal  bs-example-control-sizing" name="drop_list" method="post" action="/process-more-models.php">
                <select class="form-control margin-top-10" name="city" id="marka">
                    <option value="marka">أختر ماركة السيارة</option>
                    <option value="تويوتا">تويوتا</option>
                    <option value="شيفروليه">شيفروليه</option>
                    <option value="نيسان">نيسان</option>
                    <option value="فورد">فورد</option>
                    <option value="مرسيدس">مرسيدس</option>
                    <option value="جي ام سي">جي ام سي</option>
                    <option value="بي ام دبليو">بي ام دبليو</option>
                    <option value="لكزس">لكزس</option>
                    <option value="جيب">جيب</option>
                    <option value="هونداي">هونداي</option><option value="هوندا">هوندا</option><option value="همر">همر</option><option value="انفنيتي">انفنيتي</option><option value="لاند روفر">لاند روفر</option><option value="مازدا">مازدا</option><option value="ميركوري">ميركوري</option><option value="فولكس واجن">فولكس واجن</option><option value="ميتسوبيشي">ميتسوبيشي</option><option value="لنكولن">لنكولن</option><option value="اوبل">اوبل</option><option value="ايسوزو">ايسوزو</option><option value="بورش">بورش</option><option value="كيا">كيا</option><option value="مازيراتي">مازيراتي</option><option value="بنتلي">بنتلي</option><option value="استون مارتن">استون مارتن</option><option value="كاديلاك">كاديلاك</option><option value="كرايزلر">كرايزلر</option><option value="سيتروين">سيتروين</option><option value="دايو">دايو</option><option value="ديهاتسو">ديهاتسو</option><option value="دودج">دودج</option><option value="فيراري">فيراري</option><option value="فيات">فيات</option><option value="جاكوار">جاكوار</option><option value="لامبورجيني">لامبورجيني</option><option value="رولز رويس">رولز رويس</option><option value="بيجو">بيجو</option><option value="سوبارو">سوبارو</option><option value="سوزوكي">سوزوكي</option><option value="فولفو">فولفو</option><option value="سكودا">سكودا</option><option value="اودي">اودي</option><option value="رينو">رينو</option><option value="بيوك">بيوك</option><option value="ساب">ساب</option><option value="سيات">سيات</option><option value="MG">MG</option><option value="بروتون">بروتون</option><option value="سانج يونج">سانج يونج</option><option value="تشيري">تشيري</option><option value="جيلي">جيلي</option><option value="ZXAUTO">ZXAUTO</option><option value="دبابات">دبابات</option><option value="قطع غيار وملحقات">قطع غيار وملحقات</option><option value="شاحنات ومعدات ثقيلة">شاحنات ومعدات ثقيلة</option></select>

                <select name="subcity" id="model" class="form-control margin-top-10">
                    <option value="">أختر نوع السيارة</option>
                </select>

                <select name="model" id="year" class="form-control margin-top-10">
                    <option value="">كل الموديلات</option>

                    <option value="2017">2017</option><option value="2016">2016</option><option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option></select>

                <select name="startmodel" class="form-control margin-top-10 moreelementsinmain" id="startmodel" style="display: none;">
                    <option value="">من موديل</option>
                    <option value="2017">2017</option><option value="2016">2016</option><option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option></select>
                <select name="endmodel" class="form-control moreelementsinmain" id="endmodel" style="display: none;">
                    <option value="">إلى موديل</option>
                </select>
                <select name="cities" class="form-control moreelementsinmain cities" id="cities" style="display: none;">
                    <option value="">كل المدن</option>
                    <option value="الرياض">الرياض</option><option value="الشرقيه">الشرقيه</option><option value="جده">جده</option><option value="مكه">مكه</option><option value="ينبع">ينبع</option><option value="حفر الباطن">حفر الباطن</option><option value="المدينة">المدينة</option><option value="الطايف">الطايف</option><option value="تبوك">تبوك</option><option value="القصيم">القصيم</option><option value="حائل">حائل</option><option value="أبها">أبها</option><option value="الباحة">الباحة</option><option value="جيزان">جيزان</option><option value="نجران">نجران</option><option value="الجوف">الجوف</option><option value="عرعر">عرعر</option><option value="الكويت">الكويت</option><option value="الإمارات">الإمارات</option><option value="قطر">قطر</option><option value="البحرين">البحرين</option></select>

                <button type="submit" class="btn  btn-success form-control  margin-top-10"><i class="fa fa-search"></i> </button>
                <div class="pull-left"> 
                    <p class="showmoreoptions moreoptions">خيارات أكثر</p>
                </div>
            </form>
            <br>
            <hr>
            <form action="/search.php" method="get" class="visible-xs">
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <input type="search" class="form-control margin-top-10" placeholder="ابحث عن سلعه ..." name="key">
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"> 
                        <button type="submit" class="btn btn-success  "><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
            <br class="visible-xs">
            <form action="/search-process.php" method="post" novalidate="">
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8"><input type="text" class="form-control " placeholder="ادخل رقم الاعلان" name="adsnumber" pattern="[0-9]*"></div>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"> <button type="submit" class="btn btn-primary ">انتقال</button></div>
                </div>
            </form>
            <hr>
            <div class="bs-example bs-example-tabs">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a data-toggle="tab" href="#home">سيارات</a></li>
                    <li class=""><a data-toggle="tab" href="#profile">سيارات بالصور</a></li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div id="home" class="tab-pane fade active in">
                        <!-- start img cats-->
                        <a class="gallerypic" href="/tags/تويوتا">
                            <img class="car_cont sprite-toyota" title="سيارات تويوتا" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="سيارات تويوتا">
                        </a>
                        <a class="gallerypic" href="/tags/نيسان">
                            <img class="car_cont sprite-nissan" title="نسيان" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="نسيان"></a>
                        <a class="gallerypic" href="/tags/فورد">
                            <img class="car_cont sprite-ford" title="سيارات فورد" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="سيارات فورد"></a>
                        <a class="gallerypic" href="/tags/لكزس">
                            <img class="car_cont sprite-lexus" title="لكزس" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="لكزس"></a>
                        <a class="gallerypic" href="/tags/شيفروليه">
                            <img class="car_cont sprite-chevrolet" title="سيارات شفروليه للبيع" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="سيارات شفروليه للبيع"></a> 
                        <a class="gallerypic" href="/tags/مرسيدس">
                            <img class="car_cont sprite-benz" title="سيارات مرسيدس" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="سيارات مرسيدس"></a>  
                        <a class="gallerypic" href="/tags/جي%20ام%20سي">
                            <img class="car_cont sprite-GMC" title="جي ام سي" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="جي ام سي"></a>
                        <a class="gallerypic" href="/tags/بي%20ام%20دبليو">
                            <img class="car_cont sprite-bmw" title="بي ام دبليو" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="بي ام دبليو"></a>
                        <a class="gallerypic" href="/tags/دودج">
                            <img class="car_cont sprite-dodge" title="سيارات دودج" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="سيارات دوج"></a>
                        <a class="gallerypic" href="/tags/همر">
                            <img class="car_cont sprite-mini" title="سيارات همر" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="سيارات همر"></a>
                        <a class="gallerypic" href="/tags/كاديلاك">
                            <img class="car_cont sprite-cadillac" title="سيارات كاديلاك" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="سيارات كاديلاك"></a>
                        <a class="gallerypic" href="/tags/اودي">
                            <img class="car_cont sprite-audi" title="اودي" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="اودي"></a>  
                        <a class="gallerypic" href="/tags/هوندا">
                            <img class="car_cont sprite-honda" title="هوندا" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="هوندا"></a>
                        <a class="gallerypic" href="/tags/لاند روفر">
                            <img class="car_cont sprite-landrover" title="لاندروفر" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="لاندروفر"></a> 
                        <a class="gallerypic" href="/tags/فولكس واجن">
                            <img class="car_cont sprite-volkswagen" title="فولكس واجن" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="فولكس واجن"></a>
                        <a class="gallerypic" href="/tags/مازدا">
                            <img class="car_cont sprite-mazda" title="مازدا" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="مازدا"></a>
                        <a class="gallerypic" href="/tags/ميتسوبيشي">
                            <img class="car_cont sprite-mitsubishi" title="ميتسوبيشي" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="ميتسوبيشي"></a>
                        <a class="gallerypic" href="/tags/هونداي">
                            <img class="car_cont sprite-hyundai" title="هونداي" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="هونداي"></a>
                        <a class="gallerypic" href="/tags/جيب">
                            <img class="car_cont sprite-jeep" title="جيب" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="جيب"></a>
                        <a class="gallerypic" href="/tags/انفنيتي">
                            <img class="car_cont sprite-infiniti" title="انفنيتي" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="انفنيتي"></a>
                        <a class="gallerypic" href="/tags/سوزوكي">
                            <img class="car_cont sprite-suzuki" title="سوزوكي" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="سوزوكي"></a>
                        <a class="gallerypic" href="/tags/كيا">
                            <img class="car_cont sprite-kia" title="كيا" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="كيا"></a>
                        <a class="gallerypic" href="/tags/كرايزلر">
                            <img class="car_cont sprite-chrysler" title="كرايزلر" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="كرايزلر"></a>
                        <a class="gallerypic" href="/tags/بورش">
                            <img class="car_cont sprite-porsche" title="بورش" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="بورش"></a>
                        <a class="gallerypic" href="/tags/قطع غيار وملحقات">
                            <img class="car_cont sprite-parts" title="قطع غيار وملحقات" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="قطع غيار وملحقات"></a>
                        <a class="gallerypic" href="/tags/شاحنات ومعدات ثقيلة">
                            <img class="car_cont sprite-trucks" title="شاحنات ومعدات ثقيلة" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="شاحنات ومعدات ثقيلة"></a>

                        <a class="gallerypic" href="/tags/دبابات">
                            <img class="car_cont sprite-bikes" title="دبابات" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="دبابات"></a>

                        <a class="gallerypic" href="/tags/سيارات تراثية">
                            <img class="car_cont sprite-classic" title="سيارات تراثية" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="سيارات تراثية"></a>

                        <a class="gallerypic" href="/tags/سيارات مصدومه">
                            <img class="car_cont sprite-damaged" title="سيارات مصدومه" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="سيارات مصدومه"></a>

                        <a class="gallerypic" href="/tags/سيارات للتنازل">
                            <img class="car_cont sprite-tanazul" title="سيارات للتنازل" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="سيارات للتنازل"></a>
                        <!-- end-->
                    </div>
                    <div id="profile" class="tab-pane fade ">
                        <a class="gallerypic" href="/pic/تويوتا">
                            <img class="car_cont sprite-toyota" title="سيارات تويوتا" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="سيارات تويوتا">
                            <span class="pic-icon"><i class="fa fa-camera-retro  "></i></span></a>
                        <a class="gallerypic" href="/pic/نيسان">
                            <img class="car_cont sprite-nissan" title="نسيان" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="نسيان">  <span class="pic-icon"><i class="fa fa-camera-retro  "></i></span></a>
                        <a class="gallerypic" href="/pic/فورد">
                            <img class="car_cont sprite-ford" title="سيارات فورد" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="سيارات فورد">  <span class="pic-icon"><i class="fa fa-camera-retro  "></i></span></a>
                        <a class="gallerypic" href="/pic/لكزس">
                            <img class="car_cont sprite-lexus" title="لكزس" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="لكزس">  <span class="pic-icon"><i class="fa fa-camera-retro  "></i></span></a>
                        <a class="gallerypic" href="/pic/شيفروليه">
                            <img class="car_cont sprite-chevrolet" title="سيارات شفروليه للبيع" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="سيارات شفروليه للبيع">  <span class="pic-icon"><i class="fa fa-camera-retro  "></i></span></a>  
                        <a class="gallerypic" href="/pic/مرسيدس">
                            <img class="car_cont sprite-benz" title="سيارات مرسيدس" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="سيارات مرسيدس">  <span class="pic-icon"><i class="fa fa-camera-retro  "></i></span></a> 
                        <a class="gallerypic" href="/pic/جي%20ام%20سي">
                            <img class="car_cont sprite-GMC" title="جي ام سي" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="جي ام سي">  <span class="pic-icon"><i class="fa fa-camera-retro  "></i></span></a>
                        <a class="gallerypic" href="/pic/بي%20ام%20دبليو">
                            <img class="car_cont sprite-bmw" title="بي ام دبليو" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="بي ام دبليو">  <span class="pic-icon"><i class="fa fa-camera-retro  "></i></span></a>
                        <a class="gallerypic" href="/pic/دودج">
                            <img class="car_cont sprite-dodge" title="سيارات دودج" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="سيارات دوج">  <span class="pic-icon"><i class="fa fa-camera-retro  "></i></span></a>
                        <a class="gallerypic" href="/pic/همر">
                            <img class="car_cont sprite-mini" title="سيارات همر" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="سيارات همر">  <span class="pic-icon"><i class="fa fa-camera-retro  "></i></span></a>
                        <a class="gallerypic" href="/pic/كاديلاك">
                            <img class="car_cont sprite-cadillac" title="سيارات كاديلاك" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="سيارات كاديلاك">  <span class="pic-icon"><i class="fa fa-camera-retro  "></i></span></a>
                        <a class="gallerypic" href="/pic/اودي">
                            <img class="car_cont sprite-audi" title="اودي" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="اودي">  <span class="pic-icon"><i class="fa fa-camera-retro  "></i></span></a> 
                        <a class="gallerypic" href="/pic/هوندا">
                            <img class="car_cont sprite-honda" title="هوندا" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="هوندا">  <span class="pic-icon"><i class="fa fa-camera-retro  "></i></span></a>
                        <a class="gallerypic" href="/pic/لاند روفر">
                            <img class="car_cont sprite-landrover" title="لاندروفر" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="لاندروفر">  <span class="pic-icon"><i class="fa fa-camera-retro  "></i></span></a>  
                        <a class="gallerypic" href="/pic/فولكس واجن">
                            <img class="car_cont sprite-volkswagen" title="فولكس واجن" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="فولكس واجن">  <span class="pic-icon"><i class="fa fa-camera-retro  "></i></span></a>
                        <a class="gallerypic" href="/pic/مازدا">
                            <img class="car_cont sprite-mazda" title="مازدا" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="مازدا">  <span class="pic-icon"><i class="fa fa-camera-retro  "></i></span></a>
                        <a class="gallerypic" href="/pic/ميتسوبيشي">
                            <img class="car_cont sprite-mitsubishi" title="ميتسوبيشي" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="ميتسوبيشي">  <span class="pic-icon"><i class="fa fa-camera-retro  "></i></span></a>
                        <a class="gallerypic" href="/pic/هونداي">
                            <img class="car_cont sprite-hyundai" title="هونداي" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="هونداي">  <span class="pic-icon"><i class="fa fa-camera-retro  "></i></span></a>
                        <a class="gallerypic" href="/pic/جيب">
                            <img class="car_cont sprite-jeep" title="جيب" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="جيب">  <span class="pic-icon"><i class="fa fa-camera-retro  "></i></span></a>
                        <a class="gallerypic" href="/pic/انفنيتي">
                            <img class="car_cont sprite-infiniti" title="انفنيتي" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="انفنيتي">  <span class="pic-icon"><i class="fa fa-camera-retro  "></i></span></a>
                        <a class="gallerypic" href="/pic/سوزوكي">
                            <img class="car_cont sprite-suzuki" title="سوزوكي" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="سوزوكي">  <span class="pic-icon"><i class="fa fa-camera-retro  "></i></span></a>
                        <a class="gallerypic" href="/pic/كيا">
                            <img class="car_cont sprite-kia" title="كيا" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="كيا">  <span class="pic-icon"><i class="fa fa-camera-retro  "></i></span></a>

                        <a class="gallerypic" href="/pic/كرايزلر">
                            <img class="car_cont sprite-chrysler" title="كرايزلر" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="كرايزلر">  <span class="pic-icon"><i class="fa fa-camera-retro  "></i></span></a>

                        <a class="gallerypic" href="/pic/بورش">
                            <img class="car_cont sprite-porsche" title="بورش" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="بورش">  <span class="pic-icon"><i class="fa fa-camera-retro  "></i></span></a>

                        <a class="gallerypic" href="/pic/قطع غيار وملحقات">
                            <img class="car_cont sprite-parts" title="قطع غيار وملحقات" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="قطع غيار وملحقات">  <span class="pic-icon"><i class="fa fa-camera-retro  "></i></span></a>  

                        <a class="gallerypic" href="/pic/شاحنات ومعدات ثقيلة">
                            <img class="car_cont sprite-trucks" title="شاحنات ومعدات ثقيلة" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="شاحنات ومعدات ثقيلة">  <span class="pic-icon"><i class="fa fa-camera-retro  "></i></span></a>

                        <a class="gallerypic" href="/pic/دبابات">
                            <img class="car_cont sprite-bikes" title="دبابات" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="دبابات">  <span class="pic-icon"><i class="fa fa-camera-retro  "></i></span></a>


                        <a class="gallerypic" href="/pic/سيارات تراثية">
                            <img class="car_cont sprite-classic" title="سيارات تراثية" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="سيارات تراثية"> <span class="pic-icon"><i class="fa fa-camera-retro  "></i></span></a>

                        <a class="gallerypic" href="/pic/سيارات مصدومه">
                            <img class="car_cont sprite-damaged" title="سيارات مصدومه" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="سيارات مصدومه"> <span class="pic-icon"><i class="fa fa-camera-retro  "></i></span></a>

                        <a class="gallerypic" href="/pic/سيارات للتنازل">
                            <img class="car_cont sprite-tanazul" title="سيارات للتنازل" src="<?php echo get_template_directory_uri(); ?>/images/clear.gif" alt="سيارات للتنازل"> <span class="pic-icon"><i class="fa fa-camera-retro  "></i></span></a>
                    </div>

                </div>
            </div>
            <hr>
            <ul class="nav nav-tabs">
                <li class="active"><a href="/tags/">أجهزة</a></li>
            </ul>
            <br>
            <div>
                <div class="glyph">
                    <a href="/tags/ابل Apple">   <i class="fa fa-apple fa-3x"></i> </a>
                </div>
                <div class="glyph">
                    <a href="/tags/سامسونج Samsung" class="tag-cat"><i class="icon-Samsung fa-3x"></i></a>
                </div>
                <div class="glyph">
                    <a href="/tags/بلاك بيري BlackBerry" class="tag-cat"><i class="icon-BlackBerry fa-3x"></i></a>
                </div>
                <div class="glyph">
                    <a href="/tags/مايكروسوفت Microsoft" class="tag-cat"><i class="icon-Microsoft fa-3x"></i></a>
                </div>
                <div class="glyph">
                    <a href="/tags/فوجي فيلم fujifilm" class="tag-cat"><i class="icon-Fujifilm fa-3x"></i></a>
                </div>
                <div class="glyph">
                    <a href="/tags/توشيبا Toshiba" class="tag-cat"><i class="icon-Toshiba fa-3x"></i></a>
                </div>

                <div class="glyph">
                    <a href="/tags/نوكيا Nokia" class="tag-cat"><i class="icon-Nokia fa-3x"></i></a>
                </div>

                <div class="glyph">

                    <a href="/tags/كانون Canon" class="tag-cat"><i class="icon-Canon fa-3x"></i></a>
                </div>
                <div class="glyph">

                    <a href="/tags/سوني Sony" class="tag-cat"><i class="icon-Sony fa-3x"></i></a>
                </div>
                <div class="glyph">

                    <a href="/tags/ال جي LG" class="tag-cat"><i class="icon-LG fa-3x"></i></a>
                </div>

                <div class="glyph">
                    <a href="/tags/اتش تي سي htc" class="tag-cat"><i class="icon-HTC fa-3x"></i></a>
                </div>

                <div class="glyph">
                    <a href="/tags/أرقام مميزة" class="tag-cat">أرقام مميزة</a>
                </div>
                <br> <br> <br>
            </div>

            <div class="clear"></div>
            <hr>
            <ul class="nav nav-tabs">
                <li class="active"><a href="#">أقسام أخرى</a></li>
            </ul>
            <br>
            <div>
                <div class="glyph">

                    <a href="/tags/أبل"><i class="icon-camel fa-3x"></i> </a>
                </div>

                <div class="glyph">
                    <a href="/tags/غنم"><i class="icon-sheep2 fa-3x"></i> </a>
                </div>

                <div class="glyph">
                    <a href="/tags/ماعز"><i class="icon-goat fa-3x"></i> </a>
                </div>

                <div class="glyph">
                    <a href="/tags/دجاج"><i class="icon-chicken fa-3x"></i> </a>
                </div>

                <div class="glyph">
                    <a href="/tags/قطط"><i class="icon-cat fa-3x"></i> </a>
                </div>

                <div class="glyph">
                    <a href="/tags/ببغاء"><i class="icon-parrot fa-3x"></i> </a>
                </div>
                <br>
                <div class="glyph">
                    <a href="/tags/اثاث"><i class="icon-athath fa-3x"></i> </a>
                </div>
            </div>
            <div class="clear"></div>
            <hr>
            <ul class="nav nav-tabs">
                <li class="active"><a href="#">عقارات</a></li>
            </ul>
            <br>
            <div>
                <a title="اراضي للبيع" href="/tags/اراضي للبيع" class="tag">اراضي للبيع </a><br>
                <a title="اراضي تجارية للبيع" href="/tags/اراضي تجارية للبيع" class="tag">اراضي تجارية للبيع </a><br>
                <a title="شقق للايجار" href="/tags/شقق للايجار" class="tag">شقق للايجار </a><br>
                <a title="شقق للبيع" href="/tags/شقق للبيع" class="tag">شقق للبيع </a><br>
                <a title="فلل للبيع" href="/tags/فلل للبيع" class="tag">فلل للبيع </a><br>
                <a title="فلل للايجار" href="/tags/فلل للايجار" class="tag">فلل للايجار </a><br>
                <a title="عماره للايجار" href="/tags/عماره للايجار" class="tag">عماره للايجار </a><br>
                <a title="محلات للتقبيل" href="/tags/محلات للتقبيل" class="tag">محلات للتقبيل </a><br>
                <a title="محلات للايجار" href="/tags/محلات للايجار" class="tag">محلات للايجار </a><br>
                <a title="مزارع للبيع" href="/tags/مزارع للبيع" class="tag">مزارع للبيع </a><br>
                <a title="استراحات للبيع" href="/tags/استراحات للبيع" class="tag">استراحات للبيع </a><br>
                <a title="استراحات للايجار" href="/tags/استراحات للايجار" class="tag">استراحات للايجار </a><br>
                <a title="بيوت للبيع" href="/tags/بيوت للبيع" class="tag">بيوت للبيع </a><br>
                <a title="بيوت للايجار" href="/tags/بيوت للايجار" class="tag">بيوت للايجار </a><br>
                <a title="ادوار للايجار" href="/tags/ادوار للايجار" class="tag">ادوار للايجار </a><br>
            </div>
            <div class="clear"></div>
            <hr>
            <h3><a href="http://montada.haraj.com.sa">منتدى السيارات </a></h3>
        </div>
    </div>


    <!-- /content -->
    <script>

    </script>