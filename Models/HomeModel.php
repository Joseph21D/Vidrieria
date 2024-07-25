<?php
class HomeModel extends Query{
 
    public function __construct()
    {
        parent::__construct();
    }

    public function getCategorias()
    {
        $sql = "SELECT * FROM categorias";
        $categorias = $this->selectAll($sql);
        return $categorias;
    }

    public function getNuevoSProductos()
    {
        $sql = "SELECT * FROM productos ORDER BY id DESC LIMIT 12";
        $prodcutos = $this->selectAll($sql);
        return $prodcutos;
    }
}
 
?>