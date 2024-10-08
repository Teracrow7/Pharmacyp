$(document).ready(function (){

    var type_user = $('#type_user_hidden').val()
    if(type_user==2){

        $('#button_create').hide()
    }


    $(document).on('keyup','#search',function (){

        searchUsersData();
        var funcion;
        function searchUsersData(queryData) {
            funcion = 'search_userData'

            $.post('../controller/UserController.php',{queryData,funcion},(response)=>{

               const users = JSON.parse(response)

                let template =''

                users.forEach(user=>{
                    template+=`<div userID="${user.id}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">`;
                 if(user.typee==3){
                     template+=`<h1 class="badge badge-danger">${user.type}</h1>`;
                 }
                    if(user.typee==2){
                        template+=`<h1 class="badge badge-warning">${user.type}</h1>`;
                    }
                    if(user.typee==1){
                        template+=`<h1 class="badge badge-info">${user.type}</h1>`;
                    }
                    template+=`
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>${user.name} ${user.lastname}</b></h2>
                      <p class="text-muted text-sm"><b>Sobre mi: </b> ${user.extra_info} </p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                       <li class="small"><span class="fa-li"><i class="fas fa-lg fa-at"></i></span> Email: ${user.email}</li>
                       <li class="small"><span class="fa-li"><i class="fas fa-lg fa-birthday-cake"></i></span> Edad #: ${user.age}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Direccion: ${user.address}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Telefono #: ${user.phone}</li>
                  
                        
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="../img/CoolIcon.png" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">`;
                    if(type_user==3){
                        if(user.typee!=3){
                            template+=`<button class="delete_user btn btn-danger mr-1" type="button" data-toggle="modal" data-target="#confirm">
                   <i class="fas fa-window-close mr-1"></i>Eliminar
                    </button>`;
                        }
                        if(user.typee==2){
                            template+=`<button class="ascender btn btn-primary ml-1" type="button" data-toggle="modal" data-target="#confirm"> 
                   <i class="fas fa-sort-amount-up mr-1"></i>Ascender
                    </button>`;
                        }
                        if(user.typee==1){
                            template+=`<button class="descender btn btn-secondary ml-1" type="button" data-toggle="modal" data-target="#confirm">
                   <i class="fas fa-sort-amount-desc mr-1"></i>Descender
                    </button>`;
                        }


                    }else{
                        if(type_user==1 && user.typee!=1 && user.typee!=3){
                            template+=`<button class="delete_user btn btn-danger mr-1" type="button" data-toggle="modal" data-target="#confirm">
                   <i class="fas fa-window-close mr-1"></i>Eliminar
                    </button>`;
                        }
                    }

                    template+=`
                  </div>
                </div>
              </div>
            </div>
                    `;
                })
                $('#users').html(template)
            })

        }

        let value = $(this).val();
        if(value!==""){

            searchUsersData(value)

            //console.log(value)
        }else{

            searchUsersData()
           // console.log(value)
        }

    });

    $('#form_create').submit(e=>{
        e.preventDefault()
        let name =$('#name1').val()
        let lastname =$('#lastname1').val()
        let age =$('#age1').val()
        let pass =$('#pass1').val()

         funcion = 'create_user';

        console.log(name,lastname,age,pass,funcion)

        $.post('../controller/UserController.php',{name,lastname,age,pass,funcion},(response)=>{

            if(response=='add'){
                $('#add').hide('slow')
                $('#add').show(1000)
                $('#add').hide(2000)
                $('#add').trigger('reset')
                searchUsersData()
            }else{
                $('#noadd').hide('slow')
                $('#noadd').show(1000)
                $('#noadd').hide(2000)
                $('#noadd').trigger('reset')
            }

        })


    });

    $(document).on('click','.ascender',(e)=>{
        const elemento =$(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement
        const id=$(elemento).attr('userID')
        funcion= 'ascend'
        $('#id_user').val(id)
        $('#funcion').val(funcion)
    })
    $(document).on('click','.descender',(e)=>{
        const elemento =$(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement
        const id=$(elemento).attr('userID')
        funcion= 'descend'
        $('#id_user').val(id)
        $('#funcion').val(funcion)
    })
    $(document).on('click','.delete_user',(e)=>{
        const elemento =$(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement
        const id=$(elemento).attr('userID')
        funcion= 'delete_user'
        $('#id_user').val(id)
        $('#funcion').val(funcion)
    })

    $('#form_confirm').submit(e=>{
        let pass=$('#oldpass').val()
        let id_user=$('#id_user').val()
        funcion =$('#funcion').val()

        $.post('../controller/UserController.php',{pass,id_user,funcion},(response)=>{
            if(response=='ascendido'|| response=='descendido' || response=='borrado'){
                $('#confirmChange').hide('slow')
                $('#confirmChange').show(1000)
                $('#confirmChange').hide(2000)
                $('#form_confirm').trigger('reset')
            }
               else{
                $('#noConfirm').hide('slow')
                $('#noConfirm').show(1000)
                $('#noConfirm').hide(2000)
                $('#form_confirm').trigger('reset')
            }
            searchUsersData();
        })
        e.preventDefault()
    })

})