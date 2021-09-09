CREATE TABLE IF NOT EXISTS vehicle (    
    vehicle_id INTEGER not null PRIMARY KEY autoincrement,    
    rego varchar(6) not null,
    model varchar(50) not null,
    year integer(4) not null,
    odometer integer(10) not null,
    seats integer(2) not null
); 

CREATE TABLE IF NOT EXISTS clients(
   client_id INTEGER not null PRIMARY KEY autoincrement,
   client_name varchar(30) not null,
   age integer(2) not null,
   license_num integer(11) not null,
   license_type varchar(2) not null,
   DoB date not null
);

CREATE TABLE IF NOT EXISTS orders(
   order_id INTEGER not null PRIMARY KEY autoincrement,
   client_id integer not null,
   vehicle_id integer not null,
   date_start datetime not null,
   date_end datetime not null,
   order_status boolean not null,
   FOREIGN KEY (client_id) REFERENCES clients(client_id),
   FOREIGN key (vehicle_id) REFERENCES vehicle(vehicle_id)
);


insert into vehicle(rego, model, year, odometer, seats) values ("000OMO", "test", 2021, 10000, 5);
insert into clients(client_name, age, license_num, license_type, DoB) values ("Tony", "22", 8795464565, "P1", "1999-07-05");
insert into clients(client_name, age, license_num, license_type, DoB) values ("Han", "20", 98745658986, "L", "2001-07-05");
insert into clients(client_name, age, license_num, license_type, DoB) values ("Alex", "21", 6359784156, "P2", "2000-07-05");
insert into clients(client_name, age, license_num, license_type, DoB) values ("Alice", "25", 56487956139, "L", "1996-07-05");
insert into clients(client_name, age, license_num, license_type, DoB) values ("Frank", "18", 25467985463, "L", "2003-07-05");