<?php
session_start();
if($_SESSION['type_user']==1||$_SESSION['type_user']==3 ||$_SESSION['type_user']==2){
    include_once 'layouts/header.php';
    ?>

    <title>FarmaTec</title>

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
                        <h1>Catalogo</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="adm_Catalogue.php">Home</a></li>
                            <li class="breadcrumb-item active">Catalogo</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section>
            <div class="container-fluid">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Lotes en Riesgo</h3>
                    </div>
                    <div class="card-body p-0 table-responsive">
                        <table class="table table-hover text-nowrap">
                            <thead class="table-dark">
                            <tr>
                                <th>Cod</th>
                                <th>Producto</th>
                                <th>Stock</th>
                                <th>Laboratorio</th>
                                <th>Presentacion</th>
                                <th>Proveedor</th>
                                <th>Mes</th>
                                <th>Dia</th>
                            </tr>
                            </thead >
                            <tbody id="lotes" class="table-active">

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">


                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container-fluid">
                <div class="card card-dark">
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
    </div>
    <!-- /.content-wrapper -->






    <?php

    include_once 'layouts/footer.php';

}
else{
    header('Location: ../Index.php');
}
?>
<script src="../js/Catalogue.js"></script>
<script src="../js/ShoppingCart.js"></script>