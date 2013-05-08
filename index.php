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
				
				<li id="contFiltros">
                    <input type="checkbox" id="filtros" /><label for="filtros">Filtros</label>
				</li>

				<li>
					<div id="busqueda">
					  <input type="checkbox" id="publicos" /><label for="publicos">Publicos</label>
					  <input type="checkbox" id="libreria" /><label for="libreria">Libreria</label>
					  <input type="checkbox" id="propios" /><label for="propios">Propios</label>
					</div>
				</li>
			</ul>
			
			<a href="#"><img id="perfilUsuario" src="recursos/img/usuario.jpg" alt="imagenUsuario"></a>

			<ul id="menuDerecha">
				<li><div id="tamanosLibros"></div></li>
				<li title="Sube un libro" id="subidaLibro">Subir</li>
				<li><a href="#" id="usuario">Usuario</a></li>
			</ul>

			<div class="clear"></div>

		</div>

		<div id="subBarra">

			<ul id="conSubBarra">

				<li>
					<label for="titulo">Titulo </label>
                    <input type="text" id="titulo" class="cbText ui-widget-content ui-corner-left" size="30" />
                    <button id="btTitulo" type="button" class="cbButton">&#x25BC;</button>
                                    
                    <select id="titulos">
                        <option value="todos" selected>Todos</option>
                        <option value="Los Caminantes">Los Caminantes</option>
                        <option value="Hades Nebula">Hades Nebula</option>
                    </select>
            	</li>

            	<li>
					<label for="autor">Autores </label>
                    <input type="text" id="autor" class="cbText ui-widget-content ui-corner-left" size="30" />
                    <button id="btAutor" type="button" class="cbButton">&#x25BC;</button>
                                    
                    <select id="autores">
                        <option value="todos" selected>Todos</option>
                        <option value="Carlos Sisí">Carlos Sisí</option>
                        
                    </select>
            	</li>

				<li>
					<label for="genero">Genero </label>
                    <input type="text" id="genero" class="cbText ui-widget-content ui-corner-left"size="10" />
                    <button id="btGenero" type="button" class="cbButton">&#x25BC;</button>
                                    
                    <select id="generos">
                        <option value="todos" selected>Todos</option>
                        <option value="Horror">Horror</option>
                        <option value="Zombie">Zombie</option>
                    </select>
            	</li>

            	<li>
            		<input type="submit" value="Buscar" id="btBuscar" name="btBuscar">
            	</li>
            	
			</ul>

		</div>

		<!-- En caso de estar sin loguear--> 
		<div id="cajonUsuario">

			<form method="post" action="acceso.php">
				<table>
					<tbody>
						<tr>
							<th colspan="2"><label for="usu">Usuario</label></th>
						</tr>
						<tr>
							<td colspan="2"><input type="text" name="usu" id="usu"></td>
						</tr>

						<tr>
							<th colspan="2"><label for="pass">Contraseña</label></th>
						</tr>
						<tr>
							<td colspan="2"><input type="password" name="pass" id="pass"></td>
						</tr>

						<!--<tr>
							<td><input type="checkbox" name="recordar" id="recordar"></td>
							<th><label for="recordar">Recordar Datos</label></th>
						</tr>-->

						<tr>
							<td><input type="submit" value="Acceder"></td>
							<td><input type="button" value="Registrar"></td>
						</tr>

					</tbody>
				</table>
			</form>


		</div>


		<!-- En caso de estar sin loguear --> 
		<!--<div id="cajonUsuario">

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
		</div>-->



		<div id="content">

			<div id="contenidoPortada">

				<div id="librosPortada">


				<div class="libro">
					<a href="#"><img src="recursos/img/PortadaEjemplo.jpg" title="Horror" alt="portada"></a>
					<div>
						<a href="#">Los Caminantes</a><br/>
						<a href="#">Carlos Sisí</a>
					</div>
				</div>

				<div class="libro">
					<a href="#"><img src="recursos/img/PortadaEjemplo2.jpg"  title="Zombie" alt="portada2"></a>
					<div>
						<a href="#">Hades Nebula</a><br/>
						<a href="#">Carlos Sisí</a>
					</div>
				</div>

				<div class="libro">
					<a href="#"><img src="recursos/img/PortadaEjemplo2.jpg"  title="Zombie" alt="portada2"></a>
					<div>
						<a href="#">Hades Nebula</a><br/>
						<a href="#">Carlos Sisí</a>
					</div>
				</div>

				<ul id="opciones">
					
					<li class="seleccionado">Novedades</li>
					<li>Mas Leidos</li>
					<li>Mas Votados</li>
					<li>Proximamente</li>
				</ul>

				<div class="clear"></div>

				<div id="separador"></div>

				</div>

				

				<div class="libro">
					<a href="#"><img src="recursos/img/PortadaEjemplo.jpg" title="Horror" alt="portada"></a>
					<div>
						<a href="#">Los Caminantes</a><br/>
						<a href="#">Carlos Sisí</a>
					</div>
				</div>

				<div class="libro">
					<a href="#"><img src="recursos/img/PortadaEjemplo2.jpg"  title="Zombie" alt="portada2"></a>
					<div>
						<a href="#">Hades Nebula</a><br/>
						<a href="#">Carlos Sisí</a>
					</div>
				</div>

				<div class="libro">
					<a href="#"><img src="recursos/img/PortadaEjemplo2.jpg"  title="Zombie" alt="portada2"></a>
					<div>
						<a href="#">Hades Nebula</a><br/>
						<a href="#">Carlos Sisí</a>
					</div>
				</div>

				<div class="libro">
					<a href="#"><img src="recursos/img/PortadaEjemplo2.jpg"  title="Zombie" alt="portada2"></a>
					<div>
						<a href="#">Hades Nebula</a><br/>
						<a href="#">Carlos Sisí</a>
					</div>
				</div>

				<div class="libro">
					<a href="#"><img src="recursos/img/PortadaEjemplo2.jpg"  title="Zombie" alt="portada2"></a>
					<div>
						<a href="#">Hades Nebula</a><br/>
						<a href="#">Carlos Sisí</a>
					</div>
				</div>

				<div class="libro">
					<a href="#"><img src="recursos/img/PortadaEjemplo2.jpg"  title="Zombie" alt="portada2"></a>
					<div>
						<a href="#">Hades Nebula</a><br/>
						<a href="#">Carlos Sisí</a>
					</div>
				</div>

				<div class="clear"></div>

				<div id="separador"></div>

				<h1 id="numLibros">Se han encontrado 6 libros</h1>

				<div id="dialogoSubida" title="Subida de libro">
					<form action="subida.php" id="formSubida" method="post" enctype="multipart/form-data">
				  		<p>No nos hacemos reponsables de las subidas que realizan nuestros usuarios, el que lo sube lo paga.</p>
				  		<input type="file" name="libroSubido" id="libroSubido">
				  		<input type="submit" value="Enviar" id="enviar">
				  	</form>
				</div>

			</div>

		</div>

		<div id="cargando"></div>

	</div>


</body>


</html>