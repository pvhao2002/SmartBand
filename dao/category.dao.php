<?php
require_once('db.php');
class CategoryDAO
{
    private static $instance = NULl;
    private function __construct()
    {
    }
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new CategoryDAO();
        }
        return self::$instance;
    }

    public function getAll()
    {
        $sql = "
                SELECT *
                FROM categories
                WHERE status = 'ACTIVE'
                ";
        $db = DB::getInstance();
        $req = $db->query($sql);
        $list = [];
        foreach ($req->fetchAll() as $item) {
            $list[] = Product::fromResultSet($item);
        }
        return $list;
    }

    public function getById($id)
    {
        $sql =
            "
            SELECT *
            FROM categories
            WHERE status = 'ACTIVE'
            ";
        $db = DB::getInstance();
        $req = $db->query($sql);
        $item = $req->fetch();
        return Category::fromResultSet($item);
    }
}