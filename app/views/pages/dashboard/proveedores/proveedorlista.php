<?php require RUTA_APP . '/views/layout/dashboard/header.php'; ?>
<?php require RUTA_APP . '/views/layout/dashboard/menu.php'; ?>



<!--esto es para la eliminacion del provedor-->
<div id="cajitaEliminar" class="cajita">
    <div class="cajita-contenido">
        <div class="cajita-encabezado">
            <h4>Confirmar Eliminación</h4>
        </div>
        <div class="cajita-cuerpo">
            <p>¿Estás seguro de que quieres eliminar este proveedor?</p>
            <div class="cajita-botones">
                <button id="botonConfirmar" class="boton-eliminar">Eliminar</button>
                <button id="botonCancelar" class="boton-cancelar">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!--se llama cuando se aprieta el icono de eliminar. su script es el único que está puesto en el footer. los scripts para elminar en los demás modulos están en su respectivo php, porque solo de esta manera funcionó-->




<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Lista de Proveedores</h4>
                <h6>Gestiona tus distribuidores.</h6>
            </div>
            <div class="page-btn">
                <a href="<?php echo RUTA_URL; ?>/ProveedorController/agregarProveedor" class="btn btn-added">
                    <img src="<?php echo RUTA_URL; ?>/img/icons/plus.svg" alt="img">Añadir Proveedor
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
                            <th>Razón Social</th>
                            <th>CUIT</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data['proveedores'])): ?>
                            <?php foreach ($data['proveedores'] as $proveedor): ?>
                                <tr>
                                    
                                    <td><?php echo htmlspecialchars($proveedor->razon_social); ?></td>
                                    <td><?php echo htmlspecialchars($proveedor->cuit); ?></td>
                                    <td><?php echo htmlspecialchars($proveedor->direccion); ?></td>
                                    <td><?php echo htmlspecialchars($proveedor->telefono); ?></td>
                                    <td><?php echo htmlspecialchars($proveedor->email); ?></td>
                                    <td>
                                        <a class="edit-icon" href="<?php echo RUTA_URL; ?>/ProveedorController/editarProveedor/<?php echo $proveedor->id_proveedor;?>">
                                            <img src="<?php echo RUTA_URL; ?>/img/icons/edit.svg" alt="Editar">
                                        </a>
                                        <a class="delete-icon" onclick="confirmarEliminacionProveedor(<?php echo $proveedor->id_proveedor; ?>);">
                                            <img src="<?php echo RUTA_URL; ?>/img/icons/delete.svg" alt="Eliminar">
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">No se encontraron proveedores.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>




<?php require RUTA_APP . '/views/layout/dashboard/footer.php'; ?>