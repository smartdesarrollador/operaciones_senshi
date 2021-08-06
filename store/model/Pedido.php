<?php
/**
 * Created by PhpStorm.
 * Developer: Johen Guevara Santos.
 * Email: mguevara@enfocussoluciones.com
 * Date: 25/09/2019
 * Time: 12:17
 */
require_once "ConexionBD.class.php";
require_once("AccesoBD.class.php");

class Pedido
{
    private $cn;

    //EL CONSTRUCTOR CONSTRUYE LA VARIABLE $cn
    function __construct()
    {
        try {
            $con = ConexionBD::CadenaCN();
            $this->cn = AccesoBD::ConexionBD($con);
            $this->cn->query("SET NAMES 'utf8'");   //ACENTOS UTF8
            $this->cn->set_charset('utf8mb4');   //ACENTOS UTF8
        } catch (Exception $e) {
            throw $e;
        }
    }


    public function getPedidosByDate($fechaPedido)
    {
        try {
            $sql = "SELECT *,clientes.DNI as clienteDni FROM clientes INNER JOIN pedidos ON clientes.idCliente = pedidos.idCliente
                    WHERE fechaPedido = '$fechaPedido' AND local_distrito = 'san_borja' AND deleted = 'FALSE' ORDER BY horaPedido DESC ";
            $lista = AccesoBD::Consultar($this->cn, $sql);
            return $lista;
        } catch (Exception $e) {
            $mensaje = "Fecha: " . date("Y-m-d H:i:s") . "\n" .
                "Archivo: " . $e->getFile() . "\n" .
                "Linea: " . $e->getLine() . "\n" .
                "Mensaje: " . $sql . "\n\n";
            error_log($mensaje, 3, "log/proyecto.log");
            throw $e;
        }
    }

    public function getPedidosByFechaDeEnvio($fechaEnvio)
    {
        try {
            $sql = "SELECT * FROM pedidos
 INNER JOIN horario on pedidos.idHorario = horario.idHorario
 WHERE fechaEnvio= '$fechaEnvio' AND local_distrito = 'san_borja' AND deleted = 'FALSE'
  ORDER BY horaPedido DESC ";
            $lista = AccesoBD::Consultar($this->cn, $sql);
            return $lista;
        } catch (Exception $e) {
            $mensaje = "Fecha: " . date("Y-m-d H:i:s") . "\n" .
                "Archivo: " . $e->getFile() . "\n" .
                "Linea: " . $e->getLine() . "\n" .
                "Mensaje: " . $sql . "\n\n";
            error_log($mensaje, 3, "log/proyecto.log");
            throw $e;
        }
    }

    public function getPedidosLocalByFechaDeEnvio($fechaEnvio)
    {
        try {
            $sql = "SELECT * FROM pedidos
 where fechaEnvio= '$fechaEnvio' AND local_distrito = 'san_borja' AND deleted = 'FALSE' ORDER BY horaPedido DESC ";
            $lista = AccesoBD::Consultar($this->cn, $sql);
            return $lista;
        } catch (Exception $e) {
            $mensaje = "Fecha: " . date("Y-m-d H:i:s") . "\n" .
                "Archivo: " . $e->getFile() . "\n" .
                "Linea: " . $e->getLine() . "\n" .
                "Mensaje: " . $sql . "\n\n";
            error_log($mensaje, 3, "log/proyecto.log");
            throw $e;
        }
    }

    public function getPedidosLocalByDate($fechaPedido)
    {
        try {
            $sql = "SELECT  *,
                pedidos.idPedido,
                clientes_local.nombre,
                clientes_local.apellido,
                pedidos.pedidoTelefono,
                pedidos.distrito,
                pedidos.direccionPedido,
                pedidos.pedidoObservaciones,
                pedidos.medio,
                pedidos.horaEntregaLocal,
                driver.nombre as nombreDriver,
                clientes_local.idCliente as idClienteLocal
                
                FROM clientes_local 
                INNER JOIN pedidos 
                ON clientes_local.idCliente = pedidos.idClienteLocal
                INNER JOIN driver
                ON pedidos.idDriver = driver.idDriver
                WHERE fechaPedido = '$fechaPedido' AND local_distrito = 'san_borja' AND deleted = 'FALSE' ORDER BY horaPedido DESC ";
            $lista = AccesoBD::Consultar($this->cn, $sql);
            return $lista;
        } catch (Exception $e) {
            $mensaje = "Fecha: " . date("Y-m-d H:i:s") . "\n" .
                "Archivo: " . $e->getFile() . "\n" .
                "Linea: " . $e->getLine() . "\n" .
                "Mensaje: " . $sql . "\n\n";
            error_log($mensaje, 3, "log/proyecto.log");
            throw $e;
        }
    }

    public function getPedidosLocalLimit50Pending()
    {
        try {
            $sql = "SELECT *,
                pedidos.idPedido,
                clientes_local.nombre,
                clientes_local.apellido,
                pedidos.pedidoTelefono,
                pedidos.distrito,
                pedidos.direccionPedido,
                pedidos.pedidoObservaciones,
                pedidos.medio,
                pedidos.horaEntregaLocal,
                driver.nombre as nombreDriver,
                clientes_local.idCliente as idClienteLocal
                
                FROM clientes_local INNER JOIN pedidos 
                ON clientes_local.idCliente = pedidos.idClienteLocal
                INNER JOIN driver
                ON pedidos.idDriver = driver.idDriver WHERE idEstado=0 AND local_distrito = 'san_borja' AND deleted = 'FALSE'
                     ORDER BY idPedido DESC LIMIT 50 ";
            $lista = AccesoBD::Consultar($this->cn, $sql);
            return $lista;
        } catch (Exception $e) {
            $mensaje = "Fecha: " . date("Y-m-d H:i:s") . "\n" .
                "Archivo: " . $e->getFile() . "\n" .
                "Linea: " . $e->getLine() . "\n" .
                "Mensaje: " . $sql . "\n\n";
            error_log($mensaje, 3, "log/proyecto.log");
            throw $e;
        }
    }
    public function getPedidosLocalLimit50()
    {
        try {
            $sql = "SELECT  *,
                pedidos.idPedido,
                clientes_local.nombre,
                clientes_local.apellido,
                pedidos.pedidoTelefono,
                pedidos.distrito,
                pedidos.direccionPedido,
                pedidos.pedidoObservaciones,
                pedidos.medio,
                pedidos.horaEntregaLocal,
                driver.nombre as nombreDriver,
                clientes_local.idCliente as idClienteLocal
                FROM clientes_local INNER JOIN pedidos 
                ON clientes_local.idCliente = pedidos.idClienteLocal
                INNER JOIN driver
                ON pedidos.idDriver = driver.idDriver
                WHERE local_distrito = 'san_borja' AND deleted = 'FALSE'
                     ORDER BY idPedido DESC LIMIT 50 ";
            $lista = AccesoBD::Consultar($this->cn, $sql);

            return $lista;
        } catch (Exception $e) {
            $mensaje = "Fecha: " . date("Y-m-d H:i:s") . "\n" .
                "Archivo: " . $e->getFile() . "\n" .
                "Linea: " . $e->getLine() . "\n" .
                "Mensaje: " . $sql . "\n\n";
            error_log($mensaje, 3, "log/proyecto.log");
            throw $e;
        }
    }
    public function getPedidosItemsByidPedido($idPedido)
    {
        try {
            $sql = "select nombreProducto,cantidad,item_descripcion,precioProducto,observacionesPaquete from pedidos INNER JOIN pedido_items ON pedidos.idPedido = pedido_items.idPedido 
                    INNER JOIN productos ON pedido_items.idProducto = productos.idProducto WHERE pedidos.idPedido = '$idPedido' AND pedidos.local_distrito = 'san_borja'";
            $lista = AccesoBD::Consultar($this->cn, $sql);
            return $lista;
        } catch (Exception $e) {
            $mensaje = "Fecha: " . date("Y-m-d H:i:s") . "\n" .
                "Archivo: " . $e->getFile() . "\n" .
                "Linea: " . $e->getLine() . "\n" .
                "Mensaje: " . $sql . "\n\n";
            error_log($mensaje, 3, "log/proyecto.log");
            throw $e;
        }
    }

    public function getPedidosLimit50()
    {
        try {
            $sql = "SELECT *,clientes.DNI as clienteDni FROM clientes INNER JOIN pedidos ON clientes.idCliente = pedidos.idCliente
WHERE local_distrito = 'san_borja' AND deleted = 'FALSE' 
                     ORDER BY idPedido DESC LIMIT 50 ";
            $lista = AccesoBD::Consultar($this->cn, $sql);

            return $lista;
        } catch (Exception $e) {
            $mensaje = "Fecha: " . date("Y-m-d H:i:s") . "\n" .
                "Archivo: " . $e->getFile() . "\n" .
                "Linea: " . $e->getLine() . "\n" .
                "Mensaje: " . $sql . "\n\n";
            error_log($mensaje, 3, "log/proyecto.log");
            throw $e;
        }
    }


    public function getPedidosLimit50Pending()
    {
        try {
            $sql = "SELECT *,clientes.DNI as clienteDni FROM clientes INNER JOIN pedidos ON clientes.idCliente = pedidos.idCliente WHERE idEstado=0 AND local_distrito = 'san_borja' AND deleted = 'FALSE'
                     ORDER BY idPedido DESC LIMIT 50 ";
            $lista = AccesoBD::Consultar($this->cn, $sql);
            return $lista;
        } catch (Exception $e) {
            $mensaje = "Fecha: " . date("Y-m-d H:i:s") . "\n" .
                "Archivo: " . $e->getFile() . "\n" .
                "Linea: " . $e->getLine() . "\n" .
                "Mensaje: " . $sql . "\n\n";
            error_log($mensaje, 3, "log/proyecto.log");
            throw $e;
        }
    }


    public function getAllPedidos()
    {
        try {
            $sql = "SELECT * FROM clientes INNER JOIN pedidos ON clientes.idCliente = pedidos.idCliente where local_distrito = 'san_borja' AND deleted = 'FALSE'";
            $lista = AccesoBD::Consultar($this->cn, $sql);
            return $lista;
        } catch (Exception $e) {
            $mensaje = "Fecha: " . date("Y-m-d H:i:s") . "\n" .
                "Archivo: " . $e->getFile() . "\n" .
                "Linea: " . $e->getLine() . "\n" .
                "Mensaje: " . $sql . "\n\n";
            error_log($mensaje, 3, "log/proyecto.log");
            throw $e;
        }
    }

    public function changeFeedBackStatus($idPedido, $status, $token)
    {
        $sql = "UPDATE pedidos set
                feedBackEnviado= '$status',feedBackToken='$token' where local_distrito = 'san_borja' AND idPedido = '$idPedido'";
        $id = AccesoBD::Insertar($this->cn, $sql);
        return $id;
    }

    public function getCountOfPEdidos()
    {
        try {
            $sql = "SELECT count(idPedido) as total FROM pedidos WHERE pedidos.local_distrito = 'san_borja' AND pedidos.idCliente > 0  AND deleted = 'FALSE'";
            $lista = AccesoBD::Consultar($this->cn, $sql);
            return $lista[0];
        } catch (Exception $e) {
            $mensaje = "Fecha: " . date("Y-m-d H:i:s") . "\n" .
                "Archivo: " . $e->getFile() . "\n" .
                "Linea: " . $e->getLine() . "\n" .
                "Mensaje: " . $sql . "\n\n";
            error_log($mensaje, 3, "log/proyecto.log");
            throw $e;
        }
    }

    public function updateOrderStatus($idEstado, $idPedido)
    {
        $sql = "UPDATE pedidos set
                idEstado= '$idEstado' where idPedido = '$idPedido' AND local_distrito = 'san_borja'";
        $id = AccesoBD::Insertar($this->cn, $sql);
        return $id;
    }

    public function getPedidoByID($idPedido)
    {
        try {
            $sql = "SELECT * FROM clientes INNER JOIN pedidos ON clientes.idCliente = pedidos.idCliente 
 WHERE idPedido = '$idPedido' AND local_distrito = 'san_borja' ORDER BY horaPedido DESC ";
            $lista = AccesoBD::Consultar($this->cn, $sql);
            return $lista[0];
        } catch (Exception $e) {
            $mensaje = "Fecha: " . date("Y-m-d H:i:s") . "\n" .
                "Archivo: " . $e->getFile() . "\n" .
                "Linea: " . $e->getLine() . "\n" .
                "Mensaje: " . $sql . "\n\n";
            error_log($mensaje, 3, "log/proyecto.log");
            throw $e;
        }
    }

    public function getPedidoLocalByID($idPedido)
    {
        try {
            $sql = "SELECT *,driver.nombre as driverNombre ,clientes_local.nombre as clienteNombre FROM clientes_local INNER JOIN pedidos ON clientes_local.idCliente = pedidos.idClienteLocal
INNER JOIN driver ON pedidos.idDriver = driver.idDriver
 WHERE idPedido = '$idPedido' AND local_distrito = 'san_borja' ORDER BY horaPedido DESC ";
            $lista = AccesoBD::Consultar($this->cn, $sql);
            return $lista[0];
        } catch (Exception $e) {
            $mensaje = "Fecha: " . date("Y-m-d H:i:s") . "\n" .
                "Archivo: " . $e->getFile() . "\n" .
                "Linea: " . $e->getLine() . "\n" .
                "Mensaje: " . $sql . "\n\n";
            error_log($mensaje, 3, "log/proyecto.log");
            throw $e;
        }
    }

    public function addPedidoLocal($direccionPedido,
                                   $pedidoTelefono,
                                   $pedidoObservaciones, $precioTotal, $delivery = 'true', $local_distrito,
                                   $referencia, $distrito, $documento, $razonSocial, $direccionFiscal, $ruc, $idClienteLocal, $dni, $medio, $fechaEnvio, $horaEntregaLocal,
                                   $driverLocal,$costoEnvioLocal,$adicionalEnvioLocal,$idDriver, $costoEnvioPagado)
    {
        date_default_timezone_set('America/Lima');
        $actualDate = date('Ymd');
        $dateTime = time();
        $horaPedido = date('H:i:s');


        $sql = "INSERT INTO pedidos ( direccionPedido,
                pedidoTelefono,
                fechaPedido,
                pedidoObservaciones
                ,precioTotal,
                horaPedido,
                dateTime,
                delivery,
                local_distrito,
                referencia,
                distrito,
                documento,
                razonSocial,
                direccionFiscal
                ,ruc,idClienteLocal,
                DNI,medio,fechaEnvio,horaEntregaLocal,
                driverLocal,
                costoEnvioLocal,
                adicionalEnvioLocal,
                idDriver,
                costoEnvioPagado
                )
                
                     VALUES ('$direccionPedido','$pedidoTelefono','$actualDate','$pedidoObservaciones','$precioTotal','$horaPedido',
                     '$dateTime','$delivery', '$local_distrito', '$referencia','$distrito','$documento',
                     '$razonSocial','$direccionFiscal','$ruc','$idClienteLocal','$dni','$medio','$fechaEnvio'
                     ,'$horaEntregaLocal','$driverLocal','$costoEnvioLocal','$adicionalEnvioLocal','$idDriver','$costoEnvioPagado')";
        $id = AccesoBD::InsertAndGetLastId($this->cn, $sql);
        return $id;
    }

    public function addItemsPedido($sql)
    {

        $id = AccesoBD::addMultiQuery($this->cn, $sql);
        return $id;
    }

    public function getPedidosByDriver($idDriver)
    {
        try {
            $sql = "SELECT * FROM pedidos INNER JOIN estadopedido 
                    ON pedidos.idEstado = estadopedido.idEstado 
                    where idDriver = '$idDriver' AND local_distrito = 'san_borja' AND deleted = 'FALSE' AND LENGTH(idCliente)>0 ORDER BY fechaPedido DESC";
            $lista = AccesoBD::Consultar($this->cn, $sql);
            return $lista;
        } catch (Exception $e) {
            $mensaje = "Fecha: " . date("Y-m-d H:i:s") . "\n" .
                "Archivo: " . $e->getFile() . "\n" .
                "Linea: " . $e->getLine() . "\n" .
                "Mensaje: " . $sql . "\n\n";
            error_log($mensaje, 3, "log/proyecto.log");
            throw $e;
        }
    }

    public function getPedidosByDriverAndFechaPedido($idDriver, $fechaPedido)
    {
        try {
            $sql = "SELECT * FROM pedidos INNER JOIN estadopedido 
            ON pedidos.idEstado = estadopedido.idEstado where idDriver = '$idDriver' 
            AND fechaPedido = '$fechaPedido' AND local_distrito = 'san_borja' AND deleted = 'FALSE' AND LENGTH(idCliente)>0 ORDER BY fechaPedido DESC";
            $lista = AccesoBD::Consultar($this->cn, $sql);
            return $lista;
        } catch (Exception $e) {
            $mensaje = "Fecha: " . date("Y-m-d H:i:s") . "\n" .
                "Archivo: " . $e->getFile() . "\n" .
                "Linea: " . $e->getLine() . "\n" .
                "Mensaje: " . $sql . "\n\n";
            error_log($mensaje, 3, "log/proyecto.log");
            throw $e;
        }
    }

    public function getPedidosByDriverLocal($idDriver)
    {
        try {
            $sql = "SELECT * FROM pedidos INNER JOIN estadopedido 
                    ON pedidos.idEstado = estadopedido.idEstado 
                    where idDriver = '$idDriver' AND local_distrito = 'san_borja' AND deleted = 'FALSE' AND LENGTH(idClienteLocal)>0 ORDER BY fechaPedido DESC";
            $lista = AccesoBD::Consultar($this->cn, $sql);
            return $lista;
        } catch (Exception $e) {
            $mensaje = "Fecha: " . date("Y-m-d H:i:s") . "\n" .
                "Archivo: " . $e->getFile() . "\n" .
                "Linea: " . $e->getLine() . "\n" .
                "Mensaje: " . $sql . "\n\n";
            error_log($mensaje, 3, "log/proyecto.log");
            throw $e;
        }
    }

    public function getPedidosByDriverAndFechaPedidoLocal($idDriver, $fechaPedido)
    {
        try {
            $sql = "SELECT * FROM pedidos INNER JOIN estadopedido 
            ON pedidos.idEstado = estadopedido.idEstado where idDriver = '$idDriver' 
            AND fechaPedido = '$fechaPedido' AND local_distrito = 'san_borja' AND LENGTH(idClienteLocal)>0 AND deleted = 'FALSE' ORDER BY fechaPedido DESC";
            $lista = AccesoBD::Consultar($this->cn, $sql);
            return $lista;
        } catch (Exception $e) {
            $mensaje = "Fecha: " . date("Y-m-d H:i:s") . "\n" .
                "Archivo: " . $e->getFile() . "\n" .
                "Linea: " . $e->getLine() . "\n" .
                "Mensaje: " . $sql . "\n\n";
            error_log($mensaje, 3, "log/proyecto.log");
            throw $e;
        }
    }

    public function reporteDriver($fechaPedido)
    {
        try {
            $sql = "SELECT *,driver.nombre as nombreDriver FROM pedidos 
INNER JOIN driver ON pedidos.idDriver = driver.idDriver WHERE fechaEnvio= '$fechaPedido' AND local_distrito = 'san_borja' AND pedidos.idDriver != 3 AND deleted = 'FALSE'";
            $lista = AccesoBD::Consultar($this->cn, $sql);
            return $lista;
        } catch (Exception $e) {
            $mensaje = "Fecha: " . date("Y-m-d H:i:s") . "\n" .
                "Archivo: " . $e->getFile() . "\n" .
                "Linea: " . $e->getLine() . "\n" .
                "Mensaje: " . $sql . "\n\n";
            error_log($mensaje, 3, "log/proyecto.log");
            throw $e;
        }
    }

    public function borrarPedido($idPedido)
    {
        $sql = "UPDATE pedidos set
                deleted= 'TRUE' where idPedido = '$idPedido'";
        $id = AccesoBD::Insertar($this->cn, $sql);
        return $id;
    }
    public function reporteVentasUltimos6Meses()
    {
        try {
            $cast = "SET lc_time_names = 'es_ES';";
            $sql = "SELECT SUM(precioTotal) as montoVentas,MONTHNAME(fechaPedido) as mes FROM pedidos WHERE local_distrito = 'san_borja' AND  CHAR_LENGTH(idCliente)>0 GROUP BY MONTHNAME(fechaPedido) ORDER BY fechaPedido ASC";
            AccesoBD::OtroSQL($this->cn, $cast);
            $lista = AccesoBD::Consultar($this->cn, $sql);
            return $lista;
        } catch (Exception $e) {
            $mensaje = "Fecha: " . date("Y-m-d H:i:s") . "\n" .
                "Archivo: " . $e->getFile() . "\n" .
                "Linea: " . $e->getLine() . "\n" .
                "Mensaje: " . $sql . "\n\n";
            error_log($mensaje, 3, "log/proyecto.log");
            throw $e;
        }
    }
    public function generarExcelPrimerReporte($monthAndYear)
    {
        try {
            $arrDate = explode('-', $monthAndYear);

            $year = $arrDate[0];
            $month = $arrDate[1];


            $sql = "SELECT * FROM pedidos WHERE local_distrito = 'san_borja' AND MONTH(fechaPedido) = '$month' AND YEAR(fechaPedido) = '$year' AND CHAR_LENGTH(idCliente)>0";
            $lista = AccesoBD::Consultar($this->cn, $sql);
            return $lista;
        } catch (Exception $e) {
            $mensaje = "Fecha: " . date("Y-m-d H:i:s") . "\n" .
                "Archivo: " . $e->getFile() . "\n" .
                "Linea: " . $e->getLine() . "\n" .
                "Mensaje: " . $sql . "\n\n";
            error_log($mensaje, 3, "log/proyecto.log");
            throw $e;
        }
    }

    
    public function getPedidosByFecha($fechaInicio, $fechaFinal)
    {
        try {
            $sql = "SELECT * FROM `pedidos` WHERE local_distrito = 'san_borja' AND deleted= 'FALSE' AND fechaPedido BETWEEN '$fechaInicio' AND '$fechaFinal'";
            $lista = AccesoBD::Consultar($this->cn, $sql);
            return $lista;
        } catch (Exception $e) {
            $mensaje = "Fecha: " . date("Y-m-d H:i:s") . "\n" .
                "Archivo: " . $e->getFile() . "\n" .
                "Linea: " . $e->getLine() . "\n" .
                "Mensaje: " . $sql . "\n\n";
            error_log($mensaje, 3, "log/proyecto.log");
            throw $e;
        }
    }
}
