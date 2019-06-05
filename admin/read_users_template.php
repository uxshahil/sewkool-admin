<?php
// display the table if the number of users retrieved was greater than zero
if($num>0){
 
    echo "<table class='table table-hover table-responsive table-bordered box'>";
 
    // table headers
    echo "<tr>";
        echo "<th>First Mame</th>";
        echo "<th>Last Name</th>";
        echo "<th>Email</th>";
        echo "<th>Contact Number</th>";
        echo "<th>Access Level</th>";
    echo "</tr>";
 
    // loop through the user records
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
        // display user details
        echo "<tr>";
            echo "<td>{$first_name}</td>";
            echo "<td>{$last_name}</td>";
            echo "<td>{$contact_email}</td>";
            echo "<td>{$contact_number}</td>";
            echo "<td>{$access_level}</td>";
        echo "</tr>";
        }
 
    echo "</table>";
 
    $page_url="read_users.php?";
    $total_rows = $user->countAll();
 
    // actual paging buttons
    include_once 'paging.php';
}
 
// tell the user there are no selfies
else{
    echo "<div class='alert alert-danger'>
        <strong>No users found.</strong>
    </div>";
}
?>