<?php require RUTA_APP . '/views/layout/dashboard/header.php'; ?>
<?php require RUTA_APP . '/views/layout/dashboard/menu.php'; ?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Añadir Movimiento</h4>
                <h6>Completa la información del nuevo Registro de Stock.</h6>
            </div>
        </div>
        <div class="custom-card">
            <div class="custom-card-body">
                <form action="/appweb_cs_2c_2024/GRUPO7/Inventario/StockController/guardar" method="POST">
                    <div class="form-group">
                        <label for="id_producto">Producto</label>
                        <select name="id_producto" id="id_producto" class="form-control" required>
                            <option value="">Seleccione un Producto</option>
                            <?php foreach ($data['productos'] as $producto): ?>
                                <option value="<?php echo htmlspecialchars($producto->id_producto); ?>">
                                    <?php echo htmlspecialchars($producto->nombre_producto); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tipo_movimiento">Tipo de Movimiento</label>
                        <select name="tipo_movimiento" id="tipo_movimiento" class="form-control" required>
                            <option value="">Seleccione un tipo de movimiento</option>
                            <?php foreach ($data['tipos_movimiento'] as $value => $label): ?>
                                <option value="<?php echo htmlspecialchars($value); ?>">
                                    <?php echo htmlspecialchars($label); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input type="text" name="cantidad" id="cantidad" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Añadir Movimiento</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require RUTA_APP . '/views/layout/dashboard/footer.php'; ?>