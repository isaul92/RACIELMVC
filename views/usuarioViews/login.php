<?php if (!isset($_SESSION["identity"])): ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card divLogin">
                    <div class="card-header text-center">Iniciar sesion</div>

                    <div class="card-body d-flex justify-content-center">
                        <form action="<?= base_url ?>usuario/login" method="POST">

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label  text-md-right">Direccion de correo</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"  name="email" class="form-control" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">

                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn bg-light inicionSesion">
                                            Iniciar Sesion
                                        </button>

                                        <a class="btn " href="{{ route('password.request') }}">
                                            ¿Olvidaste tu contraseña?
                                        </a>
                                    </div>
                                </div>
                      
                    </div>
                              </form>
                </div>
            </div>
        </div>
    </div>

<?php else: ?>

    <?php header('Location' . base_url) ?>
<?php endif; ?>
