use `smartband`;
DELIMITER $$
DROP PROCEDURE IF EXISTS `AddOrUpdateCartItem`$$

CREATE PROCEDURE AddOrUpdateCartItem (
    IN p_user_id INT,
    IN p_product_id INT,
    IN p_quantity INT,
    IN p_price DECIMAL(10,2)
)
BEGIN
    DECLARE v_cart_id INT;

    -- Kiểm tra xem người dùng đã có giỏ hàng chưa
    SELECT cart_id INTO v_cart_id
    FROM carts
    WHERE user_id = p_user_id
    LIMIT 1;

    -- Nếu không có, tạo giỏ hàng mới
    IF v_cart_id IS NULL THEN
        INSERT INTO carts (user_id, total_price, total_quantity)
        VALUES (p_user_id, 0, 0);

        SET v_cart_id = LAST_INSERT_ID();
    END IF;

    -- Thêm sản phẩm vào giỏ hàng hoặc cập nhật số lượng nếu sản phẩm đã tồn tại
    INSERT INTO cart_items (cart_id, product_id, quantity, total_price)
    VALUES (v_cart_id, p_product_id, p_quantity, p_price * p_quantity)
    ON DUPLICATE KEY UPDATE 
        quantity = quantity + p_quantity,
        total_price = total_price + (p_price * p_quantity);

    -- Cập nhật tổng giá và tổng số lượng trong giỏ hàng
    UPDATE carts
    SET total_price = (SELECT SUM(total_price) FROM cart_items WHERE cart_id = v_cart_id),
        total_quantity = (SELECT SUM(quantity) FROM cart_items WHERE cart_id = v_cart_id)
    WHERE cart_id = v_cart_id;
END$$

DELIMITER ;
