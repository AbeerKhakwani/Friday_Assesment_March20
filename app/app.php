<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Client.php";
    require_once __DIR__."/../src/Stylist.php";


    $app = new Silex\Application();
    $app['debug'] = true;


    $DB = new PDO('pgsql:host=localhost;dbname=hair_salon');
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));


    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();


    $app->get("/", function() use ($app) {

          return $app['twig']->render('home.twig', array('stylists'=>Stylist::getAll()));
      });


   $app->post("/", function() use ($app) {
       $name=$_POST['name'];
        $new_stylist= new Stylist ( $name) ;
        $new_stylist->save();
     return $app['twig']->render('home.twig',array('stylists'=>Stylist::getAll()));
    });



    $app->get("/stylist/{id}", function($id) use ($app) {
        $stylist_id=Stylist::find($id);

        return $app['twig']->render('stylist.twig',array("stylist"=>$stylist_id,"clients"=>$stylist_id->getClients()));
      });


   $app->post("/stylist/{id}", function($id) use ($app) {
       $stylist_id=Stylist::find($id);


       $name=$_POST['name'];
       $stylist=$_POST['stylist'];
       $new_client=new Client($name,$id, $stylist);
       $new_client->save();

     return $app['twig']->render('stylist.twig',array("stylist"=>$stylist_id,"clients"=>$stylist_id->getClients()));
    });


    $app->get("/client/{id}", function($id) use ($app) {
        $client_id=Client::find($id);

        return $app['twig']->render('client.twig',array("client"=>$client_id));
      });

      $app->post("/delete_stylists", function() use ($app){
            Stylist::deleteAll();
            return $app['twig']->render('home.twig', array('stylists'=>Stylist::getAll()));
        });
    $app->post("/stylist/{id}/edit", function($id) use ($app) {
        $stylist_id=Stylist::find($id);

        return $app['twig']->render('client_edit.twig',array("stylist"=>$stylist_id));
      });
      $app->patch("/stylist/{id}", function($id) use ($app) {
          $stylist_id=Stylist::find($id);
          $name=$_POST['name'];

          $stylist_id->update($name);

        return $app['twig']->render('stylist.twig',array("stylist"=>$stylist_id,"clients"=>$stylist_id->getClients()));

          });




return $app;

?>
