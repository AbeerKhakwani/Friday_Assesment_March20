<?php
class Client
{
    private $id;
    private $client;

    private $stylist_id;
    function __construct( $client, $id = null, $stylist_id)
    {
        $this->id         = $id;
        $this->client       = $client;

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
    function getClient()
    {
        return $this->client;
    }
    function setClient($new_client)
    {
        $this->client = (string) $new_client;
    }

    function setStylistId($new_cuisineId)
    {
        $this->cuisine_Id = (int) $new_cuisineId;
    }
    function getStylistId()
    {
        return $this->stylist_id;
    }

    function save()
    {
        $statement = $GLOBALS['DB']->query("INSERT INTO client (client, stylist_id) VALUES ('{$this->getClient()}', {$this->getStylistId()}) RETURNING id;");
        $result    = $statement->fetch(PDO::FETCH_ASSOC);
        $this->setId($result['id']);
    }

    static function getAll()
    {
        $result_Clients = $GLOBALS['DB']->query("SELECT * FROM client;");
        $Clients  = array();
        foreach ($result_Clients as $Client) {
            $id         = $Client['id'];
            $client     = $Client['client'];
            $Stylist_id = $Client['stylist_id'];
            $new_Clients   = new Client( $client,$id, $Stylist_id);
            array_push($Clients, $new_Clients);
        }
        return $Clients;
        
    }


    static function deleteAll()
     {
         $GLOBALS['DB']->exec("DELETE FROM client *;");
     }





}


?>
