<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttribues disabled
    */

    require_once "src/Store.php";
    require_once "src/Brand.php";

    $DB = new PDO('pgsql:host=localhost;dbname=shoes_test');

    class StoreTest extends PHPUnit_Framework_TestCase
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
            $store = "Liz";
            $test_store = new Store($id, $store);
            $test_store->save();

            //Act
            $result = $test_store->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_setId()
        {
            //Arrange
            $id = null;
            $store = "Liz";
            $test_store = new Store($id, $store);
            $test_store->save();

            //Act
            $result = $test_store->setId(1);

            //Assert
            $this->assertEquals(1, $test_store->getId());
        }


        function test_getStore()
        {
            //Arrange
            $id = null;
            $store = "Liz";
            $test_store = new Store($id, $store);
            $test_store->save();

            //Act
            $result = $test_store->getStore();

            //Assert
            $this->assertEquals("Liz", $result);
        }

        function test_setStore()
        {
            //Arrange
            $id = null;
            $store = "Liz";
            $test_store = new Store($id, $store);
            $test_store->save();

            //Act
            $result = $test_store->setStore("Nhu");

            //Assert
            $this->assertEquals("Nhu", $test_store->getStore());
        }

        function test_getAll()
        {
            //Arrange
            $id = null;
            $store = "Store downtown";
            $test_store = new Store($id, $store);
            $test_store->save();

            $id2 = null;
            $store2 = "Coco 1";
            $test_store2 = new Store($id2, $store2);
            $test_store2->save();

            $id3 = null;
            $store3 = "Ana 3";
            $test_store3= new Store($id, $store3);
            $test_store3->save();

            //Act
            $result = Store::getAll();
            //Assert
            $this->assertEquals([$test_store, $test_store2, $test_store3], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $id = null;
            $store = "Liz";
            $test_store = new Store($id, $store);
            $test_store->save();

            $id2 = null;
            $store2 = "Nhu";
            $test_store2 = new Store($id2, $store2);
            $test_store2->save();

            $id3 = null;
            $store3 = "Crazy PHP";
            $test_store3= new Store($id, $store3);
            $test_store3->save();

            //Act
            Store::deleteAll();
            $result = Store::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $id = 2;
            $store = "Liz";
            $test_store = new Store($id, $store);
            $test_store->save();

            $id2 = 14;
            $store2 = "Nhu";
            $test_store2 = new Store($id2, $store2);
            $test_store2->save();

            $id3 = 41;
            $store3 = "Crazy PHP";
            $test_store3= new Store($id, $store3);
            $test_store3->save();

            //Act
            $result = Store::find($test_store->getId());

            //Assert
            $this->assertEquals($test_store, $result);
        }

        function test_deleteStore()
        {
            //Arrange
            $id = null;
            $store = "Liz";
            $test_store = new Store($id, $store);
            $test_store->save();

            $id2 = null;
            $store2 = "Nhu";
            $test_store2 = new Store($id2, $store2);
            $test_store2->save();

            $id3 = null;
            $store3 = "Crazy PHP";
            $test_store3= new Store($id, $store3);
            $test_store3->save();

            //Act
            $test_store2->deleteStore();
            $test_store3->deleteStore();

            $result = Store::getAll();

            //Assert
            $this->assertEquals([$test_store], $result);
        }

        function testUpdate()
        {
            //Arrange
            $id = 1;
            $store = "Liz";
            $test_store = new Store($id, $store);
            $test_store->save();

            $new_store = "Crazy PHP";

            //Act
            $test_store->update($new_store);

            //Assert
            $this->assertEquals("Crazy PHP", $test_store->getStore());
        }

        function testAddShoes()
        {
            //Arrange
            $id = 1;
            $shoe = "XOXO";
            $test_shoe = new Brand($id, $shoe);
            $test_shoe->save();

            $id = 2;
            $shoe2 = "Mango";
            $test_shoe2 = new Brand($id, $shoe2);
            $test_shoe2->save();

            $store = "Nhu Finney";
            $id = null;
            $test_store = new Store($id, $store);
            $test_store->save();

            //Act
            $test_store->addShoes($test_shoe);
            $test_store->addShoes($test_shoe2);

            //Assert
            $this->assertEquals($test_store->getShoes(), [$test_shoe, $test_shoe2]);
        }

        function testGetShoes()
        {
            ///Arrange
            $id = 1;
            $shoe = "DC Shoes";
            $test_shoe = new Brand($id, $shoe);
            $test_shoe->save();

            $id = 2;
            $shoe2 = "Dockers";
            $test_shoe2 = new Brand($id, $shoe2);
            $test_shoe2->save();

            $store = "Nhu Finney";
            $id = null;
            $test_store = new Store($id, $store);
            $test_store->save();

            //Act
            $test_store->addShoes($test_shoe);
            $test_store->addShoes($test_shoe2);

            //Assert
            $this->assertEquals($test_store->getShoes(), [$test_shoe, $test_shoe2]);
        }


     }
?>
