<?php
class FileUpload
{
    private static $instance = null;

    private function __construct()
    {

    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new FileUpload();
        }
        return self::$instance;
    }

    public function upload($target_dir, $target_file)
    {
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Kiểm tra file ảnh là ảnh thật hay ảnh giả
        $check = getimagesize($_FILES["img"]["tmp_name"]);
        if ($check === false) {
            return StatusUpload::FAKE_IMG;
        }

        // Kiểm tra xem tập tin đã tồn tại chưa
        if (file_exists($target_file)) {
            return StatusUpload::EXIST_IMG;
        }

        // Check file size is larger than 5MB
        if ($_FILES["img"]["size"] > 5000000) {
            return StatusUpload::SIZE_IMG;
        }

        // Cho phép một số định dạng tệp nhất định
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            return StatusUpload::FORMAT_IMG;
        }

        // thuc hien upload
        if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
            return StatusUpload::SUCCESS;
        }
        return StatusUpload::ERROR;
    }
}