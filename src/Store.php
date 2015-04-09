<?php
    class Store
    {
        private $id;
        private $store_name;

        function __construct($id = null, $store_name)
        {
            $this->id = $id;
            $this->store_name = $store_name;
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
            $this->store_name = $new_store;
        }

        function getStore()
        {
            return $this->store_name;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO stores (store_name) VALUES ('{$this->getStore()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        static function getAll()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
            $store_names = array();
            foreach($returned_stores as $store_name) {
                $new_store = new Store($store_name['id'], $store_name['store_name']);
                array_push($store_names, $new_store);
            }
            return $store_names;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores *;");
        }

        static function find($search_id)
        {
            $found_stores = null;
            $store_names = Store::getAll();
            foreach($store_names as $store_name) {
                $store_name_id = $store_name->getId();
                if ($store_name_id == $search_id) {
                    $found_stores = $store_name;
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
            $GLOBALS['DB']->exec("UPDATE stores SET store_name = '{$new_store}' WHERE id = {$this->getId()};");
            $this->setStore($new_store);
        }

        function addShoes($shoe)
        {
            $GLOBALS['DB']->exec("INSERT INTO brands_stores (shoe_id, store_id) VALUES ({$shoe->getId()}, {$this->getId()});");
        }

        function getShoes()
        {
            $query = $GLOBALS['DB']->query("SELECT brands.* FROM
                stores  JOIN brands_stores ON (stores.id =  brands_stores.store_id)
                        JOIN brands ON ( brands_stores.shoe_id = brands.id)
                        WHERE stores.id = {$this->getId()};");
            $shoe_temps = $query->fetchAll(PDO::FETCH_ASSOC);
            $related_shoes = array();
            foreach($shoe_temps as $shoe) {
                $new_shoe = new Brand($shoe['id'], $shoe['shoe']);
                array_push($related_shoes, $new_shoe);
            }
            return $related_shoes;
        }

}

?>
