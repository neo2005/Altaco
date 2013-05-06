<?php
abstract class Ebook{
	protected $metadata = array();//Metadatos del libro
	protected $chapters = array();//Array que contiene los capitulos del libro
	protected $nameChapters = array();
	protected $ebook;//Ruta del ebook del que se quiere extraer los datos
	protected $cover;//Portada del libro
	protected $path; //Nombre del libro extraido
	protected $stylePath; //Estilo del libro
	protected $imgPath;//Ruta de la imagen
	
	abstract function readMetadata();
	abstract function readChapters();
	abstract function extractCover();
	abstract function extractStyle();
}