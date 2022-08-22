<?php
    
    class ControladorClientes{

        public function create($datos){

            /* VALIDAR NOMBRE */ 

            if(isset($datos["primer_nombre"]) && !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/', $datos["primer_nombre"] )){

                $json = array(
                    "status"=>404,
                    "detalle"=>"Error en el campo de nombre, solo se permiten letras"
                );
        
                echo json_encode($json,true);
                return;
                 
            }

            /* VALIDAR APELLIDO */

            if(isset($datos["primer_apellido"]) && !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/', $datos["primer_apellido"] )){

                $json = array(
                    "status"=>404,
                    "detalle"=>"Error en el campo de apellido, solo se permiten letras"
                );
        
                echo json_encode($json,true);
                return;
                 
            }

            /* VALIDAR EMAIL */

            if(isset($datos["email"]) && !preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $datos["email"] )){

                $json = array(
                    "status"=>404,
                    "detalle"=>"Error en el campo de email, ingrese un email valido"
                );
        
                echo json_encode($json,true);
                return;
                 
            }

            /* VALIDAR EMAIL REPETIDO */

            $clientes = ModeloClientes::index("clientes");
            /* 
            foreach ($clientes as $key => $value) {
                if ($value["email"] == $datos["email"]) {
                    
                    $json = array(
                        "status"=>404,
                        "detalle"=> "el email está repetido"
                    );

                    echo json_encode($json,true);
                    return;

                }
            }
            */

            /* GENERAR CREDENCIALES DEL CLIENTE */

            $id_cliente = str_replace("$","c",crypt($datos["primer_nombre"].$datos["primer_apellido"].$datos["email"], '$2a$07$afartwetsdAD52356FEDGsfhsd$'));
            $llave_secreta = str_replace("$","a",crypt($datos["email"].$datos["primer_apellido"].$datos["primer_nombre"], '$2a$07$afartwetsdAD52356FEDGsfhsd$'));
            
            $datos = array("primer_nombre"=>$datos["primer_nombre"],
                    "primer_apellido"=>$datos["primer_apellido"],
                    "email"=>$datos["email"],
                    "id_cliente"=>$id_cliente,
                    "llave_secreta"=>$llave_secreta
                    );

            $create = ModeloClientes::create("clientes",$datos);

            if($create == "ok"){

                $json = array(
                    "status"=>404,
                    "detalle"=> "Se generó sus credenciales"
                );

                echo json_encode($json,true);
                return;

            }

        }

    }

?>