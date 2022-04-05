<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Libro extends CI_Controller {
    public $error = "";
    public $autores =[];
    public $editoriales =[];
    public $temas =[];

    public function __construct(){
        parent::__construct();
        $this->load->model("libroModel");
        $this->load->model("autorModel");
        $this->load->model("editorialModel");
        $this->load->model("temaModel");
        $this->load->helper(array('form', 'url'));
    }

	public function index()
	{
        $info["titulo"] = "Registra datos";
        $info["error"] = $this->error;
		$this->load->view('libro/lista_libro', $info);
	}

    public function formulario(){
        $this->obtieneExternos();
        $info["titulo"] = "Registro Nuevo Libro";
        $info["error"] = $this->error;
        $info["autores"] = $this->autores;
        $info["editoriales"] = $this->editoriales;
        $info["temas"] = $this->temas;
        $info["libro"] = null;
        $info["submit"] = "/libro/registrar";
        
        $this->load->view('libro/formulario_libro', $info);
    }

    public function obtenerLibros(){
        $res = $this->libroModel->obtenerTodos();
        $info["titulo"] = "Lista de libros";
        if($res["status"]){
            $info["libros"] = $res["result"];
            $info["error"] = "";
            
        }else{
            $info["libros"] = [];
            $info["error"] = $res["mensaje"];
        }
        $this->load->view('libro/lista_libro', $info);
    }

    public function registrar(){
        $fillable = [
            "ISBN" => $this->input->post("ISBN"),
            "Titulo" => $this->input->post("Titulo"),
            "NumeroEjemplares" => $this->input->post("NumeroEjemplares"),
            "idAutor" => $this->input->post("idAutor"),
            "idEditorial" => $this->input->post("idEditorial"),
            "idTema" => $this->input->post("idTema")
        ];
        $validacion = $this->libroModel->obtenerPorISBN($fillable["ISBN"]);
        if($validacion["status"] == 1){
            $this->error="ISBN ya existe";
            $this->formulario();
        }else{
            try{
                $res = $this->libroModel->insert($fillable);
                if($res["status"]){
                    $this->obtenerLibros();
                }else{
                    $error=$res["mensaje"];
                    $this->formulario();
                }
            }catch(Exception $e){
                $error = $e->getMessage();
                $this->formulario();
            }
        }
    }

    public function correcto(){
        $info["titulo"] = "Registro correcto";
        $this->load->view('libro/correcto', $info);
    }

    public function obtieneExternos(){
        $this->autores = $this->autorModel->obtenerTodos()["result"];
        $this->editoriales =$this->editorialModel->obtenerTodos()["result"];
        $this->temas =$this->temaModel->obtenerTodos()["result"];
    }

    public function edicion($idLibro){
        $libro = $this->libroModel->obtenerPorId($idLibro)["result"];
        $this->obtieneExternos();
        $info["titulo"] = "Edicion de Libro";
        $info["error"] = $this->error;
        $info["autores"] = $this->autores;
        $info["editoriales"] = $this->editoriales;
        $info["temas"] = $this->temas;
        $info["libro"] = $libro;
        $info["submit"] = "/libro/actualizar/".$idLibro;
        $this->load->view('libro/formulario_libro', $info);
    }

    public function actualizar($idLibro){
        $fillable = [
            "ISBN" => $this->input->post("ISBN"),
            "Titulo" => $this->input->post("Titulo"),
            "NumeroEjemplares" => $this->input->post("NumeroEjemplares"),
            "idAutor" => $this->input->post("idAutor"),
            "idEditorial" => $this->input->post("idEditorial"),
            "idTema" => $this->input->post("idTema")            
        ];
        $validacion = $this->libroModel->obtenerPorISBN($fillable["ISBN"], $idLibro);
        if($validacion["status"] == 1){
            $this->error="ISBN ya existe";
            $this->edicion($idLibro);
        }else{
            try{
                $res = $this->libroModel->update($fillable, $idLibro);
                if($res["status"]){
                    $this->obtenerLibros();
                }else{
                    $error=$res["mensaje"];
                    $this->formulario();
                }
            }catch(Exception $e){
                $error = $e->getMessage();
                $this->formulario();
            }
        }
    }

    public function eliminacion($idLibro){
        print_r($array);
        $res = $this->libroModel->delete($idLibro);
        print_r($res);
        if($res["status"]){
            $this->obtenerLibros();
        }else{
            $this->error = $res["mensaje"];
            $this->obtenerLibros();
        }
    }
    
}

