<?php

class OrderProductTable extends BaseTableWrapper 
{
    public function __construct(PDO $db) {
        parent::__construct($db, 'order_product', 'order_id');
    }
}