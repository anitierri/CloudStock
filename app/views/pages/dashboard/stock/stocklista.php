<?php require RUTA_APP . '/views/layout/dashboard/header.php'; ?>
<?php require RUTA_APP . '/views/layout/dashboard/menu.php'; ?>

<div id="cajitaEliminar" class="cajita">
    <div class="cajita-contenido">
        <div class="cajita-encabezado">
            <h4>Confirmar Eliminación</h4>
        </div>
        <div class="cajita-cuerpo">
            <p>¿Estás seguro de que quieres eliminar este movimiento? Al hacerlo, el stock del producto se actualizará.</p>
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
                <h4>Registro de Movimientos</h4>
                <h6>Gestiona tu Stock.</h6>
            </div>
            
            <div class="page-btn">
                <a href="<?php echo RUTA_URL; ?>/StockController/agregarMovimiento" class="btn btn-added">
                    <img src="<?php echo RUTA_URL; ?>/img/icons/plus.svg" alt="img">Añadir Movimiento
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
                                <th>Tipo de Movimiento</th>
                                <th>Cantidad</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($data['movimientos'])): ?>
                                <?php foreach ($data['movimientos'] as $movimiento_stock): ?>
                                    <tr>
                                        
                                        <td><?php echo htmlspecialchars($movimiento_stock->nombre_producto); ?></td>
                                        <td><?php echo htmlspecialchars($movimiento_stock->tipo_movimiento); ?></td>
                                        <td><?php echo htmlspecialchars($movimiento_stock->cantidad); ?></td>
                                        <td><?php echo date('d-m-Y H:i', strtotime($movimiento_stock->fecha_movimiento)); ?></td>                                
                                        <td>
                                        <a class="delete-icon" onclick="confirmarEliminacion(<?php echo $movimiento_stock->id_movimiento; ?>)">
                                                <img src="<?php echo RUTA_URL; ?>/img/icons/delete.svg" alt="img">
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center">No se encontraron movimientos.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let idMovimientoEliminar = null;
const cajita = document.getElementById('cajitaEliminar');

function confirmarEliminacion(id_movimiento) {
    console.log("Confirmar eliminación para ID:", id_movimiento); 
    idMovimientoEliminar = id_movimiento;
    cajita.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}


document.getElementById('botonConfirmar').addEventListener('click', function() {
    if (idMovimientoEliminar) {
        window.location.href = '<?php echo RUTA_URL; ?>/StockController/eliminarMovimiento/' + idMovimientoEliminar;
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
    idMovimientoEliminar = null;
    document.body.style.overflow = 'auto';
}


</script>



<?php require RUTA_APP . '/views/layout/dashboard/footer.php'; ?>
