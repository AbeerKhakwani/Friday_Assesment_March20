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
    function save()
    {
        $statement = $GLOBALS['DB']->query("INSERT INTO  stylist (name) VALUES ('{$this->getName()}')RETURNING id; ");
        $result    = $statement->fetch(PDO::FETCH_ASSOC);
        $this->setId($result['id']);
    }
    static function getAll()
    {
        $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylist;");
        $stylists         = array();
        foreach ($returned_stylists  as $stylist) {
            $id          = $stylist['id'];
            $type        = $stylist['name'];
            $new_stylist = new Stylist($type, $id);
            array_push($stylists , $new_stylist);
        }
        return $stylists;
    }
    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM stylist *;");
    }
    static function find($search_id)
    {
        $found_stylist = null;
        $stylists = Stylist::getAll();
        foreach ($stylists as $stylist) {
            $stylist_id = $stylist->getId();
            if ($stylist_id == $search_id) {
                $found_stylist = $stylist;
            }
        }
        return $found_stylist;
    }
    function getClients()
    {
        $clients          = Array();
        $returned_slients = $GLOBALS['DB']->query("SELECT * FROM client WHERE stylist_id = {$this->getId()};");

        foreach ($returned_slients as $client) {
            $name           = $client['name'];
            $id             = $client['id'];
            $stylist_id   = $client['stylist_id'];
            $new_client = new Client( $name, $id, $stylist_id);
            array_push($clients  , $new_client);
        }
        return $clients  ;
    }
    function update($new_name)
    {
        $GLOBALS['DB']->exec("UPDATE stylist SET name = '{$new_name}' WHERE id = {$this->getId()};");
        $this->setName($new_name);
    }
    function delete(){
        $GLOBALS['DB']->exec("DELETE FROM stylist Where id={$this->getId()};");
        $GLOBALS['DB']->exec("DELETE FROM client Where stylist_id={$this->getId()};");
    }
}
?>
