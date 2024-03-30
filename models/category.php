<?php
class Category
{
    private $categoryId;
    private $categoryName;
    private $categoryDescription;
    private $status;

    public function __construct($categoryId, $categoryName, $categoryDescription, $status)
    {
        $this->categoryId = $categoryId;
        $this->categoryName = $categoryName;
        $this->categoryDescription = $categoryDescription;
        $this->status = $status;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function getCategoryName()
    {
        return $this->categoryName;
    }

    public function getCategoryDescription()
    {
        return $this->categoryDescription;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function setCategoryName($categoryName)
    {
        $this->categoryName = $categoryName;
    }

    public function setCategoryDescription($categoryDescription)
    {
        $this->categoryDescription = $categoryDescription;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public static function fromResultSet($resultSet)
    {
        $category = new Category(
            $resultSet['category_id'] ?? '',
            $resultSet['category_name'] ?? '',
            $resultSet['description'] ?? '',
            $resultSet['status'] ?? ''
        );
        return $category;
    }


}
