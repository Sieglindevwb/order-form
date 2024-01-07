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

// Variable to track total order value
$totalValue = 0;

function validate($formData) {
    $errors = [];

 // Validation rules
    if (empty($formData['email']) || !filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format';
    }

    if (empty($formData['street'])) {
        $errors['street'] = 'Please enter your street.';
    }

    if (empty($formData['streetnumber']) || !is_numeric($formData['streetnumber'])) {
        $errors['streetnumber'] = 'Please enter a valid numeric value for street number';
    }

    if (empty($formData['city'])) {
        $errors['city'] = 'Please enter your city';
    }

    if (empty($formData['zipcode']) || !is_numeric($formData['zipcode'])) {
        $errors['zipcode'] = 'Please enter a valid numeric value for zipcode';
    }

    return $errors;
}

// Handle form submission
function handleForm($formData, $products) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Extract and sanitize form data
        $email = isset($formData['email']) ? test_input($formData['email']) : '';
        $street = isset($formData['street']) ? test_input($formData['street']) : '';
        $streetnumber = isset($formData['streetnumber']) ? test_input($formData['streetnumber']) : '';
        $city = isset($formData['city']) ? test_input($formData['city']) : '';
        $zipcode = isset($formData['zipcode']) ? test_input($formData['zipcode']) : '';

        // Selected products array
        $selectedProducts = [];

        // Process selected products
        if (isset($formData['products']) && is_array($formData['products'])) {
            foreach ($formData['products'] as $i => $value) {
                if ($value == 1) {
                    $selectedProducts[] = $products[$i]['name'];
                }
            }
        }

        // Validation
        $invalidFields = validate($formData);

        // Handle validation errors or successful submission
        if (!empty($invalidFields)) {
            echo "<div class='error'>Validation errors:</div>";
            echo "<ul>";
            foreach ($invalidFields as $field => $error) {
                echo "<li>$error</li>";
            }
            echo "</ul>";
        } else {
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
