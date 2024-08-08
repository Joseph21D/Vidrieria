<?php include_once 'Views/template/header.php'; ?>
<!-- Start Banner Hero -->
<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="<?php echo BASE_URL . 'assets/img/templado.png'; ?> " alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left align-self-center">
                            <h1 class="h1">Vidrios Templados</h1>
                            <h3 class="h2">Dureza y Seguridad</h3>
                            <p>
                                Nuestros Cristales Templados de alta seguridad representan una nueva alternativa para llevar a cabo los diversos proyectos de nuestros clientes.
                                Convirtiéndonos así en su principal socio estratégico, ofreciéndoles <strong>mejor tiempo de entrega a precios altamente competitivos.</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="<?php echo BASE_URL . 'assets/img/laminado.png'; ?> " alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">
                            <h1 class="h1">Vidrios Laminados</h1>
                            <h3 class="h2">Protección Acústica</h3>
                            <p>
                                Este tipo de Vidrio se encuentra conformado por la unión de paños de vidrio a los cuales se les intercala Polivinil Butiral (PVB).
                                Este complemento posee una gran resistencia elástica y resistencia al calor y la presión.
                                El resultado final es un cristal adaptable de <strong>alta resistencia y gran rendimiento.</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="<?php echo BASE_URL . 'assets/img/espejo.png'; ?> " alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">
                            <h1 class="h1">Espejos</h1>
                            <h3 class="h2">Cristales Incoloros</h3>
                            <p>
                                Nuestros espejos son elaborados a través de parámetros de <strong>alto desempeño</strong>, lo que nos permite garantizar
                                su <strong>buen performance decorativo, visual y luminoso.</strong> Esto los convierte en una excelente opción al
                                momento de modelar ambientes interiores, salas de hogar, baños, oficinas, entre otros.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
        <i class="fas fa-chevron-left"></i>
    </a>
    <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
        <i class="fas fa-chevron-right"></i>
    </a>
</div>
<!-- End Banner Hero -->


<!-- Start Categories of The Month -->
<section class="container py-5">
    <div class="row text-center pt-3">
        <div class="col-lg-6 m-auto">
            <h1 class="h1">Categorias del Mes</h1>
            <p></p>
            <p>
                <strong>¡Bienvenido a nuestra vidriería, donde la calidad y la innovación se encuentran con el diseño!</strong>
            </p>
            <p>
                En nuestra vidriería, ofrecemos una amplia gama de productos de vidrio y espejos para satisfacer todas tus necesidades, ya sea para tu hogar, oficina o proyectos comerciales.
            </p>
        </div>
    </div>
    <div class="row">
        <?php foreach ($data['categorias'] as $categoria) { ?>
            <div class="col-12 col-md-3 p-5 mt-3">
                <a href="<?php echo BASE_URL . 'principal/categorias/' . $categoria['id']; ?>"><img src="<?php echo $categoria['imagen']; ?> " class="rounded-circle img-fluid border"></a>
                <h5 class="text-center mt-3 mb-3"><?php echo $categoria['categoria'] ?></h5>
                <p class="text-center"><a class="btn btn-success" href="<?php echo BASE_URL . 'principal/categorias/' . $categoria['id']; ?>">Productos</a></p>
            </div>
        <?php } ?>
    </div>
</section>
<!-- End Categories of The Month -->


<!-- Start Featured Product -->
<section class="bg-light">
    <div class="container py-5">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Productos Destacados</h1>
                <p>
                    En esta sección, encontrarás una variedad de vidrios y espejos de alta calidad, ideales para embellecer cualquier espacio. ¡Explora y elige lo que más te inspire!
                </p>
            </div>
        </div>
        <div class="row">
            <?php foreach ($data['nuevoProductos'] as $producto) { ?>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                        <a href="<?php echo BASE_URL . 'principal/detail/' . $producto['id']; ?>">
                            <img src="<?php echo $producto['imagen']; ?>" class="card-img-top" alt="<?php echo $producto['nombre']; ?>">
                        </a>
                        <div class="card-body">
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                </li>
                                <li class="text-muted text-right"><?php echo MONEDA . ' ' . $producto['precio']; ?></li>
                            </ul>
                            <a href="<?php echo BASE_URL . 'principal/detail/' . $producto['id']; ?>" class="h2 text-decoration-none text-dark"><?php echo $producto['nombre']; ?></a>
                            <p class="card-text">
                                <?php echo $producto['descripcion']; ?>
                            </p>
                            <p class="text-muted">Reseñas (24)</p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- End Featured Product -->
<?php include_once 'Views/template/footer.php'; ?>
</body>

</html>