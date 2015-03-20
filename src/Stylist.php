<?php
class Stylist
{
    private $id;
    private $name;
    function __construct($name, $id = null)
    {
        $this->name = $name;
        $this->id   = $id;
    }
    function setName($new_name)
    {
        $this->name = (string) $new_name;
    }
    function getName()
    {
        return $this->name;
    }
    function setId($new_id)
    {
        $this->id = (int) $new_id;
    }
    function getId()
    {
        return $this->id;

    }
   function save(){

       $statement= $GLOBALS['DB']->query("INSERT INTO stylist (name) VALUES ('{$this->getName()}')RETURNING id;");

       $result= $statement->fetch(PDO::FETCH_ASSOC);
       $this->setId($result['id']);

   }
   static function getAll(){

      $returned_results=$GLOBALS['DB']->query("SELECT * FROM stylist;");

      $stylist=array();
      foreach($returned_results as $returned){
          $returned_name=$returned['name'];
          $returned_id=$returned['id'];
          $new_Stylist= new Stylist($returned_name,$returned_id);
          array_push($stylist,$new_Stylist);


      }


      return $stylist;

   }

   static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM stylist *;");
    }





}


?>
