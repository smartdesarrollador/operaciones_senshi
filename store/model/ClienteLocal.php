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

class ClienteLocal
{
    private $cn;

    //EL CONSTRUCTOR CONSTRUYE LA VARIABLE $cn
    function __construct()
    {
        try {
            $con = ConexionBD::CadenaCN();
            $this->cn = AccesoBD::ConexionBD($con);
            $this->cn->query("SET NAMES 'utf8'");   //ACENTOS UTF8
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function addNewClienteLocal($nombre, $apellido, $email, $celular,$fechaNacimiento )
    {
        date_default_timezone_set('America/Lima');
        $actualDate = date('Ymd');
        $sql = "INSERT INTO clientes_local(nombre,apellido,email,celular,fechaRegistro,fechaNacimiento)
					VALUES('$nombre','$apellido','$email','$celular','$actualDate','$fechaNacimiento')";
        $id = AccesoBD::InsertAndGetLastId($this->cn, $sql);
        return $id;
    }

    public function getClienteLocal($idClienteLocal)
    {
        try {
            $sql = "SELECT * FROM clientes_local where idCliente = '$idClienteLocal'";
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

    public function updateClienteLocal($idCliente, $nombre, $apellido, $correo, $fechaNacimiento, $celular)
    {
        $sql = "UPDATE clientes_local set
                 nombre = '$nombre',
                 apellido = '$apellido',
                 email = '$correo',
                 fechaNacimiento = '$fechaNacimiento',
                 celular = '$celular'
                
                where idCliente = '$idCliente'";
        $id = AccesoBD::Insertar($this->cn, $sql);
        return $id;
    }

}
