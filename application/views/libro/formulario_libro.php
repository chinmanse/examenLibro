<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Examen de Libros</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	</head>
	<body>

	<div id="container">
		<div class="row">
		<h1><?php echo $titulo ?></h1>
		</div>
        <?php if($error !== ""){ ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php } ?>

		<div id="formulario" class="row">
            <form method="post" name ="libro" action="<?php echo(base_url().'index.php'.$submit); ?>" class="form">

            <label for="ISBN" class="col-sm-2 col-form-label">ISBN:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="ISBN" name="ISBN" value="<?php if($libro!= null) echo($libro[0]->ISBN) ?>" />
            </div>

            <label for="Titulo" class="col-sm-2 col-form-label">Titulo:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="Titulo" name="Titulo" value="<?php if($libro!= null) echo($libro[0]->Titulo) ?>" />
            </div>

            <label for="NumeroEjemplares" class="col-sm-2 col-form-label">Numero de ejemplares:</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="NumeroEjemplares" name="NumeroEjemplares" value="<?php if($libro!= null) echo($libro[0]->NumeroEjemplares) ?>" />
            </div>

            <label for="idAutor" class="col-sm-2 col-form-label">Autor:</label>
            <div class="col-sm-10">
                <select class="form-control" id="idAutor" name ="idAutor">
                    <?php foreach($autores as $autor){ 
                        if($libro!= null &&  $libro[0]->idAutor == $autor->idAutor){
                            ?>
                            <option value="<?php echo $autor->idAutor; ?>" selected><?php echo $autor->NombreAutor; ?></option>
                            <?php
                        }else{
                            ?>
                            <option value="<?php echo $autor->idAutor; ?>"><?php echo $autor->NombreAutor; ?></option>
                            <?php
                        }
                    } ?>
                </select>
            </div>

            <label for="idEditorial" class="col-sm-2 col-form-label">Editorial:</label>
            <div class="col-sm-10">
                <select class="form-control" id="idEditorial" name="idEditorial">
                    <?php foreach($editoriales as $editorial){ 
                        if($libro!= null &&  $libro[0]->idEditorial == $editorial->idEditorial){
                        ?>
                        <option value="<?php echo $editorial->idEditorial; ?>" selected><?php echo $editorial->NombreEditorial; ?></option>
                    <?php
                        }else{
                    ?>
                        <option value="<?php echo $editorial->idEditorial; ?>"><?php echo $editorial->NombreEditorial; ?></option>
                    <?php }
                    } ?>
                </select>
            </div>

            <label for="idTema" class="col-sm-2 col-form-label">Tema:</label>
            <div class="col-sm-10">
                <select class="form-control" id="idTema" name="idTema">
                    <?php foreach($temas as $tema){ 
                        if($libro!= null &&  $libro[0]->idTema == $tema->idTema){
                            ?>
                            <option value="<?php echo $tema->idTema; ?>" selected><?php echo $tema->NombreTema; ?></option>
                            <?php
                        }else{
                            ?>
                            <option value="<?php echo $tema->idTema; ?>"><?php echo $tema->NombreTema; ?></option>
                            <?php
                        }
                    } ?>
                </select>
            </div>
            <div class="row">
                <div class="col-8"></div>
                <div class="col-2">
                    <button type="submit" class="btn btn-primary"> Enviar</button>
                </div>
                <div class="col-2">
                    <a href="<?php echo(base_url()); ?>" class="btn btn-warning"> Cancelar</a>
                </div>
            </div>
			</form>
		</div>
		<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
	</div>

	</body>
</html>
