<?php
    
    class ControladorCursos{

        public function index(){

            /* VALIDACIÓN DE CREDENCIALES */

            $clientes = ModeloClientes::index("clientes");

            if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])){
                foreach($clientes as $key => $value){
                    if(base64_encode($_SERVER['PHP_AUTH_USER'].":".$_SERVER['PHP_AUTH_PW']) == 
                       base64_encode($value->id_cliente.":".$value->llave_secreta)){

                        $cursos = ModeloCursos::index("cursos");

                        $json = array(
                            "status"=>200,
                            "total_registros"=>count($cursos),
                            "detalle"=>$cursos,
                        );
                
                        echo json_encode($json,true);
                        return;

                    }
                }
            }      
        }

        public function create(){
            $json = array(
                "detalle"=>"estas en la vista create"
            );
    
            echo json_encode($json,true);
            return;
        }

        public function show($id){
            $json = array(
                "detalle"=>"Este curso tiene el ID: ".$id
            );
    
            echo json_encode($json,true);
            return;
        }

        public function update($id){
            $json = array(
                "detalle"=>"El curso con el ID=".$id." ha sido actualizado."
            );
    
            echo json_encode($json,true);
            return;
        }

        public function delete($id){
            $json = array(
                "detalle"=>"El curso con el ID=".$id." ha sido borrado."
            );
    
            echo json_encode($json,true);
            return;
        }

    }

?>