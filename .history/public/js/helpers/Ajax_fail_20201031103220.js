function ajax_fails(jqXHRStatus,textStatus,jqXHRStatusResponseText){
        /*object jqXHR: es un objeto jqXHR que contiene todos los datos de la solicitud Ajax realizada,
         incluyendo la propiedad jqXHR.status que contiene,
         entre otros posibles, el código de estado HTTP de la respuesta. */

         console.log(message)
        if (jqXHRStatus === 0) {
            alert('Not connect: Verify Network.');
          } else if (jqXHRStatus == 404) {
            alert('Requested page not found [404]');
          } else if (jqXHRStatus == 500) {
            alert('Internal Server Error [500].');
          } else if (textStatus === 'parsererror') {
            alert('Requested JSON parse failed.');
          } else if (textStatus === 'timeout') {
            alert('Time out error.');
          } else if (textStatus === 'abort') {
            alert('Ajax request aborted.');
          } else {
            alert('Uncaught Error: ' + jqXHRStatusResponseText);
          }
}


/*
.fail(function(jqXHR,textStatus) {
             ajax_fails(jqXHR.status,textStatus,jqXHRStatus.responseText);
});
*/

