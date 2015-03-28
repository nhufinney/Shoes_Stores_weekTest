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

    //page list out all shoes exits in database, add new brand shoes into the brands table
    $app->get("/shoes", function() use ($app) {
        return $app['twig']->render('brands.html.twig', array('all_shoes' => Brand::getAll()));
    });

    //app to save new brand into database
    $app->post("/shoes", function() use ($app) {
        $shoes = $_POST['shoes'];
        $id = null;
        $new_shoes = new Brand($id, $shoes);
        $new_shoes->save();
        return $app['twig']->render('brands.html.twig', array('all_shoes' => Brand::getAll()));
    });

    //Single shoes page
    $app->get("/shoes/{id}", function($id) use ($app) {
        $shoes = Brand::find($id);
        return $app['twig']->render('shoes.html.twig', array('shoes' => $shoes, 'stores' => $shoes->getStores(), 'all_stores' => Store::getAll()));
    });

    //Single shoes page. Add new store selling the shoes.
    $app->post("/add_stores", function() use ($app) {
        $shoes = Brand::find($_POST['shoes_id']);
        $store = Store::find($_POST['store_id']);
        $shoes->addStore($store);
        return $app['twig']->render('shoes.html.twig', array('shoes' =>$shoes, 'stores' => $shoes->getStores(), 'all_stores'=> Store::getAll(), 'stores' => $shoes->getStores()));
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

    $app->get("/stores/{id}", function($id) use ($app) {
        $store = Store::find($id);
        return $app['twig']->render('store.html.twig', array('store' => $store, 'related_shoes' => $store->getShoes(), 'all_shoes' => Brand::getAll()));
    });



    return $app;
?>
