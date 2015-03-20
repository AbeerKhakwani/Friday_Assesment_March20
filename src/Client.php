<?php
class Client
{
    private $id;
    private $name;
    private $stylist_id;
    function __construct( $name,$id=null, $stylist_id)
    {
        $this->id         = $id;
        $this->name       = $name;
        $this->stylist_id = $stylist_id;
    }
    function getId()
    {
        return $this->id;
    }
    function setId($new_id)
    {
        $this->id = (int) $new_id;
    }
    function getName()
    {
        return $this->name;
    }
    function setName($new_name)
    {
        $this->name = (string) $new_name;
    }

    function setstylist_id($new_stylist_id)
    {
        $this->stylist_id = (int) $new_stylist_id;
    }
    function getstylist_id()
    {
        return $this->stylist_id;
    }
    function save()
    {
        $statement = $GLOBALS['DB']->query("INSERT INTO client (name, stylist_id) VALUES ('{$this->getName()}', {$this->getstylist_id()}) RETURNING id;");

        $result= $statement->fetch(PDO::FETCH_ASSOC);


        $blanc=$this->setId($result['id']);


    }
    static function getAll()
    {
        $result_client = $GLOBALS['DB']->query("SELECT * FROM client;");
        $clients      = array();
        foreach ($result_client as $client) {
            $id         = $client['id'];
            $name       = $client['name'];
            $stylist_id = $client['stylist_id'];
            $new_client   = new Client( $name,$id, $stylist_id);
            array_push($clients, $new_client);
        }
        return $clients;
    }
    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM client *;");
    }


    static function find($id_search)
    {
        $found_id = null;
        $ids      =Client::getAll();
        foreach ($ids as $id) {
            $rest_id = $id->getId();
            if ($rest_id == $id_search) {
                $found_id = $id;
            }
        }
        return $found_id;
    }

    function update($new_name)
    {
        $GLOBALS['DB']->exec("UPDATE client SET name = '{$new_name}' WHERE id = {$this->getId()};");
        $this->setName($new_name);
    }
    function delete(){
        $GLOBALS['DB']->exec("DELETE FROM client Where id={$this->getId()};");

    }
}
?>
