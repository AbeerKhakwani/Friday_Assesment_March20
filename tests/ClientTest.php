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

        function test_getClient()
        {
            //Arrange
            $client= "Lynda";
            $id = null;
            $phone=898998;
            $stylist_id=8;
            $test_Client = new Client($client,$id,$phone,$stylist_id);
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
             $phone=898998;
             $stylist_id=8;
             $test_Client = new Client($client,$id,$phone,$stylist_id);

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
             $phone=898998;
             $stylist_id=8;
             $test_Client = new Client($client,$id,$phone,$stylist_id);
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
             $phone=898998;
             $stylist_id=8;

             $test_Client = new Client($client,$id,$phone,$stylist_id);
             //Act
             $test_Client->setId(1);
             //Assert
             $result = $test_Client->getId();
             $this->assertEquals(1, $result);
         }
}

?>
