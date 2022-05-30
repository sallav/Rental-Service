<?php

/**
 * Edit rental details with a HTML form
 */

require "dbactions.php";  
require "../common.php";

 if (isset($_POST['submit'])) {
    try {
        $rental = [ 
            "id" => $_POST['id'],
            "vehicle" => $_POST['vehicle'],
            "vehicle_type" => $_POST['vehicle_type'],
            "vehicle_description" => $_POST['vehicle_description'],
            "price" => $_POST['price']
        ];
        $success = dbactions::updateRental($rental);
    } catch(Exception $error) {
        echo $error->getMessage();
    }
 }

 if (isset($_GET['id'])) {
        $rental = dbactions::getRentalById($_GET['id']);
 } else {
     echo "Something went wrong!";
     exit;
 }

 require "templates/admin_header.php";

 if (isset($_POST['submit']) && $success) {
    echo escape($_POST['vehicle']); ?> updated. 
<?php }
 ?>

 <h2>Edit rental</h2>

 <form method="post">
     <?php foreach ($rental as $key => $value) { 
         if ($key === 'add_date') {
             echo "Add date: " . date("d-m-Y H:i", strtotime($value)); ?>
             <br> <?php 
        } else { ?>
         <label for="<?php echo $key; ?>"><?php echo ucfirst(str_replace("_", " ", $key)); ?></label>
         <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo $value; ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
        <br>
     <?php } } ?> 
     <input type="submit" name="submit" value="Submit">
</form>

<p><a href="admin_list_rentals.php">Back to listing</a></p>

<?php require "templates/footer.php"; ?>