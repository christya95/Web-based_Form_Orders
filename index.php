<?php

    include('db_connection.php');

?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Assignment 7</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="js/form.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Oswald|Sriracha&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

    <nav class="top_menu">
        <ul>
            <li><a href="index.php">Order Form</a></li>
            <li><a href="allorders.php">Orders</a></li>
        </ul>
    </nav>

    <form name="myform" method="POST" onsubmit="return formSubmit();" action="process.php">
        <label for="name">NAME</label>
        <input id="name" placeholder="First Last" type="text" name="name" autofocus><br/>

        <label for="email">EMAIL</label>
        <input id="email" placeholder="email@domain.com" type="email" name="email"><br/>

        <label for="phone">PHONE</label>
        <input id="phone" placeholder="905-123-4567" type="phone" name="phone"><br/>

        <label for="address">ADDRESS</label>
        <input id="address" placeholder="1234 Example St." type="text" name="address"><br/>

        <label for="city">CITY</label>
        <input id="city" placeholder="CityHere" type="text" name="city"><br/>

        <label for="postalcode">POST CODE</label>
        <input id="postcode" placeholder="A1A 9X9" type="postcode" name="postcode"><br/>

        <label for="province">PROVINCE</label>
        <select name="provinceVal" id="provinceVal">
            <option value="">----- Select -----</option>
            <option value="Alberta">Alberta</option>
            <option value="British Columbia">British Columbia</option>
            <option value="Manitoba">Manitoba</option>
            <option value="New Brunswick">New Brunswick</option>
            <option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
            <option value="Northwest Territories">Northwest Territories</option>
            <option value="Nova Scotia">Nova Scotia</option>
            <option value="Nunavut">Nunavut</option>
            <option value="Ontario">Ontario</option>
            <option value="Prince Edward Island">Prince Edward Island</option>
            <option value="Quebec">Quebec</option>
            <option value="Saskatchewan">Saskatchewan</option>
            <option value="Yukon">Yukon</option>
        </select><br/><br/>

        <label for="product1">WATER BOTTLES</label>
        <input id="product1" type="product1" name="product1"><br/>

        <label for="product2">RESISTANCE BANDS</label>
        <input id="product2" type="product2" name="product2"><br/>

        <label for="product3">DUMBBELLS</label>
        <input id="product3" type="product3" name="product3"><br/>

        <label for="deliveryTime">DELIVERY TIME</label>
        <select name="deliveryTime" id="deliveryTime">
            <option value="">----- Select -----</option>
            <option value="1">1 Day</option>
            <option value="2">2 Days</option>
            <option value="3">3 Days</option>
            <option value="4">4 Days</option>
        </select><br/>
        <br/>

        <input type="submit" value="Submit">
        <p id="errors"></p>
    </form>
</body>

</html>