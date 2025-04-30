<script src="<?php echo RUTA_URL; ?>/js/script1.js"></script>
<script src="<?php echo RUTA_URL; ?>/js/script2.js"></script>
<script src="<?php echo RUTA_URL; ?>/js/script3.js"></script>
<script src="<?php echo RUTA_URL; ?>/js/jquery.slimscroll.min.js"></script>
<script src="<?php echo RUTA_URL; ?>/js/bootstrap.bundle.min.js"></script>


<!--VALIDACIONED para agregar cualquier elemento (producto, proveedor...etc.)-->
<script>
function soloNumeros(event) {
    const keyCode = event.keyCode || event.which;
    const teclaPresionada = String.fromCharCode(keyCode);
    const valorActual = event.target.value;
    
    if (event.ctrlKey || event.altKey || keyCode < 32) {
        return true;
    }
    
    if (keyCode === 43) { 
        return valorActual.length === 0;
    }
    
    if ((keyCode >= 48 && keyCode <= 57) || 
        keyCode === 32) { 
        return true;
    }
    
    event.preventDefault();
    return false;
}


function soloLetras(event) {
    const keyCode = event.keyCode ? event.keyCode : event.which;

    return (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || keyCode === 32 || keyCode === 8;
}


document.getElementById('razon_social').addEventListener('keypress', soloLetras);

document.getElementById('addSupplierForm').addEventListener('submit', function(event) {
    const razonSocial = document.getElementById('razon_social').value;
    const cuit = document.getElementById('cuit').value;
    const direccion = document.getElementById('direccion').value;
    const telefono = document.getElementById('telefono').value;
    const email = document.getElementById('email').value;

    if (!razonSocial || !cuit || !direccion || !telefono || !email) {
        alert("Todos los campos son obligatorios.");
        event.preventDefault(); 
        
    }
});
</script>

<!--BUSCAR elementos en la tabla-->
<script>
        document.getElementById('searchInput').addEventListener('input', function() {
        let searchTerm = this.value.toLowerCase();
        let rows = document.querySelectorAll('#buscarEnTabla tbody tr');
        
        rows.forEach(row => {
            let columns = row.getElementsByTagName('td');
            let match = false;
            
            for (let i = 0; i < columns.length; i++) {
                if (columns[i].textContent.toLowerCase().includes(searchTerm)) {
                    match = true;
                    break;
                }
            }
            
            row.style.display = match ? '' : 'none';
        });
    });
</script>


<!--eliminar un determinado proveedor-->
<script>let idProveedorEliminar = null;
const cajita = document.getElementById('cajitaEliminar');

function confirmarEliminacionProveedor(id) {
    idProveedorEliminar = id;
    cajita.style.display = 'flex';
    document.body.style.overflow = 'hidden'; 
}

document.getElementById('botonConfirmar').addEventListener('click', function() {
    if (idProveedorEliminar) {
        window.location.href = '<?php echo RUTA_URL; ?>/ProveedorController/borrarProveedor/' + idProveedorEliminar;
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
    idProveedorEliminar = null;
    document.body.style.overflow = 'auto'; 
}
</script>

</body>
</html>    