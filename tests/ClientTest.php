<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Client.php";
    require_once "src/Stylist.php";
    $DB = new PDO('pgsql:host=localhost;dbname=hair_salon_test');
    class ClientTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Stylist::deleteAll();
            Client::deleteAll();

        }

        function test_getClient()
        {
            //Arrange
            $client= "Lynda";
            $id = null;
            $stylist_id=8;
            $test_Client = new Client($client,$id,$stylist_id);
            //Act
            $result = $test_Client->getClient();
            //Assert
            $this->assertEquals($client,$result);
        }

        function test_setClient()
         {
             //Arrange
             $client= "Lynda";
             $id = null;
             $stylist_id=8;
             $test_Client = new Client($client,$id,$stylist_id);

             $test_Client->setClient("Julie");
             //Assert
             $result = $test_Client->getClient();
             $this->assertEquals("Julie", $result);
         }
         function test_getId()
         {
             //Arrange
             $client= "Lynda";
             $id = 2;
             $stylist_id=8;
             $test_Client = new Client($client,$id,$stylist_id);
             //Act
             $result = $test_Client->getId();
             //Assert
             $this->assertEquals(2, $result);
         }
         function test_setId()
         {
             //Arrange
             $client= "Lynda";
             $id = null;
             $stylist_id=8;
             $test_Client = new Client($client,$id,$stylist_id);
             //Act
             $test_Client->setId(1);
             //Assert
             $result = $test_Client->getId();
             $this->assertEquals(1, $result);
         }



        function test_save(){
            //Arrange
            $name = "yyo";
            $id = null;
            $test_Stylist = new Stylist($name,$id);
            //Act
            $test_Stylist->save();

            $client= "Lynda";

            $stylist_id=$test_Stylist->getId();
            $test_client = new Client($client,$id,$stylist_id);

            //Act
            $test_client ->save();

            $result = Client::getAll();


            //Assert
            $this->assertEquals($test_client, $result[0]);
        }











}

?>
