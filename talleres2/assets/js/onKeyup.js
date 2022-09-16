
  document.getElementById('consultar').disabled = true;

$('input[name=codigo]').on('keyup',()=>{

     var campo_codigo = $('.entrada_texto').val();



     if(campo_codigo >10){
        document.getElementById('consultar').disabled = false;
     }
});
