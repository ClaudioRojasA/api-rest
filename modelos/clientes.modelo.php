<?php

    require_once "conexion.php";

    class ModeloClientes{

        /* MOSTRAR LOS REGISTROS */

        static public function index($tabla){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS);
            $stmt->close();
            $stmt = null;

        }

        static public function create($tabla,$datos){

            $stmt = Conexion::conectar()->prepare("");

        }

    }

?>