<?php
    
    class ControladorClientes{

        public function create($datos){

            /* VALIDAR NOMBRE */ 

            if(isset($datos["nombre"]) && !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/', $datos["nombre"] )){

                $json = array(
                    "status"=>404,
                    "detalle"=>"Error en el campo de nombre, solo se permiten letras"
                );
        
                echo json_encode($json,true);
                return;
                 
            }

            /* VALIDAR APELLIDO */

            if(isset($datos["apellido"]) && !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/', $datos["apellido"] )){

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

            /* GENERAR CREDENCIALES DEL CLIENTE */

            $id_cliente = str_replace("$","c",crypt($datos["nombre"].$datos["apellido"].$datos["email"], '$2a$07$afartwetsdAD52356FEDGsfhsd$'));
            $llave_secreta = str_replace("$","a",crypt($datos["email"].$datos["apellido"].$datos["nombre"], '$2a$07$afartwetsdAD52356FEDGsfhsd$'));

            $datos = array(
                    "nombre"=>$datos["nombre"],
                    "apellido"=>$datos["apellido"],
                    "email"=>$datos["email"],
                    "id_cliente"=>$datos["id_cliente"],
                    "llave_secreta"=>$datos["llave_secreta"],
                    "created_at"=>date('Y-m-d h:i:s'),
                    "updated_at"=>date('Y-m-d h:i:s')
                    );

            $create = ModeloClientes::create("clientes",$datos);

        }

    }

?>