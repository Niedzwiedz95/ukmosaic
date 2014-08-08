-- Required to perform the updates.
SET SQL_SAFE_UPDATES = 0;

-- Set the prices of the products.
UPDATE Products SET Price = 49.99 WHERE ProductName REGEXP "ontario|noir|jaune|havane|gris|gris pale|caramel|blanc|rouge|chocolat";
UPDATE Products SET Price = 52.45 WHERE ProductName REGEXP "antracite|blue pale|cafe|cognac|gris perle|ivoire|lin|rose|super blanc|taupe|vert pale";
UPDATE Products SET Price = 57.45 WHERE ProductName REGEXP "blue|parme|pistache|vanille|vert|vieax rose";
UPDATE Products SET Price = 79.40 WHERE ProductName REGEXP "christaux|fusian|bahamas|fidij|camelia|coriandre|aster|marquiese|clairiere|petale|lavande|californie|tuile|carmel|caraibes|gravier|ivraie|schiste|muguet|pierre|lotus|mouette|egee";
UPDATE Products SET Price = 84.45 WHERE ProductName REGEXP "craie|chaux|albatre|calcedoine|mastic|bentonite|silex";
UPDATE Products SET Price = 89.40 WHERE ProductName REGEXP "genet|pollen|buis|galapagos|danube|fuchsia|zinnia|noisetier|bahia";
UPDATE Products SET Price = 98.40 WHERE ProductName REGEXP "prunelle|pivoine|quetsche";
UPDATE Products SET Price = 118.25 WHERE ProductName REGEXP "Basket Weave 1|Basket Weave 4|Basket Weave 6";
UPDATE Products SET Price = 119.45 WHERE ProductName REGEXP "quartz|jaspe|fabulite|malachite|amethyste|porphyre|lave|sodalite|emeraude|holite";
UPDATE Products SET Price = 127.25 WHERE ProductName REGEXP "Basket Weave 2";
UPDATE Products SET Price = 148.24 WHERE ProductName REGEXP "galene|saphir|topaze|onyx|lazuli|pepite|rubis|turquoise|resine|azurite|minium|corali|cobalt";

-- Set the descriptions of the products.
UPDATE Products SET Description = "Black and white design with diamond border" WHERE ProductName REGEXP "Panda Design";