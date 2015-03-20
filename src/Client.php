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
}


?>
