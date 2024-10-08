$(document).ready(function (){

    var funcion;

    searchLot()








    function searchLot(queryData){
        funcion = 'search'
        $.post('../controller/LotController.php',{queryData,funcion},(response)=>{


            const lots = JSON.parse(response)
            let template=''
            lots.forEach(lot=> {
                template+=`<div lotId="${lot.id}" lotStock="${lot.stock}"  class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column"> `

                if(lot.state=='light'){
                    template+=  `<div class="card bg-light d-flex flex-fill">`
                }if(lot.state=='warning'){
                    template+=  `<div class="card bg-warning d-flex flex-fill">`
                }if(lot.state=='danger'){
                    template+=  `<div class="card bg-danger d-flex flex-fill">`
                }


                template+=   `<div class="card-header border-bottom-0">
                <h6>Codigo ${lot.id}</h6>
                <i class="fas fa-lg fa-cubes mr-1"></i>
                  ${lot.stock}
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>${lot.name}</b></h2>
                  
                  
                  
                  
                      <ul class="ml-4 mb-0 fa-ul ">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span> Concentracion: ${lot.concentration}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-prescription-bottle-alt"></i></span> Extra: ${lot.extra}</li>
                         <li class="small"><span class="fa-li"><i class="fas fa-lg fa-flask"></i></span> Laboratorio: ${lot.laboratory}</li>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-copyright"></i></span> Tipo: ${lot.type}</li>
                           <li class="small"><span class="fa-li"><i class="fas fa-lg fa-pills"></i></span> Presentacion: ${lot.presentation}</li>
                           <li class="small"><span class="fa-li"><i class="fas fa-lg fa-calendar"></i></span> Vencimiento: ${lot.expiration}</li>
                           <li class="small"><span class="fa-li"><i class="fas fa-lg fa-truck"></i></span> Proveedor: ${lot.supplier}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-calendar-alt"></i></span> Mes: ${lot.months}</li>
                             <li class="small"><span class="fa-li"><i class="fas fa-lg fa-calendar-day"></i></span> Dia: ${lot.days}</li>
                              
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="${lot.avatar}" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
               
                    <button class="edit btn btn-sm btn-dark" data-toggle="modal" data-target="#editLot">
                      <i class="fas fa-pencil-alt"></i> 
                    </button>
             
                     <button class="delete btn btn-sm btn-danger">
                      <i class="fas fa-trash"></i> 
                    </button>
                  </div>
                </div>
              </div>
            </div>
            `

            })
            $('#lots').html(template)


        })
    }

    $(document).on('keyup','#searchLot',function(){
        let value = $(this).val()
        if(value!=""){
            searchLot(value)
        }else{
            searchLot()
        }
    })

    $(document).on('click','.edit',(e)=>{

        const element =$(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement
        const id=$(element).attr('lotId')
        const stock=$(element).attr('lotStock')



        $('#id_lot_prod').val(id)
        $('#stock').val(stock)
        $('#id_lote').html(id)



    })

    $('#form_editLot').submit(e=>{
        let id=$('#id_lot_prod').val()
        let stock = $('#stock').val()
        funcion = 'edit'
        $.post('../controller/LotController.php',{id,stock,funcion},(response)=>{
            if(response=='edited'){
                $('#editLote').hide('slow')
                $('#editLote').show(1000)
                $('#editLote').hide(2000)
                $('#form_editLot').trigger('reset')
                searchLot()

            }
        })
        e.preventDefault()

    })
    $(document).on('click','.delete',(e)=>{
        funcion='delete'
        const element = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement
        const id=$(element).attr('lotId')


        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: "Desea eliminar Lote: "+id+"?",
            text: "No podras deshacer esta acción!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, quiero eliminarlo!",
            cancelButtonText: "No, cancelar!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('../controller/LotController.php',{id,funcion},(response)=>{

                    if(response=='deleted'){
                        swalWithBootstrapButtons.fire({
                            title: "Borrado!",
                            text: "El Lote "+id+" fue borrado.",
                            icon: "success"
                        });
                        searchLot()
                    }else{
                        swalWithBootstrapButtons.fire({
                            title: "No se pudo borrar!",
                            text: "El Lote "+id+" no fue borrado porque está esiendo usado.",
                            icon: "success"
                        });

                    }
                })

            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelado",
                    text: "El Lote "+id+" está seguro :)",
                    icon: "error"
                });
            }
        });
    })


})