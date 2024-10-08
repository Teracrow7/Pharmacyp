<?php
session_start();
if($_SESSION['type_user']==1||$_SESSION['type_user']==3){
    include_once 'layouts/header.php';
    ?>

    <title>Editar Datos</title>

    <?php
    include_once 'layouts/nav.php'
    ?>

    <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLbel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Cambios</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   <div class="text-center">
                       <img id="pictureAvatar" src="../img/CoolIcon.png" class="profile-user-img img-fluid img-circle">
                   </div>
                    <div class="text-center">
                        <b>
                            <?php

                            echo $_SESSION[ 'username'];

                            ?>
                        </b>
                    </div>
                    <span>Necesitamos su password para continuar</span>
                    <div class="alert alert-success text-center" id="confirmChange" style="display: none">
                        <span><i class="fas fa-check m-1"></i>Se ascendió al usuario </span>
                    </div>
                    <div class="alert alert-danger text-center" id="noConfirm" style="display: none">
                        <span><i class="fas fa-times m-1"></i>Contraseña incorrecta </span>
                    </div>
                </div>
                <form id="form_confirm">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                        </div>
                        <input id="oldpass" type="password" class="form-control" placeholder="Ingrese su Contraseña">
                        <input type="hidden" id="id_user">
                        <input type="hidden" id="funcion">
                    </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
                    <button type="submit" class="btn bg-gradient-primary">Save changes</button>
                </form>
                </div>
            </div>
        </div>
    </div>




    <!--Button trigger modal-->
    <div class="modal fade" id="crearusuario" tabindex="-1" role="dialog" aria-labelledby="exampleModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Crear usuario</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">

                        <div class="alert alert-success text-center" id="add" style='display:none;'>
                            <span><i class="fas fa-check m-1"></i>Usuario Agregado Correctamente</span>
                        </div>
                        <div class="alert alert-danger text-center" id="noadd" style='display:none;'>
                            <span><i class="fas fa-times m-1"></i>Usuario ya Existente</span>
                        </div>

                        <form id="form_create">
                            <div class="form-group">
                                <label for="name1">Nombres</label>
                                <input id="name1" type="text" class="form-control" placeholder="Ingrese nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="lastname1">Apellidos</label>
                                <input id="lastname1" type="text" class="form-control" placeholder="Ingrese apellido" required>
                            </div>
                            <div class="form-group">
                                <label for="age1">Edad</label>
                                <input id="age1" type="text" class="form-control" placeholder="Ingrese nacimiento" required>
                            </div>
                            <div class="form-group">
                                <label for="pass1">Password</label>
                                <input id="pass1" type="password" class="form-control" placeholder="Ingrese password" required>
                            </div>
                            </div>
                             <div class="card-footer">
                            <button type="submit" class="btn bg-gradient-primary float-right">Guardar</button>
                            <button type="button" data-dismiss="modal" class=" btn btn-outline-secondary float-right m-1">Close</button>

                        </form></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Gestion usuarios <button type="button" id="button_create" data-toggle="modal" data-target="#crearusuario" class="btn btn-dark ml-2">Crear usuario</button></h1>
                        <input type="hidden" id="type_user_hidden" value="<?php echo $_SESSION['type_user']?>">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="adm_Catalogue.php">Home</a></li>
                            <li class="breadcrumb-item active">Gestion usuarios</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="container-fluid">
                <div class="card card-sucess">
                    <div class="card-header">
                        <h3 class="card-title">Buscar usuario</h3>
                        <div class="input-group">
                            <input type="text" id="search" class="form-control float-left" placeholder="Ingrese nombre de usuario">
                            <div class="input-group-append">
                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div id="users" class="row d-flex align-items-stretch">

                        </div>

                    </div>
                    <div class="card-footer">


                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php

    include_once 'layouts/footer.php';

}
else{
    header('Location: ../Index.php');
}
?>

<script src="../js/User_Management.js"></script>

