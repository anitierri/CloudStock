<?php require RUTA_APP . '/views/layout/dashboard/header.php'; ?>
<?php require RUTA_APP . '/views/layout/dashboard/menu.php'; ?>



<!--para elimninar la orden-->
<div id="cajitaEliminar" class="cajita">
    <div class="cajita-contenido">
        <div class="cajita-encabezado">
            <h4>Confirmar Eliminación</h4>
        </div>
        <div class="cajita-cuerpo">
            <p>¿Estás seguro de que quieres eliminar esta orden de compra?</p>
            <div class="cajita-botones">
                <button id="botonConfirmar" class="boton-eliminar">Eliminar</button>
                <button id="botonCancelar" class="boton-cancelar">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!--solo aparece cuando se aprieta el icono, ya que inicialmente está puesto en el css como display: none-->


<div class="page-wrapper">
    <div class="content">

        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-success ">
        <?php echo $_SESSION['mensaje']; ?>
        <?php unset($_SESSION['mensaje']); ?>  
             </div>
        <?php endif; ?>

        <div class="page-header">
            <div class="page-title">
                <h4>Órdenes de compra</h4>
                <h6>Gestiona tus órdenes de compra.</h6>
            </div>
            <div class="page-btn">
                <a href="<?php echo RUTA_URL; ?>/OrdenController/agregarOrden" class="btn btn-added">
                    <img src="<?php echo RUTA_URL; ?>/img/icons/plus.svg" alt="img">Añadir Orden de Compra
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
                                <th>Número de Orden</th>
                                <th>Proveedor</th>
                                <th>Empleado</th>
                                <th>Fecha Orden</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($data['ordenes'])): ?>
                                <?php foreach ($data['ordenes'] as $orden): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($orden->id_orden); ?></td>
                                        <td><?php echo htmlspecialchars($orden->proveedor); ?></td>
                                        <td><?php echo htmlspecialchars($orden->usuario); ?></td>
                                        <td><?php echo date('d-m-Y H:i', strtotime($orden->fecha_orden)); ?></td>
                                        <td><?php echo htmlspecialchars($orden->producto); ?></td>
                                        <td><?php echo htmlspecialchars($orden->cantidad); ?></td>
                                        <td>
                                        <a class="delete-icon" onclick="confirmarEliminacion(<?php echo $orden->id_orden; ?>)">
                                                <img src="<?php echo RUTA_URL; ?>/img/icons/delete.svg" alt="img">
                                        </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center">No hay órdenes disponibles.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<!--para borrar una determinada orden. 
tocó ponerlo así porque por alguna razón, si lo poniamos en un footer no andaba. capaz era mi compu, pero como anduvo de esta manera, lo dejamos asi-->


<script>
let idOrdenEliminar = null;
const cajita = document.getElementById('cajitaEliminar');

function confirmarEliminacion(id_orden) {
    idOrdenEliminar = id_orden;
    cajita.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

document.getElementById('botonConfirmar').addEventListener('click', function() {
    if (idOrdenEliminar) {
        window.location.href = '<?php echo RUTA_URL; ?>/OrdenController/eliminarOrden/' + idOrdenEliminar;
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
    idOrdenEliminar = null;
    document.body.style.overflow = 'auto';
}


</script>

<?php require RUTA_APP . '/views/layout/dashboard/footer.php'; ?>