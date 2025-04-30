<?php require RUTA_APP . '/views/layout/dashboard/header.php'; ?>
<?php require RUTA_APP . '/views/layout/dashboard/menu.php'; ?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Añadir Orden de Compra</h4>
                <h6>Completa el siguiente formulario para agregar una nueva orden de compra.</h6>
            </div>
        </div>
        <div class="custom-card">
            <div class="custom-card-body">
                <form action="<?php echo RUTA_URL; ?>/OrdenController/agregarOrden" method="POST">
                    <div class="form-group">
                        <label for="proveedor">Proveedor:</label>
                        <select id="proveedor" name="id_proveedor" class="form-control" required>
                            <option value="">Selecciona un proveedor</option>
                            <?php foreach ($data['proveedores'] as $proveedor): ?>
                                <option value="<?php echo htmlspecialchars($proveedor->id_proveedor); ?>">
                                    <?php echo htmlspecialchars($proveedor->razon_social); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="hidden" id="id_usuario" name="id_usuario" class="form-control" value="<?php echo htmlspecialchars($_SESSION['id_usuario']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="nombre_producto">Nombre del Producto:</label>
                        <input type="text" id="nombre_producto" name="producto" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="cantidad">Cantidad:</label>
                        <input type="number" id="cantidad" name="cantidad" class="form-control" required min="1">
                    </div>

                    <div class="form-group">
                        <label for="fecha_orden">Fecha de Orden:</label>
                        <input type="datetime-local" id="fecha_orden" name="fecha_orden" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Agregar Orden de Compra</button>
                        <a href="<?php echo RUTA_URL; ?>/OrdenController/agregarOrden" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

<?php require RUTA_APP . '/views/layout/dashboard/footer.php'; ?>