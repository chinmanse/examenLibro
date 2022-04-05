<?php
class libroModel extends CI_model{
    public $fillable = [
        "idLibro" => null,
        "ISBN" => null,
        "Titulo" => null,
        "NumeroEjemplares" => null,
        "idAutor" => null,
        "idEditorial" => null,
        "idTema" => null,

    ];
    
    public $table = "Libro";

    public function __construct()
    {
        $this->load->database();
    }

    public function insert($data){
        try{
            if($this->db->insert($this->table, $data)){
                return [
                    "status" => true,
                    "result" => null,
                    "mensaje" => "Libro registrado"
                ];
            }
            return [
                "status" => false,
                "result" => null,
                "mensaje" => $this->db->error()
            ];

        }catch(\Exception $e){
            return [
                "status" => false,
                "result" => null,
                "mensaje" => $e->getMessage()
            ];
        }
        
    }

    public function update($data, $idLibro){
        try{
            $this->db->where('idLibro', $idLibro);
            if($this->db->update($this->table, $data)){
                return [
                    "status" => true,
                    "result" => null,
                    "mensaje" => "Libro actualizado"
                ];
            }
            return [
                "status" => false,
                "result" => null,
                "mensaje" => $this->db->error()
            ];

        }catch(\Exception $e){
            return [
                "status" => false,
                "result" => null,
                "mensaje" => $e->getMessage()
            ];
        }
    }

    public function delete($idLibro){
        try{
            $this->db->where('idLibro', $idLibro);
            if($this->db->delete($this->table)){
                return [
                    "status" => true,
                    "result" => null,
                    "mensaje" => "Libro eliminado"
                ];
            }
            return [
                "status" => false,
                "result" => null,
                "mensaje" => $this->db->error()
            ];

        }catch(\Exception $e){
            return [
                "status" => false,
                "result" => null,
                "mensaje" => $e->getMessage()
            ];
        }
    }

    public function obtenerTodos(){
        try{
            $query = "select ". $this->table .".*, Autor.NombreAutor, Editorial.NombreEditorial, Tema.NombreTema from ". $this->table;
            $query .= " left join Autor on Libro.idAutor = Autor.idAutor ";
            $query .= " left join Editorial on Libro.idEditorial = Editorial.idEditorial ";
            $query .= " left join Tema on Libro.idTema = Tema.idTema ";

            $result = $this->db->query($query);
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
                "mensaje" => "Libros obtenidos"
            ];
        }catch(\Exception $e){
            return [
                "status" => false,
                "result" => null,
                "mensaje" => $e->getMessage()
            ];
        }
    }

    public function obtenerPorISBN($isbn, $idLibro = null){
        try{
            $query = "select * from ".$this->table." where ISBN = ".$isbn;
            if($idLibro != null){
                $query .= " and idLibro != ".$idLibro;
            }
            $result = $this->db->query($query);
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
                "mensaje" => "Libros obtenidos"
            ];
        }catch(\Exception $e){
            return [
                "status" => false,
                "result" => null,
                "mensaje" => $e->getMessage()
            ];
        }
    }

    public function obtenerPorId($idLibro){
        try{
            $query = "select * from ".$this->table." where idLibro = ".$idLibro;
            $result = $this->db->query($query);
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
                "mensaje" => "Libros obtenidos"
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
