/*initial data insers*/

-- Initial product data
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
   ),
   (
      'Biscoff Float', 
      'Frozen_Dessert', 
      'An indulgent layered dessert combining the caramelized sweetness of Biscoff cookies with smooth whipped cream and creamy custard. Every bite is a delightful harmony of textures and flavors, perfect for dessert lovers seeking a refined yet comforting treat.', 
      '/image/Biscoff-Float.jpg', 
      CURRENT_DATE, 
      150.00, 
      120.00, 
      80
   ),
   (
      'Black Sambo', 
      'Cold_Dessert', 
      'A two-layered gelatin dessert showcasing the richness of creamy milk on one side and decadent chocolate on the other. Smooth, chilled, and satisfying, this treat is perfect for those who adore classic contrasts in flavor and texture.', 
      '/image/Black-Sambo.jpg', 
      CURRENT_DATE, 
      150.00, 
      100.00, 
      120
   ),
   (
      'Brigadeiro Cake', 
      'Frozen_Dessert', 
      'A Brazilian-inspired frozen treat featuring layers of rich chocolate cake and creamy Brigadeiro frosting. This irresistible dessert offers the ultimate chocolate experience with a soft, fudgy texture and intense flavor.', 
      '/image/Brigadeiro-Cake.jpg', 
      CURRENT_DATE, 
      180.00, 
      150.00, 
      60
   ),
   (
      'Buko Pandan', 
      'Cold_Dessert', 
      'A Filipino classic made with tender young coconut, fragrant pandan jelly, and sweetened cream. This refreshing dessert delivers a perfect balance of tropical flavors and creamy indulgence, making it a favorite for any occasion.', 
      '/image/Buko-Pandan.jpg', 
      CURRENT_DATE, 
      60.00, 
      35.00, 
      70
   ),
   (
      'Cookies & Cream Cheese Cake', 
      'Cold_Dessert', 
      'A rich, creamy cheesecake infused with the nostalgic flavor of cookies and cream. Featuring a velvety smooth texture and a delightful crunch from cookie pieces, this dessert is the ultimate blend of classic comfort and gourmet flair.', 
      '/image/Cookies-&-Cream-Cheese-Cake.jpg', 
      CURRENT_DATE, 
      200.00, 
      180.00, 
      50
   ),
   (
      'Panna Cotta', 
      'Cold_Dessert', 
      'A creamy and silky Italian dessert made from sweetened cream thickened with gelatin, often served with fruit or caramel sauce. It offers a light and elegant way to end a meal.', 
      '/image/Panna-Cotta.jpg', 
      CURRENT_DATE, 
      150.00, 
      100.00, 
      70
   ),
   (
      'Crème Brûlée', 
      'Cold_Dessert', 
      'A classic French custard dessert topped with a layer of hardened caramelized sugar. Its smooth custard and crackling sugar make for a delightful texture contrast.', 
      '/image/Creme-Brulee.jpg', 
      CURRENT_DATE, 
      200.00, 
      150.00, 
      50
   ),
   (
      'Churros', 
      'Hot_Dessert', 
      'Crisp, fried dough pastries dusted with cinnamon sugar, served with chocolate or dulce de leche for dipping. Perfect for sharing or indulging in a sweet snack.', 
      '/image/Churros.jpg', 
      CURRENT_DATE, 
      120.00, 
      80.00, 
      100
   ),
   (
      'Apple Pie', 
      'Room_Temperature_Dessert', 
      'A timeless favorite made with sweetened apple slices baked in a flaky pastry crust. Its warm, comforting flavors are perfect for any occasion.', 
      '/image/Apple-Pie.jpg', 
      CURRENT_DATE, 
      180.00, 
      130.00, 
      40
   ),
   (
      'Cannoli', 
      'Room_Temperature_Dessert', 
      'A Sicilian dessert featuring a crispy shell filled with sweet ricotta cheese and often garnished with chocolate chips or candied fruit.', 
      '/image/Cannoli.jpg', 
      CURRENT_DATE, 
      150.00, 
      120.00, 
      60
   ),
   (
      'Macarons', 
      'Bite-sized_Dessert', 
      'Elegant French sandwich cookies made with almond flour, filled with buttercream, ganache, or jam. Their delicate texture and vibrant colors make them a visual and flavorful treat.', 
      '/image/Macarons.jpg', 
      CURRENT_DATE, 
      250.00, 
      200.00, 
      50
   ),
   (
      'Baklava', 
      'Room_Temperature_Dessert', 
      'A Middle Eastern pastry made with layers of phyllo dough, nuts, and honey syrup. Its rich sweetness and flaky texture make it irresistible.', 
      '/image/Baklava.jpg', 
      CURRENT_DATE, 
      220.00, 
      180.00, 
      30
   ),
   (
      'Tart Tatin', 
      'Room_Temperature_Dessert', 
      'An upside-down caramelized apple tart that’s both rustic and sophisticated. Its rich caramel flavors and buttery crust are a crowd-pleaser.', 
      '/image/Tart-Tatin.jpg', 
      CURRENT_DATE, 
      200.00, 
      160.00, 
      35
   ),
   (
      'Red Velvet Cupcakes', 
      'Room_Temperature_Dessert', 
      'Moist, red-colored cupcakes with a hint of cocoa and topped with cream cheese frosting. Each bite offers the perfect balance of sweetness and tanginess.', 
      '/image/Red-Velvet-Cupcakes.jpg', 
      CURRENT_DATE, 
      100.00, 
      70.00, 
      80
   ),
   (
      'Éclairs', 
      'Room_Temperature_Dessert', 
      'A French pastry made with choux dough, filled with custard or cream, and topped with a glossy chocolate glaze. A luxurious treat for dessert lovers.', 
      '/image/Eclairs.jpg', 
      CURRENT_DATE, 
      150.00, 
      120.00, 
      60
   );

UPDATE `crem_de_la_crem`
SET is_available = 0, quantity = 0
WHERE id >= 9;

-- Initial restock history data
INSERT INTO `restock_history` 
(item_id, datetime, old_quantity, quantity_added, new_quantity, updated_by) 
VALUES
    -- Mango Float (total: 100)
    (1, '2025-05-15 09:00:00', 0, 60, 60, 'System'),
    (1, '2025-05-18 14:30:00', 60, 40, 100, 'System'),
    
    -- Munchkins (total: 300)
    (2, '2025-05-15 09:15:00', 0, 150, 150, 'System'),
    (2, '2025-05-17 11:00:00', 150, 100, 250, 'System'),
    (2, '2025-05-19 16:45:00', 250, 50, 300, 'System'),
    
    -- Biscoff Float (total: 80)
    (3, '2025-05-15 09:30:00', 0, 50, 50, 'System'),
    (3, '2025-05-18 15:00:00', 50, 30, 80, 'System'),
    
    -- Black Sambo (total: 120)
    (4, '2025-05-15 09:45:00', 0, 70, 70, 'System'),
    (4, '2025-05-18 15:15:00', 70, 50, 120, 'System'),
    
    -- Brigadeiro Cake (total: 60)
    (5, '2025-05-15 10:00:00', 0, 60, 60, 'System'),
    
    -- Buko Pandan (total: 70)
    (6, '2025-05-15 10:15:00', 0, 40, 40, 'System'),
    (6, '2025-05-18 15:45:00', 40, 30, 70, 'System'),
    
    -- Cookies & Cream Cheese Cake (total: 50)
    (7, '2025-05-15 10:30:00', 0, 50, 50, 'System'),
    
    -- Panna Cotta (total: 70)
    (8, '2025-05-15 10:45:00', 0, 40, 40, 'System'),
    (8, '2025-05-18 16:15:00', 40, 30, 70, 'System'),
    
    -- Items 9-17 start with 0 quantity as per UPDATE statement
    (9, '2025-05-15 11:00:00', 0, 0, 0, 'System'),
    (10, '2025-05-15 11:15:00', 0, 0, 0, 'System'),
    (11, '2025-05-15 11:30:00', 0, 0, 0, 'System'),
    (12, '2025-05-15 11:45:00', 0, 0, 0, 'System'),
    (13, '2025-05-15 12:00:00', 0, 0, 0, 'System'),
    (14, '2025-05-15 12:15:00', 0, 0, 0, 'System'),
    (15, '2025-05-15 12:30:00', 0, 0, 0, 'System'),
    (16, '2025-05-15 12:45:00', 0, 0, 0, 'System'),
    (17, '2025-05-15 13:00:00', 0, 0, 0, 'System');