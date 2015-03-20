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
         $test_stylist = new Stylist($type, $id);
         //Act
         $test_stylist->save();
         $result = Stylist::getAll();
         $this->assertEquals($test_stylist, $result[0]);
     }
     function test_getAll()
     {
         //Arrange
         $name = "Work stuff";
         $id = null;
         $name2 = "Home stuff";
         $id2 = null;
         $test_stylist = new Stylist($name, $id);
         $test_stylist->save();
         $test_stylist2 = new Stylist($name2, $id2);
         $test_stylist2->save();
         //Act
         $result = Stylist::getAll();
         //Assert
         $this->assertEquals([$test_stylist, $test_stylist2], $result);
     }
     function test_find()
    {
        //Arrange
        $name = "american";
        $id = null;

        $test_stylist = new Stylist($name, $id);
        $test_stylist->save();

        $name2 = "italian";
        $id2 = 2;
        $test_stylist2 = new Stylist($name2, $id2);
        $test_stylist2->save();
        //Act
        $id_to_find=$test_stylist2->getId();
        $result = Stylist::find($id_to_find);
        //Assert
        $this->assertEquals($test_stylist2, $result);
    }
    function testGetClients(){
      //Arrange
      $name = "Work stuff";
      $id = null;
      $test_stylist= new Stylist($name, $id);
      $test_stylist->save();
      $stylist_id=$test_stylist->getId();



      $name = "Email client";
      $address = "main street";
      $test_client = new Client( $name, $id, $stylist_id);
      $test_client->save();


      $name2 = "Meet with boss";
      $address2 = "main stress";
      $test_client2 = new Client($name2, $id ,$stylist_id);
      $test_client2->save();
      //Act
      $result = $test_stylist->getClients();
      //Assert
      $this->assertEquals([$test_client, $test_client2], $result);
  }
  function testUpdate()
 {
     //Arrange
     $type = "Work stuff";
     $id = 1;
     $test_stylist = new Stylist($type, $id);
     $test_stylist->save();
     $new_type = "Home stuff";
     //Act
     $test_stylist->update($new_type);
     //Assert
     $this->assertEquals("Home stuff", $test_stylist->getName());
 }
 function testDelete()
   {
       //Arrange
       $type = "Work stuff";
       $id = 1;
       $test_stylist = new Stylist($type, $id);
       $test_stylist->save();
       $type2 = "Work stuff";
       $id2 = 1;
       $test_stylist2 = new Stylist($type2, $id2);
       $test_stylist2->save();
       //Act
       $test_stylist->delete();
       //Assert
       $this->assertEquals([$test_stylist2], Stylist::getAll());
   }
 function testDeleteClient()
  {
      //Arrange
      $type = "American";
      $id = null;
      $test_stylist = new Stylist($type, $id);
      $test_stylist->save();

      $name = "Micky";
     $stylist_id = $test_stylist->getId();
      $test_Restaurant = new Client($id, $name,$stylist_id);
      $test_Restaurant->save();
      //Act
      $test_stylist->delete();
      //Assert
      $this->assertEquals([], Client::getAll());
  }
 }

?>
