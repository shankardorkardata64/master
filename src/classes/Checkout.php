<?php


include_once('Product.php');

Class Checkout extends Product
{

 public function checkouti($item)
 {
   $list=$this->inputtoarray($item);
   
   

   $amount=0;
    foreach($list as $key=>$item)
    {
       $amount=$amount+$this->logic($key,$item);
    }
    
    if(isset($list['A']) AND isset($list['D']))
       {
        $product=$this->productlist('D');
        $numA=$list['A'];
        $numD=$list['D'];
        $alldamount=$numD*$product['PRICE'];
        $withoutofferDnum=$numD-$numA;
        
        $withofferDnum=$numA;

        $num1=$withoutofferDnum*$product['PRICE'];
        $num2=$withofferDnum*$product['WITHA'];
        $total=$num1+$num2;
       $amount=$amount-$alldamount+$total;
    }
     return $amount;
 }
 public function logic($key,$n)
 {
   $product=$this->productlist($key);
   if(!empty($product)){
   $amountbefore=$product['PRICE'];
   $offer=@$product['DISCOUNT'];
   if(!empty($offer))
   {
      $fa=array();
      
    //  ******************
    $rrr=$toa=0;
    foreach($offer as $value)
    {        
        $offeron=$value['QUANTITY'];  
        $amount=$value['AMOUNT']; 
        $rrr=$rrr+$offeron;
        $toa=$toa+$amount;
    }
    // **********
      
  if($rrr!=$n)
  {
   foreach($offer as $value)
   {
        $offeron=$value['QUANTITY'];  
        $amount=$value['AMOUNT']; 
         if($n>=$offeron)
          {   
              if($n%$offeron==0)
              {
              $productremain=$n%$offeron;
              $offer_on_product1=$n/$offeron;
              $offer_on_product=$offer_on_product1*$offeron;
              $amount2=$offer_on_product/$offeron*$amount;
              $amo=0+$amount2;  
              }
              else
              {
              $productremain=$n%$offeron;
              $offer_on_product=$n-$productremain;
              $amount1=$productremain*$amountbefore;
              $amount2=$offer_on_product/$offeron*$amount;
              $amo=$amount1+$amount2; 
              
              }

         }
        else
        {
            $productremain=$offer_on_product=0;
            $amo=$n*$amountbefore;
        }
        $fa=array_merge($fa,array($amo));

       
 }
 
   sort($fa); // print_r($fa);
   $amo=$fa[0];
}
else
{
    $amo=$toa;
}


}
else
{
    $amo=$amountbefore*$n;
}
   }
   else
   {
       $amo=0;
      
   }  
  return $amo;
}
}


$o=new Checkout(); 
$out=$o->logic('A',3);
print_r($out);