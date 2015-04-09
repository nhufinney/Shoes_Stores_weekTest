<?php

    class Brand
    {
        private $shoe;
        private $id;

        function __construct($initial_id = null, $shoe)
        {
            $this->shoe = $shoe;
            $this->id = $initial_id;
        }

        function getShoe()
        {
            return $this->shoe;
        }

        function setShoe($new_shoe)
        {
            $this->shoe = (string) $new_shoe;
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
            $statement = $GLOBALS['DB']->query("INSERT INTO brands (shoe) VALUES ('{$this->getShoe()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        static function getAll()
        {
            $returned_query = $GLOBALS['DB']->query("SELECT * FROM brands;");
            $returned_shoes = $returned_query->fetchAll(PDO::FETCH_ASSOC);
            $all_shoes = array();
            foreach($returned_shoes as $shoe) {
                $new_shoe = new Brand($shoe['id'], $shoe['shoe']);
                array_push($all_shoes, $new_shoe);
            }
            return $all_shoes;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands *;");
        }

        static function find($search_id)
        {
            $found_shoe = null;
            $all_shoes = Brand::getAll();
            foreach($all_shoes as $shoe) {
                $shoe_id = $shoe->getId();
                if ($shoe_id == $search_id) {
                  $found_shoe = $shoe;
                }
            }
            return $found_shoe;
        }

        function addStore($store)
        {
            $GLOBALS['DB']->exec("INSERT INTO brands_stores (shoe_id, store_id) VALUES ({$this->getId()}, {$store->getId()});");
        }

        function deleteBrand()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM brands_stores WHERE shoe_id = {$this->getId()};");
        }

        function getStores()
        {
            $query = $GLOBALS['DB']->query("SELECT stores.* FROM
                brands JOIN brands_stores ON (brands.id = brands_stores.shoe_id)
                            JOIN stores ON (brands_stores.store_id = stores.id)
                WHERE brands.id= {$this->getId()};");
            $related_stores = array();
            $returned_stores = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($returned_stores as $store)
            {
                $new_store = new Store ($store['id'], $store['store_name']);
                array_push($related_stores, $new_store);
            }
            return $related_stores;
        }

        

    }

?>
