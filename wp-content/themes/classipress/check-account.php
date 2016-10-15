<?php
/**
 * Template Name: check-account
 */
$current_user = wp_get_current_user(); // grabs the user info and puts into vars
?>

<div class="row padding-20">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<h2>القائمة السوداء</h2>
		
<h3 class="green">البحث في القائمة السوداء</h3>

القائمة السوداء هي قائمة بإرقام حسابات وأرقام جوالات من يقومون بإساءة إستخدام الموقع لأغراض ممنوعه مثل الغش أو الأحتيال أو   مخالفة قوانين الموقع
<br>


<span class="red">الرقم قصير جدا</span>

<br>



<br>
<form action="" method="post" name="form2"> 
	
		<input name="acc_num" size="60" placeholder="أدخل رقم الحساب أو رقم الجوال هنا" type="text" class="form-control" style="width:50%">
 <span class="red">* أرقام فقط بدون حروف</span><br><input name="submit" class="btn btn-primary" value="      فحص »    " type="submit">

</form>

<br>


</div>
</div>
<!-- /content -->
