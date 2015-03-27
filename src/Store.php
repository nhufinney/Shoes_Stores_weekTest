<?php
    class Store
    {
        private $id;
        private $store;

        function __construct($id = null, $store)
        {
            $this->id = $id;
            $this->store = $store;
        }

        function setId($new_id)
        {
            $this->id = $new_id;
        }

        function getId()
        {
            return $this->id;
        }

        function setStore($new_store)
        {
            $this->store = $new_store;
        }

        function getStore()
        {
            return $this->store;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO stores (store) VALUES ('{$this->getStore()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        static function getAll()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
            $stores = array();
            foreach($returned_stores as $store) {
                $new_store = new Store($store['id'], $store['store']);
                array_push($stores, $new_store);
            }
            return $stores;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores *;");
        }

        static function find($search_id)
        {
            $found_stores = null;
            $stores = Store::getAll();
            foreach($stores as $store) {
                $store_id = $store->getId();
                if ($store_id == $search_id) {
                    $found_stores = $store;
                }
            }
            return $found_stores;
        }

        function deleteStore()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM brands_stores WHERE store_id = {$this->getId()};");
        }

        function update($new_store)
        {
            $GLOBALS['DB']->exec("UPDATE stores SET store = '{$new_store}' WHERE id = {$this->getId()};");
            $this->setStore($new_store);
        }

        function addShoes($shoes)
        {
            $GLOBALS['DB']->exec("INSERT INTO brands_stores (shoes_id, store_id) VALUES ({$shoes->getId()}, {$this->getId()});");
        }

        function getShoes()
        {
            $query = $GLOBALS['DB']->query("SELECT brands.* FROM
                stores  JOIN brands_stores ON (stores.id =  brands_stores.store_id)
                        JOIN brands ON ( brands_stores.shoes_id = brands.id)
                        WHERE stores.id = {$this->getId()};");
            $shoes_temp = $query->fetchAll(PDO::FETCH_ASSOC);
            $related_shoes = array();
            foreach($shoes_temp as $shoes) {
                $new_shoes = new Brand($shoes['id'], $shoes['shoes']);
                array_push($related_shoes, $new_shoes);
            }
            return $related_shoes;
        }

        // static function searchStores($search_store)
        // {
        //     $query = $GLOBALS['DB']->query("SELECT * FROM stores WHERE store LIKE '%{$search_title}%';");
        //     $search_store = $query->fetchAll(PDO::FETCH_ASSOC);
        //     $stores = array();
        //
        //     foreach($search_store as $store) {
        //         $new_store = new Store($store['id'], $store['store']);
        //         array_push($stores, $new_store);
        //     }
        //     return $stores;
        // }



}

?>
