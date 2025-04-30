<?php require RUTA_APP . '/views/layout/dashboard/header.php'; ?>
<?php require RUTA_APP . '/views/layout/dashboard/menu.php'; ?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Añadir Proveedor</h4>
                <h6>Completa la información del nuevo proveedor.</h6>
            </div>
        </div>
        <div class="custom-card">
            <div class="custom-card-body">
                <form action="<?php echo RUTA_URL; ?>/ProveedorController/guardar" method="POST">
                    <div class="form-group">
                        <label for="razon_social">Razón Social</label>
                        <input type="text" name="razon_social" id="razon_social" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="cuit">CUIT</label>
                        <input type="text" name="cuit" id="cuit" class="form-control" required pattern="\d{11}" title="El CUIT debe tener 11 dígitos." onkeypress="return soloNumeros(event)">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" name="direccion" id="direccion" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" required pattern="^[+\d][0-9\s]{8,24}$" title="El teléfono debe tener el código de área." onkeydown="return soloNumeros(event)">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Añadir Proveedor</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require RUTA_APP . '/views/layout/dashboard/footer.php'; ?>
