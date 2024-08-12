<?php
class Home extends Controller
{
    public function __construct() {
        parent::__construct();
        session_start();
    }

    // Vista Principal
    public function index()
    {
        $data['perfil'] = 'no';
        $data['title'] = 'Pagina Principal';
        $data['categorias'] = $this->model->getCategorias();
        $data['nuevoProductos'] = $this->model->getNuevoSProductos();
        $this->views->getView('home', "index", $data);
    }
}