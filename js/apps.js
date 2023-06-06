
$(document).ready(function() {
    console.log('Hola Gigo 0');  
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


    $(document).on( 'click', '#btn_calcular', function(){

        console.log('primer llamado \n');
  
        $.ajax({
            type: "POST",
            url: "php/get_monto_timbres.php",
            //url: "php/getmonto.php",
            dataType: "JSON",
            data: {
                id_acto: $("#actos").prop('value'),
                monto:$('#monto').val()
            },
            success: function (response) {
                //const tasks = JSON.parse(response);
                const tasks = response;
                let template = '';
                tasks.forEach(task => {

                  let monto_moneda = new Intl.NumberFormat().format(task.tarifa);
                  //let monto_moneda =task.tarifa;  
                  template += `
                    <tr taskId="${task.id}">
                        <td>${task.id}</td>
                        <td>${task.descripcion}</td>
                        <td class="number" >${monto_moneda}</td>
                    </tr>
                        `
                });
                $('#tasks').html(template);

            }
        });


    });



    $('#form_calculadora').submit(function (e) { 
        e.preventDefault();

    });


}); 



