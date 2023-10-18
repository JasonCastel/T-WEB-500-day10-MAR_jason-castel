<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "ajax_products";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$type = $_GET['type'];
$brand = $_GET['brand'];

if (strlen($type) < 3) {
    $typeMessage = "$type: this type does not have enough characters.";
} elseif (strlen($type) > 10) {
    $typeMessage = "$type: this type has too many characters.";
} elseif (!ctype_alpha(str_replace('-', '', $type))) {
    $typeMessage = "$type: this type has non-alphabetical characters (different from '-').";
} else {
    $checkTypeQuery = "SELECT * FROM products WHERE LOWER(type) = LOWER('$type')";
    $result = $conn->query($checkTypeQuery);

    if ($result->num_rows > 0) {
        $typeMessage = "$type: this type exists in the products database.";
    } else {
        $typeMessage = "$type: this type doesn't exist in our shop.";
    }
}

if (strlen($brand) < 2) {
    $brandMessage = "$brand: this brand does not have enough characters.";
} elseif (strlen($brand) > 20) {
    $brandMessage = "$brand: this brand has too many characters.";
} elseif (!ctype_alnum(str_replace(['-', '&'], '', $brand))) {
    $brandMessage = "$brand: this brand has invalid characters.";
} else {
    $checkBrandQuery = "SELECT * FROM products WHERE LOWER(brand) = LOWER('$brand')";
    $result = $conn->query($checkBrandQuery);

    if ($result->num_rows > 0) {
        $brandMessage = "$brand: this brand already exists in the products database.";
    } else {
        $brandMessage = "$brand: this brand is valid for the type $type.";
    }
}

$response = [
    'typeMessage' => $typeMessage,
    'brandMessage' => $brandMessage,
];

header('Content-Type: application/json');
echo json_encode($response);
$conn->close();
?>
