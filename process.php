<?php
    if(empty($_POST)){//POST will be empty if someone accesses this page directly and has not come to it after submitting the order form.
        header('Location: index.php');
    }
    include('db_connection.php');
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Receipt</title>
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
    <div class="formData">

        <?php

        //Initial values and constants
            $hst = 0.00;
            $subtotal = 0.00;
            $totalTax = 0.00;
            $totalAmount = 0.00;
            $deliveryCharges = 0.00;
            $waterBottlePrice = 10.00;
            $ResistanceBandPrice = 20.00;
            $DumbbellPrice = 30.00;

            //Tax Rates for PE,NS,NB,NL
            $provinceRateA = 15.00;
            //Tax Rates for QC
            $provinceRateB = 14.975;
            //Tax Rates for ON
            $provinceRateC = 13.00;
            //Tax Rates for BC,MB
            $provinceRateD = 12.00;
            //Tax Rates for SK
            $provinceRateE = 11.00;
            //Tax Rates for AB and territories
            $provinceRateF = 5.00;

            function checkRegex($reg, $userInput, $message){
                if(!preg_match($reg, $userInput)){
                return $message.'<br>';
                }
                else{
                return '';
                }
            }
            $errors = '';// create an empty variable to store errors
            $errors2 = '';
            $errors3 = '';

            //Fetch all the input values
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $postcode = $_POST['postcode'];
            $province = $_POST['provinceVal'];
            $waterBottles = $_POST['product1'];
            $resistanceBands = $_POST['product2'];
            $dumbbells = $_POST['product3'];
            $delivery = $_POST['deliveryTime'];

            if(trim($name) ==''){
                $errors .= 'Name is required <br>';
            }

            if(trim($email) ==''){
                $errors .= 'Email is required <br>';
            }

            $emailRegex = '/^[A-Za-z0-9._-]+@[A-Za-z0-9.-]+.[A-Za-z]{2,}$/';
            $errors .=checkRegex($emailRegex, trim($email), 'Email is in incorrect format!');

            $phoneRegex = '/^[0-9]{3}[\s-]?[0-9]{3}[\s-]?[0-9]{4}$/';
            $errors .=checkRegex($phoneRegex, trim($phone), 'Phone is in incorrect format!');

            if(trim($address) ==''){
                $errors .= 'Address is required <br>';
            }
            
            if(trim($city) ==''){
                $errors .= 'City is required <br>';
            }

            $postcodeRegex = '/^[A-Za-z][0-9][A-Za-z]\s?[0-9][A-Za-z][0-9]$/';
            $errors .=checkRegex($postcodeRegex, trim($postcode), 'Postcode is in incorrect format!');

            if(trim($province) ==''){
                $errors .= 'Province must be selected! <br>';
            }

            if(trim($delivery) ==''){
                $errors .= 'Delivery time is required <br>';
            }

            //Check to see if the values entered are positive
            $postiveNum = '/^[1-9][0-9]*$/';
            $numberRegex = '/^[0-9]*$/';

            //Check to see if the values entered are numbers
            if (!(preg_match($numberRegex, $waterBottles) && preg_match($numberRegex, $resistanceBands) && preg_match($numberRegex, $dumbbells))) {
                $errors2 = 'ERROR: Must enter a valid number!';
            }
            
            //Check to see if there is one product selected for purchase
            else if (($waterBottles + $resistanceBands + $dumbbells) == 0) {
                $errors3 = 'Error: Must enter atleast 1 product for purchase!<br>';
            }
            
            //---------Checking for errors---------
            if($errors != '' || $errors2 != '' || $errors3 != ''){
                echo $errors . $errors2 . $errors3;//displaying errors
            } else {
                // set tax rate depending on province
            if ($province == "New Brunswick" && "Newfoundland and Labrador" && "Nova Scotia" && "Prince Edward Island") {
                $hst = $provinceRateA;
            } else if ($province == "Quebec") {
                $hst = $provinceRateB;
            } else if ($province == "Ontario") {
                $hst = $provinceRateC;
            } else if ($province == "British Columbia" && "Manitoba") {
                $hst = $provinceRateD;
            } else if ($province == "Saskatchewan") {
                $hst = $provinceRateE;
            } else {
                $hst = $provinceRateF;
            }

            // Calculating DeliveryCharges
            if ($delivery == 1) {
                $deliveryCharges = 30.00;
            } else if ($delivery == 2) {
                $deliveryCharges = 25.00;
            } else if ($delivery == 3) {
                $deliveryCharges = 20.00;
            } else {
                $deliveryCharges = 15.00;
            }

            //Calculations for the invoice
            $waterBottleTotal = $waterBottles * $waterBottlePrice;
            $resistanceBandsTotal = $resistanceBands * $ResistanceBandPrice;
            $dumbbellsTotal = $dumbbells * $DumbbellPrice;
            $subtotal = $waterBottleTotal + $resistanceBandsTotal + $dumbbellsTotal + $deliveryCharges;

            $totalTax = $hst * $subtotal / 100;
            $totalTax = round($totalTax ,2);
            $totalAmount = $subtotal + $totalTax;
            $totalTax = round($totalAmount, 2);

        //Printing out Invoice
        $message = " <pre>
        NAME: $name <br>
        EMAIL: $email <br>
        PHONE: $phone <br>
        DELIVERY ADDRESS: $address <br>
                          $city <br>
                          $province, $postcode <br><br>
        $waterBottles Water Bottle(s) @ $$waterBottlePrice:  $$waterBottleTotal <br>
        $resistanceBands Resistance Band(s) @ $$ResistanceBandPrice:  $$resistanceBandsTotal <br>
        $dumbbells Dumbbell(s) @ $$DumbbellPrice:  $$dumbbellsTotal <br>
        SHIPPING CHARGES:       $$deliveryCharges <br>
        SUB TOTAL: $$subtotal <br>
        TAXES @ $hst%: $$totalTax <br>
        TOTAL: $$totalAmount <br>
        </pre>
        ";

        $sqlQuery = "
        INSERT INTO orders (id, name, email, phone, address, city, postcode, province, product1, product2, product3, totalCost) VALUES (NULL, '$name', '$email', '$phone', '$address', '$city', '$postcode', '$province', '$waterBottles', '$resistanceBands', '$dumbbells', '$totalAmount');
        ";

        $sqlResult = $db->query($sqlQuery);
        if(!$sqlResult){
            //exit($db->error);
            exit('Some error in saving form has occured!');
        }

        echo $message;
    }

        ?>

    </div>


</body>
</html>