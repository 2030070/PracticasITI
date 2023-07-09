import './plugins/chartjs.min.js';
import './plugins/Chart.extension.js';
import './plugins/perfect-scrollbar.min.js';
import './argon-dashboard-tailwind.js';
import './argon-dashboard-tailwind.min.js';

import './navbar-sticky.js';

// import './bootstrap';
// configuración de Dropzone
import Dropzone from "dropzone";

Dropzone.autoDiscover = false;
const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: "Sube tu imagen aqui",
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar archivo",
    maxFiles: 1,
    uploadMUltiple: false,
    //trabajando con imagen en el contenedor de dropzone
    init: function () {
        if (document.querySelector('[name="imagen"]').value.trim()) {
            const imagenPublicada = {};
            imagenPublicada.size = 1234
            imagenPublicada.name =
                document.querySelector('[name="imagen"]').value;
            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, '/uploads/{$imagenPublicada.name}')
            imagenPublicada.previewElement.classList.add(
                "dz-success",
                "dz-complete",
            );
        };
    }
});


// Dropzone.on('sending', function(file, xhr,formdata){
//     console.log(file)
// });

//evento de envio de correo correcto 
dropzone.on('success', function (file, response) {
    // console.log(response)
    document.querySelector('[name="imagen"]').value = response.imagen;
});

//Envio cuando hay error
dropzone.on('error', function (file, message) {
    console.log(message)
});

//remover un archivo
dropzone.on('removedfile', function () {
    // console.log('El archivo se elimino')
    document.querySelector('[name="imagen"]').value="";
});


