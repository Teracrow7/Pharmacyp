<?php
session_start();
if($_SESSION['type_user']==3||$_SESSION['type_user']==1 ||$_SESSION['type_user']==2){
    include_once 'layouts/header.php';
    ?>

    <title>Gestion Venta</title>

    <?php
    include_once 'layouts/nav.php'
    ?>


    <div class="modal fade" id="watchSale" tabindex="-1" role="dialog" aria-labelledby="exampleModal">
        <div class="modal-dialog modal-xl " role="document">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Registro de Venta</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="codSale">Id Venta</label>
                            <span id="codSale"></span>
                        </div>
                        <div class="form-group">
                            <label for="clientSale">Cliente</label>
                            <span id="clientSale"></span>
                        </div>
                        <div class="form-group">
                            <label for="dateSale">Fecha</label>
                            <span id="dateSale"></span>
                        </div>
                        <div class="form-group">
                            <label for="totalSale">Total</label>
                            <span id="totalSale"></span>
                        </div>
                        <div class="form-group">
                            <label for="sellerSale">Vendedor</label>
                            <span id="sellerSale"></span>
                        </div>
                        <table class="table table-hover text-nowrap">
                            <thead class="table-success">
                            <tr>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Producto</th>
                                <th>Concentracion</th>
                                <th>Laboratorio</th>
                                <th>Presentacion</th>
                                <th>Tipo</th>
                                <th>subtotal</th>
                            </tr>
                            </thead>
                            <tbody class="table-warning" id="resgiterSale">

                            </tbody>
                        </table>
                        <div class="float-right input-group-append">
                            <h3 class="m-3">Total:</h3>
                            <h3 class="m-3" id="total"></h3>
                        </div>


                    </div>
                    <div class="card-footer">
                        <button type="button" data-dismiss="modal" class=" btn btn-outline-secondary float-right m-1">Close</button>

                       </div>
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
                        <h1>Gestion Ventas</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="adm_Catalogue.php">Home</a></li>
                            <li class="breadcrumb-item active">Gestion Ventas</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="container-fluid">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Buscar Ventas</h3>
                    </div>
                    <div class="card-body">
                        <table id="tableSalee" class="display table table-hover text-nowrap" style="width:100%; text-align: center">
                            <thead>
                            <tr >
                                <th style="text-align: center">Id Venta</th>
                                <th style="text-align: center">Cliente</th>
                                <th style="text-align: center">Fecha</th>
                                <th style="text-align: center">Total</th>
                                <th style="text-align: center">Vendedor</th>
                                <th style="text-align: center">Accion</th>

                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
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

<script src="https://cdn.datatables.net/v/dt/dt-2.0.7/datatables.min.js"></script>
<script src="../js/Sale.js"></script>



