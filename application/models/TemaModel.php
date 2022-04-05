<?php
class temaModel extends CI_model{
    public $fillable = [
        "idTema" => null,
        "NombreTema" => null,
    ];
    
    public $table = "Tema";

    public function __construct()
    {
        $this->load->database();
    }

    public function obtenerTodos(){
        try{
            $result = $this->db->query("select * from " . $this->table);
            if(empty($result->result())){
                return [
                    "status" => false,
                    "result" => null,
                    "mensaje" => "No hay temas"
                ];
            }

            return [
                "status" => true,
                "result" => $result->result(),
                "mensaje" => "Temas obtenidos"
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
