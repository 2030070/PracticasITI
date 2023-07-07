// Importar la librería Dropzone
import Dropzone from 'dropzone';

// Deshabilitar la autoconfiguración de Dropzone
Dropzone.autoDiscover = false;

// Configuración del dropzone para archivos PDF
const dropzonePDF = new Dropzone('#dropzonePDF', {
  dictDefaultMessage: 'Sube tu factura en PDF aquí', // Mensaje por defecto del dropzone
  acceptedFiles: '.pdf', // Tipos de archivo aceptados (solo PDF)
  addRemoveLinks: true, // Mostrar enlaces para eliminar los archivos
  dictRemoveFile: 'Borrar Archivo', // Texto para el enlace de eliminación
  maxFiles: 1, // Número máximo de archivos permitidos
  uploadMultiple: false, // No permitir subir múltiples archivos a la vez

  init: function () {
    // Inicialización del dropzone para archivos PDF

    // Verificar si ya hay un archivo seleccionado y cargarlo en el dropzone
    if (document.querySelector('[name="pdf_file"]').value.trim()) {
      const pdfPublicada = {};
      pdfPublicada.size = 1234;
      pdfPublicada.name = document.querySelector('[name="pdf_file"]').value;
      this.options.addedfile.call(this, pdfPublicada);
      // Mostrar la miniatura del archivo cargado en el dropzone
      this.options.thumbnail.call(this, pdfPublicada, `/uploads/${pdfPublicada.name}`);
      pdfPublicada.previewElement.classList.add('dz-success', 'dz-complete');
    }
  }
});

// Configuración del dropzone para archivos XML
const dropzoneXML = new Dropzone('#dropzoneXML', {
  dictDefaultMessage: 'Sube tu factura en XML aquí', // Mensaje por defecto del dropzone
  acceptedFiles: '.xml', // Tipos de archivo aceptados (solo XML)
  addRemoveLinks: true, // Mostrar enlaces para eliminar los archivos
  dictRemoveFile: 'Borrar Archivo', // Texto para el enlace de eliminación
  maxFiles: 1, // Número máximo de archivos permitidos
  uploadMultiple: false, // No permitir subir múltiples archivos a la vez

  init: function () {
    // Inicialización del dropzone para archivos XML

    // Verificar si ya hay un archivo seleccionado y cargarlo en el dropzone
    if (document.querySelector('[name="xml_file"]').value.trim()) {
      const xmlPublicada = {};
      xmlPublicada.size = 1234;
      xmlPublicada.name = document.querySelector('[name="xml_file"]').value;
      this.options.addedfile.call(this, xmlPublicada);
      // Mostrar la miniatura del archivo cargado en el dropzone
      this.options.thumbnail.call(this, xmlPublicada, `/uploads/${xmlPublicada.name}`);
      xmlPublicada.previewElement.classList.add('dz-success', 'dz-complete');
    }
  }
});

// Evento 'success' del dropzone para archivos PDF
dropzonePDF.on('success', function (file, response) {
  // Cuando se ha subido exitosamente un archivo PDF

  console.log(response); // Imprimir la respuesta del servidor en la consola
  document.querySelector('[name="pdf_file"]').value = response.pdf; // Actualizar dinámicamente el valor de un campo de entrada con la respuesta del servidor
});

// Evento 'removedfile' del dropzone para archivos PDF
dropzonePDF.on('removedfile', function () {
  // Cuando se ha eliminado un archivo PDF del dropzone

  document.querySelector('[name="pdf_file"]').value = ''; // Resetear el valor del campo de entrada
});

// Evento 'success' del dropzone para archivos XML
dropzoneXML.on('success', function (file, response) {
  // Cuando se ha subido exitosamente un archivo XML

  console.log(response); // Imprimir la respuesta del servidor en la consola
  document.querySelector('[name="xml_file"]').value = response.xml; // Actualizar dinámicamente el valor de un campo de entrada con la respuesta del servidor
});

// Evento 'removedfile' del dropzone para archivos XML
dropzoneXML.on('removedfile', function () {
  // Cuando se ha eliminado un archivo XML del dropzone

  document.querySelector('[name="xml_file"]').value = ''; // Resetear el valor del campo de entrada
});
