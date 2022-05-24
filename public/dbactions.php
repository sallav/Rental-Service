<?php

class dbactions {

    /**
     * Function to insert into table rentals
     */
    public static function addRentalToDatabase($new_rental) {
        try {  
            require "../config.php";
            $connection = new PDO($dsn, $username, $password, $options);
    
            $sql = "INSERT INTO rentals (vehicle, vehicle_type, vehicle_description, price) values (:vehicle, :vehicle_type, :vehicle_description, :price)";
    
            $statement = $connection->prepare($sql);
            return $statement->execute($new_rental);
        } catch(PDOException $error){
            echo $sql . "<br>" . $error->getMessage();
        }
    }

    /**
    * Function to query information based on 
    * a parameter: vehicle type
    */
    public static function getRentalFromDatabase($type) {
        try {
            require "../config.php";
            $connection = new PDO($dsn, $username, $password, $options);
    
            $sql = "SELECT * FROM rentals WHERE vehicle_type = :vehicle_type ORDER BY vehicle";
    
            $statement = $connection->prepare($sql);
            $statement->bindParam(':vehicle_type', $type, PDO::PARAM_STR);
            $statement->execute();

            return $statement->fetchAll();
        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }

    /**
     * Function to query all entries on rentals table
     */
    public static function getAllRentalsFromDatabase(){
        try {
            require "../config.php";
            $connection = new PDO($dsn, $username, $password, $options);
    
            $sql = "SELECT * FROM rentals ORDER BY vehicle_type, vehicle";
            $statement = $connection->query($sql);
        
            return $statement->fetchAll();
        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }

    public static function getRentalForEditingFromDatabase($id){
        try {
            require "../config.php";
            $connection = new PDO($dsn, $username, $password, $options);
    
            $sql = "SELECT * FROM rentals WHERE id = :id";
            $statement = $connection->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();
    
            return $statement->fetch(PDO::FETCH_ASSOC);
         } catch(PDOException $error) {
             echo $sql . "<br>" . $error->getMessage();
         }
    }

    public static function updateRental($rental){
        try {
            require "../config.php";
            $connection = new PDO($dsn, $username, $password, $options);
    
            $sql = "UPDATE rentals 
                SET id = :id,
                vehicle = :vehicle,
                vehicle_type = :vehicle_type,
                vehicle_description = :vehicle_description,
                price = :price
                WHERE id = :id";
    
            $statement = $connection->prepare($sql);
            return $statement->execute($rental);
         } catch(PDOException $error) {
             echo $sql . "<br>" . $error->getMessage();
         }
    }
}

?>