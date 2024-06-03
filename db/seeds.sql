
INSERT INTO admins (name, email, password, is_super)
VALUES
("admin", "admin@mazadegypt.com", "$2y$10$Y2HNGH12bple8h70ZZNEFuqKn0kciE2zcIsP5rmoqe/WJA.jZnyZq", "yes");

INSERT INTO users (name, email, `address`, phone, `password`, visa_card)
values
('abdulrhman hani' , 'a@a.com', 'Alexandria, Egypt', '01275784221', '$2y$10$pt0RVnFQoSQFrezDQPK9bOzzm4JANRJ9T50lCj.tMGXoorf9EsdBS', '1234567890123456'),
('oooo' , 'o@o.com', 'Giza, Egypt', '01221457115', '$2y$10$pt0RVnFQoSQFrezDQPK9bOzzm4JANRJ9T50lCj.tMGXoorf9EsdBS', '0123456789123456');

INSERT INTO cats (name, arabic_name, img)
values
("paintArt","لوحات نادرة", "paint_art.jpg"),
("antiques","أنتيكات نادرة", "antiques.jpg"),
("otherPieces","قطع أخري نادرة", "otherPieces.jpg");

