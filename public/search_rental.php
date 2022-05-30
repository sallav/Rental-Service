<?php 

if (isset($_POST['submit'])) {
    try {
        require "dbactions.php";

        if ($_POST['keyword']!="") {
            $result = dbactions::getRentalsByType($_POST['keyword']);
        } else {
            $result = dbactions::getAllRentals();
        }
    } catch(Exception $error){
        echo $error->getMessage();
    }
}
?>

<?php   require "templates/header.php"; 
        require "../common.php" ?>

<body>

<a href="index.php"><< Front page</a>

    <form method="POST">
        <fieldset>
            <legend>Search for a rental</legend>
            <div class="labels"> 
            <p><label for="startdate">Start:</label></p>  
            <p><label for="enddate">End:</label></p>
            </div>
            <div class="inputs">
            <input type="date" name="startdate" id="startdate" min="<?= date('Y-m-d'); ?>" max="<?= date('Y-m-d', strtotime('+14 days')); ?>" ><br>
            <input type="date" name="enddate" id="enddate" min="<?= date('Y-m-d'); ?>" max="<?= date('Y-m-d', strtotime('+28 days')); ?>" ><br>
            <input type="text" name="keyword" id="keyword" size="20" placeholder="Search by type"><br>
            <input type="submit" name="submit" value="Submit" class="submit">
            </div>
        </fieldset>
    </form>

<?php 
if (isset($_POST['submit'])) {
    if ($result && count($result) > 0) { ?>
    <h3>Search results:</h3>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Vehicle</th>
                <th>Type</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($result as $row) { ?>
        <tr>
            <td><?php echo escape($row["id"]); ?></td>
            <td><?php echo escape($row['vehicle']); ?></td>
            <td><?php echo escape($row['vehicle_type']); ?></td>
            <td><?php echo escape($row['price']); ?></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php } else { ?>
        No results for <?php echo escape($_POST['keyword']); ?>
    <?php }
} 
?>

<?php require "templates/footer.php"; ?>