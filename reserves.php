<?php

header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "amanda", "123456", "provaProjecte");

if(!isset($_POST['mes']) && !isset( $_POST['any'])){
    $stmt = $conn->prepare("SELECT * FROM reserves");
    $stmt->execute();
    $result = $stmt->get_result();
    $outp = $result->fetch_all(MYSQLI_ASSOC);



    echo json_encode($outp);

} else if(isset($_POST['mes']) && isset($_POST['any'])) {
        $mes = $_POST['mes'];
        $any = $_POST['any'];
        $stmt = $conn->prepare("SELECT * FROM reserves WHERE month(dataEntrada) = ? and year(dataEntrada) = ?");
        $stmt->bind_param("ii", $mes, $any);

        $stmt->execute();
        $result = $stmt->get_result();
        $outp = $result->fetch_all(MYSQLI_ASSOC);

        echo json_encode($outp);

} else if( isset($_POST['mes']) && !isset($_POST['any'])){

    $mes = $_POST['mes'];
    $stmt = $conn->prepare("SELECT * FROM reserves WHERE month(dataEntrada) = ?");
    $stmt->bind_param("i", $mes);

    $stmt->execute();
    $result = $stmt->get_result();
    $outp = $result->fetch_all(MYSQLI_ASSOC);

    echo json_encode($outp);

}else if( !isset($_POST['mes']) && isset($_POST['any'])){

    $any = $_POST['any'];
    $stmt = $conn->prepare("SELECT * FROM reserves WHERE year(dataEntrada) = ?");
    $stmt->bind_param("i", $any);

    $stmt->execute();
    $result = $stmt->get_result();
    $outp = $result->fetch_all(MYSQLI_ASSOC);

    echo json_encode($outp);

}



