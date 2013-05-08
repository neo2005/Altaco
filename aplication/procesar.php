<?php
include $_SERVER["DOCUMENT_ROOT"]."/scripts/Epub.php";

if(!isset($_FILES["libroSubido"]) || !$_FILES["libroSubido"]["type"]== "application/octet-stream" || $_FILES["libroSubido"]["error"] != 0 || !preg_match("/^.*\.epub$/" ,$_FILES["libroSubido"]["name"])){
	header('Location: http://www.altaco.es?e=0');
}
session_start();

//Se debe dar el nombre del archivo en funcion del ultimo id de la base de datos, como en nuestro caso aun no esta la base de datos hecha con datos, voy a ponerle el mismo nombre
//Esto debera ser cambiado en el futuro cuando el codigo este mas avanzado

$name = $_SERVER["DOCUMENT_ROOT"]."/libros_subidos/".$_FILES["libroSubido"]["name"];

if (move_uploaded_file($_FILES["libroSubido"]["tmp_name"], $name)){
	

		$book = new Epub($name);
		$book->unpackEpub();
		$book->readMetadata();
		$book->readChapters();
		$book->extractCover();
		$book->extractStyle();
		$_SESSION["book"] = $book;
		header('Location: http://www.altaco.es/subida.php');


}

