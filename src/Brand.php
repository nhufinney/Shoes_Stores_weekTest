<?php

    class Brand
    {
        private $shoes;
        private $id;

        function __construct($initial_id = null, $shoes)
        {
            $this->shoes = $shoes;
            $this->id = $initial_id;
        }

        function getShoes()
        {
            return $this->shoes;
        }

        function setShoes($new_shoes)
        {
            $this->shoes = (string) $new_shoes;
        }

        function getId()
        {
            return $this->id;
        }

        function setId($new_id)
        {
            $this->id = (int) $new_id;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO brands (shoes) VALUES ('{$this->getShoes()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        static function getAll()
        {
            $returned_query = $GLOBALS['DB']->query("SELECT * FROM brands;");
            $returned_shoes = $returned_query->fetchAll(PDO::FETCH_ASSOC);
            $all_shoes = array();
            foreach($returned_shoes as $shoes) {
                $new_shoes = new Brand($shoes['id'], $shoes['shoes']);
                array_push($all_shoes, $new_shoes);
            }
            return $all_shoes;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands *;");
        }

        static function find($search_id)
        {
            $found_shoes = null;
            $all_shoes = Brand::getAll();
            foreach($all_shoes as $shoes) {
                $shoes_id = $shoes->getId();
                if ($shoes_id == $search_id) {
                  $found_shoes = $shoes;
                }
            }
            return $found_shoes;
        }

        function addStore($store)
        {
            $GLOBALS['DB']->exec("INSERT INTO brands_stores (shoes_id, store_id) VALUES ({$this->getId()}, {$store->getId()});");
        }

        function deleteBrand()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM brands_stores WHERE shoes_id = {$this->getId()};");
        }

        function getStores()
        {
            $query = $GLOBALS['DB']->query("SELECT stores.* FROM
                brands JOIN brands_stores ON (brands.id = brands_stores.shoes_id)
                            JOIN stores ON (brands_stores.store_id = stores.id)
                WHERE brands.id= {$this->getId()};");
            $related_stores = array();
            $returned_stores = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($returned_stores as $store)
            {
                $new_store = new Store ($store['id'], $store['store']);
                array_push($related_stores, $new_store);
            }
            return $related_stores;
        }

        static function checkAvailable($check_shoes)
        {
            $answer=true;
            $shoes_array= array();
            $all_shoes = Brand::getAll();

            foreach ($all_shoes as $shoes)
            {
                $one = $shoes->getShoes();
                array_push($shoes_array, $one);
            }

            if (in_array($check_shoes, $shoes_array))
            {
                $answer= false;
            }
            return $answer;
        }

    }

?>
