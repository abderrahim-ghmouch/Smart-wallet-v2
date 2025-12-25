-- Active: 1764859452169@@127.0.0.1@3306@swallet
CREATE DATABASE swallet;

CREATE TABLE  users
(
    id INT PRIMARY KEY AUTO INCREMENT,
    username varchar(30) UNIQUE,
    email varchar(50) UNIQUE,
    password varchar(255)
    
)

CREATE TABLE categories
(
    id int primary key AUTO INCREMENT,
    namecategory varchar(50) not NULL,

)

CREATE TABLE incomes(

    id int PRIMARY KEY  AUTO INCREMENT,
    amount DECIMAL(10,2) NOT NULL,
    income_description TEXT not null,
    category_income int,
    FOREIGN KEY(category_income)REFERENCES categories(id)


)

CREATE TABLE expences(

    id int PRIMARY KEY  AUTO INCREMENT,
    amount DECIMAL(10,2) NOT NULL,
    expenses_description TEXT not null,
     category_expense int,
    FOREIGN KEY(category_expense)REFERENCES categories(id)


)

select *from users ;