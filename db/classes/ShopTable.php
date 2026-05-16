<?php
declare(strict_types=1);

class ShopTable extends BaseTableWrapper 
{
    public function __construct(PDO $db) {
        parent::__construct($db, 'shop', 'shop_id');
    }
}