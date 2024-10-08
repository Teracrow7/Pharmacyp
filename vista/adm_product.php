<?php
session_start();
if($_SESSION['type_user']==1||$_SESSION['type_user']==3){
    include_once 'layouts/header.php';
    ?>

    <title>Editar Datos</title>

    <?php
    include_once 'layouts/nav.php'
    ?>
    <div class="modal fade" id="crearLote" tabindex="-1" role="dialog" aria-labelledby="exampleModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Crear Lote</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">

                        <div class="alert alert-success text-center" id="addLot" style='display:none;'>
                            <span><i class="fas fa-check m-1"></i>Agregado Correctamente</span>
                        </div>
                        <form id="form_createLot">
                            <div class="form-group">
                                <label for="nameProductLot">Producto:</label>
                                <label id="nameProductLot" >Nombre de Producto</label>
                            </div>
                            <div class="form-group">
                                <label for="supplier_lot" >Proveedor</label>
                                <select id="supplier_lot" class="form-control select2" style="width: 100%"></select>
                            </div>
                            <div class="form-group">
                                <label for="stock">Stock</label>
                                <input id="stock" type="number" class="form-control" placeholder="Ingrese el Stock" required>
                            </div>
                            <div class="form-group">
                                <label for="expiration">Vencimiento</label>
                                <input id="expiration" type="date" class="form-control" placeholder="Ingrese Vencimiento" required>
                            </div>

                            <input type="hidden" id="id_lot_prod">
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn bg-gradient-primary float-right">Guardar</button>
                        <button type="button" data-dismiss="modal" class=" btn btn-outline-secondary float-right m-1">Close</button>

                        </form></div>
                </div>
            </div>
        </div>
    </div>





    <!--Button trigger modal-->
    <div class="modal fade" id="crearProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Crear Producto</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">

                        <div class="alert alert-success text-center" id="add" style='display:none;'>
                            <span><i class="fas fa-check m-1"></i>Producto Agregado Correctamente</span>
                        </div>
                        <div class="alert alert-danger text-center" id="noadd" style='display:none;'>
                            <span><i class="fas fa-times m-1"></i>Producto ya Existente</span>
                        </div>
                        <div class="alert alert-success text-center" id="editProd" style='display:none;'>
                            <span><i class="fas fa-check m-1"></i>Se edito correctamente</span>
                        </div>

                        <form id="form_createProduct">
                            <div class="form-group">
                                <label for="name_product">Nombre</label>
                                <input id="name_product" type="text" class="form-control" placeholder="Ingrese nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="concentration">Concentracion</label>
                                <input id="concentration" type="text" class="form-control" placeholder="Ingrese concentracion" >
                            </div>
                            <div class="form-group">
                                <label for="extra">Adicional</label>
                                <input id="extra" type="text" class="form-control" placeholder="Ingrese extra" >
                            </div>
                            <div class="form-group">
                                <label for="price">Precio</label>
                                <input id="price" type="number" step="0.01" class="form-control" value="1" placeholder="Ingrese el Precio" required>
                            </div>
                            <div class="form-group">
                                <label for="lab">Laboratorio</label>
                               <select name="lab" id="laboratoryProduct" class="form-control select2 select2-dark" style="width: 100%" ></select>
                            </div>
                            <div class="form-group">
                                <label for="tipo">Tipo</label>
                                <select name="tipo" id="typeProduct" class="form-control select2" style="width: 100%"></select>
                            </div>
                            <div class="form-group">
                                <label for="pre">Presentacion</label>
                                <select name="pre" id="presentationProduct" class="form-control select2" style="width: 100%"></select>
                            </div>
                            <input type="hidden" id="id_edit_prod">
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
                        <h1>Gestion Producto <button type="button" id="button_create" data-toggle="modal" data-target="#crearProducto" class="btn btn-dark ml-2">Crear Producto</button></h1>

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="adm_Catalogue.php">Home</a></li>
                            <li class="breadcrumb-item active">Gestion Producto</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="container-fluid">
                <div class="card card-sucess">
                    <div class="card-header">
                        <h3 class="card-title">Buscar Producto</h3>
                        <div class="input-group">
                            <input type="text" id="searchProduct" class="form-control float-left" placeholder="Ingrese nombre de Producto">
                            <div class="input-group-append">
                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div id="products" class="row d-flex align-items-stretch">

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

<script src="../js/Product.js"></script>


