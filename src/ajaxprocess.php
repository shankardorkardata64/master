<?php
include_once('classes/Checkout.php');
$j=$_POST;
$s='';
foreach($j as $k=>$no)
{   
    $rr='';
    for($i=1;$i<=$no;$i++)
    {
    $rr .=$k;
    }
    $s =$s.$rr;
    
}
  $o=new Checkout();
 $out=$o->checkouti($s);
echo '<h5>Final Amount will be :-  EURO '.$out.'</h5>';
?>