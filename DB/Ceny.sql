SET SQL_SAFE_UPDATES = 0;
UPDATE Products SET Price = 84.45 WHERE ProductName REGEXP "craie|chaux|albatre|calcedoine|mastic|bentonite|silex";
UPDATE Products SET Price = 119.45 WHERE ProductName REGEXP "quartz|jaspe|fabulite|malachite|amethyste|porphyre|lave|sodalite|emeraude|holite";
UPDATE Products SET Price = 148.24 WHERE ProductName REGEXP "galene|saphir|topaze|onyx|lazuli|pepite|rubis|turquoise|resine|azurite|minium|corali|cobalt";
UPDATE Products SET Price = 98.40 WHERE ProductName REGEXP "prunelle|pivoine|quetsche";
UPDATE Products SET Price = 89.40 WHERE ProductName REGEXP "genet|pollen|buis|galapagos|danube|fuchsia|zinnia|noisetier|bahia";
UPDATE Products SET Price = 79.40 WHERE ProductName REGEXP "christaux|fusian|bahamas|fidij|camelia|coriandre|aster|marquiese|clairiere|petale|lavande|californie|tuile|carmel|caraibes|gravier|ivraie|schiste|muguet|pierre|lotus|mouette|egee";
