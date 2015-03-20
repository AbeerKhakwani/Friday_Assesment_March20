<?php
    /**
    * @backupGlobals disabled

    * @backupStaticAttributes disabled
    */
    require_once "src/Client.php";
    require_once "src/Stylist.php";
    $DB = new PDO('pgsql:host=localhost;dbname=hair_salon');
    class ClientTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Stylist::deleteAll();
            Client::deleteAll();

        }
               function test_save(){
                   //Arrange
                   $type="American";
                   $id=null;
                   $new_cuisine= new Stylist($type,$id);
                   $new_cuisine->save();
                   $cuisine_id=$new_cuisine->getId();

                   $name = "Olive Garden";
                   $test_restaurant = new Client( $name, $id, $cuisine_id);
                   //Act
                   $get= $test_restaurant->save();

                   $result = Client::getAll();

                   //Assert
                   $this->assertEquals($test_restaurant, $result[0]);
               }


               function test_getAll()
               {   //Arrange
                   $type="American";
                   $id=null;
                   $new_cuisine= new Stylist($type,$id);
                   $new_cuisine->save();
                   $cuisine_id=$new_cuisine->getId();


                   $name = "Olive Garden";
                   $address = "Main Street";
                   $test_restaurant = new Client( $name,$id, $cuisine_id);
                   $test_restaurant->save();



                   $name2 = "Burgerville";
                   $address2 = "Hi Street";
                   $test_restaurant2 = new Client( $name2,$id ,$cuisine_id);
                   $test_restaurant2->save();
                   //Act
                    $result = Client::getAll();
                   //Assert
                    $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
               }
               function test_find()
                   {
                       //Arrange
                       $type="American";
                       $id=null;
                       $new_cuisine= new Stylist($type,$id);
                       $new_cuisine->save();
                       $cuisine_id=$new_cuisine->getId();


                       $name = "Olive Garden";

                       $test_restaurant = new Client( $name,$id, $cuisine_id);
                       $test_restaurant->save();



                       $name2 = "Burgerville";

                       $test_restaurant2 = new Client( $name2, $id ,$cuisine_id);
                       $test_restaurant2->save();
                       //Act
                       $result= Client::find($test_restaurant->getId());
                       //Assert
                       $this->assertEquals($test_restaurant,$result);
    }

        function testUpdate()
        { //Arrange

           $type="American";
           $id=null;
           $new_cuisine= new Stylist($type,$id);
           $new_cuisine->save();
           $cuisine_id=$new_cuisine->getId();

           $name = "Olive Garden";
           $test_restaurant = new Client( $name,$id, $cuisine_id);
           $test_restaurant->save();

           $new_type = "Home stuff";
           //Act
           $test_restaurant->update($new_type);
           //Assert
           $this->assertEquals("Home stuff", $test_restaurant->getName());
        }
        function testDelete()
        {

             //Arrange
             $type="American";
             $id=null;
             $new_cuisine= new Stylist($type,$id);
             $new_cuisine->save();
             $cuisine_id=$new_cuisine->getId();

             $name = "Olive Garden";
             $test_restaurant = new Client( $name,$id, $cuisine_id);
             $test_restaurant->save();

             $name2 = "Burgerville";

             $test_restaurant2 = new Client( $name2, $id ,$cuisine_id);
             $test_restaurant2->save();

             //Act
             $test_restaurant->delete();
             //Assert
             $this->assertEquals([ $test_restaurant2], Client::getAll());
         }





}

?>
