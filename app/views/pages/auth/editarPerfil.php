<?php require RUTA_APP . '/views/layout/dashboard/header.php'; ?>
<?php require RUTA_APP . '/views/layout/dashboard/menu.php'; ?>



<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Editar Proveedor </h4>
            </div>
        </div>
        <div class="custom-card">
            <div class="custom-card-body">
                <form method="POST" action="<?php echo RUTA_URL . '/AuthController/actualizarPerfil' ?>">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $data['usuario']->nombre; ?>" required required title="El nombre debe estar conformado únicamente por letras." onkeypress="return soloLetras(event)">
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $data['usuario']->apellido; ?>" required title="El apellido debe estar conformado únicamente por letras." onkeypress="return soloLetras(event)">
                    </div>
                    <div class="form-group">
                        <label for="dni">DNI</label>
                        <input type="text" class="form-control" id="dni" name="dni" value="<?php echo $data['usuario']->dni; ?>" required pattern="\d{8}" title="El DNI debe tener 8 dígitos." onkeypress="return soloNumeros(event)">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $data['usuario']->email; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php require RUTA_APP . '/views/layout/dashboard/footer.php'; ?>