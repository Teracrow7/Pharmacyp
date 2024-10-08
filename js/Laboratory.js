$(document).ready(function (){
    searchLab()
    var funcion;
    var editFlag=false
    $('#form_createLaboratory').submit(e=>{
        let nameLab = $('#name_lab').val()
        let id_edited = $('#id_edit_lab').val()
        if(editFlag==false){
            funcion='create'
        }else{
            funcion = 'edit'
        }

        $.post('../controller/LaboratoryController.php',{nameLab,id_edited,funcion},(response)=>{

            if(response=='add'){

                $('#addLaboratory').hide('slow')
                $('#addLaboratory').show(1000)
                $('#addLaboratory').hide(2000)
                $('#form_createLaboratory').trigger('reset')
                searchLab()
            }if(response=='noadd'){
                $('#noaddLaboratory').hide('slow')
                $('#noaddLaboratory').show(1000)
                $('#noaddLaboratory').hide(2000)
                $('#form_createLaboratory').trigger('reset')
            }
            if(response=='edit'){
                $('#editLabi').hide('slow')
                $('#editLabi').show(1000)
                $('#editLabi').hide(2000)
                $('#form_createLaboratory').trigger('reset')
                searchLab()
            }
            editFlag=false
        })
        e.preventDefault()
    })


    function searchLab(queryData) {
        funcion ='search'
        $.post('../controller/LaboratoryController.php',{queryData,funcion},(response)=>{
            const laboratories = JSON.parse(response)
            let template=''

            laboratories.forEach(laboratorio => {

                template+=`
                <tr labId="${laboratorio.id}" labName="${laboratorio.name}" labAvatar="${laboratorio.avatar}">
                    <td>${laboratorio.name}</td>
                    <td><img src="${laboratorio.avatar}" class="avatar img-fluid rounded" width="70" height="70"></td>
                    <td>
                    <button class="edit btn btn-success" title="Editar Laboratorio" type="button" data-toggle="modal" data-target="#createLaboratory">
                    <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button class="delete btn btn-danger" title="Borrar Laboratorio">
                    <i class="fas fa-trash"></i>
                    </button>
                    
</td>
                </tr>    
                `;

            })
            $('#laboratories').html(template)
        })
    }

    $(document).on('keyup','#labsearch',function (){
        let value = $(this).val()
        if(value!='') {

        searchLab(value)

        }
        else{

            searchLab()
        }

    })

    $(document).on('click','.delete',(e)=>{
        funcion='delete'
        const elemento = $(this)[0].activeElement.parentElement.parentElement
        const id= $(elemento).attr('labId')
        const name = $(elemento).attr('labName')
        const avatar = $(elemento).attr('labAvatar')

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
                $.post('../controller/LaboratoryController.php',{id,funcion},(response)=>{
                    editFlag=false
                    if(response=='deleted'){
                        swalWithBootstrapButtons.fire({
                            title: "Borrado!",
                            text: "El laboratorio fue borrado.",
                            icon: "success"
                        });
                        searchLab()
                    }else{
                        swalWithBootstrapButtons.fire({
                            title: "No se pudo borrar!",
                            text: "El laboratorio no fue borrado porque está en un producto.",
                            icon: "success"
                        });

                    }
                })

            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelado",
                    text: "El laboratorio está seguro :)",
                    icon: "error"
                });
            }
        });
    })

    $(document).on('click','.edit',(e)=>{

        const element = $(this)[0].activeElement.parentElement.parentElement
        const id= $(element).attr('labId')
        const name = $(element).attr('labName')

        $('#id_edit_lab').val(id)
        $('#name_lab').val(name)
        editFlag=true;


    })

})