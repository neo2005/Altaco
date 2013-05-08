

// Al cargar el documento
$(document).ready( function() {

  // Carga botones jquery de tipo radio
  $( "#busqueda" ).buttonset();

  // Check para mostrar filtrado
  $("#filtros").button();

  // Muestra o oculta lo filtros al hacer click
  $("#filtros").on("click", function() {
    $("#subBarra").toggle( "slide", { direction: "up" } );
  });

  // Slider para el tamano de los libros
  $("#tamanosLibros").slider({
    value: 60,
    orientation: "horizontal",
    range: "min",
    animate: true
  });


  $("#subidaLibro").button();

  /* Genera el tooltip para mostrar el genero */
  $(document).tooltip({
    position: {
      my: "center bottom+50",
      at: "center bottom",
      using: function( position, feedback ) {
        $( this ).css( position );
        $( "<div>" )
          .addClass( "arrow" )
          .addClass( feedback.vertical )
          .addClass( feedback.horizontal )
          .appendTo( this );
      }
    }
  }); 






  /* AUTOCOMPLETADO */

  // Crea el boton para simular un combobox
  $(".cbButton").button();

  // Añade autocompletado a los elementos pasados
  autoCompletado("#titulo", "#titulos","#btTitulo");
  autoCompletado("#autor", "#autores","#btAutor");
  autoCompletado("#genero", "#generos","#btGenero");

  function autoCompletado(input, select, btCB) {

    // Inicializa el input con el valor seleccionad 
    $(input).val($(select +" option:selected").text());

    // Añade el autocomletado
    $(input).autocomplete({
      source: obtieneValores(select),
      minLength: 0,
      /*select: function(event, ui) {
        var opcion = $("#valor option").filter(function(index) {
          return $(this).text() == ui.item.label;
        }).val();
        //alert(opcion); // Obtiene el valor a modo de prueba
      }*/
    });

    // Al hacer clic en el input se muestran todas las opciones
    $(input).click(function() {
        $(this).autocomplete("search", "");
    });

    $(btCB).click(function() {
      $(input).autocomplete("search", "");
      $(input).focus();
    });

  }

  // Lee los valores del lo option pasado y los añade al array
  function obtieneValores(inputCB) {
    
    var valores = [];

    $(inputCB+" option").each(function(i, value) {
        valores[i] = $(value).text();
    });

    return valores;
  }

  /* Oculta los select que no se utilizan */
  $("#titulos").hide();
  $("#autores").hide();
  $("#generos").hide();
  




  /* SELECCIONAR ULTIMOS LIBROS PORTADA */

  /* Al hacer click en las opciones de ultimos libros de portada */
  $("#opciones").find("li").on("click", function() {
      
    /* En caso de ser la que tengo seleccionada 
    no se hace nada para evitar llamadas al servidor */      
    if ($(this).hasClass("seleccionado")) {
      return false;
    }

    $(".seleccionado").removeClass("seleccionado");
    $(this).addClass('seleccionado');

    // Codigo Ajax que carga los libros segun la categoría pulsada

    // Funcion para ultimos libros / novedades / mas leidos


  });


  /* DIALOGO QUE APARECE EN LA SUBIDA DE UN LIBRO */
  $("#subidaLibro").on("click", function() {
    $( "#dialogoSubida" ).dialog( "open" );
  });

  $( "#dialogoSubida" ).dialog({
    autoOpen: false,
    width: 580,
    height: 260,
    modal: true,
    closeText: false,
    hide: {
      effect: "drop",
      duration: 1000
    },
    buttons: {
      "Subir": function() {
        $( this ).dialog( "close" ); // Funcion al subir, submit al formulario
      }
    }
  });


  // Ajustar tamaño para centrar libros Portada
  var anchoVentana = $(window).width();
  console.log(anchoVentana);

  $("#contenidoPortada").width(anchoVentana-80);

  $(window).resize(function() {
     var anchoVentana = $(window).width();
    $("#contenidoPortada").width(anchoVentana-80);
  });
  

  // Ocultar o mostrar cajon usuario
  $("#usuario").click(function() {
    $("#cajonUsuario").toggle( "slide", { direction: "up" } );
    return false;
  });

  $("#perfilUsuario").click(function() {
    $("#cajonUsuario").toggle( "slide", { direction: "up" } );
    return false;
  });


  $("#cajonUsuario input[type='submit']").button();

  $("#cajonUsuario input[type='button']").button();


 

  // Genera un ebook pasandole un JSON con los datos del libro       //NO IMPLEMENTADO
  function componerEbook() {}



  /* PRESENTACION DE LIBRO */
  $("#anadir").button();
  $("#descargar").button();
  $("#eliminar").button();
  /* FIN DE PRESENTAION DE LIBRO */






  /* SUBIDA DE LIBRO */

  $("#confirmar").button();
  $("#cancelar").button();


  // Vuelve a la página anterior
  $("#cancelar").on("click", function() {
    history.back();
  });


  /* FIN DE SUBIDA DE LIBRO */



});





