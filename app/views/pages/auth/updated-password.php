<?php require RUTA_APP . "/views/layout/auth/header.php";?>

<div class="container">



            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">Restablecer contraseña</h1>
                                </div>
                                <hr>
                                <form class="user" action="<?php echo RUTA_URL;?>/AuthController/actualizar_password/"
                                    method="POST">
                                    <div class="form-group">
                                        <input name="email" type="email" class="form-control form-control-user mt-2"
                                            id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Tu email">
                                        <input name="pass_actual" type="password"
                                            class="form-control form-control-user mt-2" id="exampleInputEmail"
                                            aria-describedby="emailHelp" placeholder="Contraseña actual">
                                        <input name="pass_nueva" type="password"
                                            class="form-control form-control-user mt-2" id="exampleInputEmail"
                                            aria-describedby="emailHelp" placeholder="Nueva Contraseña">
                                        <input name="pass_nueva2" type="password"
                                            class="form-control form-control-user mt-2" id="exampleInputEmail"
                                            aria-describedby="emailHelp" placeholder="Repetir nueva contraseña" required>
                                    </div>
                                    <?php
                                        if ($data['error_pass']!=''){
                                            echo $data['error_pass'];
                                        }
                                    ?>
                                    <hr>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Guardar
                                    </button>
                                    <hr>
                                    <div class="text-center mb-2">
                                        <a class="small" href="<?php echo RUTA_URL;?>/AuthController/login">Iniciar sesión</a>
                                    </div>
                                </form>
                                
                                <?php if ($data['mail'] != ''){
                                    echo $data['mail'];
                                }
                                ?>
                                <?php if ($data['error_mail'] != ''){
                                    echo $data['error_mail'];
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>