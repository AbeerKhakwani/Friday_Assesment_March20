<?php
class Client
{
    private $id;
    private $client;
    private $phone;
    private $stylist_id;
    function __construct( $client, $id = null,$phone, $stylist_id)
    {
        $this->id         = $id;
        $this->client       = $client;
        $this->phone    = $phone;
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
    function getPhone()
    {
        return $this->phone;
    }
    function setPhone($new_phone)
    {
        $this->phone = (string) $new_phone;
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
        $statement = $GLOBALS['DB']->query("INSERT INTO client (client, stylist_id, phone) VALUES ('{$this->getClient()}', {$this->getStylistId()}, {$this->getPhone()}) RETURNING id;");
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
            $phone    = $Client['phone'];
            $Stylist_id = $Client['stylist_id'];
            $new_Clients   = new Client( $client,$id, $phone, $Stylist_id);
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
