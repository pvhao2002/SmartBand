<?php
require_once('db.php');
class DashboardDAO
{
    private static $instance = NULl;
    private function __construct()
    {
    }
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new DashboardDAO();
        }
        return self::$instance;
    }

    public function getDashboard()
    {
        $sql = "
                select count(1) as rs
                from products
                union all
                select count(1)
                from orders
                union all
                select sum(total_price)
                from orders
                where status != 'refunded'
                ";
        $db = DB::getInstance();
        $req = $db->query($sql);
        $rs = $req->fetchAll();
        return ['product' => $rs[0]['rs'], 'order' => $rs[1]['rs'], 'revenue' => $rs[2]['rs']];
    }
}