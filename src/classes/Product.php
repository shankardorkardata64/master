<?php
Class Product
{
  
    static function productlist($SKU='')
    {
        $array=array(
            'A'=>array('PRICE'=>50,'DISCOUNT'=>array(array('QUANTITY'=>3,'AMOUNT'=>130))),
            'B'=>array('PRICE'=>30,'DISCOUNT'=>array(array('QUANTITY'=>2,'AMOUNT'=>45))),
            'C'=>array('PRICE'=>20,'DISCOUNT'=>array(array('QUANTITY'=>2,'AMOUNT'=>38),array('QUANTITY'=>3,'AMOUNT'=>50))),
            'D'=>array('PRICE'=>15,'WITHA'=>5),
            'E'=>array('PRICE'=>5));
       
            if($SKU=='')
                return $array;
             $ou=@$array[$SKU];
             if($ou)
                return $ou; 
             return false;
             
   }

   public function is_valid_sku($sku)
   {
     $arrsuk=$this->inputtoarray($sku);
    foreach($arrsuk as  $r=>$kay)
    {
     $out=$this->productlist($r);
    
     if($out==false)
     {
       return false;
     }
    
    }   

    return true;
   }

  public function inputtoarray($item)
  {
    $arr=str_split($item);
    return array_count_values($arr);
  }

   public function is_discount_on($key)
   {
    $data=$this->productlist($key);
    if($data!=false)
    {
     if(in_array(@$data['DISCOUNT'],$data))
     {
      return $data['DISCOUNT'];
     }
     else
     {
      return false;
     }
   }
  else
  {
    return false;
  }
   }


public function is_discount_avalable_on($key)
   {
    $data=$this->productlist($key);
    if($data!=false)
    {
     if(in_array(@$data['DISCOUNT'],$data))
     {
      return true;
     }
     else
     {
      return false;
     }
   }
  else
  {
    return false;
  }
   }
}


?>