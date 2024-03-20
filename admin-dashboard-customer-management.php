
<?php
//customer management
//view customer accounts, including their order history and address details




//add in database connection code



//fetching customer accounts
$sql = "SELECT * FROM customers";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Customer Accounts:</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Customer ID</th><th>Name</th><th>Email</th><th>Action</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row['customer_id']."</td>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td><a href='view_order_history.php?customer_id=".$row['customer_id']."'>View Order History</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

?>