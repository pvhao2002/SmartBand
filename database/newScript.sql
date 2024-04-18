drop database if exists `web-smartband`;
create database if not exists `web-smartband`;
use `web-smartband`;
create table if not exists `otp` (
    id int auto_increment primary key,
    otp varchar(6) not null,
    email varchar(50) not null,
    created_at timestamp default current_timestamp
);
create table if not exists `role` (
    role_id int auto_increment primary key,
    role_code varchar(50) not null,
    role_name varchar(50) not null
);
create table if not exists `permission` (
    permission_id int auto_increment primary key,
    permission_code varchar(50) not null,
    permission_name varchar(50) not null,
    role_id int not null,
    foreign key (role_id) references role (role_id)
);
create table if not exists `users` (
    user_id int auto_increment primary key,
    email varchar(50) not null,
    password varchar(255) not null,
    phone varchar(15) not null,
    full_name varchar(50) not null,
    status enum ('active', 'inactive', 'block') default 'active',
    point decimal(10, 2) default 0,
    role_id int not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp,
    foreign key (role_id) references role (role_id)
);
create table if not exists `address` (
    address_id int auto_increment primary key,
    user_id int,
    address_name varchar(50) not null,
    address_line varchar(500) not null,
    city varchar(50) not null,
    district varchar(50) not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp,
    foreign key (user_id) references users (user_id)
);
create table if not exists `leave` (
    leave_id int auto_increment primary key,
    user_id int,
    leave_date date not null,
    leave_type enum ('FULL_DAY', 'HALF_DAY') not null,
    message varchar(500) not null,
    status enum ('pending', 'approved', 'rejected') default 'pending',
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp,
    foreign key (user_id) references users (user_id)
);
create table if not exists `blog_type` (
    blog_type_id int auto_increment primary key,
    blog_type_name varchar(50) not null,
    status enum ('active', 'inactive') default 'active',
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp
);
create table if not exists `blog` (
    blog_id int auto_increment primary key,
    blog_type_id int,
    subject varchar(255) not null,
    content text not null,
    image varchar(255) not null,
    status enum ('active', 'inactive') default 'active',
    created_by varchar(50) default 'admin',
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp,
    foreign key (blog_type_id) references blog_type (blog_type_id)
);
create table if not exists `category` (
    category_id int auto_increment primary key,
    category_name varchar(50) not null,
    description text,
    status enum ('active', 'inactive') default 'active',
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp
);
create table if not exists `brand` (
    brand_id int auto_increment primary key,
    brand_name varchar(50) not null,
    status enum ('active', 'inactive') default 'active',
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp
);
create table if not exists `product` (
    product_id int auto_increment primary key,
    category_id int,
    brand_id int,
    product_name varchar(50) not null,
    price decimal(10, 2) not null,
    description text,
    status enum ('active', 'inactive') default 'active',
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp,
    foreign key (category_id) references category (category_id),
    foreign key (brand_id) references brand (brand_id)
);
create table if not exists `product_image` (
    product_image_id int auto_increment primary key,
    product_id int,
    image varchar(255) not null,
    foreign key (product_id) references product (product_id)
);
create table if not exists `product_info` (
    product_info_id int auto_increment primary key,
    product_id int,
    usage_object varchar(50) not null,
    dial_diameter varchar(50) not null,
    strap_material varchar(50) not null,
    glass_material varchar(50) not null,
    water_resistant varchar(50) not null,
    luminous_markets varchar(50) not null,
    energy_source varchar(50) not null,
    movement_type varchar(50) not null,
    manufacturing_location varchar(50) not null,
    foreign key (product_id) references product (product_id)
);
create table if not exists `product_voucher` (
    product_voucher_id int auto_increment primary key,
    product_id int,
    voucher_code varchar(50) not null,
    discount decimal(10, 2) not null,
    start_date date,
    end_date date,
    status enum ('active', 'inactive') default 'active',
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp,
    foreign key (product_id) references product (product_id)
);
create table if not exists `supplier` (
    supplier_id int auto_increment primary key,
    supplier_name varchar(50) not null,
    email varchar(50) not null,
    contact_person varchar(50) not null,
    phone_number varchar(15) not null,
    status enum ('active', 'inactive') default 'active'
);
create table if not exists `supplier_product` (
    supplier_product_id int auto_increment primary key,
    supplier_id int,
    product_id int,
    unit_price decimal(10, 2) not null,
    quantity int not null,
    status_order enum ('PAID', 'NOT_PAY') default 'NOT_PAY',
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp,
    foreign key (supplier_id) references supplier (supplier_id),
    foreign key (product_id) references product (product_id)
);
create table if not exists `order` (
    order_id int auto_increment primary key,
    user_id int,
    shipping_address varchar(500) not null,
    phone_number varchar(15) not null,
    full_name varchar(50) not null,
    total_price decimal(10, 2) not null,
    total_discount decimal(10, 2) not null,
    final_total_price decimal(10, 2) not null,
    total_quantity int not null,
    payment_method enum ('COD', 'VN_PAY', 'MOMO', 'CREDIT_CARD') default 'COD',
    status_order enum (
        'pending',
        'processing',
        'completed',
        'canceled',
        'refunded',
        'done'
    ) default 'pending',
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp,
    foreign key (user_id) references users (user_id)
);
create table if not exists `order_item` (
    order_item_id int auto_increment primary key,
    order_id int,
    product_id int,
    quantity int not null,
    unit_price decimal(10, 2) not null,
    total_price decimal(10, 2) not null,
    discount decimal(10, 2) not null,
    final_total_price decimal(10, 2) not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp,
    foreign key (order_id) references `order` (order_id),
    foreign key (product_id) references product (product_id)
);
create table if not exists `cart` (
    cart_id int auto_increment primary key,
    user_id int,
    total_price decimal(10, 2) not null,
    total_quantity int not null,
    total_discount decimal(10, 2) not null,
    final_total_price decimal(10, 2) not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp,
    foreign key (user_id) references users (user_id)
);
create table if not exists `cart_item` (
    cart_item_id int auto_increment primary key,
    cart_id int,
    product_id int,
    quantity int not null,
    unit_price decimal(10, 2) not null,
    total_price decimal(10, 2) not null,
    discount decimal(10, 2) not null,
    final_total_price decimal(10, 2) not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp,
    foreign key (cart_id) references cart (cart_id),
    foreign key (product_id) references product (product_id)
);