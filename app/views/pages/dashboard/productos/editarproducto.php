<?php require RUTA_APP . '/views/layout/dashboard/header.php'; ?> 
<?php require RUTA_APP . '/views/layout/dashboard/menu.php'; ?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Editar Producto</h4>
            </div>
        </div>
        
        
        <div class="custom-card">
            <div class="custom-card-body">
                <form action="<?php echo RUTA_URL; ?>/ProductoController/guardarCambiosProducto" method="POST">
                
                <input type="hidden" name="id_producto" value="<?php echo htmlspecialchars($data['producto']->id_producto); ?>">
                
                    <div class="form-group">
                        <label for="proveedor">Seleccionar Proveedor</label>
                        
                        <select name="id_proveedor" id="proveedor" class="form-control">
                        <option value="<?php echo htmlspecialchars($data['producto']->id_proveedor); ?>" selected>
                             <?php echo htmlspecialchars($data['producto']->proveedor); ?>
                        </option>

                            <?php foreach ($data['proveedores'] as $proveedor): ?>
                                <option value="<?php echo htmlspecialchars($proveedor->id_proveedor); ?>">
                                    <?php echo htmlspecialchars($proveedor->razon_social); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="codigo_producto">Código del Producto</label>
                        <input type="text" name="codigo_producto" id="codigo_producto" class="form-control" 
                        value="<?php echo ($data['producto']->codigo_producto); ?>" >
                    </div>
                    <div class="form-group">
                        <label for="nombre_producto">Nombre del Producto</label>
                        <input type="text" name="nombre_producto" id="nombre_producto" class="form-control" 
                        value="<?php echo ($data['producto']->nombre_producto); ?>" >
                    </div>

                    <div class="form-group">
                        <label for="categoria">Categoría</label>
                        

                        <select name="id_categoria" id="categoria" class="form-control" >
                        <option value="<?php echo htmlspecialchars($data['producto']->id_categoria); ?>" selected>
                            <?php echo htmlspecialchars($data['producto']->categoria); ?>
                         </option>

                            <?php foreach ($data['categorias'] as $categoria): ?>
                                <option value="<?php echo htmlspecialchars($categoria->id_categoria) ; ?>">
                                    <?php echo htmlspecialchars($categoria->nombre_categoria); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require RUTA_APP . '/views/layout/dashboard/footer.php'; ?>
