<?php 
include $_SERVER["DOCUMENT_ROOT"]."/scripts/Epub.php";

if(!isset($_FILES["libroSubido"]) || !$_FILES["libroSubido"]["type"]== "application/octet-stream" || $_FILES["libroSubido"]["error"] != 0 || !preg_match("/^.*\.epub$/" ,$_FILES["libroSubido"]["name"])){
	header('Location: http://www.altaco.es');
}

//Se debe dar el nombre del archivo en funcion del ultimo id de la base de datos, como en nuestro caso aun no esta la base de datos hecha con datos, voy a ponerle el mismo nombre
//Esto debera ser cambiado en el futuro cuando el codigo este mas avanzado

$name = $_SERVER["DOCUMENT_ROOT"]."/libros_subidos/".$_FILES["libroSubido"]["name"];

if (move_uploaded_file($_FILES["libroSubido"]["tmp_name"], $name)){
	
	try {
		$book = new Epub($name);
		$book->unpackEpub();
		$book->readMetadata();
		$book->readChapters();
		$book->extractCover();
		$book->extractStyle();
	}
	catch (Exception $e){
		header('Location: http://www.altaco.es?e=1');
	}
}

$metadata = $book->getMetadata();
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<title>Altaco</title>
	
	<link rel="stylesheet" type="text/css" href="css/ui-darkness/jquery-ui.css" />
	<link rel="stylesheet" type="text/css" href="css/altaco.css">
	
	<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
	<script src="js/jquery-ui-1.10.2.custom.min.js"></script>
	<script src="js/altaco.js"></script>

</head>

<body>

	<div id="wrapper">

		<div id="menuBar">

			<ul id="menuIzquierda">
				<li>
					<a href="/"><h1 id="tituloWeb" title="Ir a la librería">Altaco</h1></a>
				</li>
				
				<li>Subida de Libro</li>
			</ul>
			
			<a href="#"><img id="perfilUsuario" src="recursos/img/usuario.jpg" alt="imagenUsuario"></a>

			<ul id="menuDerecha">
				<li><a href="#" id="usuario">Usuario</a></li>
			</ul>

			<div class="clear"></div>

		</div>


		<!-- En caso de estar sin loguear --> 
		<div id="cajonUsuario">

				<table id="cajonLogueado">
					<tbody>

						<tr>
							<td><span class="ui-icon ui-icon-person"></span><a href="#">Perfil</a></td>
						</tr>

						<tr>
							<td><span class="ui-icon ui-icon-power"></span><a href="#">Salir</a></td>
						</tr>

					</tbody>
				</table>
		</div>



		<div id="content">

			<div id="presentacionLibro">


				<img id="portada" src="recursos/img/PortadaEjemplo.jpg">

				<div id="cajonSubida">

					<h3> Estos son los datos que hemos extraido del libro, si quieres puedes modifica algunos datos antes de subirlo.
					</h3>

					<form method="post" action="subirLibro.php">

						<table>

							<tbody>

								<tr>
									<td><label for="titulo"><h2>Titulo</h2></label></td>
								</tr>

								<tr>
									<td><input type="text" name="tituloB" id="tituloB" value="<?php echo $metadata["title"]?>"></td>
								</tr>

								<tr>
									<td><label for="autor"><h2>Autor</h2></label></td>
								</tr>

								<tr>
									<td><input type="text" name="autor" id="autorB" value="<?php echo $metadata["author"]?>"></td>
								</tr>
								
								<tr>
									<td><label for="genero"><h2>Genero</h2></label></td>
								</tr>

								<tr>
									<td><input type="text" name="genero" id="generoB" value="<?php echo $metadata["category"]?>"></td>
								</tr>
								
								<tr>
									<td><label for="capitulos"><h2>Capitulos</h2></label></td>
								</tr>

								<tr>
									<td><input type="text" name="capitulos" id="capitulos" value="<?php echo count($book->getChapters())?>" readonly="readonly"></td>
								</tr>
								

								<tr>
									<td><label for="sinopsis"><h2>Sinopsis</h2></label></td>
								</tr>

								<tr>
									<td><textarea name="sinopsis" id="sinopsis"><?php echo $metadata["description"]?></textarea></td>
								</tr>

								<tr>
									<td id="botones">
										<input type="submit" value="Confirmar" id="confirmar">
										<input type="button" value="Cancelar" id="cancelar">
									</td>
								</tr>

							</tbody>

						</table>

					</form>

				</div>

				<div class="clear"></div>

			</div>

	</div>

</body>
</html>