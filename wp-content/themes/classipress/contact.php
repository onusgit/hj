<?php
/**
 * Template Name: contact
 */
$current_user = wp_get_current_user(); // grabs the user info and puts into vars
?>
<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-25">
        <h2>أتصل بنا</h2>
        <div class="comment">
            <div class="alert alert-info">* نعتذر عن الإتصال بأرقام الجوالات، وسيلة التواصل لدينا هي البريد الإلكتروني <br>
                * تأكد من صحة بريدك الإلكتروني حتى يتم الرد عليك<br>
            </div>
            <form action="" method="post" name="postform" enctype="multipart/form-data" onsubmit="return validate_form(this);">
                <table class="table  tableMsg table-borderedAds tableextra">
                    <tbody><tr>
                            <th colspan="2"> الإتصال بنا </th>
                        </tr>
                        <tr>
                            <td width="15%">
                                البريد الإلكتروني
                            </td><td align="right"> <input type="text" name="from" size="45" maxlength="60" value="1mgbyt@gmail.com" class="form-control"></td>
                        </tr>
                        <tr>

                            <td width="15%">سبب الإتصال</td><td align="right"> <input type="text" name="subject" size="45" class="form-control" value=""></td>
                        </tr>
                        <tr>

                            <td>نص الرساله<br></td>

                            <td> 
                                <textarea name="message" cols="6" rows="5" id="message" class="form-control"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td class="row4" colspan="2">
                                <input class="btn btn-primary" name="submit" type="submit" value="إرســـال">      </td>
                        </tr>
                    </tbody></table>
            </form>
        </div></div></div>

<!-- /content -->
