<?php
session_start();
if($_SESSION['type_user']==1||$_SESSION['type_user']==3){
    include_once 'layouts/header.php';
    ?>

    <title>ADM | ATRIBUTO</title>

    <?php
    include_once 'layouts/nav.php'
    ?>

    <div class="modal fade" id="createLaboratory" tabindex="-1" role="dialog" aria-labelledby="exampleModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Crear Laboratorio</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">

                        <div class="alert alert-success text-center" id="addLaboratory" style='display:none;'>
                            <span><i class="fas fa-check m-1"></i>Agregado Correctamente</span>
                        </div>
                        <div class="alert alert-danger text-center" id="noaddLaboratory" style='display:none;'>
                            <span><i class="fas fa-times m-1"></i>Laboratorio ya Existente</span>
                        </div>
                        <div class="alert alert-success text-center" id="editLabi" style='display:none;'>
                            <span><i class="fas fa-check m-1"></i>Editado Correctamente</span>
                        </div>

                        <form id="form_createLaboratory">
                            <div class="form-group">
                                <label for="name_lab">Nombre</label>
                                <input id="name_lab" type="text" class="form-control" placeholder="Ingrese nombre" required>
                                <input type="hidden" id="id_edit_lab">
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

    <div class="modal fade" id="createType" tabindex="-1" role="dialog" aria-labelledby="exampleModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Crear Tipo</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">

                        <div class="alert alert-success text-center" id="addType" style='display:none;'>
                            <span><i class="fas fa-check m-1"></i>Agregado Correctamente</span>
                        </div>
                        <div class="alert alert-danger text-center" id="noaddType" style='display:none;'>
                            <span><i class="fas fa-times m-1"></i>Tipo ya Existente</span>
                        </div>
                        <div class="alert alert-success text-center" id="editTypeei" style='display:none;'>
                            <span><i class="fas fa-check m-1"></i>Editado Correctamente</span>
                        </div>

                        <form id="form_createType">
                            <div class="form-group">
                                <label for="name_Type">Nombre</label>
                                <input id="name_Type" type="text" class="form-control" placeholder="Ingrese nombre" required>
                                <input type="hidden" id="id_edit_type">
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

    <div class="modal fade" id="createPresentation" tabindex="-1" role="dialog" aria-labelledby="exampleModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Crear Presentacion</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">

                        <div class="alert alert-success text-center" id="addPre" style='display:none;'>
                            <span><i class="fas fa-check m-1"></i>Agregado Correctamente</span>
                        </div>
                        <div class="alert alert-danger text-center" id="noaddPre" style='display:none;'>
                            <span><i class="fas fa-times m-1"></i>Presentacion ya Existente</span>
                        </div>
                        <div class="alert alert-success text-center" id="editPre" style='display:none;'>
                            <span><i class="fas fa-check m-1"></i>Editado Correctamente</span>
                        </div>

                        <form id="form_createPresentation">
                            <div class="form-group">
                                <label for="name_Presentation">Nombre</label>
                                <input id="name_Presentation" type="text" class="form-control" placeholder="Ingrese nombre" required>
                                <input type="hidden" id="id_edit_pre">
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
                        <h1>Gestion Atributos</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="adm_Catalogue.php">Home</a></li>
                            <li class="breadcrumb-item active">Gestion Atributos</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="container-fluid">
            <div class=" row ">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                   <a href="#laboratory" class="nav-link active" data-toggle="tab">Laboratorio</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#typeLab" class="nav-link" data-toggle="tab">Tipo</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#presenLab" class="nav-link" data-toggle="tab">Presentacion</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" >
                                <div class="tab-pane  active" id="laboratory">
                                    <div class="card-dark">
                                       <div class="card-header">
                                           <div class="card-title">Buscar Laboratorio
                                           <button  type="button"  data-toggle="modal" data-target="#createLaboratory" class="btn bg-gradient-primary btn-sm m-2">Crear Laboratorio</button>
                                           </div>
                                           <div class="input-group">
                                               <input id="labsearch" class="form-control float-left" placeholder="Ingrese nombre">
                                               <div type="text" class="input-group-append">
                                                   <button class="btn btn-default"><i class="fas fa-search"></i></button>
                                               </div>
                                           </div>
                                       </div>
                                        <div class="card-body p-0">
                                            <table class="table table-over text-nowrap">
                                                <thead class="table-dark">
                                                <tr>
                                                    <th>Laboratorio</th>
                                                    <th>Logo</th>
                                                    <th>Accion</th>
                                                </tr>
                                                </thead>
                                                <tbody class="table-active" id="laboratories">



                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="card-footer">

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="typeLab">
                                    <div class="card-dark">
                                        <div class="card-header">
                                            <div class="card-title">Buscar Tipo
                                                <button type="button"  data-toggle="modal" data-target="#createType" class="btn bg-gradient-primary btn-sm m-2">Crear Tipo</button></div>
                                            <div class="input-group">
                                                <input id="typesearch" class="form-control float-left" placeholder="Ingrese nombre">
                                                <div type="text" class="input-group-append">
                                                    <button class="btn btn-default"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body p-0">
                                            <table class="table table-over text-nowrap">
                                                <thead class="table-dark">
                                                <tr>
                                                    <th>Tipos</th>
                                                    <th>Accion</th>
                                                </tr>
                                                </thead>
                                                <tbody class="table-active" id="tipos">
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="card-footer"></div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="presenLab">
                                    <div class="card-dark">
                                        <div class="card-header">
                                            <div class="card-title">Buscar Presentacion
                                                <button type="button"  data-toggle="modal" data-target="#createPresentation" class="btn bg-gradient-primary btn-sm m-2">Crear Presentacion</button></div>
                                            <div class="input-group">
                                                <input id="presensearch" class="form-control float-left" placeholder="Ingrese nombre">
                                                <div type="text" class="input-group-append">
                                                    <button class="btn btn-default"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body p-0">
                                            <table class="table table-over text-nowrap">
                                                <thead class="table-dark">
                                                <tr>
                                                    <th>Presentaciones</th>
                                                    <th>Accion</th>
                                                </tr>
                                                </thead>
                                                <tbody class="table-active" id="presentaciones">
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="card-footer"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">


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
<script src="../js/Laboratory.js"></script>
<script src="../js/Type.js"></script>
<script src="../js/Presentation.js"></script>