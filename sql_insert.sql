CREATE TABLE `product` (
                           `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                           `title` varchar(255) NOT NULL,
                           `price` float NOT NULL
) ENGINE=InnoDB CHARSET=utf8;

CREATE TABLE `product_tag` (
                               `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                               `title` varchar(255) NOT NULL
) ENGINE=InnoDB CHARSET=utf8;

CREATE TABLE product_tag_product (
                                     product_id INT NOT NULL,
                                     product_tag_id INT NOT NULL,
                                     PRIMARY KEY (product_id, product_tag_id),
                                     FOREIGN KEY (product_id) REFERENCES product(id),
                                     FOREIGN KEY (product_tag_id) REFERENCES product_tag(id)
) ENGINE=InnoDB CHARSET=utf8;


CREATE TABLE `exchange_rate` (
                                 `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                 `title` varchar(255) NOT NULL,
                                 `rate` float NOT NULL
) ENGINE=InnoDB CHARSET=utf8;

INSERT INTO `exchange_rate` (`id`, `title`, `rate`) VALUES (1, 'EUR', 1);

CREATE TABLE `order` (
                         `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                         `email` varchar(255) NOT NULL,
                         `full_name` varchar(255) NOT NULL,
                         `phone` varchar(15) NOT NULL,
                         `total_price` float NOT NULL
) ENGINE=InnoDB CHARSET=utf8;

CREATE TABLE order_product (
                               product_id INT NOT NULL,
                               order_id INT NOT NULL,
                               item_count INT NOT NULL,
                               PRIMARY KEY (order_id, product_id),
                               FOREIGN KEY (order_id) REFERENCES `order`(id),
                               FOREIGN KEY (product_id) REFERENCES product(id)
) ENGINE=InnoDB CHARSET=utf8;


INSERT INTO `product` (`id`, `title`, `price`) VALUES
                                                   (1, 'Čepice', '25.00'),
                                                   (2, 'Kalhoty', '235.00');

INSERT INTO `product_tag` (`id`, `title`) VALUES
                                              (1, 'Hlava'),
                                              (2, 'Vlna'),
                                              (3, 'Muž'),
                                              (4, 'Nohy'),
                                              (5, 'Bavlna');

INSERT INTO `product_tag_product` (`product_id`, `product_tag_id`) VALUES
                                                                       (1, 1),
                                                                       (1, 2),
                                                                       (1, 3),
                                                                       (2, 4),
                                                                       (2, 5),
                                                                       (2, 3);