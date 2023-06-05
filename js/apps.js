
$(function(){
    console.log('Hola Gigo');  
    $.ajax({
        type: "GET",
        url: "php/get_registros.php",
        success: function (response) {

            if(!response.error){

                let registros = JSON.parse(response);
                let template = '';
                registros.forEach(registro => {
                  template += `
                         <option value=${registro.id}> ${registro.value} </option>
                        ` 
                });
               // $('#combos').show();
                $('#registros').html(template);

                
                let id= $("#registros").prop('value');
                update_actos(id);


            }else{

                console.log('Dio un error la consulta!!!');
            }


        }
    });

    $('#registros').change(function (e) { 

        let id= $("#registros").prop('value');
        update_actos(id);
    });

    function update_actos(id_acto){
        $.ajax({
            type: "POST",
            data: {id_acto},
            url: "php/get_actos.php",
            success: function (response) {
                
                if(!response.error){
    
                    let registros = JSON.parse(response);
                    let template = '';
                    registros.forEach(registro => {
                      template += `
                             <option value=${registro.id}> ${registro.value} </option>
                            ` 
                    });
                   // $('#combos').show();
                    $('#actos').html(template);
    
    
                }else{
    
                    console.log('Dio un error la consulta!!!');
                }
    
    
            }
        });
    }


}); 



