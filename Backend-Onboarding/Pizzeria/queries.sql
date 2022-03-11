-- Pizzen mit Salami UND Preis >= 7€
SELECT * FROM pizzeria.produkt as p
WHERE p.preis >= 7.0 and 'Salami' in 
    (SELECT z.name FROM pizzeria.produkt_zutat as pz
    LEFT JOIN pizzeria.zutat as z ON z.zutat_id=pz.zutat_id
    WHERE pz.produkt_id=p.produkt_id);

-- Bestellungen + Produkte für DATE=2021-12-00 to 2022-01-01
SELECT b.bestellung_id, p.name, b.datum FROM pizzeria.bestellung as b 
RIGHT JOIN pizzeria.lieferung as bp ON b.bestellung_id = bp.bestellung_id
LEFT JOIN pizzeria.produkt as p ON p.produkt_id = bp.produkt_id
WHERE datum BETWEEN '2021-12-01' and '2021-12-31';

-- Bestellungen mit Salami
SELECT b.bestellung_id FROM pizzeria.bestellung as b
WHERE 'Salami' in (
    SELECT DISTINCT z.name FROM pizzeria.lieferung as l
    RIGHT JOIN pizzeria.produkt_zutat as pz ON pz.produkt_id = l.produkt_id
    LEFT JOIN pizzeria.zutat as z ON pz.zutat_id = z.zutat_id 
    WHERE l.bestellung_id = b.bestellung_id
)

-- Bestellungen + Produkte pro Kunde
SELECT k.kunde_id, b.bestellung_id, p.name FROM pizzeria.kunde as k
RIGHT JOIN pizzeria.bestellung as b ON k.kunde_id = b.kunde_id
RIGHT JOIN pizzeria.lieferung as l ON b.bestellung_id = l.bestellung_id
LEFT JOIN pizzeria.produkt as p ON l.produkt_id = p.produkt_id

-- Bestellung Anzahl >= 2 UND Produkte >= 3
SELECT d.bestellung_id, p.name
FROM pizzeria.lieferung as d
LEFT JOIN pizzeria.produkt as p ON d.produkt_id = p.produkt_id
WHERE d.bestellung_id in (
    SELECT l.bestellung_id
    FROM pizzeria.lieferung as l
    WHERE l.bestellung_id not in (
            SELECT DISTINCT bestellung_id 
            FROM pizzeria.lieferung 
            WHERE anzahl < 2) 
    GROUP BY l.bestellung_id
    HAVING count(l.bestellung_id) >= 3)

SELECT l.bestellung_id, p.name
FROM pizzeria.lieferung as l
LEFT JOIN pizzeria.produkt as p ON l.produkt_id = p.produkt_id
WHERE l.bestellung_id not in (
        SELECT DISTINCT bestellung_id 
        FROM pizzeria.lieferung 
        WHERE anzahl < 2
    ) and l.bestellung_id not in (
        SELECT bestellung_id 
        FROM pizzeria.lieferung 
        WHERE bestellung_id = l.bestellung_id
        HAVING count(*) < 3
    ) 
-- Kunden die alle Produkte bereits bestellt haben
SELECT k.kunde_id
FROM pizzeria.kunde as k
HAVING (SELECT COUNT(DISTINCT produkt_id) 
        FROM pizzeria.bestellung as b
        RIGHT JOIN pizzeria.lieferung as l ON l.bestellung_id = b.bestellung_id
        WHERE k.kunde_id = b.kunde_id) = (SELECT COUNT(*) FROM pizzeria.produkt)

