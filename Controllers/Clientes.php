<?php
class Clientes extends Controller
{
    public function __construct() {
        parent::__construct();
        session_start();
    }

    // Vista Principal
    public function index()
    {
        $data['title'] = 'Tu Perfil';
        $this->views->getView('principal', "perfil", $data);
    }
}