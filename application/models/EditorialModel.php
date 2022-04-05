<?php
class editorialModel extends CI_model{
    public $fillable = [
        "idEditorial" => null,
        "NombreEditorial" => null,
        "Direccion" => null,
        "Telefono" => null
    ];
    
    public $table = "Editorial";

    public function __construct()
    {
        $this->load->database();
    }

    public function obtenerTodos(){
        try{
            $result = $this->db->query("select * from ". $this->table);
            if(empty($result->result())){
                return [
                    "status" => false,
                    "result" => null,
                    "mensaje" => "No hay libros"
                ];
            }

            return [
                "status" => true,
                "result" => $result->result(),
                "mensaje" => "Editoriales obtenidas"
            ];
        }catch(\Exception $e){
            return [
                "status" => false,
                "result" => null,
                "mensaje" => $e->getMessage()
            ];
        }
    }
}

