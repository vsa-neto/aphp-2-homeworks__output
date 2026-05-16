<?php
declare(strict_types=1);

class ProductTable extends BaseTableWrapper 
{
    public function __construct(PDO $db) {
        parent::__construct($db, 'product', 'product_id');
    }
}