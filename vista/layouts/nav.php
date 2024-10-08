<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- sweetAlert2 -->
<link rel="stylesheet" href="../css/sweetalert2.css"">
<!-- select2 -->
<link rel="stylesheet" href="../css/select2.css"">
<!-- Font Awesome -->
<link rel="stylesheet" href="../css/css/all.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="../css/css/adminlte.min.css">
<!-- Compra -->
<link rel="stylesheet" href="../css/compra.css">
<!-- DataTable -->
<link href="https://cdn.datatables.net/v/dt/dt-2.0.7/datatables.min.css" rel="stylesheet">



</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="adm_Catalogue.php" class="nav-link">Home</a>
            </li>
            <li class="nav-item dropdown" id="shoppingCart" style="display: none">
                <img src="../img/shoppingCart.png" class="imagen-carrito nav-link dropdown-toggle" href="#" role="button" id="navbarDropdown" data-toggle="dropdown" aria-expanded="true"
                style="position: relative; display: inline-block; text-align: center">
                    <span class="contador badge badge-danger" id="counter" style="position: absolute; top: 0; right: 3px;"></span>
                </img>


                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                   <table class="table table-hover text-nowrap p-0">
                       <thead class="table-success">
                        <tr>
                            <th>Stock</th>
                            <th>Nombre</th>
                            <th>Concentracion</th>
                            <th>Laboratorio</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Eliminar</th>
                        </tr>
                       </thead>
                       <tbody id="list">

                       </tbody>
                   </table>
                    <a href="#" class="btn btn-danger btn-block" id="buyybaby">Procesar Compra</a>
                    <a href="#"  id="emptyCart" class=" btn btn-primary btn-block">Vaciar Carrito</a>
                </div>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">



            <a href="../controller/Logout.php">Cerrar Sesion</a>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="adm_Catalogue.php" class="brand-link">
            <img src="/img/logoMainDashBoard.png" alt="Admin Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Farmacia Tec</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="/img/CoolIcon.png" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">
                        <?php
                        echo $_SESSION['username'];
                        ?>
                    </a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-header">Usuario</li>

                    <li class="nav-item">
                        <a href="edit_personal_data.php" class="nav-link">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>
                                Datos Personales
                            </p>
                        </a>
                    </li>
                    <li id="gestion_usuario" class="nav-item">
                        <a href="adm_user.php" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Gestion Usuarios
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">Ventas</li>

                    <li class="nav-item">
                        <a href="adm_sale.php" class="nav-link">
                            <i class="nav-icon fas fa-notes-medical"></i>
                            <p>
                                Listar Ventas
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">Almacen</li>

                    <li id="gestion_producto" class="nav-item">
                        <a href="adm_product.php" class="nav-link">
                            <i class="nav-icon fas fa-pills"></i>
                            <p>
                                Gestion Producto
                            </p>
                        </a>
                    </li>
                    <li id="gestion_atributo" class="nav-item">
                        <a href="adm_attribute.php" class="nav-link">
                            <i class="nav-icon fas fa-vials"></i>
                            <p>
                                Gestion Atributo
                            </p>
                        </a>
                    </li>
                    <li id="gestion_lote" class="nav-item">
                        <a href="adm_lot.php" class="nav-link">
                            <i class="nav-icon fas fa-cubes"></i>
                            <p>
                                Gestion Lote
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">Compras</li>

                    <li id="gestion_proveedor" class="nav-item">
                        <a href="adm_supplier.php" class="nav-link">
                            <i class="nav-icon fas fa-truck"></i>
                            <p>
                                Gestion Proveedor
                            </p>
                        </a>
                    </li>


                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>



