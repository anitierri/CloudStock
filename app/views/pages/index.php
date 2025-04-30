<?php require RUTA_APP . '/views/layout/landing/header.php'; ?>
<header class="masthead">
        <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
            <div class="d-flex justify-content-center">
                <div class="text-center">
                    <h1 class="mx-auto my-0 text-uppercase">CloudStock</h1>
                    <h2 class="text-white-50 mx-auto mt-2 mb-5">Tu inventario: menos estrés, más eficiencia.</h2>
                    <a class="btn btn-primary" href="<?php echo RUTA_URL; ?>/AuthController/login">Iniciar sesión</a>
                </div>
            </div>
        </div>
    </header>

<script>
    if (window.history && window.history.pushState) {
        window.history.pushState(null, null, window.location.href);
        
        window.onpopstate = function () {
            window.history.pushState(null, null, window.location.href);
        };
    }
</script>



<?php require RUTA_APP . '/views/layout/landing/footer.php'; ?>