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
                   $new_stylist= new Stylist($type,$id);
                   $new_stylist->save();
                   $stylist_id=$new_stylist->getId();

                   $name = "Olive Garden";
                   $test_client = new Client( $name, $id, $stylist_id);
                   //Act
                   $get= $test_client->save();

                   $result = Client::getAll();

                   //Assert
                   $this->assertEquals($test_client, $result[0]);
               }


               function test_getAll()
               {   //Arrange
                   $type="American";
                   $id=null;
                   $new_stylist= new Stylist($type,$id);
                   $new_stylist->save();
                   $stylist_id=$new_stylist->getId();


                   $name = "Olive Garden";
                   $address = "Main Street";
                   $test_client = new Client( $name,$id, $stylist_id);
                   $test_client->save();



                   $name2 = "Burgerville";
                   $address2 = "Hi Street";
                   $test_client2 = new Client( $name2,$id ,$stylist_id);
                   $test_client2->save();
                   //Act
                    $result = Client::getAll();
                   //Assert
                    $this->assertEquals([$test_client, $test_client2], $result);
               }
               function test_find()
                   {
                       //Arrange
                       $type="American";
                       $id=null;
                       $new_stylist= new Stylist($type,$id);
                       $new_stylist->save();
                       $stylist_id=$new_stylist->getId();


                       $name = "Olive Garden";

                       $test_client = new Client( $name,$id, $stylist_id);
                       $test_client->save();



                       $name2 = "Burgerville";

                       $test_client2 = new Client( $name2, $id ,$stylist_id);
                       $test_client2->save();
                       //Act
                       $result= Client::find($test_client->getId());
                       //Assert
                       $this->assertEquals($test_client,$result);
    }

        function testUpdate()
        { //Arrange

           $type="American";
           $id=null;
           $new_stylist= new Stylist($type,$id);
           $new_stylist->save();
           $stylist_id=$new_stylist->getId();

           $name = "Olive Garden";
           $test_client = new Client( $name,$id, $stylist_id);
           $test_client->save();

           $new_type = "Home stuff";
           //Act
           $test_client->update($new_type);
           //Assert
           $this->assertEquals("Home stuff", $test_client->getName());
        }
        function testDelete()
        {

             //Arrange
             $type="American";
             $id=null;
             $new_stylist= new Stylist($type,$id);
             $new_stylist->save();
             $stylist_id=$new_stylist->getId();

             $name = "Olive Garden";
             $test_client = new Client( $name,$id, $stylist_id);
             $test_client->save();

             $name2 = "Burgerville";

             $test_client2 = new Client( $name2, $id ,$stylist_id);
             $test_client2->save();

             //Act
             $test_client->delete();
             //Assert
             $this->assertEquals([ $test_client2], Client::getAll());
         }





}

?>
