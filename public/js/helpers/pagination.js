
console.log("-----------------JS_PAGINATION_SUCCESS-----------------")
let NumerosPaginasCrear_Pagination=0;
function InitializarPagination(Total_registros,Registros_Mostrar,inicio_paginacion){
    NumerosPaginasCrear_Pagination=Math.ceil(Total_registros/Registros_Mostrar);
    //console.log(NumerosPaginasCrear);
    let List_paginations="";
    for (var item = 1; item <=NumerosPaginasCrear_Pagination; item++) {

          if(item==6)
            break;

          List_paginations+=`
            <li class="page-item ${item==1?'active':''}" >
            <a class="page-link pagination_a_event" href="#"
            data-numero_pagina="${item}" ${NumerosPaginasCrear_Pagination==1?'':''}>${item}</a></li>
          `;
    }
    if(NumerosPaginasCrear_Pagination>1){
      List_paginations+=`<li class="page-item"><a class="page-link pagination_a_event" href="#" data-numero_pagina="2"><i class="fas fa-chevron-right"></i></a></li>`;
    }
    $('.contenedor_users_paginations').html(List_paginations);

    if(inicio_paginacion==0)
        {inicio_paginacion=1;}

    $('#registros_informacion_text').html(`<p> Mostrando ${inicio_paginacion}  a ${Registros_Mostrar} de ${Total_registros} registros</p>`);
}



function CrearNuevaPagination(numPagina,Total_registros,Registros_Mostrar,inicio_paginacion) {
        //console.log("CrearNuevaPagination");
        $('.contenedor_users_paginations').html('');
        totalPaginas=NumerosPaginasCrear_Pagination;
        paginaActive = numPagina;

        if (paginaActive > 1) {
            $('.contenedor_users_paginations').append
            (`<li class="page-item"><a class="page-link pagination_a pagination_a_event " href="#" data-numero_pagina="${paginaActive-1}">
                <i class="fas fa-chevron-left"></i></a></li>
            `);
        }

        if (numPagina == 1 && numPagina < totalPaginas - 1 && totalPaginas >= 5) {
            for (let i = numPagina; i <= numPagina + 4; i++) {
                GenerarPagination_a(i,paginaActive)
            }
        }

        if (numPagina == 2 && numPagina < totalPaginas - 1 && totalPaginas >= 5) {
            for (let i = numPagina - 1; i <= numPagina + 3; i++) {
                GenerarPagination_a(i,paginaActive)
            }
        }

        if (numPagina >= 3 && numPagina < totalPaginas-1 && totalPaginas >= 5) {

            for (let i = numPagina - 2; i <= numPagina + 2; i++) {
                GenerarPagination_a(i,paginaActive)
            }
        }
        if (numPagina == totalPaginas - 1 && numPagina <= totalPaginas - 1 && totalPaginas >= 5) {
            for (let i = numPagina - 3; i <= numPagina + 1; i++) {
                GenerarPagination_a(i,paginaActive)
            }
        }
        if (numPagina == totalPaginas && totalPaginas >= 5) {
            for (let i = numPagina - 4; i <= numPagina; i++) {
                GenerarPagination_a(i,paginaActive)
            }
        }
        if (totalPaginas <= 5) {
            for (let i = 1; i <= totalPaginas; i++) {
                if (i == 6) {
                    break;
                }
                GenerarPagination_a(i,paginaActive)
            }
        }
        if (paginaActive < totalPaginas) {
            $('.contenedor_users_paginations').append
            (`<li class="page-item"><a class="page-link pagination_a pagination_a_event" href="#"
                 data-numero_pagina="${paginaActive+1}">
                <i class="fas fa-chevron-right"></i></a></li></a></li>
            `);
        }

        $('#registros_informacion_text').html(`<p> Mostrando ${inicio_paginacion}  a ${Registros_Mostrar} de ${Total_registros} registros</p>`);
    }

function GenerarPagination_a(item,paginaActive) {
   let List_paginations_new="";
    List_paginations_new+=`
      <li class="page-item ${paginaActive==item?'active':''}" >
      <a class="page-link pagination_a_event" href="#" data-numero_pagina="${item}">${item}</a></li>
    `;
    $('.contenedor_users_paginations').append(List_paginations_new);
}



// $(document).on('click','.pagination_a_event',function(){
//   let numero_pagina=$(this).data('numero_pagina');
//   CrearNuevaPagination(numero_pagina);
// });

// InitializarPagination(1000,100);
