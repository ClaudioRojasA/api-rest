<?php
    
    class ControladorCursos{

        public function index(){

            $cursos = ModeloCursos::index("cursos");

            $json = array(
                "detalle"=>$cursos,
            );
    
            echo json_encode($json,true);
            return;
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