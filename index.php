<?php

declare(strict_types=1);
session_start();

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$products = [
    ['name' => 'The One With All the Cheesecakes', 'price' => 10.7],
    ['name' => 'The One With the East German Laundry Detergent - Chickenwings', 'price' => 11.6],
    ['name' => 'The One With Phoebe`s Cookies', 'price' => 5.3],
    ['name' => 'The One With The Truth About London - Fried stuff with cheese', 'price' => 7.4],
    ['name' => 'Joey doesn`t share food! - French Fries', 'price' => 4.4],
    ['name' => 'The One With the Jam', 'price' => 1.4],
    ['name' => 'The One With the Dozen Lasagnas', 'price' => 12.6],
    ['name' => 'A show called “Mac and C.H.E.E.S.E."', 'price' => 10.6],
    ['name' => 'The One With Ross`s Sandwich.', 'price' => 7.2],
    ['name' => '“Custard? Good. Jam? Good. Meat? Gooooood.”', 'price' => 16.2],
    ['name' => 'The One With Unagi', 'price' => 14.3],
];

$totalValue = 0;

function validate($formData) {
    $errors = [];
    $formData = $_POST;

    if (empty($formData["email"])) {
        $errors["email"] = 'Email is required';
    } elseif (!filter_var(test_input($formData["email"]), FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = 'Invalid email format';
    }

    if (empty($formData["street"])) {
        $errors["street"] = 'Please enter your street.';
    } else {
        $formData["street"] = test_input($formData["street"]);
    }

    if (empty($formData["streetnumber"])) {
        $errors["streetnumber"] = 'Please enter your street number.';
    } elseif (!is_numeric($formData["streetnumber"])) {
        $errors["streetnumber"] = 'Please enter a valid numeric value';
    }

    if (empty($formData["city"])) {
        $errors["city"] = 'Please enter your city';
    } else {
        $formData["city"] = test_input($formData["city"]);
    }

    if (empty($formData["zipcode"])) {
        $errors["zipcode"] = 'Please enter your zipcode';
    } elseif (!is_numeric($formData["zipcode"])) {
        $errors["zipcode"] = 'Please enter a valid numeric value';
    }

    return $errors;
}

function handleForm($formData, $products) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = isset($formData['email']) ? htmlspecialchars($formData['email']) : '';
        $street = isset($formData['street']) ? htmlspecialchars($formData['street']) : '';
        $streetnumber = isset($formData['streetnumber']) ? htmlspecialchars($formData['streetnumber']) : '';
        $city = isset($formData['city']) ? htmlspecialchars($formData['city']) : '';
        $zipcode = isset($formData['zipcode']) ? htmlspecialchars($formData['zipcode']) : '';

        $selectedProducts = [];

        if (isset($formData['products']) && is_array($formData['products'])) {
            foreach ($formData['products'] as $i => $value) {
                if ($value == 1) {
                    $selectedProducts[] = $products[$i]['name'];
                }
            }
        }

        // Validation
        $invalidFields = validate($formData);

        if (!empty($invalidFields)) {
            // Handle errors
            echo "<div class='error'>Validation errors:</div>";
            echo "<ul>";
            foreach ($invalidFields as $field => $error) {
                echo "<li>$error</li>";
            }
            echo "</ul>";
        } else {
            // Handle successful submission
            echo "<div class='success'>Order placed successfully!</div>";
            echo "<h2>Order Confirmation</h2>";
            echo "<p>Email: $email</p>";
            echo "<p>Delivery Address: $street $streetnumber, $city, $zipcode</p>";
            echo "<p>Selected Products:</p>";
            echo "<ul>";
            foreach ($selectedProducts as $selectedProduct) {
                echo "<li>$selectedProduct</li>";
            }
            echo "</ul>";
        }
    }
}

// Replace this if by an actual check for the form to be submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    handleForm($_POST, $products);
}

require 'form-view.php';
