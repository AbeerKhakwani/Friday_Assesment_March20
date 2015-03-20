<?php
/**
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 */
 require_once "src/Client.php";
 require_once "src/Stylist.php";
 $DB = new PDO('pgsql:host=localhost;dbname=hair_salon');
 class StylistTest extends PHPUnit_Framework_TestCase
 {
     protected function tearDown()
     {
       Stylist::deleteAll();
       Client::deleteAll();
     }

     function test_save(){
         //Arrange
         $type = "Italian";
         $id = null;
         $test_cuisine = new Stylist($type, $id);
         //Act
         $test_cuisine->save();
         $result = Stylist::getAll();
         $this->assertEquals($test_cuisine, $result[0]);
     }
     function test_getAll()
     {
         //Arrange
         $name = "Work stuff";
         $id = null;
         $name2 = "Home stuff";
         $id2 = null;
         $test_Cuisine = new Stylist($name, $id);
         $test_Cuisine->save();
         $test_Cuisine2 = new Stylist($name2, $id2);
         $test_Cuisine2->save();
         //Act
         $result = Stylist::getAll();
         //Assert
         $this->assertEquals([$test_Cuisine, $test_Cuisine2], $result);
     }
     function test_find()
    {
        //Arrange
        $name = "american";
        $id = null;

        $test_cuisine = new Stylist($name, $id);
        $test_cuisine->save();

        $name2 = "italian";
        $id2 = 2;
        $test_cuisine2 = new Stylist($name2, $id2);
        $test_cuisine2->save();
        //Act
        $id_to_find=$test_cuisine2->getId();
        $result = Stylist::find($id_to_find);
        //Assert
        $this->assertEquals($test_cuisine2, $result);
    }
    function testGetRestaurants(){
      //Arrange
      $name = "Work stuff";
      $id = null;
      $test_cuisine= new Stylist($name, $id);
      $test_cuisine->save();
      $cuisine_id=$test_cuisine->getId();



      $name = "Email client";
      $address = "main street";
      $test_restaurant = new Client( $name, $id, $cuisine_id);
      $test_restaurant->save();


      $name2 = "Meet with boss";
      $address2 = "main stress";
      $test_restaurant2 = new Client($name2, $id ,$cuisine_id);
      $test_restaurant2->save();
      //Act
      $result = $test_cuisine->getClients();
      //Assert
      $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
  }
  function testUpdate()
 {
     //Arrange
     $type = "Work stuff";
     $id = 1;
     $test_cuisine = new Stylist($type, $id);
     $test_cuisine->save();
     $new_type = "Home stuff";
     //Act
     $test_cuisine->update($new_type);
     //Assert
     $this->assertEquals("Home stuff", $test_cuisine->getName());
 }
 function testDelete()
   {
       //Arrange
       $type = "Work stuff";
       $id = 1;
       $test_cuisine = new Stylist($type, $id);
       $test_cuisine->save();
       $type2 = "Work stuff";
       $id2 = 1;
       $test_cuisine2 = new Stylist($type2, $id2);
       $test_cuisine2->save();
       //Act
       $test_cuisine->delete();
       //Assert
       $this->assertEquals([$test_cuisine2], Stylist::getAll());
   }
 function testDeleteClient()
  {
      //Arrange
      $type = "American";
      $id = null;
      $test_cuisine = new Stylist($type, $id);
      $test_cuisine->save();

      $name = "Micky";
     $cuisine_id = $test_cuisine->getId();
      $test_Restaurant = new Client($id, $name,$cuisine_id);
      $test_Restaurant->save();
      //Act
      $test_cuisine->delete();
      //Assert
      $this->assertEquals([], Client::getAll());
  }
 }

?>
