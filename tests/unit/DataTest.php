<?php
use PHPUnit\Framework\TestCase;
include_once('src/classes/Checkout.php');

class DataTest extends TestCase
{

     
    

    
    /**
     * @dataProvider sku
     */
 public function testQuestion_Format($sku,$expected)
 {
    $o=new Checkout();
    $out=$o->checkouti($sku); //This will for 4 units of product having SKU C 
    $this->assertEquals($out,$expected);
 }

 public function sku()
 {
     return [
         '-If you buy 5 ‘C’s you would get 2 for 38 + 3 for 50'=>['CCCCC',88],
         '-If you buy 4 ‘C’s you would get 3 for 50 + 1 for 20'=>['CCCC',70],
         '-if you buy 10 ‘D’s and 6 ‘A’s, 6 of the ‘D’s will cost 5 each whilst the other 4 will cost 15'=>['AAAAAADDDDDDDDDD',350]
     ];
 }




    /**
     * @dataProvider skulist
     */
    public function test_check_single_sku_with_price($sku,$num,$expected)
    {
       $o=new Checkout();
       $out=$o->logic($sku,$num); //This will for 4 units of product having SKU C 
       $this->assertEquals($out,$expected);
    }


    public function skulist()
    {
        return [
              '-This will Check amount is valid or not for single SKU(A) in multiple(3 Unit) buy test'=>['A','3',130],
              '-This will Check amount is valid or not for single SKU(B) in multiple(2 Unit) buy test'=>['B','2',45],
              
        ];
    }


    /**
     * @dataProvider additionProvider
     */
    public function test_Is_Discount_is_available_or_not($sku, $expected)
    {
        $o=new Checkout(); 
        $out=$o->is_discount_avalable_on($sku); // A/B/C/D/E/
        $this->assertEquals($out,$expected);


    }

    public function additionProvider()
    {
        return [
            '-Check Discount Available on Selected SKU  C (Discount is  available actually)'=> ['C',true],
            '-Check Discount Available on Selected SKU  A (Discount is  available actually)'=> ['A',true],
            '-Check Discount Available on Selected SKU  E (Discount is not available actually) '=> ['E',false],
        ];
    }

     /**
     * @dataProvider additionProvider1
     */
    public function test_Given_SKU_list_is_Valid_Or_Not($sku, $expected)
    {
        $o=new Checkout(); 
        $out=$o->is_valid_sku($sku);
        $this->assertEquals($out,$expected);
    }

    public function additionProvider1()
    {
        return [
            '-We provide input of SKU and return false if SKU is not valid(Provided input AAAB)'=>['AAAB',true],
        ];
    }




}
?>