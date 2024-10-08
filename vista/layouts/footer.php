<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2024-2025 <a href="https://www.tuxtla.tecnm.mx/">TECNM</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../js/jsFront/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../js/jsFront/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../js/jsFront/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../js/jsFront/demo.js"></script>

<!-- sweetAlert2 -->
<script src="../js/sweetalert2.js"></script>
<!-- select2 -->
<script src="../js/select2.js"></script>

<script>
    let funcion = 'userType'
    $.post('../controller/UserController.php',{funcion},(response)=>{
        if(response==1){
            $('#gestion_lote').hide()
        }else if(response==2){
            $('#gestion_lote').hide()
            $('#gestion_usuario').hide()
            $('#gestion_producto').hide()
            $('#gestion_atributo').hide()
            $('#gestion_proveedor').hide()
        }
    })

</script>

</body>
</html>
