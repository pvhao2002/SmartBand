<?php
class User
{
    private $userId;
    private $email;
    private $password;
    private $fullName;
    private $role;
    private $status;

    public function __construct($userId, $email, $password, $fullName, $role, $status)
    {
        $this->userId = $userId;
        $this->email = $email;
        $this->password = $password;
        $this->fullName = $fullName;
        $this->role = $role;
        $this->status = $status;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getFullName()
    {
        return $this->fullName;
    }

    public function getRole()
    {
        return $this->role;
    }
    public function getStatusValue()
    {
        return $this->status;
    }

    public function getStatus()
    {
        switch($this->status){
            case 'active':
                return 'Đã kích hoạt';
            case 'block':
                return 'Bị khóa';
            default:
                return 'Chưa kích hoạt';
        }
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getUserId()
    {
        return $this->userId;
    }


    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function toArray()
    {
        return array(
            "userId" => $this->userId,
            "email" => $this->email,
            "password" => $this->password,
            "fullName" => $this->fullName,
            "role" => $this->role
        );
    }
    public static function fromResultSet($arr)
    {
        return new User(
            $arr["user_id"],
            $arr["email"],
            $arr["password"],
            $arr["full_name"],
            $arr["role"],
            $arr["status"]
        );
    }
}