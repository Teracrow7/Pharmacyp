<?php
session_start();
if($_SESSION['type_user']==3){
    include_once 'layouts/header.php';
    ?>

    <title>Gestion Lote</title>

    <?php
    include_once 'layouts/nav.php'
    ?>


    <div class="modal fade" id="editLot" tabindex="-1" role="dialog" aria-labelledby="exampleModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Editar Lote</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">

                        <div class="alert alert-success text-center" id="editLote" style='display:none;'>
                            <span><i class="fas fa-check m-1"></i>Modificado Correctamente</span>
                        </div>
                        <form id="form_editLot">
                            <div class="form-group">
                                <label for="id_loti">Codigo Lote:</label>
                                <label id="id_loti" >Codigo Lote</label>
                            </div>
                            <div class="form-group">
                                <label for="stock">Stock</label>
                                <input id="stock" type="number" class="form-control" placeholder="Ingrese el Stock" required>
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


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Gestion Lote</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="adm_Catalogue.php">Home</a></li>
                            <li class="breadcrumb-item active">Gestion Lote</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="container-fluid">
                <div class="card card-sucess">
                    <div class="card-header">
                        <h3 class="card-title">Buscar Lotes</h3>
                        <div class="input-group">
                            <input type="text" id="searchLot" class="form-control float-left" placeholder="Ingrese nombre de Producto">
                            <div class="input-group-append">
                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div id="lots" class="row d-flex align-items-stretch">

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

<script src="../js/Lot.js"></script>



