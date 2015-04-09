<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Brand.php";
    require_once __DIR__."/../src/Store.php";

    $app = new Silex\Application();
    $app['debug'] = true;

    $DB = new PDO('pgsql:host=localhost;dbname=shoes');

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();


    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });

//****SHOES********SHOES***********SHOES********SHOES***********SHOES********SHOES*******

    //page list out all shoes exits in database, add new brand shoe into the brands table
    $app->get("/shoes", function() use ($app) {
        return $app['twig']->render('brands.html.twig', array('all_shoes' => Brand::getAll()));
    });

    //save new brand of shoes into database. Do not save if duplicate values.
    $app->post("/shoes", function() use ($app) {
        $shoe = $_POST['shoe'];
        $id = null;
        $new_shoe = new Brand($id, $shoe);
        $new_shoe->save();

        return $app['twig']->render('brands.html.twig', array('all_shoes' => Brand::getAll()));
    });


    //Single shoe page
    $app->get("/shoe/{id}", function($id) use ($app) {
        $shoe = Brand::find($id);
        return $app['twig']->render('shoes.html.twig', array('shoe' => $shoe, 'stores' => $shoe->getStores(), 'all_stores' => Store::getAll()));
    });

    //Single shoes page. Add new store selling the shoes.
    $app->post("/add_stores", function() use ($app) {
        $shoe = Brand::find($_POST['shoe_id']);
        $store = Store::find($_POST['store_id']);
        $shoe->addStore($store);
        return $app['twig']->render('shoes.html.twig', array('shoe' =>$shoe, 'stores' => $shoe->getStores(), 'all_stores'=> Store::getAll(), 'stores' => $shoe->getStores()));
    });



//****STORES***********STORES***********STORES*********STORES*************STORES******

    //app list out all stores exits in database, add new stores
    $app->get("/stores", function() use ($app) {
        return $app['twig']->render('stores.html.twig', array('all_stores' => Store::getAll()));
    });

    //app to save new store into the stores table
    $app->post("/stores", function() use ($app) {
        $store = $_POST['store'];
        $id = null;
        $new_store = new Store($id, $store);
        $new_store->save();

        return $app['twig']->render('stores.html.twig', array('all_stores' => Store::getAll()));
    });

    //delete all stores in the stores table
    $app->delete("/delete_stores", function() use ($app){
        Store::deleteAll();
        return $app['twig']->render('stores.html.twig', array('all_stores' => Store::getAll()));
    });

    //Page of single store.
    $app->get("/stores/{id}", function($id) use ($app) {
        $store = Store::find($id);
        return $app['twig']->render('store.html.twig', array('store' => $store, 'related_shoes' => $store->getShoes(), 'all_shoes' => Brand::getAll()));
    });

    //Add shoes in the list of shoes for the store.
    $app->post("/add_shoe", function() use ($app) {
        $store = Store::find($_POST['store_id']);
        $shoe = Brand::find($_POST['shoe_id']);
        $store->addShoes($shoe);
        return $app['twig']->render('store.html.twig', array('store' =>$store, 'related_shoes' => $store->getShoes(), 'all_shoes' => Brand::getAll()));
    });

    //update new name for a single store
    $app->patch("/stores/{id}", function($id) use ($app) {
        $store_edited = $_POST['store'];
        $store = Store::find($id);
        $store->update($store_edited);
        return $app['twig']->render('store.html.twig', array('store' => $store, 'related_shoes' => $store->getShoes(), 'all_shoes' => Brand::getAll()));
    });

    //delete a single store
    $app->delete("/stores/{id}", function($id) use ($app){
       $store = Store::find($id);
       $store->deleteStore();
       return $app['twig']->render('stores.html.twig', array('all_stores' => Store::getAll()));
   });

    return $app;
?>
