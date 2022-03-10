drop database pizzeria;

create DATABASE pizzeria;

create table pizzeria.zutat (
	zutat_id int,
    name varchar(255),
    PRIMARY KEY (zutat_id)
);

create table pizzeria.produkt (
	produkt_id int,
    name varchar(255),
    bild blob,
    preis float,
    PRIMARY KEY (produkt_id)
);

create table pizzeria.produkt_zutat (
	produkt_id int,
    zutat_id int,
    PRIMARY KEY (produkt_id, zutat_id),
    FOREIGN KEY (zutat_id) REFERENCES pizzeria.zutat(zutat_id),
    FOREIGN KEY (produkt_id) REFERENCES pizzeria.produkt(produkt_id)
);

create table pizzeria.ort (
    plz int,
    name varchar(255),
    PRIMARY KEY (plz)
);

create table pizzeria.kunde (
	kunde_id int,
    plz int,
    strasse varchar(255),
    nr int,
    PRIMARY KEY (kunde_id),
    FOREIGN KEY (plz) REFERENCES pizzeria.ort(plz)
);

create table pizzeria.warenkorb (
    kunde_id int,
    produkt_id int,
    anzahl int,
    PRIMARY KEY (produkt_id, kunde_id),
    FOREIGN KEY (kunde_id) REFERENCES pizzeria.kunde(kunde_id),
    FOREIGN KEY (produkt_id) REFERENCES pizzeria.produkt(produkt_id)
);

create table pizzeria.bestellung (
	bestellung_id int,
    kunde_id int,
    datum date,
    PRIMARY KEY (bestellung_id),
    FOREIGN KEY (kunde_id) REFERENCES pizzeria.kunde(kunde_id)
);

create table pizzeria.lieferung (
    bestellung_id int,
    produkt_id int,
    anzahl int,
    PRIMARY KEY (produkt_id, bestellung_id),
    FOREIGN KEY (bestellung_id) REFERENCES pizzeria.bestellung(bestellung_id),
    FOREIGN KEY (produkt_id) REFERENCES pizzeria.produkt(produkt_id)
);

