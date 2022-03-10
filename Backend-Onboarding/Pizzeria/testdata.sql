INSERT INTO pizzeria.ort VALUES(47546,'Kalkar');
INSERT INTO pizzeria.ort VALUES(47555,'Kleve');
INSERT INTO pizzeria.ort VALUES(47444,'Emmerich');
INSERT INTO pizzeria.ort VALUES(47333,'Bocholt');
INSERT INTO pizzeria.ort VALUES(47222,'Rees');

INSERT INTO pizzeria.zutat VALUES(1, 'Salami');
INSERT INTO pizzeria.zutat VALUES(2, 'Käse');
INSERT INTO pizzeria.zutat VALUES(3, 'Schinken');
INSERT INTO pizzeria.zutat VALUES(4, 'Pilze');
INSERT INTO pizzeria.zutat VALUES(5, 'Tomaten');

INSERT INTO pizzeria.produkt VALUES(1, 'Salami', null, 6.0);
INSERT INTO pizzeria.produkt VALUES(2, 'Margherita', null, 4.0);
INSERT INTO pizzeria.produkt VALUES(3, 'Funghi', null, 7.0);
INSERT INTO pizzeria.produkt VALUES(4, 'Calzone', null, 10.0);
INSERT INTO pizzeria.produkt VALUES(5, 'Vegetaria', null, 5.0);

INSERT INTO pizzeria.produkt_zutat VALUES(1, 1);
INSERT INTO pizzeria.produkt_zutat VALUES(1, 2);
INSERT INTO pizzeria.produkt_zutat VALUES(2, 2);
INSERT INTO pizzeria.produkt_zutat VALUES(3, 2);
INSERT INTO pizzeria.produkt_zutat VALUES(3, 3);
INSERT INTO pizzeria.produkt_zutat VALUES(3, 4);
INSERT INTO pizzeria.produkt_zutat VALUES(4, 1);
INSERT INTO pizzeria.produkt_zutat VALUES(4, 2);
INSERT INTO pizzeria.produkt_zutat VALUES(4, 3);
INSERT INTO pizzeria.produkt_zutat VALUES(4, 4);
INSERT INTO pizzeria.produkt_zutat VALUES(4, 5);
INSERT INTO pizzeria.produkt_zutat VALUES(5, 2);
INSERT INTO pizzeria.produkt_zutat VALUES(5, 4);
INSERT INTO pizzeria.produkt_zutat VALUES(5, 5);

INSERT INTO pizzeria.kunde VALUES(1, 47546, 'Bahnhofstrasse', 50);
INSERT INTO pizzeria.kunde VALUES(2, 47555, 'Baumstrasse', 5);
INSERT INTO pizzeria.kunde VALUES(3, 47444, 'Dorfstrasse', 543);
INSERT INTO pizzeria.kunde VALUES(4, 47333, 'Lachstrasse', 98);
INSERT INTO pizzeria.kunde VALUES(5, 47222, 'Lauchstrasse', 1);

INSERT INTO pizzeria.warenkorb VALUES(1, 1, 1);
INSERT INTO pizzeria.warenkorb VALUES(1, 3, 2);
INSERT INTO pizzeria.warenkorb VALUES(3, 4, 4);
INSERT INTO pizzeria.warenkorb VALUES(3, 5, 2);
INSERT INTO pizzeria.warenkorb VALUES(3, 2, 1);

INSERT INTO pizzeria.bestellung VALUES(1, 1, '2022-01-01');
INSERT INTO pizzeria.bestellung VALUES(2, 1, '2021-12-12');
INSERT INTO pizzeria.bestellung VALUES(3, 1, '2021-11-11');
INSERT INTO pizzeria.bestellung VALUES(4, 2, '2020-12-12');
INSERT INTO pizzeria.bestellung VALUES(5, 3, '2022-02-01');
INSERT INTO pizzeria.bestellung VALUES(6, 3, '2022-03-01');
INSERT INTO pizzeria.bestellung VALUES(7, 4, '2021-07-09');
INSERT INTO pizzeria.bestellung VALUES(8, 5, '2022-03-06');
INSERT INTO pizzeria.bestellung VALUES(9, 5, '2022-03-04');

INSERT INTO pizzeria.lieferung VALUES(1, 1, 3);
INSERT INTO pizzeria.lieferung VALUES(1, 2, 3);
INSERT INTO pizzeria.lieferung VALUES(1, 3, 3);
INSERT INTO pizzeria.lieferung VALUES(1, 4, 3);
INSERT INTO pizzeria.lieferung VALUES(1, 5, 3);
INSERT INTO pizzeria.lieferung VALUES(2, 1, 3);
INSERT INTO pizzeria.lieferung VALUES(2, 5, 3);
INSERT INTO pizzeria.lieferung VALUES(3, 1, 3);
INSERT INTO pizzeria.lieferung VALUES(4, 4, 3);
INSERT INTO pizzeria.lieferung VALUES(5, 3, 3);
INSERT INTO pizzeria.lieferung VALUES(6, 2, 3);
INSERT INTO pizzeria.lieferung VALUES(7, 1, 3);
INSERT INTO pizzeria.lieferung VALUES(8, 2, 3);
INSERT INTO pizzeria.lieferung VALUES(8, 3, 3);
INSERT INTO pizzeria.lieferung VALUES(8, 5, 3);
INSERT INTO pizzeria.lieferung VALUES(9, 1, 3);
INSERT INTO pizzeria.lieferung VALUES(9, 2, 3);
INSERT INTO pizzeria.lieferung VALUES(9, 3, 3);
INSERT INTO pizzeria.lieferung VALUES(9, 4, 3);
INSERT INTO pizzeria.lieferung VALUES(9, 5, 3);