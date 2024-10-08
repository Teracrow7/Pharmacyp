$(document).ready(function (){

    var funcion;
    var editFlag=false
    $('.select2').select2()
fillLabs();
    filltipos()
    fillPresen()
    searchProduct()
    fillSups()
    function fillSups(){
        funcion='fillSuppliers';
        $.post('../controller/SupplierController.php',{funcion},(response)=>{

            const suppliers = JSON.parse(response)
            let template=''

            suppliers.forEach(supplier=>{
                template+=`
                <option value="${supplier.id}">${supplier.name}</option>
                
                `
            })

            $('#supplier_lot').html(template)
        })

    }
    function fillLabs(){
        funcion='fillLabs';
        $.post('../controller/LaboratoryController.php',{funcion},(response)=>{

            const laboratories = JSON.parse(response)
            let template=''

            laboratories.forEach(laboratory=>{
                template+=`
                <option value="${laboratory.id}">${laboratory.name}</option>
                
                `
            })

            $('#laboratoryProduct').html(template)
        })

    }
    function filltipos(){
        funcion='filltipos';
        $.post('../controller/TypeController.php',{funcion},(response)=>{

            const tipos = JSON.parse(response)
            let template=''

            tipos.forEach(type=>{
                template+=`
                <option value="${type.id}">${type.name}</option>
                
                `
            })

            $('#typeProduct').html(template)
        })

    }
    function fillPresen(){
        funcion='fillpresen';
        $.post('../controller/PresentationController.php',{funcion},(response)=>{

            const presentaciones = JSON.parse(response)
            let template=''

            presentaciones.forEach(presen=>{
                template+=`
                <option value="${presen.id}">${presen.name}</option>
                
                `
            })

            $('#presentationProduct').html(template)
        })

    }

    $('#form_createProduct').submit(e=>{
        let id=$('#id_edit_prod').val()
        let name = $('#name_product').val()
        let concentration = $('#concentration').val()
        let extra = $('#extra').val()
        let price = $('#price').val()
        let laboratory = $('#laboratoryProduct').val()
        let type = $('#typeProduct').val()
        let  presentation= $('#presentationProduct').val()

if(editFlag==true){
    funcion ='edit'
    console.log(funcion)
}else{
    funcion ='create'
}


        $.post('../controller/ProductController.php',{funcion,id,name,concentration,extra,price,laboratory,type,presentation},(response)=>{
            response = response.trim();

            if(response=='add'){
                $('#add').hide('slow')
                $('#add').show(1000)
                $('#add').hide(2000)
                $('#form_createProduct').trigger('reset')
                searchProduct()
            }if(response=='edit'){
                $('#editProd').hide('slow')
                $('#editProd').show(1000)
                $('#editProd').hide(2000)
                $('#form_createProduct').trigger('reset')
                searchProduct()
            }if(response=='noadd'){
                $('#noadd').hide('slow')
                $('#noadd').show(1000)
                $('#noadd').hide(2000)
                $('#form_createProduct').trigger('reset')
            }if(response=='noedit'){
                $('#noadd').hide('slow')
                $('#noadd').show(1000)
                $('#noadd').hide(2000)
                $('#form_createProduct').trigger('reset')
            }
            editFlag=false;


        })

        e.preventDefault()

    })


    function searchProduct(queryData){
        funcion = 'search'
        $.post('../controller/ProductController.php',{queryData,funcion},(response)=>{

            const products = JSON.parse(response)
            let template=''
            products.forEach(product=> {
            template+=`<div prodId="${product.id}"  prodName="${product.name}" prodPrice="${product.price}" prodConcentration="${product.concentration}"
            prodExtra="${product.extra}" prodLaboratory="${product.id_laboratory}" prodType="${product.id_type}" prodPresentation="${product.id_presentation}" prodAvatar="${product.avatar}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                <i class="fas fa-lg fa-cubes mr-1"></i>
                  ${product.stock}
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>${product.name}</b></h2>
                     <h4 class="lead"><b><i class="fas fa-lg fa-dollar-sign mr-1"></i>${product.price}</b></h4>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span> Concentracion: ${product.concentration}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-prescription-bottle-alt"></i></span> Extra: ${product.extra}</li>
                         <li class="small"><span class="fa-li"><i class="fas fa-lg fa-flask"></i></span> Laboratorio: ${product.laboratory}</li>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-copyright"></i></span> Tipo: ${product.type}</li>
                           <li class="small"><span class="fa-li"><i class="fas fa-lg fa-pills"></i></span> Presentacion: ${product.presentation}</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="${product.avatar}" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
               
                    <button class="edit btn btn-sm btn-dark" data-toggle="modal" data-target="#crearProducto">
                      <i class="fas fa-pencil-alt"></i> 
                    </button>
                     <button class="lot btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#crearLote">
                      <i class="fas fa-plus-square"></i> 
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
            $('#products').html(template)


        })
    }

    $(document).on('keyup','#searchProduct',function(){
        let value = $(this).val()
        if(value!=""){
            searchProduct(value)
        }else{
            searchProduct()
        }
    })
    $(document).on('click','.lot',(e)=>{

        const element =$(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement
        const id=$(element).attr('prodId')
        const name=$(element).attr('prodName')



        $('#id_lot_prod').val(id)
        $('#nameProductLot').html(name)


    })
    $(document).on('click','.edit',(e)=>{

        const element =$(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement
        const id=$(element).attr('prodId')
        const name=$(element).attr('prodName')
        const concentration = $(element).attr('prodConcentration')
        const extra=$(element).attr('prodExtra')
        const price = $(element).attr('prodPrice')
        const laboratory=$(element).attr('prodLaboratory')
        const type = $(element).attr('prodType')
        const presentation = $(element).attr('prodPresentation')


        $('#id_edit_prod').val(id)
        $('#name_product').val(name)
        $('#concentration').val(concentration)
        $('#extra').val(extra)
        $('#price').val(price)
        $('#laboratoryProduct').val(laboratory).trigger('change')
        $('#typeProduct').val(type).trigger('change')
        $('#presentationProduct').val(presentation).trigger('change')
    editFlag=true
    })
    $(document).on('click','.delete',(e)=>{
        funcion='delete'
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement
        const id= $(elemento).attr('prodId')
        const name = $(elemento).attr('prodName')
        const avatar = $(elemento).attr('prodAvatar')

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
                $.post('../controller/ProductController.php',{id,funcion},(response)=>{
                    editFlag=false
                    if(response=='deleted'){
                        swalWithBootstrapButtons.fire({
                            title: "Borrado!",
                            text: "El Producto "+name+" fue borrado.",
                            icon: "success"
                        });
                        searchProduct()
                    }else{
                        swalWithBootstrapButtons.fire({
                            title: "No se pudo borrar!",
                            text: "El producto "+name+" no fue borrado porque está en un Lote.",
                            icon: "success"
                        });

                    }
                })

            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelado",
                    text: "El Producto "+name+" está seguro :)",
                    icon: "error"
                });
            }
        });
    })

$('#form_createLot').submit(e=>{

    let id_product=$('#id_lot_prod').val()
    let supplier=$('#supplier_lot').val()
    let stock=$('#stock').val()
    let expiration=$('#expiration').val()

    funcion='create'

    $.post('../controller/LotController.php',{funcion,id_product,supplier,stock,expiration},(response)=>{

        $('#addLot').hide('slow')
        $('#addLot').show(1000)
        $('#addLot').hide(2000)
        $('#form_createLot').trigger('reset')
    searchProduct()
    })
    e.preventDefault()
})



})