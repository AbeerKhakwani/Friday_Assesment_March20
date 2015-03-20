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

        function test_setType()
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












    }
?>
