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

            $stmt = Conexion::conectar()->prepare("INSERT INTO clientes
            (primer_nombre, primer_apellido, email, id_cliente, llave_secreta)
            VALUES (:primer_nombre, :primer_apellido, :email, :id_cliente, :llave_secreta)");

            $stmt->bindParam(":primer_nombre", $datos["primer_nombre"],PDO::PARAM_STR);
            $stmt->bindParam(":primer_apellido", $datos["primer_apellido"],PDO::PARAM_STR); 
            $stmt->bindParam(":email", $datos["email"],PDO::PARAM_STR); 
            $stmt->bindParam(":id_cliente", $datos["id_cliente"],PDO::PARAM_STR); 
            $stmt->bindParam(":llave_secreta", $datos["llave_secreta"],PDO::PARAM_STR);  

            if($stmt->execute()){
                return "ok";
            }else{
                /* RETORNAR EL ERROR SI LA CONECCIÓN NO FUNCIONA */
                print_r(Conexion::conectar()->errorInfo());
            }

            $stmt->close();
            $stmt = null;

        }

    }

?>