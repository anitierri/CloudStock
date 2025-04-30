<style>
.sidebar-menu li.active a {
    background-color: #007bff; 
    color: #ffffff;
}

.sidebar-menu li a:hover {
    background-color: #f1f1f1;
    color: #333333; 
}
</style>

<div class="sidebar" id="sidebar">
<div class="sidebar-inner slimscroll">
<div id="sidebar-menu" class="sidebar-menu">
<ul>
    <li><a href="<?php echo RUTA_URL; ?>/StockController/listarMovimientos"><img src="<?php echo RUTA_URL; ?>/img/icons/dashboard.svg" alt="img"><span> Movimientos de Stock</span></a></li>
    <li><a href="<?php echo RUTA_URL; ?>/ProductoController/listarProductos"><img src="<?php echo RUTA_URL; ?>/img/icons/product.svg" alt="img"><span> Productos</span></a></li>
    <li><a href="<?php echo RUTA_URL; ?>/ProveedorController/listarProveedores"><img src="<?php echo RUTA_URL; ?>/img/icons/users1.svg" alt="img"><span> Proveedores</span></a></li>
    <li><a href="<?php echo RUTA_URL; ?>/OrdenController/ordenLista"><img src="<?php echo RUTA_URL; ?>/img/icons/sales1.svg" alt="img"><span> Órdenes de Compra</span></a></li>
</ul>

</div>
</div>
</div>

<script>
const menuItems = document.querySelectorAll('.sidebar-menu li a');

menuItems.forEach(item => {
    item.addEventListener('click', function() {

        menuItems.forEach(i => i.parentElement.classList.remove('active'));
        
        item.parentElement.classList.add('active');
    });
});

</script>