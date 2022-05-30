<?php

/**
 * Delete a rental
 */

require "dbactions.php";
require "../common.php";

if (isset($_GET['delete']) && isset($_GET['id'])) {
    $success = dbactions::removeRental($_GET['id']);
}

if (isset($_GET['id'])) {
    $rental = dbactions::getRentalById($_GET['id']);
} else {
    echo "Something went wrong!";
    exit;
}

require "templates/admin_header.php";
?>

<h2>Delete vehicle</h2>

<?php 
if (isset($_GET['delete']) && $success) {
    echo "Vehicle deleted.";
    $deleted = true;
} else {
    echo "<p>Do you want to delete this vehicle from the database?</p>";
}

if (!$deleted) { ?>

<form method="get">
    
<input type="hidden" name="id" value=<?php echo $_GET['id'];?> >
<?php
foreach ($rental as $key => $value) {
    if ($key === 'add_date') {
        echo "Add date: " . date("d-m-Y H:i", strtotime($value)) . "<br>";
    } else {
        echo "<p>" . ucfirst(str_replace("_", " ", $key)) . ": ". $value . "</p>";
    }
} ?>

<input type='submit' name='delete' value='Delete'>

</form>

<?php } ?>

<p><a href="admin_list_rentals.php">Back to listing</a></p>

<?php require "templates/footer.php"; ?>
