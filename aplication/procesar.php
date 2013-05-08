<?php
include $_SERVER["DOCUMENT_ROOT"]."/scripts/Epub.php";

if(!isset($_FILES["libroSubido"]) || !$_FILES["libroSubido"]["type"]== "application/octet-stream" || $_FILES["libroSubido"]["error"] != 0){
	header('Location: http://www.altaco.es?e=0');
}

echo "hola";