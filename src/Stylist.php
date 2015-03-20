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

   static function find($search_id) {

       $all_stylists= Stylist::getAll();
       $found_stylist=null;

       foreach( $all_stylists as $stylists){
           $stylists_id= $stylists->getId();
           if ($stylists_id ==$search_id){

               $found_stylist=$stylists;

           }
        }
       return $found_stylist;

   }

    function update($new_name){
        $GLOBALS['DB']->exec("UPDATE stylist SET name '{$new_name}' WHERE id={$this->getId()}; ");
        $this->setName($new_name);

    }

    function delete(){
        $GLOBALS['DB']->exec("DELETE FROM stylist  WHERE id = {$this->getId()};");
        $GLOBALS['DB']->exec("DELETE FROM  client WHERE stylist_id = {$this->getId()};");
    }









}


?>
