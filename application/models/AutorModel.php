<?php
class autorModel extends CI_model{
    public $fillable = [
        "idAutor" => null,
        "NombreAutor" => null,
    ];
    
    public $table = "Autor";

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
                "mensaje" => "Autores obtenidos"
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

