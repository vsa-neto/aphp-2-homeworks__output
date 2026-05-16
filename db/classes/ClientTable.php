<?php
declare(strict_types=1);

class ClientTable extends BaseTableWrapper 
{
    public function __construct(PDO $db) {
        parent::__construct($db, 'client', 'client_id');
    }
}