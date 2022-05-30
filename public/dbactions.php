<?php

class dbactions {

    /**
     * Function to query all entries on rentals table
     */
    public static function getAllRentals() {
        try {
            require "../config.php";
            $connection = new PDO($dsn, $username, $password, $options);
    
            $sql = "SELECT * FROM rentals ORDER BY vehicle_type, vehicle, price";
            $statement = $connection->query($sql);
        
            return $statement->fetchAll();
        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }

    /**
     * Prepare an sql statement
     */
    public static function prepareStatement($sql) {
        try {
            require "../config.php";
            $connection = new PDO($dsn, $username, $password, $options);
            $statement = $connection->prepare($sql);
            return $statement;
        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }

    /**
     * Function to insert into table rentals
     */
    public static function addRental($new_rental) {
        try {  
            $sql = "INSERT INTO rentals (vehicle, vehicle_type, vehicle_description, price) 
                    values (:vehicle, :vehicle_type, :vehicle_description, :price)";
            $statement = self::prepareStatement($sql);
            return $statement->execute($new_rental);
        } catch(PDOException $error){
            echo $sql . "<br>" . $error->getMessage();
        }
    }

    /**
    * Function to query information based on 
    * a parameter: vehicle type
    */
    public static function getRentalsByType($type) {
        try {
            $sql = "SELECT * FROM rentals WHERE vehicle_type = :vehicle_type ORDER BY vehicle, price";
            $statement = self::prepareStatement($sql);
            $statement->bindParam(':vehicle_type', $type, PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetchAll();
        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }

    public static function getRentalById($id) {
        try {
            $sql = "SELECT * FROM rentals WHERE id = :id";
            $statement = self::prepareStatement($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
         } catch(PDOException $error) {
             echo $sql . "<br>" . $error->getMessage();
         }
    }

    public static function updateRental($rental) {
        try {
            $sql = "UPDATE rentals 
                SET id = :id,
                vehicle = :vehicle,
                vehicle_type = :vehicle_type,
                vehicle_description = :vehicle_description,
                price = :price
                WHERE id = :id";
    
            $statement = self::prepareStatement($sql);
            return $statement->execute($rental);
         } catch(PDOException $error) {
             echo $sql . "<br>" . $error->getMessage();
         }
    }

    public static function removeRental($id) {
        try {
            $sql = "DELETE FROM rentals WHERE id = :id";
            $statement = self::prepareStatement($sql);
            $statement->bindValue(':id', $id);
            return $statement->execute();
        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }
}
?>