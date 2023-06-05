window.onload=function(){
    let cmb_registro = document.getElementById("select_registro");

    if (cmb_registro){
        cmb_registro.addEventListener('change', function(){
             alert(cmb_registro.value);
            

        });
    }
  }


