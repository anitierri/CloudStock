<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>CloudStock</title>
    <link rel="icon" type="image/png" href="<?php echo RUTA_URL; ?>/img/icono.png" />

    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>/css/cajitaEliminar.css">
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>/css/tablas.css">
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>/css/animate.css">
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>/css/styleDashboard.css">
    
</head>

<body>
    <div id="global-loader">
    <div class="whirly-loader"> </div>
    </div>

    <div class="main-wrapper">

    <div class="header">

    <div class="header-left active">
    <a href="<?php echo RUTA_URL; ?>/StockController/index" class="logo">
    <img src="<?php echo RUTA_URL; ?>/img/logo.png" alt=""style="width: 200px; height: auto;">
    </a>
    <a href="<?php echo RUTA_URL; ?>/StockController/index" class="logo-small">
    <img src="<?php echo RUTA_URL; ?>/img/logo.png" alt=""style="width: 120px; height: auto;">
    </a>
    <a id="toggle_btn" href="<?php echo RUTA_URL; ?>/StockController/index">
    </a>
    </div>

    <a id="mobile_btn" class="mobile_btn" href="#sidebar">
    <span class="bar-icon">
    <span></span>
    <span></span>
    <span></span>
    </span>
    </a>

    <ul class="nav user-menu">




    <li class="nav-item dropdown has-arrow main-drop">
    <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
    <span class="user-img"><img src="<?php echo RUTA_URL; ?>/img/icono.png" alt="">
    <span class="status online"></span></span>
    </a>

    <div class="dropdown-menu menu-drop-user">
    <div class="profilename">
    <div class="profileset">
    <span class="user-img"><img src="<?php echo RUTA_URL; ?>/img/icono.png" alt="">
    <span class="status online"></span></span>
    <div class="profilesets">
    <h6> 
         <?php
         echo isset($_SESSION['nombre']) ? htmlspecialchars($_SESSION['nombre']) : 'Usuario Desconocido'; 
         ?> 
    </h6>
    <h5>Empleado</h5>
    </div>
    </div>
    <hr class="m-0">
    <a class="dropdown-item" href="<?php echo RUTA_URL; ?>/AuthController/editarPerfil"> <i class="me-2" data-feather="user"></i>Mi Perfil</a>
    <hr class="m-0">
    <a class="dropdown-item logout pb-0" href="<?php echo RUTA_URL; ?>/AuthController/logout">
    <img src="<?php echo RUTA_URL; ?>/img/icons/log-out.svg" class="me-2" alt="img">Cerrar Sesión
</a>
    </div>
    </div>
    </li>
    </ul>


    <div class="dropdown mobile-user-menu">
    <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-ellipsis-v"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="profile.html">Mi Perfil</a>
        <a class="dropdown-item" href="<?php echo RUTA_URL; ?>/AuthController/logout">Cerrar Sesión</a>
    </div>
</div>
    </div>

    </div>