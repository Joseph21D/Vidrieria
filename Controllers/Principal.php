<?php
class Principal extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    // Vista Principal
    public function index()
    {
    }

    // Vista About
    public function about()
    {
        $data['title'] = 'Sobre Nosotros';
        $this->views->getView('principal', "about", $data);
    }

    // Vista Tienda
    public function shop($page)
    {
        $pagina = (empty($page)) ? 1 : $page;
        $porpagina = 15;
        $desde = ($pagina - 1) * $porpagina;
        $data['title'] = 'Productos';
        $data['productos'] = $this->model->getProductos($desde, $porpagina);
        $data['pagina'] = $pagina;
        $total = $this->model->getTotalProductos();
        $data['total'] = ceil($total['total'] / $porpagina);
        $this->views->getView('principal', "shop", $data);
    }

    // Vista Detalle Producto
    public function detail($id_producto)
    {
        $data['producto'] = $this->model->getProducto($id_producto);
        $id_categoria = $data['producto']['id_categoria'];
        $data['relacionados'] = $this->model->getAleatorios($id_categoria, $data['producto']['id']);
        $data['title'] = $data['producto']['nombre'];
        $this->views->getView('principal', "detail", $data);
    }

    // Vista Categorias Producto
    public function categorias($datos)
    {
        $id_categoria = 1;
        $page = 1;
        $array = explode(',', $datos);
        if (isset($array[0])) {
            if (!empty($array[0])) {
                $id_categoria = $array[0];
            }
        }
        if (isset($array[1])) {
            if (!empty($array[1])) {
                $page = $array[1];
            }
        }
        $pagina = (empty($page)) ? 1 : $page;
        $porpagina = 15;
        $desde = ($pagina - 1) * $porpagina;

        $data['pagina'] = $pagina;
        $total = $this->model->getTotalProductosCat($id_categoria);
        $data['total'] = ceil($total['total'] / $porpagina);

        $data['productos'] = $this->model->getProductosCat($id_categoria, $desde, $porpagina);
        $data['title'] = 'Categorias';
        $data['id_categoria'] = $id_categoria;
        $this->views->getView('principal', "categorias", $data);
    }

    // Vista Contacto
    public function contact()
    {
        $data['title'] = '------------';
        $this->views->getView('principal', "contact", $data);
    }

    // Vista Lista Deseos
    public function deseo()
    {
        $data['title'] = 'Lista de Deseos';
        $this->views->getView('principal', "deseo", $data);
    }

    // Obtener Productos
    public function listaProductos()
    {
        $datos = file_get_contents("php://input");
        $json = json_decode($datos, true);
        $array['productos'] = array();
        $total = 0.00;
        foreach ($json as $producto) {
            $result = $this->model->getProducto($producto['idProducto']);
            $data['id'] = $result['id'];
            $data['nombre'] = $result['nombre'];
            $data['precio'] = $result['precio'];
            $data['cantidad'] = $producto['cantidad'];
            $data['imagen'] = $result['imagen'];
            $subTotal = $result['precio'] * $producto['cantidad'];
            $data['subTotal'] = number_format($subTotal, 2);
            array_push($array['productos'], $data);
            $total += $subTotal;
        }
        $array['total'] = number_format($total, 2);
        $array['totalPaypal'] = $total;
        $array['moneda'] = MONEDA;
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
        die();
    }
}
