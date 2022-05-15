<?php 
include_once('classes/Checkout.php');
$o=new Checkout(); 
$out=$o->productlist();
// print_r($out);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Simple Checkout</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.4.1.js"></script> 
</head>
<body>
<div class="container">
<hr>
<div class="row">

<div class="col-lg-8 col-offset-2">

<h2>Test Checkout Page</h2>
<br>
<p>Please Enter Number Of Product</p>
</div>
</div>
<div class="row">

<div class="col-lg-6">
<div class="page-header">
<form action="javascript:void(0)" method="post" id="ajax-form">

<?php foreach($out as $item=>$data){?>

    <div class="form-group">
<label>SKU-<?=$item?></label>
<input type="number" name="<?=$item?>" placeholder='Enter How much quntity you need item <?=$item?>' id="name" class="form-control" value="0" maxlength="50" >
</div>

    <?php } ?>



<input type="submit" class="btn btn-primary" name="submit" value="submit">
</form>
</div>
</div>
<div class="col-lg-4 ">
<hr>
<div id='show_message'></div>


</div>
</div>    
</div>
<script type="text/javascript">
$(document).ready(function($){
// hide messages 
$("#error").hide();
$("#show_message").hide();
// on submit...
$('#ajax-form').submit(function(e){
e.preventDefault();
$("#error").hide();

$.ajax({
type:"POST",
url: "ajaxprocess.php",
data: $(this).serialize(), // get all form field value in serialize form
success: function(response){
$("#show_message").fadeIn();
//$("#ajax-form").fadeOut();
$("#show_message").html(response);
}
});
});  
return false;
});
</script>
</body>
</html>