<?php
if (isset($_POST['submit'])) {
    require "dbactions.php";
    try {  
        $new_rental = array(
            "vehicle" => $_POST['vehicle'],
            "vehicle_type" => $_POST['type'],
            "vehicle_description" => $_POST['description'],
            "price" => $_POST['price']
        );
        $success = dbactions::addRental($new_rental);
    } catch(Exception $error){
        echo $error->getMessage();
    }
}

require "templates/admin_header.php";
require "../common.php" ?>

<form method="POST">
    <fieldset>
        <legend>Add vehicle</legend>

        <label for="vehicle">Vehicle:</label>
        <input type="text" name="vehicle" id="vehicle" placeholder="Vehicle" required><br>
        <label for="type">Vehicle type:</label>
        <input type="text" name="type" id="type" placeholder="Type"><br>
        <label for="description">Details:</label>
        <textarea rows="3" cols="25" name="description" id="description" placeholder="Description" maxlength="255"></textarea><br>
        <label for="price">Price:</label>
        <input type="text" name="price" id="price" placeholder="Rental price"><br>
        <input type="submit" name="submit" value="Submit">
    </fieldset>
</form>

<?php if (isset($_POST['submit']) && $success) { ?>
    <p>
    <?php echo escape($_POST['vehicle']); ?> successfully added.</p>
<?php } 
?>

<a href="admin_list_rentals.php">Back to rentals</a>

<?php require "templates/footer.php"; ?>