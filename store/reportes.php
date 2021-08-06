<?php
session_start();
$page = 'reportes';
if (isset($_SESSION["current_email"]) && $_SESSION["current_email"] != '') {

} else {
    echo "Usuario no Autorizado";
    exit();
}

if ($_SESSION['current_rol'] == 'admin') {

} else {
    echo "No tienes Permisos para acceder a este lugar";
    exit();
}


require 'model/Pedido.php';
$objPedido = new Pedido();
$fecha_actual = date("Y-m-d");

$fecha_maxima = date("Y-m-d",strtotime($fecha_actual));

if($_POST){

  $fecha_inicio = $_POST["fecha_inicio"];
  $fechaInicio = date("Y-m-d",strtotime($fecha_inicio));
  $fecha_final = $_POST["fecha_final"];
  $fechaFinal = date("Y-m-d",strtotime($fecha_final));
  
}else{
  $fechaInicio = date("Y-m-d",strtotime($fecha_actual."+ 1 days"));
  $fechaFinal = date("Y-m-d",strtotime($fecha_actual."+ 1 days"));
  
}

/*
    $fechaIni = strtotime($fechaInicio);
    $fechaFin = strtotime($fechaFinal);

    echo $fechaIni;
    echo $fechaFin;

    //Lunes
    for ($i = $fechaIni; $i <= $fechaFin; $i += 86400 * 7){
    $Lunes[] = date("Y-m-d", strtotime('monday this week', $i)).'<br>';
    }

    $Lunes_fecha = array_unique($Lunes);
    $Lunes_cant = count($Lunes_fecha);
    //echo $Lunes_cant."<br>";

    //Martes
    for ($j = $fechaIni; $j <= $fechaFin; $j += 86400 * 7){
      $Martes[] = date("Y-m-d", strtotime('tuesday this week', $j)).'<br>';
      }
  
      $Martes_fecha = array_unique($Martes);
      $Martes_cant = count($Martes_fecha);
      //echo $Martes_cant;

    //Miercoles
    for ($z = $fechaIni; $z <= $fechaFin; $z += 86400 * 7){
      $Miercoles[] = date("Y-m-d", strtotime('wednesday this week', $z)).'<br>';
      }
  
      $Miercoles_fecha = array_unique($Miercoles);
      $Miercoles_cant = count($Miercoles_fecha);
      //echo $Miercoles_cant."<br>";

    //Jueves
    for ($x = $fechaIni; $x <= $fechaFin; $x += 86400 * 7){
      $Jueves[] = date("Y-m-d", strtotime('thursday this week', $x)).'<br>';
      }
  
      $Jueves_fecha = array_unique($Jueves);
      $Jueves_cant = count($Jueves_fecha);
      //echo $Jueves_cant."<br>";

    //Viernes
    for ($y = $fechaIni; $y <= $fechaFin; $y += 86400 * 7){
      $Viernes[] = date("Y-m-d", strtotime('friday this week', $y)).'<br>';
      }
  
      $Viernes_fecha = array_unique($Viernes);
      $Viernes_cant = count($Viernes_fecha);
      //echo $Viernes_cant."<br>";

    //Sabado
    for ($k = $fechaIni; $k <= $fechaFin; $k += 86400 * 7){
      $Sabado[] = date("Y-m-d", strtotime('saturday this week', $k)).'<br>';
      }
  
      $Sabado_fecha = array_unique($Sabado);
      $Sabado_cant = count($Sabado_fecha);
      //echo $Sabado_cant."<br>";

    //Domingo
    for ($m = $fechaIni; $m <= $fechaFin; $m += 86400 * 7){
      $Domingo[] = date("Y-m-d", strtotime('sunday this week', $m)).'<br>';
      }
  
      $Domingo_fecha = array_unique($Domingo);
      $Domingo_cant = count($Domingo_fecha);
      //echo $Domingo_cant."<br>";
*/
  



//echo $fechaInicio."<br>";
//echo $fechaFinal;
$listaFecha = $objPedido->getPedidosByFecha($fechaInicio,$fechaFinal);

/*
if($_POST){
var_dump($listaFecha);
exit();
}
*/
/*
foreach($listaFecha as $indice => $valor){
  echo $valor['fechaPedido'];
  echo "<br>";
}
*/

    $cant_lunes = 0;
    $cant_martes = 0;
    $cant_miercoles = 0;
    $cant_jueves = 0;
    $cant_viernes = 0;
    $cant_sabado = 0;
    $cant_domingo = 0;

    $cant_Monday_11 = 0;
    $cant_Monday_12 = 0;
    $cant_Monday_01 = 0;
    $cant_Monday_02 = 0;
    $cant_Monday_03 = 0;
    $cant_Monday_04 = 0;
    $cant_Monday_05 = 0;
    $cant_Monday_06 = 0;
    $cant_Monday_07 = 0;
    $cant_Monday_08 = 0;

    $cant_Tuesday_11 = 0;
    $cant_Tuesday_12 = 0;
    $cant_Tuesday_01 = 0;
    $cant_Tuesday_02 = 0;
    $cant_Tuesday_03 = 0;
    $cant_Tuesday_04 = 0;
    $cant_Tuesday_05 = 0;
    $cant_Tuesday_06 = 0;
    $cant_Tuesday_07 = 0;
    $cant_Tuesday_08 = 0;

    $cant_Wednesday_11 = 0;
    $cant_Wednesday_12 = 0;
    $cant_Wednesday_01 = 0;
    $cant_Wednesday_02 = 0;
    $cant_Wednesday_03 = 0;
    $cant_Wednesday_04 = 0;
    $cant_Wednesday_05 = 0;
    $cant_Wednesday_06 = 0;
    $cant_Wednesday_07 = 0;
    $cant_Wednesday_08 = 0;

    $cant_Thursday_11 = 0;
    $cant_Thursday_12 = 0;
    $cant_Thursday_01 = 0;
    $cant_Thursday_02 = 0;
    $cant_Thursday_03 = 0;
    $cant_Thursday_04 = 0;
    $cant_Thursday_05 = 0;
    $cant_Thursday_06 = 0;
    $cant_Thursday_07 = 0;
    $cant_Thursday_08 = 0;

    $cant_Friday_11 = 0;
    $cant_Friday_12 = 0;
    $cant_Friday_01 = 0;
    $cant_Friday_02 = 0;
    $cant_Friday_03 = 0;
    $cant_Friday_04 = 0;
    $cant_Friday_05 = 0;
    $cant_Friday_06 = 0;
    $cant_Friday_07 = 0;
    $cant_Friday_08 = 0;

    $cant_Saturday_11 = 0;
    $cant_Saturday_12 = 0;
    $cant_Saturday_01 = 0;
    $cant_Saturday_02 = 0;
    $cant_Saturday_03 = 0;
    $cant_Saturday_04 = 0;
    $cant_Saturday_05 = 0;
    $cant_Saturday_06 = 0;
    $cant_Saturday_07 = 0;
    $cant_Saturday_08 = 0;

    $cant_Sunday_11 = 0;
    $cant_Sunday_12 = 0;
    $cant_Sunday_01 = 0;
    $cant_Sunday_02 = 0;
    $cant_Sunday_03 = 0;
    $cant_Sunday_04 = 0;
    $cant_Sunday_05 = 0;
    $cant_Sunday_06 = 0;
    $cant_Sunday_07 = 0;
    $cant_Sunday_08 = 0;

    $sum_Monday_11 = 0;
    $sum_Monday_12 = 0;
    $sum_Monday_01 = 0;
    $sum_Monday_02 = 0;
    $sum_Monday_03 = 0;
    $sum_Monday_04 = 0;
    $sum_Monday_05 = 0;
    $sum_Monday_06 = 0;
    $sum_Monday_07 = 0;
    $sum_Monday_08 = 0;

    $sum_Tuesday_11 = 0;
    $sum_Tuesday_12 = 0;
    $sum_Tuesday_01 = 0;
    $sum_Tuesday_02 = 0;
    $sum_Tuesday_03 = 0;
    $sum_Tuesday_04 = 0;
    $sum_Tuesday_05 = 0;
    $sum_Tuesday_06 = 0;
    $sum_Tuesday_07 = 0;
    $sum_Tuesday_08 = 0;

    $sum_Wednesday_11 = 0;
    $sum_Wednesday_12 = 0;
    $sum_Wednesday_01 = 0;
    $sum_Wednesday_02 = 0;
    $sum_Wednesday_03 = 0;
    $sum_Wednesday_04 = 0;
    $sum_Wednesday_05 = 0;
    $sum_Wednesday_06 = 0;
    $sum_Wednesday_07 = 0;
    $sum_Wednesday_08 = 0;

    $sum_Thursday_11 = 0;
    $sum_Thursday_12 = 0;
    $sum_Thursday_01 = 0;
    $sum_Thursday_02 = 0;
    $sum_Thursday_03 = 0;
    $sum_Thursday_04 = 0;
    $sum_Thursday_05 = 0;
    $sum_Thursday_06 = 0;
    $sum_Thursday_07 = 0;
    $sum_Thursday_08 = 0;

    $sum_Friday_11 = 0;
    $sum_Friday_12 = 0;
    $sum_Friday_01 = 0;
    $sum_Friday_02 = 0;
    $sum_Friday_03 = 0;
    $sum_Friday_04 = 0;
    $sum_Friday_05 = 0;
    $sum_Friday_06 = 0;
    $sum_Friday_07 = 0;
    $sum_Friday_08 = 0;

    $sum_Saturday_11 = 0;
    $sum_Saturday_12 = 0;
    $sum_Saturday_01 = 0;
    $sum_Saturday_02 = 0;
    $sum_Saturday_03 = 0;
    $sum_Saturday_04 = 0;
    $sum_Saturday_05 = 0;
    $sum_Saturday_06 = 0;
    $sum_Saturday_07 = 0;
    $sum_Saturday_08 = 0;

    $sum_Sunday_11 = 0;
    $sum_Sunday_12 = 0;
    $sum_Sunday_01 = 0;
    $sum_Sunday_02 = 0;
    $sum_Sunday_03 = 0;
    $sum_Sunday_04 = 0;
    $sum_Sunday_05 = 0;
    $sum_Sunday_06 = 0;
    $sum_Sunday_07 = 0;
    $sum_Sunday_08 = 0;

    $Fecha_lunes[0] = "Sin ventas";
    $Fecha_martes[0] = "Sin ventas";
    $Fecha_miercoles[0] = "Sin ventas";
    $Fecha_jueves[0] = "Sin ventas";
    $Fecha_viernes[0] = "Sin ventas";
    $Fecha_sabado[0] = "Sin ventas";
    $Fecha_domingo[0] = "Sin ventas";


foreach($listaFecha as $indice => $valor){
  $date = new DateTime($valor['fechaPedido']);

  //$tiempo[] = date("d-m-Y (H:i:s)", $valor['dateTime']);
  
  if($date->format('l') == "Monday"){

    $FechaMonday[] = $valor["fechaPedido"];
    $Fecha_lunes = array_unique($FechaMonday);

    $cant_lunes = count($Fecha_lunes);

    $Monday[] = $valor["horaPedido"];

    

 

    $hora = new DateTime($valor["horaPedido"]);

    
    
    switch ($hora->format('H')) {
      case 11:
         $Monday_11[] = $valor["horaPedido"];
         $cant_Monday_11 = count($Monday_11);
         $Lunes_11[] = $valor["precioTotal"];
         $sum_Monday_11 = array_sum($Lunes_11);
          break;
      case 12:
        $Monday_12[] = $valor["horaPedido"];
        $cant_Monday_12 = count($Monday_12);
        $Lunes_12[] = $valor["precioTotal"];
         $sum_Monday_12 = array_sum($Lunes_12);
        break;
      case 13:
        $Monday_01[] = $valor["horaPedido"];
        $cant_Monday_01 = count($Monday_01);
        $Lunes_01[] = $valor["precioTotal"];
         $sum_Monday_01 = array_sum($Lunes_01);
        break;
      case 14:
        $Monday_02[] = $valor["horaPedido"];
        $cant_Monday_02 = count($Monday_02);
        $Lunes_02[] = $valor["precioTotal"];
         $sum_Monday_02 = array_sum($Lunes_02);
        break;
      case 15:
        $Monday_03[] = $valor["horaPedido"];
        $cant_Monday_03 = count($Monday_03);
        $Lunes_03[] = $valor["precioTotal"];
         $sum_Monday_03 = array_sum($Lunes_03);
        break;
      case 16:
        $Monday_04[] = $valor["horaPedido"];
        $cant_Monday_04 = count($Monday_04);
        $Lunes_04[] = $valor["precioTotal"];
         $sum_Monday_04 = array_sum($Lunes_04);
        break;
      case 17:
        $Monday_05[] = $valor["horaPedido"];
        $cant_Monday_05 = count($Monday_05);
        $Lunes_05[] = $valor["precioTotal"];
         $sum_Monday_05 = array_sum($Lunes_05);
        break;
      case 18:
        $Monday_06[] = $valor["horaPedido"];
        $cant_Monday_06 = count($Monday_06);
        $Lunes_06[] = $valor["precioTotal"];
         $sum_Monday_06 = array_sum($Lunes_06);
        break;
      case 19:
        $Monday_07[] = $valor["horaPedido"];
        $cant_Monday_07 = count($Monday_07);
        $Lunes_07[] = $valor["precioTotal"];
         $sum_Monday_07 = array_sum($Lunes_07);
        break;
        case 20:
          $Monday_08[] = $valor["horaPedido"];
          $cant_Monday_08 = count($Monday_08);
          $Lunes_08[] = $valor["precioTotal"];
           $sum_Monday_08 = array_sum($Lunes_08);
          break;
     
      
  
  }
  } // End If

  if($date->format('l') == "Tuesday"){
    $Tuesday[] = $valor["fechaPedido"];

    $FechaTuesday[] = $valor["fechaPedido"];
    $Fecha_martes = array_unique($FechaTuesday);

    $cant_martes = count($Fecha_martes);

    
    
    
    $hora = new DateTime($valor["horaPedido"]);

    switch ($hora->format('H')) {
      case 11:
         $Tuesday_11[] = $valor["horaPedido"];
         $cant_Tuesday_11 = count($Tuesday_11);
         $Martes_11[] = $valor["precioTotal"];
         $sum_Tuesday_11 = array_sum($Martes_11);
          break;
      case 12:
        $Tuesday_12[] = $valor["horaPedido"];
        $cant_Tuesday_12 = count($Tuesday_12);
        $Martes_12[] = $valor["precioTotal"];
         $sum_Tuesday_12 = array_sum($Martes_12);
        break;
      case 13:
        $Tuesday_01[] = $valor["horaPedido"];
        $cant_Tuesday_01 = count($Tuesday_01);
        $Martes_01[] = $valor["precioTotal"];
         $sum_Tuesday_01 = array_sum($Martes_01);
        break;
      case 14:
        $Tuesday_02[] = $valor["horaPedido"];
        $cant_Tuesday_02 = count($Tuesday_02);
        $Martes_02[] = $valor["precioTotal"];
         $sum_Tuesday_02 = array_sum($Martes_02);
        break;
      case 15:
        $Tuesday_03[] = $valor["horaPedido"];
        $cant_Tuesday_03 = count($Tuesday_03);
        $Martes_03[] = $valor["precioTotal"];
         $sum_Tuesday_03 = array_sum($Martes_03);
        break;
      case 16:
        $Tuesday_04[] = $valor["horaPedido"];
        $cant_Tuesday_04 = count($Tuesday_04);
        $Martes_04[] = $valor["precioTotal"];
         $sum_Tuesday_04 = array_sum($Martes_04);
        break;
      case 17:
        $Tuesday_05[] = $valor["horaPedido"];
        $cant_Tuesday_05 = count($Tuesday_05);
        $Martes_05[] = $valor["precioTotal"];
         $sum_Tuesday_05 = array_sum($Martes_05);
        break;
      case 18:
        $Tuesday_06[] = $valor["horaPedido"];
        $cant_Tuesday_06 = count($Tuesday_06);
        $Martes_06[] = $valor["precioTotal"];
         $sum_Tuesday_06 = array_sum($Martes_06);
        break;
      case 19:
        $Tuesday_07[] = $valor["horaPedido"];
        $cant_Tuesday_07 = count($Tuesday_07);
        $Martes_07[] = $valor["precioTotal"];
         $sum_Tuesday_07 = array_sum($Martes_07);
        break;
        case 20:
          $Tuesday_08[] = $valor["horaPedido"];
          $cant_Tuesday_08 = count($Tuesday_08);
          $Martes_08[] = $valor["precioTotal"];
           $sum_Tuesday_08 = array_sum($Martes_08);
          break;
       
      
  
  }
  } // End If

  if($date->format('l') == "Wednesday"){
    $Wednesday[] = $valor["fechaPedido"];

    $FechaWednesday[] = $valor["fechaPedido"];
    $Fecha_miercoles = array_unique($FechaWednesday);

    $cant_miercoles = count($Fecha_miercoles);

    $hora = new DateTime($valor["horaPedido"]);

    switch ($hora->format('H')) {
      case 11:
         $Wednesday_11[] = $valor["horaPedido"];
         $cant_Wednesday_11 = count($Wednesday_11);
         $Miercoles_11[] = $valor["precioTotal"];
         $sum_Wednesday_11 = array_sum($Miercoles_11);
          break;
      case 12:
        $Wednesday_12[] = $valor["horaPedido"];
        $cant_Wednesday_12 = count($Wednesday_12);
        $Miercoles_12[] = $valor["precioTotal"];
         $sum_Wednesday_12 = array_sum($Miercoles_12);
        break;
      case 13:
        $Wednesday_01[] = $valor["horaPedido"];
        $cant_Wednesday_01 = count($Wednesday_01);
        $Miercoles_01[] = $valor["precioTotal"];
         $sum_Wednesday_01 = array_sum($Miercoles_01);
        break;
      case 14:
        $Wednesday_02[] = $valor["horaPedido"];
        $cant_Wednesday_02 = count($Wednesday_02);
        $Miercoles_02[] = $valor["precioTotal"];
         $sum_Wednesday_02 = array_sum($Miercoles_02);
        break;
      case 15:
        $Wednesday_03[] = $valor["horaPedido"];
        $cant_Wednesday_03 = count($Wednesday_03);
        $Miercoles_03[] = $valor["precioTotal"];
         $sum_Wednesday_03 = array_sum($Miercoles_03);
        break;
      case 16:
        $Wednesday_04[] = $valor["horaPedido"];
        $cant_Wednesday_04 = count($Wednesday_04);
        $Miercoles_04[] = $valor["precioTotal"];
         $sum_Wednesday_04 = array_sum($Miercoles_04);
        break;
      case 17:
        $Wednesday_05[] = $valor["horaPedido"];
        $cant_Wednesday_05 = count($Wednesday_05);
        $Miercoles_05[] = $valor["precioTotal"];
         $sum_Wednesday_05 = array_sum($Miercoles_05);
        break;
      case 18:
        $Wednesday_06[] = $valor["horaPedido"];
        $cant_Wednesday_06 = count($Wednesday_06);
        $Miercoles_06[] = $valor["precioTotal"];
         $sum_Wednesday_06 = array_sum($Miercoles_06);
        break;
      case 19:
        $Wednesday_07[] = $valor["horaPedido"];
        $cant_Wednesday_07 = count($Wednesday_07);
        $Miercoles_07[] = $valor["precioTotal"];
         $sum_Wednesday_07 = array_sum($Miercoles_07);
        break;
        case 20:
          $Wednesday_08[] = $valor["horaPedido"];
          $cant_Wednesday_08 = count($Wednesday_08);
          $Miercoles_08[] = $valor["precioTotal"];
           $sum_Wednesday_08 = array_sum($Miercoles_08);
          break;
     
  
  }
  } // End If

  if($date->format('l') == "Thursday"){
    $Thursday[] = $valor["fechaPedido"];

    $FechaThursday[] = $valor["fechaPedido"];
    $Fecha_jueves = array_unique($FechaThursday);

    $cant_jueves = count($Fecha_jueves);
    
    $hora = new DateTime($valor["horaPedido"]);

    switch ($hora->format('H')) {
      case 11:
         $Thursday_11[] = $valor["horaPedido"];
         $cant_Thursday_11 = count($Thursday_11);
         $Jueves_11[] = $valor["precioTotal"];
         $sum_Thursday_11 = array_sum($Jueves_11);
          break;
      case 12:
        $Thursday_12[] = $valor["horaPedido"];
        $cant_Thursday_12 = count($Thursday_12);
        $Jueves_12[] = $valor["precioTotal"];
         $sum_Thursday_12 = array_sum($Jueves_12);
        break;
      case 13:
        $Thursday_01[] = $valor["horaPedido"];
        $cant_Thursday_01 = count($Thursday_01);
        $Jueves_01[] = $valor["precioTotal"];
         $sum_Thursday_01 = array_sum($Jueves_01);
        break;
      case 14:
        $Thursday_02[] = $valor["horaPedido"];
        $cant_Thursday_02 = count($Thursday_02);
        $Jueves_02[] = $valor["precioTotal"];
         $sum_Thursday_02 = array_sum($Jueves_02);
        break;
      case 15:
        $Thursday_03[] = $valor["horaPedido"];
        $cant_Thursday_03 = count($Thursday_03);
        $Jueves_03[] = $valor["precioTotal"];
         $sum_Thursday_03 = array_sum($Jueves_03);
        break;
      case 16:
        $Thursday_04[] = $valor["horaPedido"];
        $cant_Thursday_04 = count($Thursday_04);
        $Jueves_04[] = $valor["precioTotal"];
         $sum_Thursday_04 = array_sum($Jueves_04);
        break;
      case 17:
        $Thursday_05[] = $valor["horaPedido"];
        $cant_Thursday_05 = count($Thursday_05);
        $Jueves_05[] = $valor["precioTotal"];
         $sum_Thursday_05 = array_sum($Jueves_05);
        break;
      case 18:
        $Thursday_06[] = $valor["horaPedido"];
        $cant_Thursday_06 = count($Thursday_06);
        $Jueves_06[] = $valor["precioTotal"];
         $sum_Thursday_06 = array_sum($Jueves_06);
        break;
      case 19:
        $Thursday_07[] = $valor["horaPedido"];
        $cant_Thursday_07 = count($Thursday_07);
        $Jueves_07[] = $valor["precioTotal"];
         $sum_Thursday_07 = array_sum($Jueves_07);
        break;
        case 20:
          $Thursday_08[] = $valor["horaPedido"];
          $cant_Thursday_08 = count($Thursday_08);
          $Jueves_08[] = $valor["precioTotal"];
           $sum_Thursday_08 = array_sum($Jueves_08);
          break;
     
  
  }
  } // End If

  if($date->format('l') == "Friday"){
    $Friday[] = $valor["fechaPedido"];

    $FechaFriday[] = $valor["fechaPedido"];
    $Fecha_viernes = array_unique($FechaFriday);

    $cant_viernes = count($Fecha_viernes);
    
    $hora = new DateTime($valor["horaPedido"]);

    switch ($hora->format('H')) {
      case 11:
         $Friday_11[] = $valor["horaPedido"];
         $cant_Friday_11 = count($Friday_11);
         $Viernes_11[] = $valor["precioTotal"];
         $sum_Friday_11 = array_sum($Viernes_11);
          break;
      case 12:
        $Friday_12[] = $valor["horaPedido"];
        $cant_Friday_12 = count($Friday_12);
        $Viernes_12[] = $valor["precioTotal"];
         $sum_Friday_12 = array_sum($Viernes_12);
        break;
      case 13:
        $Friday_01[] = $valor["horaPedido"];
        $cant_Friday_01 = count($Friday_01);
        $Viernes_01[] = $valor["precioTotal"];
         $sum_Friday_01 = array_sum($Viernes_01);
        break;
      case 14:
        $Friday_02[] = $valor["horaPedido"];
        $cant_Friday_02 = count($Friday_02);
        $Viernes_02[] = $valor["precioTotal"];
         $sum_Friday_02 = array_sum($Viernes_02);
        break;
      case 15:
        $Friday_03[] = $valor["horaPedido"];
        $cant_Friday_03 = count($Friday_03);
        $Viernes_03[] = $valor["precioTotal"];
         $sum_Friday_03 = array_sum($Viernes_03);
        break;
      case 16:
        $Friday_04[] = $valor["horaPedido"];
        $cant_Friday_04 = count($Friday_04);
        $Viernes_04[] = $valor["precioTotal"];
         $sum_Friday_04 = array_sum($Viernes_04);
        break;
      case 17:
        $Friday_05[] = $valor["horaPedido"];
        $cant_Friday_05 = count($Friday_05);
        $Viernes_05[] = $valor["precioTotal"];
         $sum_Friday_05 = array_sum($Viernes_05);
        break;
      case 18:
        $Friday_06[] = $valor["horaPedido"];
        $cant_Friday_06 = count($Friday_06);
        $Viernes_06[] = $valor["precioTotal"];
         $sum_Friday_06 = array_sum($Viernes_06);
        break;
      case 19:
        $Friday_07[] = $valor["horaPedido"];
        $cant_Friday_07 = count($Friday_07);
        $Viernes_07[] = $valor["precioTotal"];
         $sum_Friday_07 = array_sum($Viernes_07);
        break;
        case 20:
          $Friday_08[] = $valor["horaPedido"];
          $cant_Friday_08 = count($Friday_08);
          $Viernes_08[] = $valor["precioTotal"];
           $sum_Friday_08 = array_sum($Viernes_08);
          break;
      
  
  }
  } // End If

  if($date->format('l') == "Saturday"){
    $Saturday[] = $valor["fechaPedido"];

    $FechaSaturday[] = $valor["fechaPedido"];
    $Fecha_sabado = array_unique($FechaSaturday);
    
$cant_sabado = count($Fecha_sabado);

    $hora = new DateTime($valor["horaPedido"]);

    switch ($hora->format('H')) {
      case 11:
         $Saturday_11[] = $valor["horaPedido"];
         $cant_Saturday_11 = count($Saturday_11);
         $Sabado_11[] = $valor["precioTotal"];
         $sum_Saturday_11 = array_sum($Sabado_11);
          break;
      case 12:
        $Saturday_12[] = $valor["horaPedido"];
        $cant_Saturday_12 = count($Saturday_12);
        $Sabado_12[] = $valor["precioTotal"];
         $sum_Saturday_12 = array_sum($Sabado_12);
        break;
      case 13:
        $Saturday_01[] = $valor["horaPedido"];
        $cant_Saturday_01 = count($Saturday_01);
        $Sabado_01[] = $valor["precioTotal"];
         $sum_Saturday_01 = array_sum($Sabado_01);
        break;
      case 14:
        $Saturday_02[] = $valor["horaPedido"];
        $cant_Saturday_02 = count($Saturday_02);
        $Sabado_02[] = $valor["precioTotal"];
         $sum_Saturday_02 = array_sum($Sabado_02);
        break;
      case 15:
        $Saturday_03[] = $valor["horaPedido"];
        $cant_Saturday_03 = count($Saturday_03);
        $Sabado_03[] = $valor["precioTotal"];
         $sum_Saturday_03 = array_sum($Sabado_03);
        break;
      case 16:
        $Saturday_04[] = $valor["horaPedido"];
        $cant_Saturday_04 = count($Saturday_04);
        $Sabado_04[] = $valor["precioTotal"];
         $sum_Saturday_04 = array_sum($Sabado_04);
        break;
      case 17:
        $Saturday_05[] = $valor["horaPedido"];
        $cant_Saturday_05 = count($Saturday_05);
        $Sabado_05[] = $valor["precioTotal"];
         $sum_Saturday_05 = array_sum($Sabado_05);
        break;
      case 18:
        $Saturday_06[] = $valor["horaPedido"];
        $cant_Saturday_06 = count($Saturday_06);
        $Sabado_06[] = $valor["precioTotal"];
         $sum_Saturday_06 = array_sum($Sabado_06);
        break;
      case 19:
        $Saturday_07[] = $valor["horaPedido"];
        $cant_Saturday_07 = count($Saturday_07);
        $Sabado_07[] = $valor["precioTotal"];
         $sum_Saturday_07 = array_sum($Sabado_07);
        break;
        case 20:
          $Saturday_08[] = $valor["horaPedido"];
          $cant_Saturday_08 = count($Saturday_08);
          $Sabado_08[] = $valor["precioTotal"];
           $sum_Saturday_08 = array_sum($Sabado_08);
          break;
        
      
  
  }
  } // End If

  if($date->format('l') == "Sunday"){
    $Sunday[] = $valor["fechaPedido"];

    $FechaSunday[] = $valor["fechaPedido"];

    $Fecha_domingo = array_unique($FechaSunday);

    $cant_domingo = count($Fecha_domingo);
    
    $hora = new DateTime($valor["horaPedido"]);

    switch ($hora->format('H')) {
      case 11:
         $Sunday_11[] = $valor["horaPedido"];
         $cant_Sunday_11 = count($Sunday_11);
         $Domingo_11[] = $valor["precioTotal"];
         $sum_Sunday_11 = array_sum($Domingo_11);
          break;
      case 12:
        $Sunday_12[] = $valor["horaPedido"];
        $cant_Sunday_12 = count($Sunday_12);
        $Domingo_12[] = $valor["precioTotal"];
         $sum_Sunday_12 = array_sum($Domingo_12);
        break;
      case 13:
        $Sunday_01[] = $valor["horaPedido"];
        $cant_Sunday_01 = count($Sunday_01);
        $Domingo_01[] = $valor["precioTotal"];
         $sum_Sunday_01 = array_sum($Domingo_01);
        break;
      case 14:
        $Sunday_02[] = $valor["horaPedido"];
        $cant_Sunday_02 = count($Sunday_02);
        $Domingo_02[] = $valor["precioTotal"];
         $sum_Sunday_02 = array_sum($Domingo_02);
        break;
      case 15:
        $Sunday_03[] = $valor["horaPedido"];
        $cant_Sunday_03 = count($Sunday_03);
        $Domingo_03[] = $valor["precioTotal"];
         $sum_Sunday_03 = array_sum($Domingo_03);
        break;
      case 16:
        $Sunday_04[] = $valor["horaPedido"];
        $cant_Sunday_04 = count($Sunday_04);
        $Domingo_04[] = $valor["precioTotal"];
         $sum_Sunday_04 = array_sum($Domingo_04);
        break;
      case 17:
        $Sunday_05[] = $valor["horaPedido"];
        $cant_Sunday_05 = count($Sunday_05);
        $Domingo_05[] = $valor["precioTotal"];
         $sum_Sunday_05 = array_sum($Domingo_05);
        break;
      case 18:
        $Sunday_06[] = $valor["horaPedido"];
        $cant_Sunday_06 = count($Sunday_06);
        $Domingo_06[] = $valor["precioTotal"];
         $sum_Sunday_06 = array_sum($Domingo_06);
        break;
      case 19:
        $Sunday_07[] = $valor["horaPedido"];
        $cant_Sunday_07 = count($Sunday_07);
        $Domingo_07[] = $valor["precioTotal"];
         $sum_Sunday_07 = array_sum($Domingo_07);
        break;
        case 20:
          $Sunday_08[] = $valor["horaPedido"];
          $cant_Sunday_08 = count($Sunday_08);
          $Domingo_08[] = $valor["precioTotal"];
           $sum_Sunday_08 = array_sum($Domingo_08);
          break;
      
  
  }
  } // End If
  
} // End Foreach

$total_cant_Monday = $cant_Monday_11 + $cant_Monday_12 + $cant_Monday_01 + $cant_Monday_02 + $cant_Monday_03 + $cant_Monday_04 + $cant_Monday_05 + $cant_Monday_06 + $cant_Monday_07 + $cant_Monday_08;
$total_cant_Tuesday = $cant_Tuesday_11 + $cant_Tuesday_12 + $cant_Tuesday_01 + $cant_Tuesday_02 + $cant_Tuesday_03 + $cant_Tuesday_04 + $cant_Tuesday_05 + $cant_Tuesday_06 + $cant_Tuesday_07 + $cant_Tuesday_08;
$total_cant_Wednesday = $cant_Wednesday_11 + $cant_Wednesday_12 + $cant_Wednesday_01 + $cant_Wednesday_02 + $cant_Wednesday_03 + $cant_Wednesday_04 + $cant_Wednesday_05 + $cant_Wednesday_06 + $cant_Wednesday_07 + $cant_Wednesday_08;
$total_cant_Thursday = $cant_Thursday_11 + $cant_Thursday_12 + $cant_Thursday_01 + $cant_Thursday_02 + $cant_Thursday_03 + $cant_Thursday_04 + $cant_Thursday_05 + $cant_Thursday_06 + $cant_Thursday_07 + $cant_Thursday_08;
$total_cant_Friday = $cant_Friday_11 + $cant_Friday_12 + $cant_Friday_01 + $cant_Friday_02 + $cant_Friday_03 + $cant_Friday_04 + $cant_Friday_05 + $cant_Friday_06 + $cant_Friday_07 + $cant_Friday_08;
$total_cant_Saturday = $cant_Saturday_11 + $cant_Saturday_12 + $cant_Saturday_01 + $cant_Saturday_02 + $cant_Saturday_03 + $cant_Saturday_04 + $cant_Saturday_05 + $cant_Saturday_06 + $cant_Saturday_07 + $cant_Saturday_08;
$total_cant_Sunday = $cant_Sunday_11 + $cant_Sunday_12 + $cant_Sunday_01 + $cant_Sunday_02 + $cant_Sunday_03 + $cant_Sunday_04 + $cant_Sunday_05 + $cant_Sunday_06 + $cant_Sunday_07 + $cant_Sunday_08;

$total_sum_Monday = $sum_Monday_11 + $sum_Monday_12 + $sum_Monday_01 + $sum_Monday_02 + $sum_Monday_03 + $sum_Monday_04 + $sum_Monday_05 + $sum_Monday_06 + $sum_Monday_07 + $sum_Monday_08;
$total_sum_Tuesday = $sum_Tuesday_11 + $sum_Tuesday_12 + $sum_Tuesday_01 + $sum_Tuesday_02 + $sum_Tuesday_03 + $sum_Tuesday_04 + $sum_Tuesday_05 + $sum_Tuesday_06 + $sum_Tuesday_07 + $sum_Tuesday_08;
$total_sum_Wednesday = $sum_Wednesday_11 + $sum_Wednesday_12 + $sum_Wednesday_01 + $sum_Wednesday_02 + $sum_Wednesday_03 + $sum_Wednesday_04 + $sum_Wednesday_05 + $sum_Wednesday_06 + $sum_Wednesday_07 + $sum_Wednesday_08;
$total_sum_Thursday = $sum_Thursday_11 + $sum_Thursday_12 + $sum_Thursday_01 + $sum_Thursday_02 + $sum_Thursday_03 + $sum_Thursday_04 + $sum_Thursday_05 + $sum_Thursday_06 + $sum_Thursday_07 + $sum_Thursday_08;
$total_sum_Friday = $sum_Friday_11 + $sum_Friday_12 + $sum_Friday_01 + $sum_Friday_02 + $sum_Friday_03 + $sum_Friday_04 + $sum_Friday_05 + $sum_Friday_06 + $sum_Friday_07 + $sum_Friday_08;
$total_sum_Saturday = $sum_Saturday_11 + $sum_Saturday_12 + $sum_Saturday_01 + $sum_Saturday_02 + $sum_Saturday_03 + $sum_Saturday_04 + $sum_Saturday_05 + $sum_Saturday_06 + $sum_Saturday_07 + $sum_Saturday_08;
$total_sum_Sunday = $sum_Sunday_11 + $sum_Sunday_12 + $sum_Sunday_01 + $sum_Sunday_02 + $sum_Sunday_03 + $sum_Sunday_04 + $sum_Sunday_05 + $sum_Sunday_06 + $sum_Sunday_07 + $sum_Sunday_08;

/*
foreach($Monday as $lunes){
  echo $lunes;
  echo "<br>";
}

echo "<hr>";
$num = count($Thursday);

for($i=0;$i<$num;$i++){
  echo $Thursday[$i];
  echo "<br>";
}
*/

//var_dump($Fecha_sabado);

//var_dump($tiempo);



?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>.:Reportes:.</title>
    <?php include 'layout/library.php' ?>
    <script src="library/js/apexcharts.js"></script>
    <script src="library/js/download.js"></script>

<!-- Inicio:Estilos Venta hora por dia -->
<style>
    .highcharts-figure, .highcharts-data-table table {
    min-width: 360px; 
    max-width: 800px;
    margin: 1em auto;
}

.highcharts-data-table table {
	font-family: Verdana, sans-serif;
	border-collapse: collapse;
	border: 1px solid #EBEBEB;
	margin: 10px auto;
	text-align: center;
	width: 100%;
	max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
	font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

</style>
<!-- Fin:Estilos Venta hora por dia -->




    <style>
        .m-0 {
            margin: 0 !important;

        }

        .p-0 {
            padding: 0 !important;
        }
    </style>
</head>
<body class="">
<?php include 'layout/userNavBar.php' ?>
<div class="container">
<div class="row">
<div class="col">

<table>
<form action="reportes.php" method="POST" class="form-inline">
<tr>
<td>
<label for=""> <strong>FECHA INICIAL :</strong></label>
  <input class="form-control" type="date" id="fecha_inicio" name="fecha_inicio" max="<?php echo $fecha_maxima; ?>">
</td>
<td>
<label for=""> <strong>FECHA FINAL :</strong></label>
  <input class="form-control" type="date" id="fecha_final" name="fecha_final" max="<?php echo $fecha_maxima; ?>">
</td>
<td>
<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
</td>
</tr>
</form>
</table>


</div>
</div>
<div class="row">
<div class="col">
<?php if($_POST){ ?>
  <h5><?php echo "Mostrando del: ".date("d-m-Y",strtotime($_POST["fecha_inicio"]))." hasta ".date("d-m-Y",strtotime($_POST["fecha_final"])); ?></h5>
<?php }else{  ?>
  <h5>Seleccionar una fecha de Inicial y Final</h5>

<?php } ?>

</div>

</div>
<div class="row">
        <div class="col s12">
            <h5 class="center-align">Cantidad de ventas por Hora</h5>
        </div>
</div>



<div class="row">
<table class="table table-striped">
  <thead>
    <tr>
     <th scope="col"></th>
     <th scope="col">11a12</th>
      <th scope="col">12a1</th>
      <th scope="col">1a2</th>
      <th scope="col">2a3</th>
      <th scope="col">3a4</th>
      <th scope="col">4a5</th>
      <th scope="col">5a6</th>
      <th scope="col">6a7</th>
      <th scope="col">7a8</th>
      <th scope="col">8a9</th>
      <th scope="col">Total</th>
      
      
      
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"> Lunes </th>
      <td><?php echo $cant_Monday_11; ?></td>
      <td><?php echo $cant_Monday_12; ?></td>
      <td><?php echo $cant_Monday_01; ?></td>
      <td><?php echo $cant_Monday_02; ?></td>
      <td><?php echo $cant_Monday_03; ?></td>
      <td><?php echo $cant_Monday_04; ?></td>
      <td><?php echo $cant_Monday_05; ?></td>
      <td><?php echo $cant_Monday_06; ?></td>
      <td><?php echo $cant_Monday_07; ?></td>
      <td><?php echo $cant_Monday_08; ?></td>
      <td><?php echo $total_cant_Monday; ?></td>
      
    </tr>
    <tr>
      <th scope="row"> Martes </th>
      <td><?php echo $cant_Tuesday_11; ?></td>
      <td><?php echo $cant_Tuesday_12; ?></td>
      <td><?php echo $cant_Tuesday_01; ?></td>
      <td><?php echo $cant_Tuesday_02; ?></td>
      <td><?php echo $cant_Tuesday_03; ?></td>
      <td><?php echo $cant_Tuesday_04; ?></td>
      <td><?php echo $cant_Tuesday_05; ?></td>
      <td><?php echo $cant_Tuesday_06; ?></td>
      <td><?php echo $cant_Tuesday_07; ?></td>
      <td><?php echo $cant_Tuesday_08; ?></td>
      <td><?php echo $total_cant_Tuesday; ?></td>
      
    </tr>
    <tr>
      <th scope="row"> Miércoles </th>
      <td><?php echo $cant_Wednesday_11; ?></td>
      <td><?php echo $cant_Wednesday_12; ?></td>
      <td><?php echo $cant_Wednesday_01; ?></td>
      <td><?php echo $cant_Wednesday_02; ?></td>
      <td><?php echo $cant_Wednesday_03; ?></td>
      <td><?php echo $cant_Wednesday_04; ?></td>
      <td><?php echo $cant_Wednesday_05;; ?></td>
      <td><?php echo $cant_Wednesday_06; ?></td>
      <td><?php echo $cant_Wednesday_07; ?></td>
      <td><?php echo $cant_Wednesday_08; ?></td>
      <td><?php echo $total_cant_Wednesday; ?></td>
      
    </tr>
    <tr>
      <th scope="row"> Jueves </th>
      <td><?php echo $cant_Thursday_11; ?></td>
      <td><?php echo $cant_Thursday_12; ?></td>
      <td><?php echo $cant_Thursday_01; ?></td>
      <td><?php echo $cant_Thursday_02; ?></td>
      <td><?php echo $cant_Thursday_03; ?></td>
      <td><?php echo $cant_Thursday_04; ?></td>
      <td><?php echo $cant_Thursday_05; ?></td>
      <td><?php echo $cant_Thursday_06; ?></td>
      <td><?php echo $cant_Thursday_07; ?></td>
      <td><?php echo $cant_Thursday_08; ?></td>
      <td><?php echo $total_cant_Thursday; ?></td>
      
    </tr>
    <tr>
      <th scope="row"> Viernes </th>
      <td><?php echo $cant_Friday_11; ?></td>
      <td><?php echo $cant_Friday_12; ?></td>
      <td><?php echo $cant_Friday_01; ?></td>
      <td><?php echo $cant_Friday_02; ?></td>
      <td><?php echo $cant_Friday_03; ?></td>
      <td><?php echo $cant_Friday_04; ?></td>
      <td><?php echo $cant_Friday_05; ?></td>
      <td><?php echo $cant_Friday_06; ?></td>
      <td><?php echo $cant_Friday_07; ?></td>
      <td><?php echo $cant_Friday_08; ?></td>
      <td><?php echo $total_cant_Friday; ?></td>
      
    </tr>
    <tr>
      <th scope="row"> Sábado </th>
      <td><?php echo $cant_Saturday_11; ?></td>
      <td><?php echo $cant_Saturday_12; ?></td>
      <td><?php echo $cant_Saturday_01; ?></td>
      <td><?php echo $cant_Saturday_02; ?></td>
      <td><?php echo $cant_Saturday_03; ?></td>
      <td><?php echo $cant_Saturday_04; ?></td>
      <td><?php echo $cant_Saturday_05; ?></td>
      <td><?php echo $cant_Saturday_06; ?></td>
      <td><?php echo $cant_Saturday_07; ?></td>
      <td><?php echo $cant_Saturday_08; ?></td>
      <td><?php echo $total_cant_Saturday; ?></td>
      
    </tr>
    <tr>
      <th scope="row"> Domingo </th>
      <td><?php echo $cant_Sunday_11; ?></td>
      <td><?php echo $cant_Sunday_12; ?></td>
      <td><?php echo $cant_Sunday_01; ?></td>
      <td><?php echo $cant_Sunday_02; ?></td>
      <td><?php echo $cant_Sunday_03; ?></td>
      <td><?php echo $cant_Sunday_04; ?></td>
      <td><?php echo $cant_Sunday_05; ?></td>
      <td><?php echo $cant_Sunday_06; ?></td>
      <td><?php echo $cant_Sunday_07; ?></td>
      <td><?php echo $cant_Sunday_08; ?></td>
      <td><?php echo $total_cant_Sunday; ?></td>
      
    </tr>
  </tbody>
</table>

</div>

<!-- Inicio:Contenedor Cantidad Venta hora por dia -->
<div class="row">
<figure class="highcharts-figure">
        <div id="container"></div>
        <p class="highcharts-description">
            Grafico
        </p>
    </figure>
</div>
<!-- Fin:Contenedor Cantidad Venta hora por dia -->

<div class="row">
        <div class="col s12">
            <h5 class="center-align">Ingresos de ventas por Hora</h5>
        </div>
</div>



<div class="row">
<table class="table table-striped">
  <thead>
    <tr>
     <th scope="col"></th>
     <th scope="col">11a12</th>
      <th scope="col">12a1</th>
      <th scope="col">1a2</th>
      <th scope="col">2a3</th>
      <th scope="col">3a4</th>
      <th scope="col">4a5</th>
      <th scope="col">5a6</th>
      <th scope="col">6a7</th>
      <th scope="col">7a8</th>
      <th scope="col">8a9</th>
      <th scope="col">Total</th>
      
      
      
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Lunes </th>
      <td><?php echo $sum_Monday_11; ?></td>
      <td><?php echo $sum_Monday_12; ?></td>
      <td><?php echo $sum_Monday_01; ?></td>
      <td><?php echo $sum_Monday_02; ?></td>
      <td><?php echo $sum_Monday_03; ?></td>
      <td><?php echo $sum_Monday_04; ?></td>
      <td><?php echo $sum_Monday_05; ?></td>
      <td><?php echo $sum_Monday_06; ?></td>
      <td><?php echo $sum_Monday_07; ?></td>
      <td><?php echo $sum_Monday_08; ?></td>
      <td><?php echo $total_sum_Monday; ?></td>
      
    </tr>
    <tr>
      <th scope="row">Martes </th>
      <td><?php echo $sum_Tuesday_11; ?></td>
      <td><?php echo $sum_Tuesday_12; ?></td>
      <td><?php echo $sum_Tuesday_01; ?></td>
      <td><?php echo $sum_Tuesday_02; ?></td>
      <td><?php echo $sum_Tuesday_03; ?></td>
      <td><?php echo $sum_Tuesday_04; ?></td>
      <td><?php echo $sum_Tuesday_05; ?></td>
      <td><?php echo $sum_Tuesday_06; ?></td>
      <td><?php echo $sum_Tuesday_07; ?></td>
      <td><?php echo $sum_Tuesday_08; ?></td>
      <td><?php echo $total_sum_Tuesday; ?></td>
      
    </tr>
    <tr>
      <th scope="row">Miércoles </th>
      <td><?php echo $sum_Wednesday_11; ?></td>
      <td><?php echo $sum_Wednesday_12; ?></td>
      <td><?php echo $sum_Wednesday_01; ?></td>
      <td><?php echo $sum_Wednesday_02; ?></td>
      <td><?php echo $sum_Wednesday_03; ?></td>
      <td><?php echo $sum_Wednesday_04; ?></td>
      <td><?php echo $sum_Wednesday_05; ?></td>
      <td><?php echo $sum_Wednesday_06; ?></td>
      <td><?php echo $sum_Wednesday_07; ?></td>
      <td><?php echo $sum_Wednesday_08; ?></td>
      <td><?php echo $total_sum_Wednesday; ?></td>
      
    </tr>
    <tr>
      <th scope="row">Jueves </th>
      <td><?php echo $sum_Thursday_11; ?></td>
      <td><?php echo $sum_Thursday_12; ?></td>
      <td><?php echo $sum_Thursday_01; ?></td>
      <td><?php echo $sum_Thursday_02; ?></td>
      <td><?php echo $sum_Thursday_03; ?></td>
      <td><?php echo $sum_Thursday_04; ?></td>
      <td><?php echo $sum_Thursday_05; ?></td>
      <td><?php echo $sum_Thursday_06; ?></td>
      <td><?php echo $sum_Thursday_07; ?></td>
      <td><?php echo $sum_Thursday_08; ?></td>
      <td><?php echo $total_sum_Thursday; ?></td>
      
    </tr>
    <tr>
      <th scope="row">Viernes </th>
      <td><?php echo $sum_Friday_11; ?></td>
      <td><?php echo $sum_Friday_12; ?></td>
      <td><?php echo $sum_Friday_01; ?></td>
      <td><?php echo $sum_Friday_02; ?></td>
      <td><?php echo $sum_Friday_03; ?></td>
      <td><?php echo $sum_Friday_04; ?></td>
      <td><?php echo $sum_Friday_05; ?></td>
      <td><?php echo $sum_Friday_06; ?></td>
      <td><?php echo $sum_Friday_07; ?></td>
      <td><?php echo $sum_Friday_08; ?></td>
      <td><?php echo $total_sum_Friday; ?></td>
      
    </tr>
    <tr>
      <th scope="row">Sábado </th>
      <td><?php echo $sum_Saturday_11; ?></td>
      <td><?php echo $sum_Saturday_12; ?></td>
      <td><?php echo $sum_Saturday_01; ?></td>
      <td><?php echo $sum_Saturday_02; ?></td>
      <td><?php echo $sum_Saturday_03; ?></td>
      <td><?php echo $sum_Saturday_04; ?></td>
      <td><?php echo $sum_Saturday_05; ?></td>
      <td><?php echo $sum_Saturday_06; ?></td>
      <td><?php echo $sum_Saturday_07; ?></td>
      <td><?php echo $sum_Saturday_08; ?></td>
      <td><?php echo $total_sum_Saturday; ?></td>
      
    </tr>
    <tr>
      <th scope="row">Domingo </th>
      <td><?php echo $sum_Sunday_11; ?></td>
      <td><?php echo $sum_Sunday_12; ?></td>
      <td><?php echo $sum_Sunday_01; ?></td>
      <td><?php echo $sum_Sunday_02; ?></td>
      <td><?php echo $sum_Sunday_03; ?></td>
      <td><?php echo $sum_Sunday_04; ?></td>
      <td><?php echo $sum_Sunday_05; ?></td>
      <td><?php echo $sum_Sunday_06; ?></td>
      <td><?php echo $sum_Sunday_07; ?></td>
      <td><?php echo $sum_Sunday_08; ?></td>
      <td><?php echo $total_sum_Sunday; ?></td>
      
    </tr>
  </tbody>
</table>

</div>

<!-- Inicio:Contenedor Precio Total Venta hora por dia -->
<div class="row">
<figure class="highcharts-figure">
        <div id="container_suma"></div>
        <p class="highcharts-description">
            Grafico
        </p>
    </figure>
</div>
<!-- Fin:Contenedor Precio Total Venta hora por dia -->


<div class="row" style="margin-top: 15px">
        <div class="col s12">
            <h5 class="center-align">Reportes</h5>

        </div>
    </div>
    <div class=" row" style="margin-top: 15px">
        <div class="col s12 m12 l6 p-0 m-0">
            <div class="card-panel teal grey">
                <h6>Ventas por web el ultimo año</h6>
                <div id="chart"></div>
                <div class="center-align">
                    <div style="margin-bottom: 5px">

                        <small class="black-text" style="display: block">Selecciona un mes</small>
                        <input class="center-align" type="month" id="monthSelector" name="start"
                               min="2020-05" max="<?= date('Y-m'); ?>">
                    </div>
                    <button id="btnExportarPrimerReporte"
                            class="btn btn-flat white-text black waves-effect waves-light">Exportar detalle <i
                                class="material-icons right">
                            cloud_download
                        </i>
                    </button>
                </div>
            </div>

        </div>
    </div>
    
</div>
<?php include 'layout/userFooter.php' ?>


<!-- Inicio:Librerias js Venta hora por dia -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<!-- Inicio:Librerias js Venta hora por dia -->

<!-- Inicio:Script Venta hora por dia -->
<script>
        Highcharts.chart('container', {

title: {
  text: 'Grafico'
},

subtitle: {
  text: 'Cantidad de ventas por hora'
},

yAxis: {
  title: {
    text: 'Cantidad'
  }
},

xAxis: {
    categories:["11a12","12a1","1a2","2a3","3a4","4a5","5a6","6a7","7a8","8a9"]
  /*accessibility: {
    rangeDescription: 'Range: 2010 to 2017'
  }*/
},

legend: {
  layout: 'vertical',
  align: 'right',
  verticalAlign: 'middle'
},

/* plotOptions: {
  series: {
    label: {
      connectorAllowed: false
    },
    pointStart: 12
  }
},*/

series: [{
  name: 'Lunes',
  data: [<?php echo $cant_Monday_11; ?>, <?php echo $cant_Monday_12; ?>, <?php echo $cant_Monday_01; ?>, <?php echo $cant_Monday_02; ?>, <?php echo $cant_Monday_03; ?>,
   <?php echo $cant_Monday_04; ?>, <?php echo $cant_Monday_05; ?>, <?php echo $cant_Monday_06; ?>,<?php echo $cant_Monday_07; ?>,<?php echo $cant_Monday_08; ?>]
}, {
  name: 'Martes',
  data: [<?php echo $cant_Tuesday_11; ?>, <?php echo $cant_Tuesday_12; ?>, <?php echo $cant_Tuesday_01; ?>, <?php echo $cant_Tuesday_02; ?>, <?php echo $cant_Tuesday_03; ?>,
   <?php echo $cant_Tuesday_04; ?>, <?php echo $cant_Tuesday_05; ?>, <?php echo $cant_Tuesday_06; ?>,<?php echo $cant_Tuesday_07; ?>,<?php echo $cant_Tuesday_08; ?>]
}, {
  name: 'Miercoles',
  data: [<?php echo $cant_Wednesday_11; ?>, <?php echo $cant_Wednesday_12; ?>, <?php echo $cant_Wednesday_01; ?>, <?php echo $cant_Wednesday_02; ?>, <?php echo $cant_Wednesday_03; ?>, 
  <?php echo $cant_Wednesday_04; ?>, <?php echo $cant_Wednesday_05; ?>, <?php echo $cant_Wednesday_06; ?>,<?php echo $cant_Wednesday_07; ?>,<?php echo $cant_Wednesday_08; ?>]
}, {
  name: 'Jueves',
  data: [<?php echo $cant_Thursday_11; ?>, <?php echo $cant_Thursday_12; ?>, <?php echo $cant_Thursday_01; ?>, <?php echo $cant_Thursday_02; ?>, <?php echo $cant_Thursday_03; ?>, 
  <?php echo $cant_Thursday_04; ?>, <?php echo $cant_Thursday_05; ?>, <?php echo $cant_Thursday_06; ?>,<?php echo $cant_Thursday_07; ?>,<?php echo $cant_Thursday_08; ?>]
}, {
  name: 'Viernes',
  data: [<?php echo $cant_Friday_11; ?>, <?php echo $cant_Friday_12; ?>, <?php echo $cant_Friday_01; ?>, <?php echo $cant_Friday_02; ?>, <?php echo $cant_Friday_03; ?>,
   <?php echo $cant_Friday_04; ?>, <?php echo $cant_Friday_05; ?>, <?php echo $cant_Friday_06; ?>,<?php echo $cant_Friday_07; ?>,<?php echo $cant_Friday_08; ?>]
},{
  name: 'Sabado',
  data: [<?php echo $cant_Saturday_11; ?>, <?php echo $cant_Saturday_12; ?>, <?php echo $cant_Saturday_01; ?>, <?php echo $cant_Saturday_02; ?>, <?php echo $cant_Saturday_03; ?>,
   <?php echo $cant_Saturday_04; ?>, <?php echo $cant_Saturday_05; ?>, <?php echo $cant_Saturday_06; ?>,<?php echo $cant_Saturday_07; ?>,<?php echo $cant_Saturday_08; ?>]
},{
  name: 'Domingo',
  data: [<?php echo $cant_Sunday_11; ?>, <?php echo $cant_Sunday_12; ?>, <?php echo $cant_Sunday_01; ?>, <?php echo $cant_Sunday_02; ?>, <?php echo $cant_Sunday_03; ?>,
   <?php echo $cant_Sunday_04; ?>, <?php echo $cant_Sunday_05; ?>, <?php echo $cant_Sunday_06; ?>,<?php echo $cant_Sunday_07; ?>,<?php echo $cant_Sunday_08; ?>]
}],

responsive: {
  rules: [{
    condition: {
      maxWidth: 500
    },
    chartOptions: {
      legend: {
        layout: 'horizontal',
        align: 'center',
        verticalAlign: 'bottom'
      }
    }
  }]
}

});

    </script>
<!-- Inicio:Script Venta hora por dia -->

<!-- Inicio:Script suma Venta hora por dia -->
<script>
        Highcharts.chart('container_suma', {

title: {
  text: 'Grafico'
},

subtitle: {
  text: 'Ingresos de ventas por Hora'
},

yAxis: {
  title: {
    text: 'Ingreso'
  }
},

xAxis: {
    categories:["11a12","12a1","1a2","2a3","3a4","4a5","5a6","6a7","7a8","8a9"]
  /*accessibility: {
    rangeDescription: 'Range: 2010 to 2017'
  }*/
},

legend: {
  layout: 'vertical',
  align: 'right',
  verticalAlign: 'middle'
},

/* plotOptions: {
  series: {
    label: {
      connectorAllowed: false
    },
    pointStart: 12
  }
},*/

series: [{
  name: 'Lunes',
  data: [<?php echo $sum_Monday_11; ?>, <?php echo $sum_Monday_12; ?>, <?php echo $sum_Monday_01; ?>, <?php echo $sum_Monday_02; ?>, <?php echo $sum_Monday_03; ?>,
   <?php echo $sum_Monday_04; ?>, <?php echo $sum_Monday_05; ?>, <?php echo $sum_Monday_06; ?>,<?php echo $sum_Monday_07; ?>,<?php echo $sum_Monday_08; ?>]
}, {
  name: 'Martes',
  data: [<?php echo $sum_Tuesday_11; ?>, <?php echo $sum_Tuesday_12; ?>, <?php echo $sum_Tuesday_01; ?>, <?php echo $sum_Tuesday_02; ?>, <?php echo $sum_Tuesday_03; ?>,
   <?php echo $sum_Tuesday_04; ?>, <?php echo $sum_Tuesday_05; ?>, <?php echo $sum_Tuesday_06; ?>,<?php echo $sum_Tuesday_07; ?>,<?php echo $sum_Tuesday_08; ?>]
}, {
  name: 'Miercoles',
  data: [<?php echo $sum_Wednesday_11; ?>, <?php echo $sum_Wednesday_12; ?>, <?php echo $sum_Wednesday_01; ?>, <?php echo $sum_Wednesday_02; ?>, <?php echo $sum_Wednesday_03; ?>, 
  <?php echo $sum_Wednesday_04; ?>, <?php echo $sum_Wednesday_05; ?>, <?php echo $sum_Wednesday_06; ?>,<?php echo $sum_Wednesday_07; ?>,<?php echo $sum_Wednesday_08; ?>]
}, {
  name: 'Jueves',
  data: [<?php echo $sum_Thursday_11; ?>, <?php echo $sum_Thursday_12; ?>, <?php echo $sum_Thursday_01; ?>, <?php echo $sum_Thursday_02; ?>, <?php echo $sum_Thursday_03; ?>, 
  <?php echo $sum_Thursday_04; ?>, <?php echo $sum_Thursday_05; ?>, <?php echo $sum_Thursday_06; ?>,<?php echo $sum_Thursday_07; ?>,<?php echo $sum_Thursday_08; ?>]
}, {
  name: 'Viernes',
  data: [<?php echo $sum_Friday_11; ?>, <?php echo $sum_Friday_12; ?>, <?php echo $sum_Friday_01; ?>, <?php echo $sum_Friday_02; ?>, <?php echo $sum_Friday_03; ?>,
   <?php echo $sum_Friday_04; ?>, <?php echo $sum_Friday_05; ?>, <?php echo $sum_Friday_06; ?>,<?php echo $sum_Friday_07; ?>,<?php echo $sum_Friday_08; ?>]
},{
  name: 'Sabado',
  data: [<?php echo $sum_Saturday_11; ?>, <?php echo $sum_Saturday_12; ?>, <?php echo $sum_Saturday_01; ?>, <?php echo $sum_Saturday_02; ?>, <?php echo $sum_Saturday_03; ?>,
   <?php echo $sum_Saturday_04; ?>, <?php echo $sum_Saturday_05; ?>, <?php echo $sum_Saturday_06; ?>,<?php echo $sum_Saturday_07; ?>,<?php echo $sum_Saturday_08; ?>]
},{
  name: 'Domingo',
  data: [<?php echo $sum_Sunday_11; ?>, <?php echo $sum_Sunday_12; ?>, <?php echo $sum_Sunday_01; ?>, <?php echo $sum_Sunday_02; ?>, <?php echo $sum_Sunday_03; ?>,
   <?php echo $sum_Sunday_04; ?>, <?php echo $sum_Sunday_05; ?>, <?php echo $sum_Sunday_06; ?>,<?php echo $sum_Sunday_07; ?>,<?php echo $sum_Sunday_08; ?>]
}],

responsive: {
  rules: [{
    condition: {
      maxWidth: 500
    },
    chartOptions: {
      legend: {
        layout: 'horizontal',
        align: 'center',
        verticalAlign: 'bottom'
      }
    }
  }]
}

});

    </script>
<!-- Inicio:Script suma Venta hora por dia -->

<script>
    const D = document;
    const monthSelectorElement = D.getElementById('monthSelector');
    const btnExportarPrimerReporte = D.getElementById('btnExportarPrimerReporte');

    document.addEventListener('DOMContentLoaded', async () => {
        await construirPrimerReporte();

    });
    btnExportarPrimerReporte.addEventListener('click', () => {
        if (!monthSelectorElement.value) {
            alert('Elije un mes');
            return false;
        }
        descargarPrimerExcel(monthSelectorElement.value);


    });


    /*primer reporte*/
    async function construirPrimerReporte() {
        const report1Data = await fetchPrimerReporte();
        let options = {
            series: [{
                name: 'Total ventas',
                data: []
            }],
            chart: {
                foreColor: '#000000',
                height: 350,
                type: 'bar',
                events: {
                    click: function (chart, w, e) {
                        // console.log(chart, w, e)
                    }
                },
                toolbar: {
                    tools: {
                        download: '<i class="material-icons" style="color: black">\n' +
                            'menu\n' +
                            '</i>',
                    }
                }
            },
            plotOptions: {
                bar: {
                    columnWidth: '45%',
                    distributed: true
                }
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                show: false
            },
            xaxis: {
                categories: [],
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            }
        };

        report1Data.forEach(item => {
            options.series[0].data.push(item.montoVentas * 1);
            options.xaxis.categories.push(item.mes);

        });

        let chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    }
    async function fetchPrimerReporte() {
        return fetch('script/reportes/ventasUltimos6Meses.php')
            .then(value => {
                if (value.ok) {
                    return value.json();
                } else {
                    throw Error('Servicio no disponibles')
                }
            }).then(value => value)
    }

    /*end primer reporte*/


    function descargarPrimerExcel(monthAndYear) {

        const body = new FormData();
        body.append('monthAndYear', monthAndYear);

        fetch('excel/totalVentasPorMes.php', {method: 'POST', body}).then(value => {
            if (value.ok) {
                return value.blob();
            } else {
                throw  new Error('Servicio no disponible');
            }
        }).then(value => {
            download(value, `reporte-${monthAndYear}`);
        })
    }
</script>
</body>
</html>
