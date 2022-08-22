<?php
    
    $arrayRutas = explode("/",$_SERVER['REQUEST_URI']);
    // echo "<pre>"; print_r($arrayRutas); echo "<pre>";

    /* CUANDO NO SE HACE NINGUNA PETICIÓN A LA API */

    if(count(array_filter($arrayRutas)) == 1){
        $json = array(
            "detalle"=>"no encontrado"
        );

        echo json_encode($json,true);
        return;
    }else{

        /* CUANDO PASAMOS SOLO UN ÍNDICE EN EL ARRAY $arrayRutas */
             
        if(count(array_filter($arrayRutas)) == 2){

            /* CUANDO SE HACE UNA PETICIÓN DESDE CURSOS */

            if(array_filter($arrayRutas)[2] == "cursos"){
                
                if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST"){
                    $cursos = new ControladorCursos();
                    $cursos->create();
                }
                else if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET"){
                    $cursos = new ControladorCursos();
                    $cursos->index();
                }

            }
            
            /* CUANDO SE HACE UNA PETICIÓN DESDE REGISTRO */

            if(array_filter($arrayRutas)[2] == "registro"){

                if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST"){

                    $datos = array("primer_nombre" => $_POST["primer_nombre"],
                    "primer_apellido" => $_POST["primer_apellido"],
                    "email" => $_POST["email"]);

                    //echo "<pre>"; print_r($datos); echo "<pre>";

                    $clientes = new ControladorClientes();
                    $clientes->create($datos);
                }

            }

        }else{
            if(array_filter($arrayRutas) [2] == "cursos" && is_numeric(array_filter($arrayRutas)[3])){

                /* PETICION GET */

                if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET"){
                    $curso = new ControladorCursos();
                    $curso->show(array_filter($arrayRutas)[3]);
                }

                /* PETICION GET */

                if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "PUT"){
                    $editarCurso = new ControladorCursos();
                    $editarCurso->update(array_filter($arrayRutas)[3]);
                }

                /* PETICION DELETE */

                if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "DELETE"){
                    $borrarCurso = new ControladorCursos();
                    $borrarCurso->delete(array_filter($arrayRutas)[3]);
                }

            }
        }
    }
    

?>