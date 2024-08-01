<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-cart-arrow-down"></i> Carrito</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle" id="tableListaCarrito">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>SubTotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <h3 id="totalGeneral"></h3>
                <a class="btn btn-outline-primary" href="<?php echo BASE_URL . 'clientes'; ?>">Procesar</a>
            </div>
        </div>
    </div>
</div>

<!-- Start Login -->
<div id="modalLogin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="titleLogin">Iniciar Sesión</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body m-3">
                <form method="get" action="">
                    <div class="text-center">
                        <img class="img-thumbnail rounded-circle" src="<?php echo BASE_URL . 'assets/img/icono.png'; ?>" alt="" width="100">
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="frmLogin">
                            <div class="form-group mb-3">
                                <label for="correoLogin"><i class="fas fa-envelope"></i> Correo</label>
                                <input id="correoLogin" class="form-control" type="text" name="correoLogin" placeholder="Correo Electrónico">
                            </div>
                            <div class="form-group mb-3">
                                <label for="claveLogin"><i class="fas fa-key"></i> Contraseña</label>
                                <input id="claveLogin" class="form-control" type="text" name="claveLogin" placeholder="Contraseña">
                            </div>
                            <a href="#" id="btnRegister">¿Todavia no tienes Cuenta?</a>
                            <div class="float-end">
                                <button class="btn btn-primary btn-lg" type="button">Ingresar</button>
                            </div>
                        </div>
                        <!-- Formulario Registro -->
                        <div class="col-md-12 d-none" id="frmRegister">
                            <div class="form-group mb-3">
                                <label for="nombreRegistro"><i class="fas fa-list"></i> Nombre</label>
                                <input id="nombreRegistro" class="form-control" type="text" name="nombreRegistro" placeholder="Nombre Completo">
                            </div>
                            <div class="form-group mb-3">
                                <label for="correoRegistro"><i class="fas fa-envelope"></i> Correo</label>
                                <input id="correoRegistro" class="form-control" type="text" name="correoRegistro" placeholder="Correo Electrónico">
                            </div>
                            <div class="form-group mb-3">
                                <label for="claveRegistro"><i class="fas fa-key"></i> Contraseña</label>
                                <input id="claveRegistro" class="form-control" type="text" name="claveRegistro" placeholder="Contraseña">
                            </div>
                            <a href="#" id="btnLogin">¿Ya tienes Cuenta?</a>
                            <div class="float-end">
                                <button class="btn btn-primary btn-lg" type="button" id="registrarse">Registrarse</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Login -->

<!-- Start Footer -->
<footer class="bg-dark" id="tempaltemo_footer">
    <div class="container">
        <div class="row">

            <div class="col-md-4 pt-5">
                <h2 class="h2 text-success border-bottom pb-3 border-light logo">VVelasquez</h2>
                <ul class="list-unstyled text-light footer-link-list">
                    <li>
                        <i class="fas fa-map-marker-alt fa-fw"></i>
                        Av. Tomás Valle 1075
                    </li>
                    <li>
                        <i class="fa fa-phone fa-fw"></i>
                        <a class="text-decoration-none" href="tel:010-020-0340">999-888-777</a>
                    </li>
                    <li>
                        <i class="fa fa-envelope fa-fw"></i>
                        <a class="text-decoration-none" href="mailto:info@company.com">velasquez@company.com</a>
                    </li>
                </ul>
            </div>

            <div class="col-md-4 pt-5">
                <h2 class="h2 text-light border-bottom pb-3 border-light">Productos</h2>
                <ul class="list-unstyled text-light footer-link-list">
                    <li><a class="text-decoration-none" href="#">Espejos</a></li>
                    <li><a class="text-decoration-none" href="#">Fachadas</a></li>
                    <li><a class="text-decoration-none" href="#">Seguridad</a></li>
                    <li><a class="text-decoration-none" href="#">Hogar</a></li>
                    <li><a class="text-decoration-none" href="#">Decoración</a></li>
                    <li><a class="text-decoration-none" href="#">Accesorios</a></li>
                    <li><a class="text-decoration-none" href="#">Limpieza</a></li>
                </ul>
            </div>

            <div class="col-md-4 pt-5">
                <h2 class="h2 text-light border-bottom pb-3 border-light">Información</h2>
                <ul class="list-unstyled text-light footer-link-list">
                    <li><a class="text-decoration-none" href="#">Principal</a></li>
                    <li><a class="text-decoration-none" href="#">Sobre Nosotros</a></li>
                    <li><a class="text-decoration-none" href="#">Ubícanos</a></li>
                    <li><a class="text-decoration-none" href="#">Preguntas Frecuentes</a></li>
                    <li><a class="text-decoration-none" href="#">Contáctanos</a></li>
                </ul>
            </div>

        </div>

        <div class="row text-light mb-4">
            <div class="col-12 mb-3">
                <div class="w-100 my-3 border-top border-light"></div>
            </div>
            <div class="col-auto me-auto">
                <ul class="list-inline text-left footer-icons">
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="http://facebook.com/"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                    </li>
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="https://www.instagram.com/"><i class="fab fa-instagram fa-lg fa-fw"></i></a>
                    </li>
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="https://twitter.com/"><i class="fab fa-twitter fa-lg fa-fw"></i></a>
                    </li>
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="https://www.linkedin.com/"><i class="fab fa-linkedin fa-lg fa-fw"></i></a>
                    </li>
                </ul>
            </div>
            <div class="col-auto">
                <label class="sr-only" for="subscribeEmail">Correo Electrónico</label>
                <div class="input-group mb-2">
                    <input type="text" class="form-control bg-dark border-light" id="subscribeEmail" placeholder="Correo Electrónico">
                    <div class="input-group-text btn-success text-light">Suscribirse</div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-100 bg-black py-3">
        <div class="container">
            <div class="row pt-2">
                <div class="col-12">
                    <p class="text-left text-light">
                        Copyright &copy; 2021 Vidrieria Velasquez
                    </p>
                </div>
            </div>
        </div>
    </div>

</footer>
<!-- End Footer -->

<!-- Start Script -->
<script src="<?php echo BASE_URL . 'assets/js/jquery-1.11.0.min.js'; ?> "></script>
<script src="<?php echo BASE_URL . 'assets/js/jquery-migrate-1.2.1.min.js'; ?> "></script>
<script src="<?php echo BASE_URL . 'assets/js/bootstrap.bundle.min.js'; ?> "></script>
<script src="<?php echo BASE_URL . 'assets/js/templatemo.js'; ?> "></script>
<script src="<?php echo BASE_URL . 'assets/js/custom.js'; ?> "></script>
<script src="<?php echo BASE_URL . 'assets/js/sweetalert2.all.min.js'; ?> "></script>
<script>
    const base_url = '<?php echo BASE_URL; ?>';
</script>
<script src="<?php echo BASE_URL . 'assets/js/carrito.js'; ?> "></script>
<script src="<?php echo BASE_URL . 'assets/js/login.js'; ?> "></script>
<!-- End Script -->