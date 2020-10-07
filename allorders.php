<?php 

    include('db_connection.php');

?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Display</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Bilbo+Swash+Caps" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Kalam" rel="stylesheet"> 
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="js/script.js"></script>
</head>
<body>
    <nav class="top_menu">
        <ul>
            <li><a href="index.php">Order Form</a></li>
            <li><a href="allorders.php">Orders</a></li>
        </ul>
    </nav>
    <div>
        <table class="table">
            <tr>
                <th>Order ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>City</th>
                <th>Postal Code</th>
                <th>Province</th>
                <th>WaterBottles</th>
                <th>ResistanceBands</th>
                <th>Dumbells</th>
                <th>Total Cost</th>
            </tr>
            <?php 
                $sqlQuery = 'SELECT * FROM orders';
                $sqlResult = $db->query($sqlQuery);
                if($sqlResult->num_rows > 0){
                    // data returned from DB is presented here
                    while($row = $sqlResult->fetch_assoc()){
                        ?>
                <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['city']; ?></td>
                        <td><?php echo $row['postcode']; ?></td>
                        <td><?php echo $row['province']; ?></td>
                        <td><?php echo $row['product1']; ?></td>
                        <td><?php echo $row['product2']; ?></td>
                        <td><?php echo $row['product3']; ?></td>
                        <td>$<?php echo $row['totalCost']; ?></td>
                </tr>
            <?php
                    }
                }
                else{
                    echo "<td colspan='10'>No data found</td>";
                } ?>     
        </table>    
    </div>
</body>
</html>




