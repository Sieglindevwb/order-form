<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);

// We are going to use session variables so we need to enable sessions
session_start();

// Use this function when you need to need an overview of these variables
function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
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

function validate()
{
    // TODO: This function will send a list of invalid fields back
    return [];
}

function handleForm()
{
    // TODO: form related tasks (step 1)

    // Validation (step 2)
    $invalidFields = validate();
    if (!empty($invalidFields)) {
        // TODO: handle errors
    } else {
        // TODO: handle successful submission
    }
}

// TODO: replace this if by an actual check for the form to be submitted
$formSubmitted = false;
if ($formSubmitted) {
    handleForm();
}

require 'form-view.php';