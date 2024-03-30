<?php
require_once('db.php');
class UserDAO
{
    private static $instance = NULl;
    private function __construct()
    {
    }
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new UserDAO();
        }
        return self::$instance;
    }

    public function checkEmailExist($email)
    {
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $db = DB::getInstance();
        $req = $db->query($sql);
        $item = $req->fetch();
        return $item;
    }

    public function getAll()
    {
        $sql = "
                    select *
                    from users
                    where role = 'user';
                ";
        $db = DB::getInstance();
        $req = $db->query($sql);
        $list = [];
        foreach ($req->fetchAll() as $item) {
            $list[] = User::fromResultSet($item);
        }
        return $list;
    }

    public function getById($id)
    {
        $sql = "
                    select *
                    from users
                    where user_id = :user_id;
                ";
        $db = DB::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute(['user_id' => $id]);
        $item = $stmt->fetch();
        return User::fromResultSet($item);
    }

    public function register($sql)
    {
        $db = DB::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $lastId = $db->lastInsertId();
        return $lastId;
    }

    public function action($sql)
    {
        $db = DB::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();
    }
}