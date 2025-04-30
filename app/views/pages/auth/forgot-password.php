<?php require RUTA_APP . "/views/layout/auth/header.php";?>

<div class="container">



            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">¿Olvidaste la contraseña?</h1>
                                    <p class="mb-4">Ingresa tu email, y te enviaremos el link para generar una nueva.</p>
                                </div>
                                <form class="user" action="<?php echo RUTA_URL;?>/AuthController/enviar_password/"
                                    method="POST">
                                    <div class="form-group">
                                        <input name="email" type="email" class="form-control form-control-user"
                                            id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Email">
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Enviar
                                    </button>
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