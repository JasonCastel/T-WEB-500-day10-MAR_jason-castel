<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(200);
            echo json_encode(array('email' => $email));
        } else {
            http_response_code(400);
            echo json_encode(array('error' => 'Invalid email address.'));
        }
    } else {
        http_response_code(400);
        echo json_encode(array('error' => 'Email parameter is missing.'));
    }
} else {
    http_response_code(405);
    echo json_encode(array('error' => 'Method Not Allowed.'));
}
?>
