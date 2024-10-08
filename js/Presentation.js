$(document).ready(function (){
    searchPre()
    var funcion;
    var editFlag=false
    $('#form_createPresentation').submit(e=>{
        let namePre = $('#name_Presentation').val()
        let id_edited = $('#id_edit_pre').val()
        if(editFlag==false){
            funcion='create'
        }else{
            funcion = 'edit'
        }

        $.post('../controller/PresentationController.php',{namePre,id_edited,funcion},(response)=>{
            response = response.trim();
            if(response=='add'){

                $('#addPre').hide('slow')
                $('#addPre').show(1000)
                $('#addPre').hide(2000)
                $('#form_createPresentation').trigger('reset')
                searchPre()
            }if(response=='noadd'){

                $('#noaddPre').hide('slow')
                $('#noaddPre').show(1000)
                $('#noaddPre').hide(2000)
                $('#form_createPresentation').trigger('reset')
            }
            if(response=='edit'){

                $('#editPre').hide('slow')
                $('#editPre').show(1000)
                $('#editPre').hide(2000)
                $('#form_createPresentation').trigger('reset')
                searchPre()
            }
            editFlag=false
        })
        e.preventDefault()
    })


    function searchPre(queryData) {
        funcion ='search'
        $.post('../controller/PresentationController.php',{queryData,funcion},(response)=>{
            console.log(response)
            const presentaciones = JSON.parse(response)
            let template=''

            presentaciones.forEach(presentation => {

                template+=`
                <tr preId="${presentation.id}" preName="${presentation.name}" >
                    <td>${presentation.name}</td>
                   
                    <td>
                    <button class="edit_pre btn btn-success" title="Editar Presentacion" type="button" data-toggle="modal" data-target="#createPresentation">
                    <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button class="delete_pre btn btn-danger" title="Borrar Presentacion">
                    <i class="fas fa-trash"></i>
                    </button>             
                    </td>
                    
                </tr>    
                `;

            })
            $('#presentaciones').html(template)
        })
    }

    $(document).on('keyup','#presensearch',function (){
        let value = $(this).val()
        if(value!='') {

            searchPre(value)

        }
        else{

            searchPre()
        }

    })

    $(document).on('click','.delete_pre',(e)=>{
        funcion='delete'
        const elemento = $(this)[0].activeElement.parentElement.parentElement
        const id= $(elemento).attr('preId')
        const name = $(elemento).attr('preName')


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
                $.post('../controller/PresentationController.php',{id,funcion},(response)=>{
                    editFlag=false
                    response = response.trim();
                    if(response=='deleted'){
                        swalWithBootstrapButtons.fire({
                            title: "Borrado!",
                            text: "La Presentacion fue "+name+" borrado.",
                            icon: "success"
                        });
                        searchPre()
                    }else{
                        swalWithBootstrapButtons.fire({
                            title: "No se pudo borrar!",
                            text: "La Presentacion "+name+" no fue borrado porque está en un producto.",
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

    $(document).on('click','.edit_pre',(e)=>{

        const element = $(this)[0].activeElement.parentElement.parentElement
        const id= $(element).attr('preId')
        const name = $(element).attr('preName')

        $('#id_edit_pre').val(id)
        $('#name_Presentation').val(name)
        editFlag=true;


    })

})