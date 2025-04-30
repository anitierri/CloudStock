<?php require RUTA_APP . '/views/layout/dashboard/header.php'; ?>
<?php require RUTA_APP . '/views/layout/dashboard/menu.php'; ?>

<!--para elimninar el producto-->
<div id="cajitaEliminar" class="cajita">
    <div class="cajita-contenido">
        <div class="cajita-encabezado">
            <h4>Confirmar Eliminación</h4>
        </div>
        <div class="cajita-cuerpo">
            <p>¿Estás seguro de que quieres eliminar este producto?</p>
            <div class="cajita-botones">
                <button id="botonConfirmar" class="boton-eliminar">Eliminar</button>
                <button id="botonCancelar" class="boton-cancelar">Cancelar</button>
            </div>
        </div>
    </div>
</div>


<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Lista de Productos</h4>
                <h6>Gestiona tus productos.</h6>
            </div>
            <div class="page-btn">
                <a href="<?php echo RUTA_URL; ?>/ProductoController/agregarProducto" class="btn btn-added">
                    <img src="<?php echo RUTA_URL; ?>/img/icons/plus.svg" alt="img">Añadir Producto
                </a>
            </div>
        </div>

        <div class="search-input">
                <input type="search" id="searchInput" class="form-control form-control-sm" placeholder="Buscar..." aria-controls="DataTables_Table_0">
        </div>

        <div class="custom-card">
            <div class="custom-card-body">
                <div class="custom-table-responsive">
                    <table class="custom-table" id="buscarEnTabla">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Código</th>
                                <th>Proveedor</th>
                                <th>Categoría</th>
                                <th>Cantidad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($data['productos'])): ?>
                            <?php foreach ($data['productos'] as $producto): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($producto->nombre_producto); ?></td>
                                    <td><?php echo htmlspecialchars($producto->codigo_producto); ?></td>
                                    <td><?php echo htmlspecialchars($producto->proveedor); ?></td>
                                    <td><?php echo htmlspecialchars($producto->categoria); ?></td>          
                                    <td><?php echo htmlspecialchars($producto->cantidad); ?></td>
                                    <td>
                                        <a href="<?php echo RUTA_URL; ?>/ProductoController/editarProducto/<?php echo $producto->id_producto; ?>" class="me-3">
                                            <img src="<?php echo RUTA_URL; ?>/img/icons/edit.svg" alt="img">
                                        </a>
                                        <a class="delete-icon" onclick="confirmarEliminacion(<?php echo $producto->id_producto; ?>);">
                                            <img src="<?php echo RUTA_URL; ?>/img/icons/delete.svg" alt="Eliminar">
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">No se encontraron productos disponibles.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!--para borrar un determinado producto. 
tocó ponerlo así porque por alguna razón, si lo poniamos en un footer no andaba. capaz era mi compu, pero como anduvo de esta manera, lo dejamos asi-->


<script>
let idProductoEliminar = null;
const cajita = document.getElementById('cajitaEliminar');

function confirmarEliminacion(id_producto) {
    idProductoEliminar = id_producto;
    cajita.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

document.getElementById('botonConfirmar').addEventListener('click', function() {
    if (idProductoEliminar) {
        window.location.href = '<?php echo RUTA_URL; ?>/ProductoController/borrarProducto/' + idProductoEliminar;
    }
});

document.getElementById('botonCancelar').addEventListener('click', function() {
    cerrarCajita();
});

cajita.addEventListener('click', function(e) {
    if (e.target === cajita) {
        cerrarCajita();
    }
});

function cerrarCajita() {
    cajita.style.display = 'none';
    idProductoEliminar = null;
    document.body.style.overflow = 'auto';
}


</script>

<?php require RUTA_APP . '/views/layout/dashboard/footer.php'; ?>
