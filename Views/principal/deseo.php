<?php include_once 'Views/template/header.php'; ?>

<!-- Start Content -->
<div class="container py-5">
    <div class="alert alert-success d-flex align-items-center" role="alert">
        <div class="h3">
            <?php echo ucfirst($data['title']); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body shadow-lg">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover align-middle" id = "tableListaDeseo" style="width: 100%">
                            <thead class="bg-success text-white">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Producto</th>
                                    <th class="text-center">Precio</th>
                                    <th class="text-center">Cantidad</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</div>
<!-- End Content -->

<?php include_once 'Views/template/footer.php'; ?>

<script src = "<?php echo BASE_URL . 'assets/js/modules/listaDeseo.js'; ?>"></script>

</body>

</html>