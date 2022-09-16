function buscar_ahora(buscar){
    //var parametros = ("buscar":buscar);

    console.log(buscar);

    $.ajax({
      url: 'buscador.php',
    type: 'POST',
    dataType: 'html',
    data: {buscar: buscar},
    
    })
    .done(function(respuesta){
      $('#datos_buscador').html(respuesta);
    })
    .fail(function(){
    
    })
    
    }

    $(document).on('click','#buscar',function(){
        var valor = $('#codigo').val();
        if(valor!=""){
            buscar_ahora(valor);
        }else{
            buscar_ahora();
        }
        });