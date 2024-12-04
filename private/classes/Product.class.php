<?php
 class Product extends DatabaseObject {
    static protected $table_name = 'products';
    static protected $db_columns = ['id', 'categoryID', 'productCode', 'productName', 'listPrice'];

    public $id;
    public $categoryID;
    public $productCode;
    public $productName;
    public $listPrice;
    public function __construct($args=[]) {
        $this->id = $args['id'] ?? '';
        $this->categoryID = $args['categoryID'] ?? '';
        $this->productCode = $args['productCode'] ?? '';
        $this->productName = $args['productName'] ?? '';
        $this->listPrice = $args['listPrice'] ?? '';
      }
 }