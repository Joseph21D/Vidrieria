<?php
const BASE_URL = "http://localhost/vidrieria/";
const HOST = "localhost";
const USER = "root";
const PASS = "";
const DB = "vidrieria";
const CHARSET = "charset=utf8";
const TITLE = "Vidrieria Velasquez";
const MONEDA = "S/.";
const MONEDAPAYPAL = "USD";
const CLIENT_ID = "AeKNqOMJsFcwZDK8lsOP1p9s_asl_-5qPiSangK-YkFoZXfZjk-_4hQR_C-a0mt28M5DRMtPpCMHfvCH";
const USER_SMTP = "jomadica1721@gmail.com";
const PASS_SMTP = "hhqlmtmayiotilsz";
const PUERTO_SMTP = 465;
const HOST_SMTP = "smtp.gmail.com";

function obtenerPrecio()
{
    $token = 'apis-token-9859.3YF3ZIMLTLgWwtgJdWLNhwzPuEpN9feV';
    $fecha = date('Y-m-d');

    // Iniciar llamada a API
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.apis.net.pe/v2/sunat/tipo-cambio?date=' . $fecha,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 2,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Referer: https://apis.net.pe/tipo-de-cambio-sunat-api',
            'Authorization: Bearer ' . $token
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    // Datos listos para usar
    $tipoCambioSunat = json_decode($response);
    return $tipoCambioSunat->precioVenta;
}

define('PRECIO', obtenerPrecio());
?>