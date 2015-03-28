<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttribues disabled
    */

    require_once "src/Brand.php";
    require_once "src/Store.php";

    $DB = new PDO('pgsql:host=localhost;dbname=shoes_test');

    class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Brand::deleteAll();
            Store::deleteAll();
            // Brand::deleteBrand();
            // Store::deleteStore();
        }

        function test_getId()
        {
            //Arrange
            $id = null;
            $shoes = "Liz";
            $test_shoes = new Brand($id, $shoes);
            $test_shoes->save();

            //Act
            $result = $test_shoes->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_setId()
        {
            //Arrange
            $id = null;
            $shoes = "Liz";
            $test_shoes = new Brand($id, $shoes);
            $test_shoes->save();

            //Act
            $result = $test_shoes->setId(1);

            //Assert
            $this->assertEquals(1, $test_shoes->getId());
        }


        function test_getShoes()
        {
            //Arrange
            $id = 10;
            $shoes = "Liz";
            $test_shoes = new Brand($id, $shoes);
            $test_shoes->save();

            //Act
            $result = $test_shoes->getShoes();

            //Assert
            $this->assertEquals($result, "Liz");
        }

        function test_setShoes()
        {
            //Arrange
            $id = 12;
            $shoes = "Liz";
            $test_shoes = new Brand($id, $shoes);
            $test_shoes->save();

            //Act
            $result = $test_shoes->setShoes("Nhu");

            //Assert
            $this->assertEquals("Nhu", $test_shoes->getShoes());
        }

        function test_getAll()
        {
            //Arrange
            $id = 12;
            $shoes = "Channel";
            $test_shoes = new Brand($id, $shoes);
            $test_shoes->save();

            $id2 = 21;
            $shoes2 = "Gucci";
            $test_shoes2 = new Brand($id2, $shoes2);
            $test_shoes2->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([$test_shoes, $test_shoes2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $id = null;
            $shoes = "Liz";
            $test_shoes = new Brand($id, $shoes);
            $test_shoes->save();

            $id2 = null;
            $shoes2 = "Nhu";
            $test_shoes2 = new Brand($id2, $shoes2);
            $test_shoes2->save();

            $id3 = null;
            $shoes3 = "Crazy PHP";
            $test_shoes3= new Brand($id, $shoes3);
            $test_shoes3->save();

            //Act
            Brand::deleteAll();
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $id = null;
            $shoes = "Liz";
            $test_shoes = new Brand($id, $shoes);
            $test_shoes->save();

            $id2 = null;
            $shoes2 = "Nhu";
            $test_shoes2 = new Brand($id2, $shoes2);
            $test_shoes2->save();

            $id3 = null;
            $shoes3 = "Crazy PHP";
            $test_shoes3= new Brand($id, $shoes3);
            $test_shoes3->save();

            //Act
            $result = Brand::find($test_shoes->getId());

            //Assert
            $this->assertEquals($test_shoes, $result);
        }

        function test_addStores()

        {
            //Arrange
            $id = 1;
            $store = "Store P";
            $test_store = new Store($id, $store);
            $test_store->save();

            $id2 = 2;
            $store2 = "Crazy Javascript";
            $test_store2 = new Store($id2, $store2);
            $test_store2->save();

            $shoes = "Nhu Finney";
            $id = 20;
            $test_shoes = new Brand($id, $shoes);
            $test_shoes->save();

            //Act
            $test_shoes->addStore($test_store);
            $test_shoes->addStore($test_store2);
            // $result = $test_shoes->getStores();
            // var_dump($result);

            //Assert
            $this->assertEquals($test_shoes->getStores(), [$test_store, $test_store2]);
        }

        function testGetStores()
        {
            ///Arrange

            $id3 = 1;
            $shoes = "Mango Shoes";
            $test_shoes = new Brand($id3, $shoes);
            $test_shoes->save();

            $store = "Nhu Finney";
            $id = null;
            $test_store = new Store($id, $store);
            $test_store->save();

            $store2 = "Portland shoes";
            $id2 = 22;
            $test_store2 = new Store($id2, $store2);
            $test_store2->save();

            //Act
            $test_shoes->addStore($test_store);
            $test_shoes->addStore($test_store2);
            
            $result= $test_shoes->getStores();

            var_dump($result);
            //Assert
            $this->assertEquals($test_shoes->getStores(), [$test_store, $test_store2]);
        }
    }
?>
