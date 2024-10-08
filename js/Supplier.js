$(document).ready(function (){
    var editFlag=false
    var funcion
searchSupplier()
    $('#form_create_supplier').submit(e=>{


        let id = $('#id_edit_supp').val()
        let name = $('#nameSupplier').val()
        let phone = $('#phoneSupplier').val()
        let email = $('#emailSupplier').val()
        let address = $('#addressSupplier').val()
    if(editFlag==true){
        funcion='edit'
    }else{
        funcion='create'
    }

        $.post('../controller/SupplierController.php',{id,name,phone,email,address,funcion}, (response)=>{
           response=response.trim()
    console.log(response)
            if(response=='add'){
                $('#add_supp').hide('slow')
                $('#add_supp').show(1000)
                $('#add_supp').hide(2000)
                $('#form_create_supplier').trigger('reset')
                searchSupplier()

            }if(response=='noadd'){
                $('#noadd_supp').hide('slow')
                $('#noadd_supp').show(1000)
                $('#noadd_supp').hide(2000)
                $('#form_create_supplier').trigger('reset')
            }
            if(response=='edit'){
                $('#editSup').hide('slow')
                $('#editSup').show(1000)
                $('#editSup').hide(2000)
                $('#form_create_supplier').trigger('reset')
                searchSupplier()

            }if(response=='noedit'){
                $('#noadd_supp').hide('slow')
                $('#noadd_supp').show(1000)
                $('#noadd_supp').hide(2000)
                $('#form_create_supplier').trigger('reset')
            }
            editFlag=false;

        })
        e.preventDefault()
    })

    function searchSupplier(queryData){

        funcion='search'
        $.post('../controller/SupplierController.php',{queryData,funcion},(response)=>{

            const suppliers = JSON.parse(response)
            let template=''

            suppliers.forEach(supplier=>{

                template+=
                    `
                <div supId="${supplier.id}"  supName="${supplier.name}" supEmail="${supplier.email}"  supPhone="${supplier.phone}"  supAddress="${supplier.address}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  <h1 class="badge badge-success">Proveedor</h1>
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>${supplier.name}</b></h2>
                   
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Direccion: ${supplier.address}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: ${supplier.phone}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-at"></i></span> Email: ${supplier.email}</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="${supplier.avatar}" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <button class="editSup btn btn-sm bg-teal" title="Editar Proveedor" type="button" data-toggle="modal" data-target="#crearProveedor">
                      <i class="fas fa-pencil-alt"></i>
                    </button>
                    <a class="deleteSup btn btn-sm btn-danger" title="Elimnar Proveedor">
                      <i class="fas fa-trash"></i> 
                    </a>
                  </div>
                </div>
              </div>
            </div>
                `
            })
            $('#suppliers').html(template)

        })
    }
    $(document).on('keyup','#searchSupplier',function (){
        let value=$(this).val()
        if(value!=''){
            searchSupplier(value)
        }else{
            searchSupplier()
        }
    })
    $(document).on('click','.editSup',(e)=>{

        const element = e.currentTarget.closest('.col-12');
        const id= $(element).attr('supId')
        const name = $(element).attr('supName')
        const address = $(element).attr('supAddress')
        const phone = $(element).attr('supPhone')
        const email = $(element).attr('supEmail')

        $('#id_edit_supp').val(id)
        $('#nameSupplier').val(name)
        $('#phoneSupplier').val(phone)
        $('#emailSupplier').val(email)
        $('#addressSupplier').val(address)
        editFlag=true

    })



    $(document).on('click','.deleteSup',(e)=>{
        funcion='delete'
        const element = e.currentTarget.closest('.col-12');
        const id= $(element).attr('supId')
        const name = $(element).attr('supName')
        console.log(name,id)


        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: "Desea eliminar "+name+"?",
            text: "No podras deshacer esta acción!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, quiero eliminarlo!",
            cancelButtonText: "No, cancelar!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('../controller/SupplierController.php',{id,funcion},(response)=>{
    console.log(response)
                    response=response.trim()
                    if(response=='deleted'){
                        swalWithBootstrapButtons.fire({
                            title: "Borrado!",
                            text: "El Proveedor "+name+" fue borrado.",
                            icon: "success"
                        });
                        searchSupplier()
                    }else{
                        swalWithBootstrapButtons.fire({
                            title: "No se pudo borrar!",
                            text: "El Proveedor "+name+" no fue borrado porque está en un Lote.",
                            icon: "success"
                        });

                    }
                })

            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelado",
                    text: "El Proveedor "+name+" está seguro :)",
                    icon: "error"
                });
            }
        });
    })

})