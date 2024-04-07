use `smartband`;
DELIMITER $$
DROP PROCEDURE IF EXISTS `CreateOrder`$$
CREATE PROCEDURE IF NOT EXISTS `CreateOrder`(
    IN user_id INT,
    IN payment_method ENUM('COD', 'VN_PAY'),
    IN p_fullName VARCHAR(255),
    IN p_address VARCHAR(255),
    IN p_phone VARCHAR(20)
)
BEGIN
    DECLARE cart_id INT;
    DECLARE total_price DECIMAL(10,2);
    DECLARE total_quantity INT;
    DECLARE order_id INT;

    -- Retrieve the cart id, total price and total quantity for the given user
    SELECT c.cart_id, c.total_price, c.total_quantity INTO cart_id, total_price, total_quantity
    FROM carts c
    WHERE c.user_id = user_id
    ORDER BY c.created_at DESC
    LIMIT 1;

    -- Create a new order using the cart's total price and total quantity
    INSERT INTO orders (user_id, total_price, total_quantity, payment_method, full_name, shipping_address, phone_number)
    VALUES (user_id, total_price, total_quantity, payment_method, p_fullName, p_address, p_phone);
    SET order_id = LAST_INSERT_ID();

    -- Loop through all items in the user's cart and add them to the order_items table
    INSERT INTO order_items (order_id, product_id, quantity, total_price)
    SELECT order_id, ci.product_id, ci.quantity, ci.total_price
    FROM cart_items ci
    WHERE ci.cart_id = cart_id;

    -- Optional: Clear the user's cart after creating the order
    DELETE FROM cart_items WHERE cart_id = cart_id;
    UPDATE carts SET total_price = 0, total_quantity = 0 WHERE cart_id = cart_id;
    
    -- Return the new order ID
    SELECT order_id;
END$$

DELIMITER ;
