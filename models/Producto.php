<?php

namespace Model;

class Producto extends ActiveRecord{
    public static $tabla = 'productos';
    public static $columnaDB = ['producto_nombre','producto_precio', 'producto_situacion'];
    public static $idTabla = 'producto_id';

    public $producto_id;
    public $producto_nombre;
    public $producto_precio;
    public $producto_situacion;

    
    
}