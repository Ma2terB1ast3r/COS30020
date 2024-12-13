# Lab 07

The wk07 lab is focused on SQL statements, below are the SQL statements used in the lab.

## Create Table:

```sql
CREATE TABLE cars (car_id INT NOT NULL AUTO_INCREMENT,
make VARCHAR (32) NOT NULL,
model VARCHAR (32) NOT NULL,
price FLOAT NOT NULL,
yom INT NOT NULL, 
PRIMARY KEY (car_id));
```

## Create Records:

```sql
INSERT INTO cars (make, model, price, yom) VALUES
('Holden', 'Astra', 14000, 2005),
('BMW', 'X3', 35000.00, 2004),
('Ford', 'Falcon', 39000.00, 2011),
('Toyota', 'Corolla', 20000.00, 2012),
('Holden', 'Commodore', 13500.00, 2005),
('Holden', 'Astra', 8000.00, 2001),
('Holden', 'Commodore', 28000.00, 2009),
('Ford', 'Falcon', 14000.00, 2007),
('Ford', 'Falcon', 7000.00, 2003),
('Ford', 'Laser', 10000.00, 2010),
('Mazda', 'RX-7', 26000.00, 2000),
('Toyota', 'Corolla', 12000.00, 2001),
('Mazda', '3', 14500.00, 2009);
```

## Show all records:

```sql
SELECT * FROM cars;
```

## Make model, price, sorted by make and model

```sql
SELECT make, model, price FROM cars ORDER BY make, model;
```

## Make and model of cars cost 20,000 or more

```sql
SELECT make, model, price FROM cars WHERE price >= 20000;
```

## Make and model cost below 15,000

```sql
SELECT make, model, price FROM cars WHERE price < 15000;
```

## Average price of cars of the same make

```sql
SELECT AVG(price) AS avg, make FROM cars GROUP BY make;
```
