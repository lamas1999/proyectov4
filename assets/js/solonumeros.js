/* funcion para permitir solo numeros */
function solonumeros(e) {
    key=e.KeyCode || e.which;
    teclado=String.fromCharCode(Key);
    numeros="0123456789";
    especialaes="8-37-38-46";//arrray
    teclado_especial=false;
  
    for(var i in especiales){
        if (key==especiales[i]) {
            teclado_especial=true;
            
        }
    }
    if (numeros.indexOf(teclado)==-1 && !teclado_especial) {
        return false;
    }
  
  }