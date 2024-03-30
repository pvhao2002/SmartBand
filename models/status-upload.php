<?php
class StatusUpload
{
    const FAKE_IMG = 'File không phải là hình ảnh';
    const EXIST_IMG = 'File đã tồn tại';
    const SIZE_IMG = 'File của bạn quá lớn. File không được lớn hơn 5MB.';
    const FORMAT_IMG = 'Chỉ cho phép các file JPG, JPEG, PNG và GIF';
    const SUCCESS = 'Thành công';
    const ERROR = 'Đã xảy ra lỗi khi upload file';

    public static function fromValue($value)
    {
        $reflection = new ReflectionClass(static::class);
        $constants = $reflection->getConstants();

        if (in_array($value, $constants)) {
            return $value;
        }

        throw new InvalidArgumentException("Không có giá trị: $value");
    }
}