<?php require RUTA_APP . "/views/layout/auth/header.php";?>
<div class="container">



            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Ingresar</h1>
                                </div>
                                <form id="loginForm" class="user" action="<?php echo RUTA_URL; ?>/AuthController/loginUsuario/"
                                    method="POST">
                                    <div class="form-group">
                                        <input name="email" type="email" class="form-control form-control-user"
                                            id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input name="pass" type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password" required>
                                    </div>
                                    <?php 
                                        if ($data['error_login']!=''){
                                           echo $data['error_login'];
                                        }
                                    ?>
                                <div class="text-center">
                                    <a class="small" href="<?php echo RUTA_URL;?>/AuthController/resetPassword">¿Olvidaste tu contraseña?</a>
                                </div>       
                                <hr>                             
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Continuar
                                    </button>

                                </form>
                                <hr>

                                <div class="text-center">
                                    <a class="small" href="<?php echo RUTA_URL;?>/AuthController/register"">Crear cuenta</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>