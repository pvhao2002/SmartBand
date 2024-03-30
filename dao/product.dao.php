<?php
require_once ('db.php');
class ProductDAO
{
    private static $instance = NULl;
    private function __construct()
    {
    }
    public static function getInstance()
    {
        if (!isset (self::$instance)) {
            self::$instance = new ProductDAO();
        }
        return self::$instance;
    }

    public function getTop10ProductByCategory($category_id)
    {
        $sql = "SELECT p.*, c.category_name
                FROM products p
                    INNER JOIN categories c ON c.category_id = p.category_id
                WHERE p.status = 'ACTIVE' AND p.category_id = $category_id
                ORDER BY p.created_at DESC
                LIMIT 10
                ";
        $db = DB::getInstance();
        $req = $db->query($sql);
        $list = [];
        $reqList = $req->fetchAll();
        if ($reqList) {
            foreach ($reqList as $item) {
                $list[] = Product::fromResultSet($item);
            }
        }
        return $list;
    }

    public function getAll()
    {
        $sql = "SELECT p.*, c.category_name
                FROM products p
                    INNER JOIN categories c ON c.category_id = p.category_id
                WHERE p.status = 'ACTIVE'
                ";
        $db = DB::getInstance();
        $req = $db->query($sql);
        $list = [];
        foreach ($req->fetchAll() as $item) {
            $list[] = Product::fromResultSet($item);
        }
        return $list;
    }
    public function getProducPaginate($page, $limit, $cate, $sort)
    {
        $orderBy = "";
        switch ($sort) {
            case 'A-Z':
                $orderBy = "ORDER BY p.product_name";
                break;
            case 'Z-A':
                $orderBy = "ORDER BY p.product_name desc";
                break;
            case 'price-desc':
                $orderBy = "ORDER BY p.price desc";
                break;
            case 'price-asc':
                $orderBy = "ORDER BY p.price";
                break;
            default:
                $orderBy = "ORDER BY p.created_at desc";
                break;
        }

        $start = ((int) $page - 1) * ((int) $limit);
        $sql = "
                SELECT p.*, c.category_name
                FROM products p
                    INNER JOIN categories c ON c.category_id = p.category_id
                WHERE p.status = 'ACTIVE' AND IF('$cate' = '0', 1, p.category_id = '$cate')
                $orderBy
                LIMIT $start, $limit
                ";
        $db = DB::getInstance();
        $req = $db->query($sql);
        $list = [];
        foreach ($req->fetchAll() as $item) {
            $list[] = Product::fromResultSet($item);
        }

        $totalRows = $db->query("
            SELECT COUNT(1) AS total 
            FROM products 
            WHERE status='ACTIVE'
                AND IF('$cate' = '0', 1, category_id = '$cate')
        ")->fetch(PDO::FETCH_ASSOC)['total'];
        return ['data' => $list, 'total' => $totalRows];
    }

    public function getById($id)
    {
        $sql =
            "
                SELECT p.*, c.category_name
                FROM products p
                    INNER JOIN categories c ON c.category_id = p.category_id
                WHERE p.status = 'ACTIVE' AND p.product_id = $id
            ";
        $db = DB::getInstance();
        $req = $db->query($sql);
        $item = $req->fetch();
        return Product::fromResultSet($item);
    }

    public function action($sql)
    {
        $db = DB::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();
    }

}