<?php
header('Content-Type: application/json');

if (isset($_GET['nom'])) {
    $name = $_GET['nom'];
    $response = array('nom' => $name);
    echo json_encode($response);
} else {
    echo json_encode(array('erreur' => 'Erreur'));
}
?>
