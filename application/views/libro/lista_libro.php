<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Examen de Libros</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
	</head>
	<body>

	<div id="container">
		<div class="row">
		<h1><?php echo $titulo ?></h1>
		</div>

		<div id="semiCabecera">
			<a href="<?php echo(base_url()); ?>index.php/libro/nuevo" class="btn btn-primary">Nuevo Registro</a>
		</div>
		<div id="listadoLibros">
			<?php
			if($error !== ""){
				echo($error);
			}else{
				?>
				<table class='table'>
				<tr><th>ISBN</th><th>Titulo</th><th>NumeroEjemplares</th><th>Autor</th><th>Editorial</th><th>Tema</th><th>Acciones</th></tr>
				<?php 
					foreach($libros as $libro){
				?>
					<tr>
						<td><?php echo($libro->ISBN) ?></td>
						<td><?php echo($libro->Titulo) ?></td>
						<td><?php echo($libro->NumeroEjemplares) ?></td>
						<td><?php echo($libro->NombreAutor) ?></td>
						<td><?php echo($libro->NombreEditorial) ?></td>
						<td><?php echo($libro->NombreTema) ?></td>
						<td>
							<a href="<?php echo(base_url()).'index.php/libro/edicion/'.$libro->idLibro ?>">Editar</a>
							<button type="button" onclick="estableceData(<?php echo('\''.$libro->Titulo.'\', \''.$libro->NombreAutor.'\', \''.$libro->NombreEditorial.'\', \''.$libro->NombreTema.'\','. $libro->idLibro) ?>)" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
  								Eliminar
							</button>
						</td>
					</tr>
				<?php 
					}
				?>
				</table>
			<?php
				}
			?>
		</div>

		<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Eliminación de Libro</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<p>Usted va a eliminar el libro <span id="libro" class="acentuado"></span> del autor <span id="autor" class="acentuado"></span> publicado por <span id="editorial" class="acentuado"></span>, perteneciente a la temática de <span id="tema" class="acentuado"></span> </p>
			<p>¿Esta seguro de continuar con la eliminación?</p>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
			<a id="eliminacion" class="btn btn-primary">Eliminar</<a>
		</div>
		</div>
	</div>
	</div>
	<style>
		.acentuado{
			font-weight: bold;
		}
	</style>

	<script>
		function estableceData(titulo, autor, editorial, tema, idLibro){
			$("#libro").html(titulo);
			$("#autor").html(autor);
			$("#editorial").html(editorial);
			$("#tema").html(tema);
			$("#eliminacion").attr("href", "<?php echo(base_url()).'index.php/libro/eliminar/'?>"+idLibro);
		}
	</script>


	</body>
</html>
