<?php
session_start();
if($_SESSION['type_user']==1||$_SESSION['type_user']==3 ||$_SESSION['type_user']==2){
    include_once 'layouts/header.php';
    ?>

    <title>Editar Datos</title>

    <?php
    include_once 'layouts/nav.php'
    ?>





    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Datos Personales</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="adm_Catalogue.php">Home</a></li>
                            <li class="breadcrumb-item active">Datos Personales</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="container-fluid">
    <div class="row">
       <div class="col-md-3">
          <div class="card card-dark card-outline">
             <div class="card-body box-profile">
                 <div class="text-center">
                     <img src="../img/CoolIcon.png" class="profile-user-img img-fluid img-circle" >
                 </div>
                <input id="id_user" type="hidden" value="<?php echo $_SESSION['id_user'] ?>">
                 <h3 id="username" class="profile-username text-center ">Nombre</h3>
                 <p id="user_lastname" class="text-muted text-center">Apellidos</p>
                 <ul class="list-group list-group-unbordered mb-3">
                     <li class="list-group-item">
                         <b>Edad</b><a id="age" class="float-right">20</a>
                     </li>
                     <li class="list-group-item">
                         <b>ID</b><a id="id_user1" class="float-right">1</a>
                     </li>
                     <li class="list-group-item">
                         <b>Tipo De Usuario</b>
                         <span id="type_user" class="float-right badge badge-primary">Administrador</span>
                     </li>

                 </ul>
             </div>
          </div>
           <div class="card card-dark">
              <div class="card-header">
                  <h3 class="card-title">Informacion</h3>
              </div>
               <div class="card-body">
                <strong>
                    <i class="fas fa-phone mr-1"></i>Telefono
                </strong>
                   <p id="user_phone" class="text-muted">434343</p>
                   <strong>
                       <i class="fas fa-map-marker mr-1"></i>Direccion
                   </strong>
                   <p id="user_address" class="text-muted">434343</p>
                   <strong>
                       <i class="fas fa-at mr-1"></i>Correo
                   </strong>
                   <p id="user_email" class="text-muted">434343</p>
                   <strong>
                       <i class="fas fa-pencil-alt mr-1"></i>Informacion Adicional
                   </strong>
                   <p id="user_extra_info" class="text-muted">434343</p>
                   <button class="edit btn btn-block bg-gradient-dark">Editar</button>
               </div>
               <div class="card-footer">
                   <p class="text-muted">Click si desea editar</p>
               </div>
           </div>
       </div>

        <div class="col-md-9">
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">Editar Datos Personales</h3>
                </div>
                <div class="card-body">
                    <div class="alert alert-success text-center" id="edited" style='display:none;'>
                        <span><i class="fas fa-check m-1"></i>Editado</span>
                    </div>
                    <div class="alert alert-danger text-center" id="noedited" style='display:none;'>
                        <span><i class="fas fa-times m-1"></i>Edicion Deshabilitada</span>
                    </div>

                 <form id="userForm" class="form-horizontal">
                     <div class="form-group row">
                         <label for="phone" class="col-sm-2 col-form-label">Telefono</label>
                         <div class="col-sm-10">
                             <input type="text" id="phone" class="form-control">
                         </div>
                     </div>
                     <div class="form-group row">
                         <label for="address" class="col-sm-2 col-form-label">Dirreccion</label>
                         <div class="col-sm-10">
                             <input type="text" id="address" class="form-control">
                         </div>
                     </div>
                     <div class="form-group row">
                         <label for="email" class="col-sm-2 col-form-label">Correo</label>
                         <div class="col-sm-10">
                             <input type="text" id="email" class="form-control">
                         </div>
                     </div>
                     <div class="form-group row">
                         <label for="extraInfo" class="col-sm-2 col-form-label">Informacion Adicional</label>
                         <div class="col-sm-10">

                             <textarea class="form-control" id="extraInfo" cols="30" rows="10"> </textarea>
                         </div>
                     </div>
                     <div class="form-group row">
                         <div class="offset-sm-2 col-sm-10 float-right">
                             <button class="btn btn-block btn-outline-dark">Guardar</button>
                         </div>
                     </div>
                 </form>
                </div>
                <div class="card-footer">
                <p class="text-muted">Cuidado al hacer cambios</p>
                </div>
            </div>
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

<script src="../js/User.js"></script>
