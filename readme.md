Code hệ thống quản lí bán thiết bị đeo thông minh  có các chức năng:

- đăng nhập, kí (xác tài khoản email), quên mật khẩu
- giỏ hàng, mua hàng
- thanh toán hoá đơn( VN PAY hoặc thanh toán tiền mặt )
- admin quản lý sản phẩm, người dùng, đơn hàng, thống kê

DEMO VNPAY:

Ngân hàng	NCB

Số thẻ	9704198526191432198

Tên chủ thẻ	NGUYEN VAN A

Ngày phát hành	07/15

Mật khẩu OTP	123456

Cách chạy project:

Cách 1: Copy project vào httpdocs ở xamapp, sau đó mở trên web với: http://localhost/[tên project]/

Cách 2: Chạy bằng terminal: php -S localhost:443 (có thể thay 443 bằng port bất kỳ)

Link thư viện:

1: PHP Mailer - https://github.com/PHPMailer/PHPMailer

2: QR-CODE - https://github.com/endroid/qr-code


Chú ý: Để có thể sử dụng điện thoại quét mã QR-code  và xem được đơn hàng 

Bước 1: Dùng laptop để bật hostpot phát wifi và sau đó điện thoại kết nối wifi

Bước 2: Bấm window + r, nhập vào C:\Windows\System32\Drivers\etc

Bước 3: Mở file host dưới quyền admin

Bước 4: Kiểm tra địa chỉ ipv4 của máy bằng cách nhập trên terminal: ipconfig /all

Bước 5: Cấu hình ở file host như sau:

[ipv4] smartband.test.com

Thay ipv4 bằng địa chỉ ip của máy
