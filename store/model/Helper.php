<?php

class Helper
{

    //EL CONSTRUCTOR CONSTRUYE LA VARIABLE $cn
    function __construct()
    {
    }

    function my_simple_crypt($string, $action = 'e')
    {
        // you may change these values to your own
        $secret_key = 'enfocussoluciones';
        $secret_iv = 'enfocussoluciones';

        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if ($action == 'e') {
            $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
        } else if ($action == 'd') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }

    function calculaedad($fechanacimiento)
    {
        list($ano, $mes, $dia) = explode("-", $fechanacimiento);
        $ano_diferencia = date("Y") - $ano;
        $mes_diferencia = date("m") - $mes;
        $dia_diferencia = date("d") - $dia;
        if ($dia_diferencia < 0 || $mes_diferencia < 0)
            $ano_diferencia--;
        return $ano_diferencia;
    }

    function sumasdiasemana($fecha, $dias)
    {
        $datestart = strtotime($fecha);
        $datesuma = 15 * 86400;
        //dia de la semana en numero
        $diasemana = date('N', $datestart);

        //sumando dias al dia actual
        $totaldias = $diasemana + $dias;


        $findesemana = intval($totaldias / 5) * 2;


        $diasabado = $totaldias % 5;


        if ($diasabado == 6) $findesemana++;

        if ($diasabado == 0) $findesemana = $findesemana - 2;

        $total = (($dias + $findesemana) * 86400) + $datestart;

        return $fechafinal = date('Y-m-d', $total);
    }

    function addOneDayWithoutSunday($fecha)
    {
        $datestart = strtotime($fecha);
        $diasemana = date('N', $datestart);

        $diasASumar = 0;
        if ($diasemana == 1) {
            $diasASumar = 1;
        }
        if ($diasemana == 2) {
            $diasASumar = 1;
        }
        if ($diasemana == 3) {
            $diasASumar = 1;
        }
        if ($diasemana == 4) {
            $diasASumar = 1;
        }
        if ($diasemana == 5) {
            $diasASumar = 1;
        }
        if ($diasemana == 6) {
            $diasASumar = 2;
        }
        if ($diasemana == 7) {
            $diasASumar = 1;
        }

        return date('Y-m-d', strtotime($fecha . " + $diasASumar days"));


    }

}
