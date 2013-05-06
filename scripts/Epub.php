<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/scripts/EBook.php");

class Epub extends Ebook{

	private $toc;//Tabla de contenido del libro
	private $error; //Variable que contiene errores. 0 es sin errores, 1 el directorio ya existia, 2 fallo al extraer el directorio, 3 fallo en la apertura del archivo

	function __construct($ebook){
		$this->ebook = $ebook;
		$this->error = 0;
		$name = explode("/", $this->ebook);
		$this->path = end($name);

	}//Fin constructor

	function readMetadata(){

		//Cargo la ruta donde se ecuentra el archivo opf
		$pathOpf = (string)simplexml_load_file($_SERVER["DOCUMENT_ROOT"]."/tmp/".$this->path."/META-INF/container.xml")->rootfiles->rootfile['full-path'];

		//cargo el archivo opf
		$opf = simplexml_load_file($_SERVER["DOCUMENT_ROOT"]."/tmp/".$this->path."/".$pathOpf);

		//Extraigo los metadatos
		$value = $opf->metadata->xpath('//dc:title');
		list( , $nodo) = each($value);
		$this->metadata["title"] = (string)$nodo;
			
		$value = $opf->metadata->xpath('//dc:subject');
		list( , $nodo) = each($value);
		$this->metadata["category"] = (string)$nodo;
			
		$value = $opf->metadata->xpath('//dc:creator');
		list( , $nodo) = each($value);
		$this->metadata["author"] = (string)$nodo;
			
		$value = $opf->metadata->xpath('//dc:description');
		list( , $nodo) = each($value);
		$this->metadata["description"] = (string)$nodo;
			
		$value = $opf->metadata->xpath('//dc:language');
		list( , $nodo) = each($value);
		$this->metadata["language"] = (string)$nodo;
	}

	function readChapters(){

		//Cargo la ruta donde se ecuentra el archivo opf
		$pathOpf = (string)simplexml_load_file($_SERVER["DOCUMENT_ROOT"]."/tmp/".$this->path."/META-INF/container.xml")->rootfiles->rootfile['full-path'];

		//cargo el archivo opf
		$opf = simplexml_load_file($_SERVER["DOCUMENT_ROOT"]."/tmp/".$this->path."/".$pathOpf);
			
			
		//obtengo la ruta del archivo toc
		$pathToc = (string)$opf->manifest->item[0]["href"];
			
		//Como estos archivos hacen referencia a rutas relativas obtengo el directorio desde el cual se encuentra el archivo opf para poder referenciar el archivo
		global $path;
		$path = explode("/", $pathOpf);
			
		//Cargo el archivo toc
		$this->toc = simplexml_load_file($_SERVER["DOCUMENT_ROOT"]."/tmp/".$this->path."/".$path[0]."/".$pathToc);
			
		//Recorro el archivo toc para extraer los capitulos
		
		$limit = count($this->toc->navMap->navPoint);
		for ($cont =0; $cont < $limit; $cont++){
			$this->chapters[] = $path[0]."/".(string)$this->toc->navMap->navPoint[$cont]->content['src'];
			$this->nameChapters[] = (string)$this->toc->navMap->navPoint[$cont]->navLabel->text;
			$last = $cont;
		}//Fin for

		for ($cont =0; $cont < count($this->toc->navMap->navPoint[$last]->navPoint); $cont++){
			$this->chapters[] = $path[0]."/".(string)$this->toc->navMap->navPoint[$last]->navPoint[$cont]->content['src'];
			$this->nameChapters[] = (string)$this->toc->navMap->navPoint[$last]->navPoint[$cont]->navLabel->text;
		}

	}//Fin readChapters

	/**
	 *  Funcion que dada la ruta de un archivo ebook lo descomprime en un directorio indicado. En caso de haber podido descomprimirlo devuelve true y en caso contrario devuelve false
	 * @return boolean
	 */
	function unpackEpub(){

		if (!file_exists($_SERVER["DOCUMENT_ROOT"]."/tmp/".$this->path)){
			$zip = new ZipArchive();
				
			if ($zip->open($this->ebook) === true){
				//Extraigo el libro
				if($zip->extractTo($_SERVER["DOCUMENT_ROOT"]."/tmp/".$this->path)){
					$zip->close();
					$this->error = 0;
					return true;
				}//Fin if extract to

				else {
					rmdir($_SERVER["DOCUMENT_ROOT"]."/tmp/".$this->path);
					$this->error = 2;
					return false;
				}//Fin else extract to
					
			}//Fin if open
				
			else {
				$this->error = 3;
				return false;
			}//Fin else open

		}//Fin if file exist

		else {
			$this->error = 1;
			return true;
		}//fin else file exist
	}//Fin upackEpub



	function extractCover(){
		global $path;
		
		//Guardo la portada
		$cover = (string)simplexml_load_file($_SERVER["DOCUMENT_ROOT"]."/tmp/".$this->path."/".$this->chapters[0])->body->h1->img['src'];
		
		$cover = explode("/", $cover);
		
		$this->cover = "";
		for ($cont = 1 ; $cont < count($cover); $cont++)
			$this->cover .= $cover[$cont]."/";
		
		$this->cover = substr($this->cover, 0, -1);
		
		$this->cover = $path[0]."/".$this->cover;
		
		$imgPath = explode("/", $this->cover);
		
		for($cont = 0; $cont < count($imgPath)-1; $cont++)
			$this->imgPath .= $imgPath[$cont]."/";
		
		$this->imgPath = substr($this->imgPath, 0, -1);
		
		
		unset($this->chapters[0]);
		
		$this->chapters = array_values($this->chapters);
		
	}//Fin encodeChapters
	
	function extractStyle(){
		//Variable global $path
		global $path;

		//Extraigo el style, uso la portada para evitar errores de codificacion
		$style = (string)simplexml_load_file($_SERVER["DOCUMENT_ROOT"]."/tmp/".$this->path."/".$this->chapters[0])->head->link["href"];
		
		//La separo en tokens para eliminar ../
		$style = explode("/", $style);
		
		//Compongo el resto
		$this->stylePath = "";
		for ($cont = 1 ; $cont < count($style); $cont++)
			$this->stylePath .= $style[$cont]."/";
		
		//Le añado el directorio en el que se encuentra y le quito el / que sobra
		$this->stylePath = substr($this->stylePath, 0, -1);	
		$this->stylePath = $path[0]."/".$this->stylePath;
	}


	//Metodos get
	function getToc (){return $this->toc;}
	function getMetadata(){return $this->metadata;}
	function getEbook(){return $this->ebook;}
	function getChapters(){return $this->chapters;}
	function getCover(){return $this->cover;}
	function getPath(){return $this->path;}
	function getError(){return $this->error;}
	function getImgPath(){return $this->imgPath;}
	function getStylePath(){return $this->stylePath;}
	function getNameChapters(){return $this->nameChapters;}
}