<?php
session_start();
if($_SESSION['type_user']==1||$_SESSION['type_user']==3){
    include_once 'layouts/header.php';
    ?>

    <title>Editar Datos</title>

    <?php
    include_once 'layouts/nav.php'
    ?>





    <!--Button trigger modal-->
    <div class="modal fade" id="crearProveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Crear proveedor</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">

                        <div class="alert alert-success text-center" id="add_supp" style='display:none;'>
                            <span><i class="fas fa-check m-1"></i>Se Agregó Correctamente</span>
                        </div>
                        <div class="alert alert-danger text-center" id="noadd_supp" style='display:none;'>
                            <span><i class="fas fa-times m-1"></i>Proveedor ya Existente</span>
                        </div>
                        <div class="alert alert-success text-center" id="editSup" style='display:none;'>
                            <span><i class="fas fa-check m-1"></i>Proveedor modificado</span>
                        </div>

                        <form id="form_create_supplier">
                            <div class="form-group">
                                <label for="nameSupplier">Nombre</label>
                                <input id="nameSupplier" type="text" class="form-control" placeholder="Ingrese nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="phoneSupplier">Telefono</label>
                                <input id="phoneSupplier" type="text" class="form-control" placeholder="Ingrese el Telefono" required>
                            </div>
                            <div class="form-group">
                                <label for="emailSupplier">Email</label>
                                <input id="emailSupplier" type="text" class="form-control" placeholder="Ingrese el Email" >
                            </div>
                            <div class="form-group">
                                <label for="addressSupplier">Direccion</label>
                                <input id="addressSupplier" type="text" class="form-control" placeholder="Ingrese la Direcccion" required>
                            </div>
                            <input type="hidden" id="id_edit_supp">
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
                        <h1>Gestion proveedor <button type="button" data-toggle="modal" data-target="#crearProveedor" class="btn btn-dark ml-2">Crear proveedor</button></h1>

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="adm_Catalogue.php">Home</a></li>
                            <li class="breadcrumb-item active">Gestion proveedor</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="container-fluid">
                <div class="card card-sucess">
                    <div class="card-header">
                        <h3 class="card-title">Buscar proveedor</h3>
                        <div class="input-group">
                            <input type="text" id="searchSupplier" class="form-control float-left" placeholder="Ingrese nombre de proveedor">
                            <div class="input-group-append">
                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div id="suppliers" class="row d-flex align-items-stretch">

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

<script src="../js/Supplier.js"></script>


