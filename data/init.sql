CREATE DATABASE test;

use test;

CREATE TABLE rentals (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    vehicle VARCHAR(30) NOT NULL,
    vehicle_type VARCHAR(30) NOT NULL,
    vehicle_description VARCHAR(255),
    price INT(4) NOT NULL,
    add_date TIMESTAMP
);

CREATE TABLE reservations (
    id INT(11) UNSIGNED AUTO_INCREMENT,
    startdate DATETIME NOT NULL,
    enddate DATETIME NOT NULL,
    vehicleId INT(11) UNSIGNED NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (vehicleId) REFERENCES rentals(id) 
);