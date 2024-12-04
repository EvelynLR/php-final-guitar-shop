<?php
 class Category extends DatabaseObject {
    static protected $table_name = 'categories';
    static protected $db_columns = ['id', 'categoryName'];
    public $id;
    public $categoryName;
    public function __construct($args=[]) {
        $this->id = $args['id'] ?? '';
        $this->categoryName = $args['categoryName'] ?? '';
      }

 }