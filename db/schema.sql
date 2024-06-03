create table users (
    id int unsigned auto_increment not null,
    name varchar(255) not null,
    email varchar(255) not null,
    `address` varchar(255),
    `phone` varchar(255),
    `password` varchar(255) not null,
    visa_card varchar(255) not null default "0",
    profile_pic varchar(255),
    created_at datetime not null default now(),
    primary key(id)
);

create table admins (
    id int unsigned auto_increment not null,
    name varchar(255) not null,
    email varchar(255) not null,
    is_super ENUM("yes", "no") not null default "no",
    `password` varchar(255) not null,
    created_at datetime not null default now(),
    primary key(id)
);

create table orders(
    id int unsigned auto_increment not null,
    `creator_name` varchar(255) not null,
    `creator_email` varchar(255) not null,
    `creator_phone` varchar(255) not null,
    `creator_address` varchar(255) not null,
    `winner_name` varchar(255) not null,
    `winner_email` varchar(255) not null,
    `winner_phone` varchar(255) not null,
    `winner_address` varchar(255) not null,
    `product` varchar(255) not null,
    `last_price` varchar(255) not null, 
    created_at datetime not null default now(),
    primary key(id)
);

create table cats(
    id int unsigned auto_increment not null,
    name varchar(255) not null,
    arabic_name varchar(255) not null,
    img varchar(255) not null,
    created_at datetime not null default now(),
    primary key(id)
);

create table products(
    id int unsigned auto_increment not null,
    name varchar(255) not null,
    `desc` TEXT not null,
    price DECIMAL(10,0) not null,
    pieces_no SMALLINT not null,
    img varchar(255) not null,
    active ENUM("yes", "pending", "no", "finished") not null default 'pending',
    product_owner int unsigned,
    cat_id INT unsigned,
    created_at datetime not null default now(),
    finish_at varchar(255),
    user_finish_at varchar(255),
    primary key(id),
    foreign key(cat_id) references cats(id) on delete set null,
    foreign key(product_owner) references users(id) on delete set null
);

create table auction(
    id int unsigned auto_increment not null,
    price int not null,
    `user_id` int unsigned,
    product_id int unsigned,
    added_at datetime not null default now(),
    finish_at datetime,
    primary key(id),
    foreign key(`user_id`) references users(id),
    foreign key(`product_id`) references products(id)
);

create table contact(
    id int unsigned auto_increment not null,
    username varchar(255) not null default "Anonymous",
    `message` varchar(255) not null,
    created_at datetime not null default now(),
    primary key(id)
);

create table profits(
    id int unsigned auto_increment not null,
    profit varchar(255),
    auction_name varchar(255) not null,
    created_at datetime not null default now(),
    primary key(id)
);