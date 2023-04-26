<?php

namespace handler\Listener;

use Phalcon\Di\Injectable;

class Listener extends Injectable
{

    public function dbEvent()
    {
        $di = $this->getDI();
        $connection = $di->get('db');
        $product = $this->db->fetchAll(
            "SELECT * FROM products",
            \Phalcon\Db\Enum::FETCH_ASSOC
        );
        foreach ($product as $array) {
            $id = $array['id'];
            foreach ($array as $valuekey => $value) {
                if ($value === "0") {
                    $connection->query("update `products` set `$valuekey`=10 where `id`='$id' ");
                }
            }
        }
    }
}
