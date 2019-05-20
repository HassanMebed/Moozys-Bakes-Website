create database moozysbakes;
use moozysbakes;

create table Customer
(
	FirstName varchar(200) not null,
    LastName  varchar(200) not null,
    Email varchar(320) not null unique,
    Password char(100) not null,
    Telephone varchar(10) not null,
    primary key(Email)
);
create table Address
(
	Email varchar(320) not null,
    Street varchar(150) not null,
    HouseNumber varchar(100) not null,
    Area varchar(100) not null,
    ZIPCode varchar(100),
    foreign key(Email) references Customer(Email) on update cascade on delete cascade
);
create table Deliverable
(
	ID int unsigned not null unique,
    Name varchar(255) not null,
    Price float unsigned not null,
    primary key(ID)
);
create table Product
(
	ID int unsigned not null,
    QuantityAvailable smallint not null,
    foreign key(ID) references Deliverable(ID) on update cascade on delete cascade
);
create table CateringService
(
	ID int unsigned not null,
    Availability boolean not null,
    foreign key(ID) references Deliverable(ID) on update cascade on delete cascade
);
create table Orders
(
	OrderID int unsigned not null unique auto_increment,
    Customer varchar(320) not null,
    OrderDate datetime not null,
    DeliveryDate date not null,
    ProductID int unsigned,
    QuantityOrdered varchar(100) not null,
    primary key(OrderID),
    foreign key(ProductID) references Deliverable(ID) on update cascade on delete cascade,
    foreign key(Customer) references Customer(Email) on update cascade on delete cascade
);
create table DeliveryAddress
(
	OrderID int unsigned not null,
    Street varchar(150) not null,
    HouseNumber varchar(100) not null,
    Area varchar(100) not null,
    ZIPCode varchar(100),
    foreign key(OrderID) references Orders(OrderID) on update cascade on delete cascade
);

insert into Deliverable values(1, 'Banana Sour Cream Bread', 110);
insert into Deliverable values(2, 'Chocolate Zucchini Bread', 110);
insert into Deliverable values(3, 'Apple Cinnamon Cake', 90);
insert into Deliverable values(4, 'Lemon Cake', 70);
insert into Deliverable values(5, 'Chocolate Cake', 70);
insert into Deliverable values(6, 'Banana Cake', 70);
insert into Deliverable values(7, 'Vanilla Cake', 70);
insert into Deliverable values(8, 'Marble Cake', 90);
insert into Deliverable values(9, 'Brownies', 70);
insert into Deliverable values(10, 'Vanilla Cookies', 70);
insert into Deliverable values(11, 'Wedding Catering', 400);
insert into Deliverable values(12, 'Corporate Catering', 200);
insert into Deliverable values(13, 'Social Event Catering', 320);
insert into Deliverable values(14, 'Concession Catering', 320);

insert into Product values(1, 100);
insert into Product values(2, 100);
insert into Product values(3, 100);
insert into Product values(4, 100);
insert into Product values(5, 100);
insert into Product values(6, 100);
insert into Product values(7, 100);
insert into Product values(8, 100);
insert into Product values(9, 100);
insert into Product values(10, 100);

insert into CateringService values(11, true);
insert into CateringService values(12, true);
insert into CateringService values(13, true);
insert into CateringService values(14, true);