/*initial data insers*/

INSERT INTO `crem_de_la_crem` 
(name, category, description, image_path, last_restocked, sell_price, cost_price, quantity) 
VALUES 
(
   'Mango Float', 
   'Frozen_Dessert', 
   'A classic Filipino chilled dessert featuring layers of ripe, sweet mango puree, rich whipped cream, and graham cracker crumbs. Creamy, refreshing, and indulgent, this dessert combines the tropical sweetness of Philippine mangoes with a smooth, velvety texture. Perfect for hot days or as a light, elegant dessert after a meal. Each serving offers a delightful blend of fruity freshness and creamy decadence.', 
   '/image/Mango-Float.jpg', 
   CURRENT_DATE, 
   150.00, 
   120.00, 
   100
),
(
    'Munchkins', 
    'Bite-sized_Dessert', 
    'Delightful mini chocolate donuts, perfectly bite-sized with a marhsmallow filling and topped with coconut shavings. These small, soft donuts are ideal for quick snacks or as a sweet treat to share. Each munchkin is crafted to provide a burst of chocolate flavor in one compact, irresistible package.', 
    '/image/munchkins.jpg', 
    CURRENT_DATE, 
    50.00, 
    30.00, 
    300
);