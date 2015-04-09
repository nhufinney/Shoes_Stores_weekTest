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
        }

        function test_getId()
        {
            //Arrange
            $id = null;
            $shoe = "Liz";
            $test_shoe = new Brand($id, $shoe);
            $test_shoe->save();

            //Act
            $result = $test_shoe->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_setId()
        {
            //Arrange
            $id = null;
            $shoe = "Liz";
            $test_shoe = new Brand($id, $shoe);
            $test_shoe->save();

            //Act
            $result = $test_shoe->setId(1);

            //Assert
            $this->assertEquals(1, $test_shoe->getId());
        }


        function test_getShoe()
        {
            //Arrange
            $id = 10;
            $shoe = "Liz";
            $test_shoe = new Brand($id, $shoe);
            $test_shoe->save();

            //Act
            $result = $test_shoe->getShoe();

            //Assert
            $this->assertEquals($result, "Liz");
        }

        function test_setShoe()
        {
            //Arrange
            $id = 12;
            $shoe = "Liz";
            $test_shoe = new Brand($id, $shoe);
            $test_shoe->save();

            //Act
            $result = $test_shoe->setShoe("Nhu");

            //Assert
            $this->assertEquals("Nhu", $test_shoe->getShoe());
        }

        function test_getAll()
        {
            //Arrange
            $id = 12;
            $shoe = "Channel";
            $test_shoe = new Brand($id, $shoe);
            $test_shoe->save();

            $id2 = 21;
            $shoe2 = "Gucci";
            $test_shoe2 = new Brand($id2, $shoe2);
            $test_shoe2->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([$test_shoe, $test_shoe2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $id = null;
            $shoe = "Liz";
            $test_shoe = new Brand($id, $shoe);
            $test_shoe->save();

            $id2 = null;
            $shoe2 = "Nhu";
            $test_shoe2 = new Brand($id2, $shoe2);
            $test_shoe2->save();

            $id3 = null;
            $shoe3 = "Crazy PHP";
            $test_shoe3= new Brand($id, $shoe3);
            $test_shoe3->save();

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
            $shoe = "Liz";
            $test_shoe = new Brand($id, $shoe);
            $test_shoe->save();

            $id2 = null;
            $shoe2 = "Nhu";
            $test_shoe2 = new Brand($id2, $shoe2);
            $test_shoe2->save();

            $id3 = null;
            $shoe3 = "Crazy PHP";
            $test_shoe3= new Brand($id, $shoe3);
            $test_shoe3->save();

            //Act
            $result = Brand::find($test_shoe->getId());

            //Assert
            $this->assertEquals($test_shoe, $result);
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

            $shoe = "Nhu Finney";
            $id = 20;
            $test_shoe = new Brand($id, $shoe);
            $test_shoe->save();

            //Act
            $test_shoe->addStore($test_store);
            $test_shoe->addStore($test_store2);

            //Assert
            $this->assertEquals($test_shoe->getStores(), [$test_store, $test_store2]);
        }

        function testGetStores()
        {
            ///Arrange

            $id3 = 1;
            $shoe = "Mango Shoes";
            $test_shoe = new Brand($id3, $shoe);
            $test_shoe->save();

            $store = "Nhu Finney";
            $id = null;
            $test_store = new Store($id, $store);
            $test_store->save();

            $store2 = "Portland shoes";
            $id2 = 22;
            $test_store2 = new Store($id2, $store2);
            $test_store2->save();

            //Act
            $test_shoe->addStore($test_store);
            $test_shoe->addStore($test_store2);

            $result= $test_shoe->getStores();

            //Assert
            $this->assertEquals($test_shoe->getStores(), [$test_store, $test_store2]);
        }

        
    }
?>
