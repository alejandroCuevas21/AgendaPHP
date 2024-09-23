
const validarFormulario = () => {
    let MsjAtencion ="";
    
    if (document.getElementById("txtNombre").value == "") {
        MsjAtencion += "- Favor de ingresar nombre </br>";
    } 
    
    if (document.getElementById("txtDomicilio").value == ""  ){
        MsjAtencion += "- Favor de ingresar domicilio </br>";
    }
    
    if(document.getElementById("txtNumero").value == ""){
        MsjAtencion += "- Favor de ingresar numero domicilio </br>";
    }
    
    if(document.getElementById("txtColonia").value == ""){
        MsjAtencion += "- Favor de ingresar colonia </br>"
    }
    
    if(document.getElementById("txtNumero").value == ""){
        MsjAtencion += "- Favor de ingresar numero </br>";
    }
    
    if(document.getElementById("txtColonia").value == ""){
        MsjAtencion += "-Favor de ingresar colonia </br>";
    }
    
    if(document.getElementById("txtCP").value == ""){
        MsjAtencion += "-Favor de ingresar codigo postal </br>";
    }
    if(document.getElementById("txtCiudad").value == ""){
        MsjAtencion += "-Favor de ingresar ciudad </br>";
    }
    if(document.getElementById("txtEstado").value == ""){
        MsjAtencion += "-Favor de ingresar estado </br>" ;
    }
 //   if(document.getElementById("txtTelefono").length  < 10){
     if(document.getElementById("txtTelefono").value.length < 10){
        MsjAtencion += "-Favor de ingresar un telefono valido </br>";
    }
    if(!validarCorreoElectronico()){
        MsjAtencion += "-Favor de ingresar correo valido</br>";
    }
    if (MsjAtencion != ""){
        Swal.fire({
            title: "Atención",
            html: MsjAtencion,
            icon: 'warning'
        });
       

    }else {
           const ObjDomicilio = {
            Domicilio: document.getElementById("txtDomicilio").value,
            Numero: document.getElementById("txtNumero").value,
            Colonia: document.getElementById("txtColonia").value,
            Cp: document.getElementById("txtCP").value,
            Ciudad: document.getElementById("txtCiudad").value,
            Estado: document.getElementById("txtEstado").value,
           } 

        CargarDatosGps(ObjDomicilio);
    }
    
    }

    const CargarDatosGps = (objDomicilio) => {
        const { Domicilio, Numero, Colonia, Cp, Ciudad, Estado } = objDomicilio;
    
        const DomicilioCompleto = `${Domicilio}, ${Numero} ,${Colonia} ,${Cp} ,${Ciudad}, ${Estado}`;
        const requestOptions = {
            method: 'GET', // Cambia a GET
            headers: {
                'Content-Type': 'application/json'
            }
        };
        Swal.fire({
            title: 'Cargando',
            html: '<div class="spinner-border" role="status"><span class="sr-only">Cargando...</span></div>',
            allowOutsideClick: false,
            showCancelButton: false,
            showConfirmButton: false,
            allowEscapeKey: false
        });
        // Asegúrate de que el DomicilioCompleto esté correctamente codificado
        const url = `https://nominatim.openstreetmap.org/search?format=json&limit=1&q=${encodeURIComponent(DomicilioCompleto)}`;
    //   const url = "hts:/nominatim.openstreetmap.org/search?format=json&limit=10&q=Los Sauces 16009, Mazatlan, Sinaloa, Mexico";
        // Realiza la solicitud GET
        fetch(url, requestOptions)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                Swal.close();
                if (data.length == 0){
                   
                    Swal.fire("Atencion", "Domicilio invalido no existente en la configuracion","warning" );
                }else{
                 
                const { lat, lon} = data[0];

                document.getElementById("txtLatitud").value = lat;
                document.getElementById("txtLongitud").value = lon;
                }
               //  console.log(data);
            
            })
            .catch(error => {
                Swal.close();
                Swal.fire('Error', 'Ocurrió un error al consultar: ' + error, 'error');
            });
    };


    const GuardarContacto = (Accion, id=null) => {
            if (document.getElementById("txtLatitud").value == "" && document.getElementById("txtLongitud").value == "" ){
                Swal.fire("Atencion", "Favor de validar la ubicacion", "warning");
            }else{ 

            const objAgenda = {
                Nombre: document.getElementById('txtNombre').value,
                Domicilio: document.getElementById('txtDomicilio').value,
                Numero: parseInt(document.getElementById('txtNumero').value),
                Colonia: document.getElementById('txtColonia').value,
                CP: document.getElementById('txtCP').value,
                Ciudad: document.getElementById('txtCiudad').value,
                Estado: document.getElementById('txtEstado').value,
                Telefono: document.getElementById('txtTelefono').value,
                Correo: document.getElementById('txtCorreo').value,
                Latitud: parseFloat(document.getElementById('txtLatitud').value),
                Longitud: parseFloat(document.getElementById('txtLongitud').value),
            };
       
            
            let url;
            let metodo;

            if(Accion == 'Actualizar'){
                url =`/agendas/ActualizarAgenda/${id}`;
                metodo ='PUT';
            }else{
                url= `/agendas/InsertarAgenda`;
                metodo='POST';
            }

            Swal.fire({
                title: 'Cargando',
                html: '<div class="spinner-border" role="status"><span class="sr-only">Cargando...</span></div>',
                allowOutsideClick: false,
                showCancelButton: false,
                showConfirmButton: false,
                allowEscapeKey: false
            });
            const requestOptions = {
                method: metodo,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.getElementById("token").value,
 
                },
                body: JSON.stringify(objAgenda)
            };
          
            fetch(url, requestOptions)
            .then(response => {
                if (!response.ok) {
                    return response.text().then(text => { throw new Error(text); });
                }
                return response.json();
            })
            .then(data => {
                Swal.close();
                Swal.fire({
                    title: "Exito",
                    text: data.Mensaje,
                    icon: "success",
                    closeOnClickOutside: false,
                    closeOnEsc: false,
                    button: "Aceptar"
                }).then(function (isConfirm) {
                    if (Accion == 'Actualizar'){
                        location.href= '/ConsultaAgenda';
                    }else{
                        location.reload();
                    }
                });
            })
            .catch(error => {
                Swal.close();
                Swal.fire('Error', 'Ocurrió un error al guardar la licitación: ' + error, 'error');
            });
        
        };
    }


const validarCorreoElectronico = () => {
    let retorno = true;
    const email = document.getElementById("txtCorreo").value;
    
    // Simple regex for email validation
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    
    // Check if the email format is valid
    if (!emailPattern.test(email)) {
        retorno = false;
    }

    return retorno;
}
