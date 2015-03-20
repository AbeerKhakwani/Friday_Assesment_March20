<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Stylist.php";
    require_once "src/Client.php";
    $DB = new PDO('pgsql:host=localhost;dbname=hair_salon_test');
    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Stylist::deleteAll();
            Client::deleteAll();

        }
        function test_getName()
        {
            //Arrange
            $name = "Lynda";
            $id = null;
            $test_Stylist = new Stylist($name,$id);
            //Act
            $result = $test_Stylist->getName();
            //Assert
            $this->assertEquals($name, $result);
        }

        function test_setName()
         {
             //Arrange
             $name = "Lynda";
             $id = null;
             $test_Stylist = new Stylist($name,$id);

             $test_Stylist->setName("Julie");
             //Assert
             $result = $test_Stylist->getName();
             $this->assertEquals("Julie", $result);
         }
         function test_getId()
         {
             //Arrange
             $name = "Lynda";
             $id = 2;
             $test_Stylist = new Stylist($name,$id);
             //Act
             $result = $test_Stylist->getId();
             //Assert
             $this->assertEquals(2, $result);
         }
         function test_setId()
         {
             //Arrange
             $name = "Lynda";
             $id = null;
             $test_Stylist = new Stylist($name,$id);
             //Act
             $test_Stylist->setId(1);
             //Assert
             $result = $test_Stylist->getId();
             $this->assertEquals(1, $result);
         }

         function test_save(){
            //Arrange
            $name = "yyo";
            $id = null;
            $test_Stylist = new Stylist($name,$id);
            //Act
            $test_Stylist ->save();

            $result = Stylist::getAll();
            $this->assertEquals($test_Stylist, $result[0]);
        }



        function test_find() {
           //Arrange
           $name = "yyo";
           $id = null;
           $test_Stylist = new Stylist($name,$id);
           //Act
           $test_Stylist ->save();

           $name2 = "yyo";

           $test_Stylist2 = new Stylist($name2,$id);
           //Act
           $test_Stylist2 ->save();

           //Act
           $id_to_find=$test_Stylist2->getId();
           $result = Stylist::find($id_to_find);
           //Assert
           $this->assertEquals($test_Stylist2, $result);
       }

       function testDelete()
          {
              //Arrange
              $name = "yyo";
              $id = 2;
              $test_Stylist = new Stylist($name,$id);
              //Act
              $test_Stylist ->save();
              $id2 = 4;
              $name2 = "yyo";
              $test_Stylist2 = new Stylist($name2,$id2);
              //Act
              $test_Stylist2 ->save();

              //Act
              $test_Stylist->delete();
              //Assert
              $this->assertEquals([$test_Stylist2], Stylist::getAll());
          }

        // function testGetClients(){
        //      //Arrange
        //      $name = "yyo";
        //      $id = 2;
        //      $test_Stylist = new Stylist($name,$id);
        //      //Act
        //      $test_Stylist ->save();
        //
        //      $test_stylist_id = $test_Stylist->getId();
        //      $name = "Email client";
        //      $address = "main street";
        //      $test_client = new Client($name, $id, $test_stylist_id);
        //      $test_client->save();
        //
        //
        //      //Act
        //      $result = $test_Stylist->getClient();
        //      var_dump( $test_Stylist->getClient());
        //
        //      //Assert
        //      $this->assertEquals([$test_client], $result);
        //  }
        // 



      function testUpdate()
        {
           //Arrange
           $name = "yyo";
           $id = 2;
           $test_Stylist = new Stylist($name,$id);

           $test_Stylist ->save();

           $new_name = "HOOOOOO";
           //Act
           $test_Stylist->update($new_name);
           //Assert
           $this->assertEquals("HOOOOOO", $test_Stylist->getName());
        }




    }
?>
