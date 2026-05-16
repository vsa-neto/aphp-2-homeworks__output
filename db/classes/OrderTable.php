<?php
declare(strict_types=1);

class OrderTable extends BaseTableWrapper 
{
    public function __construct(PDO $db) {
        parent::__construct($db, 'order', 'order_id');
    }
}