<?php require RUTA_APP . '/views/layout/dashboard/header.php'; ?>
<?php require RUTA_APP . '/views/layout/dashboard/menu.php'; ?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Añadir Producto</h4>
                <h6>Completa la información del nuevo producto.</h6>
            </div>
        </div>
        <div class="custom-card">
            <div class="custom-card-body">
                <form action="<?php echo RUTA_URL; ?>/ProductoController/guardar" method="POST">
                <?php if(isset($data['error'])): ?>
                    <div class="alert alert-danger">
                         <?php echo $data['error']; ?>
                    </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="proveedor">Seleccionar Proveedor</label>
                        <select name="id_proveedor" id="proveedor" class="form-control" required>
                            <option value="">Seleccione un Proveedor</option>

                            <?php foreach ($data['proveedores'] as $proveedor): ?>
                                <option value="<?php echo htmlspecialchars($proveedor->id_proveedor); ?>">
                                    <?php echo htmlspecialchars($proveedor->razon_social); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="codigo_producto">Código del Producto</label>
                        <input type="text" name="codigo_producto" id="codigo_producto" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nombre_producto">Nombre del Producto</label>
                        <input type="text" name="nombre_producto" id="nombre_producto" class="form-control" required>
                    </div>

                    <div class="form-group" style="display: none;">
                        <label for="cantidad">Cantidad</label>
                        <input type="hidden" name="cantidad" id="cantidad" class="form-control" value="0">
                    </div>


                    <div class="form-group">
                        <label for="categoria">Seleccionar Categoría</label>
                        <select name="id_categoria" id="categoria" class="form-control" required>
                            <option value="">Seleccione una Categoría</option>

                            <?php foreach ($data['categorias'] as $categoria): ?>
                                <option value="<?php echo htmlspecialchars($categoria->id_categoria); ?>">
                                    <?php echo htmlspecialchars($categoria->nombre_categoria); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <button type="submit" class="btn btn-primary">Añadir Producto</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require RUTA_APP . '/views/layout/dashboard/footer.php'; ?>