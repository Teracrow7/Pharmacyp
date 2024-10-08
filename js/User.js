$(document).ready(function (){

    var funcion='';
    var id_user = $('#id_user').val();
    var edit=false;

    search_user(id_user);
    function search_user(data){
        console.log(data)
        funcion='search_user';
        $.post('../controller/UserController.php',{data,funcion},(response)=>{


            let name='';
            let lastname='';
            let age='';
            let type='';
            let phone='';
            let address='';
            let email='';
            let extra_info='';

            const user =JSON.parse(response);//extrae los atributos del json


            name+=`${user.name}`;
            lastname+=`${user.lastname}`;
            age+=`${user.age}`;
            type+=`${user.type}`;
            phone+=`${user.phone}`;
            address+=`${user.address}`;
            email+=`${user.email}`;
            extra_info+=`${user.extra_info}`;

            $('#username').html(name);
            $('#user_lastname').html(lastname);
            $('#user_address').html(address);
            $('#user_phone').html(phone);
            $('#age').html(age);
            $('#type_user').html(type);
            $('#user_extra_info').html(extra_info);
            $('#user_email').html(email);


        })

    }


    $(document).on('click','.edit',(e)=>{

        funcion='saveData'
        edit=true
        console.log(id_user)
        $.post('../controller/UserController.php',{funcion,id_user},(response)=>{

            const user = JSON.parse(response);
            $('#phone').val(user.phone)
            $('#address').val(user.address)
            $('#email').val(user.email)
            $('#extraInfo').val(user.extra_info)

        })
    });

    $('#userForm').submit(e=>{
        if(edit===true){
            let phone = $('#phone').val()
            let address = $('#address').val()
            let email = $('#email').val()
            let extraInfo = $('#extraInfo').val()

            funcion='edit_user'

            $.post('../controller/UserController.php',{id_user,funcion,phone,address,email,extraInfo},(response)=>{
                if(response==='edited'){

                    $('#edited').hide('slow')
                    $('#edited').show(1000)
                    $('#edited').hide(2000)
                    $('#userForm').trigger('reset')

                }
                edit=false
                search_user(id_user)
            })

        }else{
            $('#noedited').hide('slow')
            $('#noedited').show(1000)
            $('#noedited').hide(2000)
            $('#userForm').trigger('reset')
        }
        e.preventDefault()

    })

})

