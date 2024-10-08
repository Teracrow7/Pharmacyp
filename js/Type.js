$(document).ready(function (){
    searchType()
    var funcion;
    var editFlag=false
    $('#form_createType').submit(e=>{
        let nameType = $('#name_Type').val()
        let id_edited = $('#id_edit_type').val()
        if(editFlag==false){
            funcion='create'
        }else{
            funcion = 'edit'
        }

        $.post('../controller/TypeController.php',{nameType,id_edited,funcion},(response)=>{
            response = response.trim();
            if(response=='add'){

                $('#addType').hide('slow')
                $('#addType').show(1000)
                $('#addType').hide(2000)
                $('#form_createType').trigger('reset')
                searchType()
            }if(response=='noadd'){

                $('#noaddType').hide('slow')
                $('#noaddType').show(1000)
                $('#noaddType').hide(2000)
                $('#form_createType').trigger('reset')
            }
            if(response=='edit'){

                $('#editTypeei').hide('slow')
                $('#editTypeei').show(1000)
                $('#editTypeei').hide(2000)
                $('#form_createType').trigger('reset')
                searchType()
            }
            editFlag=false
        })
        e.preventDefault()
    })


    function searchType(queryData) {
        funcion ='search'
        $.post('../controller/TypeController.php',{queryData,funcion},(response)=>{
            const tipos = JSON.parse(response)
            let template=''

            tipos.forEach(tipo => {

                template+=`
                <tr typId="${tipo.id}" typName="${tipo.name}" >
                    <td>${tipo.name}</td>
                   
                    <td>
                    <button class="edit_typ btn btn-success" title="Editar Tipo" type="button" data-toggle="modal" data-target="#createType">
                    <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button class="delete_typ btn btn-danger" title="Borrar Tipo">
                    <i class="fas fa-trash"></i>
                    </button>             
                    </td>
                    
                </tr>    
                `;

            })
            $('#tipos').html(template)
        })
    }

    $(document).on('keyup','#typesearch',function (){
        let value = $(this).val()
        if(value!='') {

            searchType(value)

        }
        else{

            searchType()
        }

    })

    $(document).on('click','.delete_typ',(e)=>{
        funcion='delete'
        const elemento = $(this)[0].activeElement.parentElement.parentElement
        const id= $(elemento).attr('typId')
        const name = $(elemento).attr('typName')


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
                $.post('../controller/TypeController.php',{id,funcion},(response)=>{
                    editFlag=false
                    response = response.trim();
                    if(response=='deleted'){
                        swalWithBootstrapButtons.fire({
                            title: "Borrado!",
                            text: "El Tipo fue "+name+" borrado.",
                            icon: "success"
                        });
                        searchType()
                    }else{
                        swalWithBootstrapButtons.fire({
                            title: "No se pudo borrar!",
                            text: "El Tipo "+name+" no fue borrado porque está en un producto.",
                            icon: "success"
                        });

                    }
                })

            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelado",
                    text: "El Tipo "+name+" está seguro :)",
                    icon: "error"
                });
            }
        });
    })

    $(document).on('click','.edit_typ',(e)=>{

        const element = $(this)[0].activeElement.parentElement.parentElement
        const id= $(element).attr('typId')
        const name = $(element).attr('typName')

        $('#id_edit_type').val(id)
        $('#name_Type').val(name)
        editFlag=true;


    })

})