<?php

require "dbactions.php";

if (isset($_POST['submit'])) {
    try {
        if ($_POST['keyword']!="") {
            $result = dbactions::getRentalsByType($_POST['keyword']);
        } else {
            $result = dbactions::getAllRentals();
        }
    } catch(Exception $error) {
        echo $error->getMessage();
    }
} else {
    $result = dbactions::getAllRentals();
}
?>

<?php   require "templates/admin_header.php"; 
        require "../common.php"?>

<div>
    <form method="POST">
        <fieldset>
            <legend>List rentals</legend>
            <label for="keyword">Filter by type:</label>
            <input type="text" name="keyword" id="keyword" size="20" placeholder="Vehicle type">
            <input type="submit" name="submit" value="submit" class="submit">
        </fieldset>
    </form>
</div>

<h3><a href="add_rental.php">Add rental</a></h3>

<div id="results">

<?php
if (isset($_POST['submit'])) {
    if($result && count($result)>0) { ?>
        <h2>Vehicles:</h2>
        <?php
        $count = 0; 
        foreach ($result as $row) { 
            $count++; ?>
            <div class="resultrow">
            <a href="#" onclick="showElement(<?php echo escape($row['id']); ?>);return false;" class="result">
                <div class="resultheader">
                    <div class="item">Id: <?php echo escape($row['id']); ?></div> 
                    <div class="item"><?php echo escape($row['vehicle']); ?></div>
                    <div class="item"><?php echo escape($row['vehicle_type']); ?></div>
                    <div class="item">Price: <?php echo escape($row['price']); ?></div>
                </div>
                </a>
                <div id="<?php echo escape($row['id']); ?>" style="visibility: visible" class="resultcontent">
                    <p><?php echo escape($row['vehicle_description']); ?></p>
                    <p>Added: <?php echo date("d-m-Y H:i", strtotime(escape($row['add_date']))); ?>
                    <span class="tab"><a href="update.php?id=<?php echo escape($row['id']); ?>">Edit</a></span>    
                    <span class="tab"><a href="delete.php?id=<?php echo escape($row['id']); ?>">Remove</a></span>   
                    </p>
                </div>
            </div>
        <?php }
    } else { ?>
        No results for <?php echo escape($row['vehicle_type']); ?>
    <?php } 
}
?>

</div>

<script type="text/javascript">
    let links = document.getElementsByClassName("result");
    links.forEach(item => {item.addEventListener("click", showElement)});
    function showElement(id) { 
        let nxt = event.target.nextElementSibling;
        let elementId = nxt.getAttribute('id');
        let element = document.getElementById(id.toString());
        alert(element.innerHtml);
        element.setAttribute("style", "backgroundcolor: yellow;");
    }
</script>

<?php require "templates/footer.php"; ?>