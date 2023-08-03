<?php

namespace Controllers;

use Exception;
use Model\Producto;
use MVC\Router;

class ProductoController{
    public static function index(Router $router){
        $productos = Producto::all();
        // $productos2 = Producto::all();
        // var_dump($productos);
        // exit;
        $router->render('productos/index', [
            'productos' => $productos,
            // 'productos2' => $productos2,
        ]);

    }

    public static function guardarAPI(){
        try {
            $producto = new Producto($_POST);
            $resultado = $producto->crear();

            if($resultado['resultado'] == 1){
                echo json_encode([
                    'mensaje' => 'Registro guardado correctamente',
                    'codigo' => 1
                ]);
            }else{
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
            }
            // echo json_encode($resultado);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function buscarAPI(){
        // $productos = Producto::all();
        $producto_nombre = $_GET['producto_nombre'];
        $producto_precio = $_GET['producto_precio'];

        $sql = "SELECT * FROM productos where producto_situacion = 1 ";
        if($producto_nombre != '') {
            $sql.= " and producto_nombre like '%$producto_nombre%' ";
        }
        if($producto_precio != '') {
            $sql.= " and producto_precio = $producto_precio ";
        }
        try {
            
            $productos = Producto::fetchArray($sql);
    
            echo json_encode($productos);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function modificarAPI(){
        $producto_id = $_POST['producto_id'];
        $producto_nombre = $_POST['producto_nombre'];
        $producto_precio = $_POST['producto_precio'];
    
        try {
            // First, retrieve the product by its ID
            $producto = Producto::find($producto_id);
    
            if (!$producto) {
                echo json_encode([
                    'mensaje' => 'Producto no encontrado',
                    'codigo' => 0
                ]);
                return;
            }
    
            // Update the product data with the new values
            $producto->producto_nombre = $producto_nombre;
            $producto->producto_precio = $producto_precio;
    
            // Save the changes to the database
            $resultado = $producto->guardar();
    
            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro modificado correctamente',
                    'codigo' => 1
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error al modificar el registro',
                    'codigo' => 0
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }


    public static function eliminarAPI(){
        $producto_id = $_POST['producto_id'];
    
        try {
            // First, retrieve the product by its ID
            $producto = Producto::find($producto_id);
    
            if (!$producto) {
                echo json_encode([
                    'mensaje' => 'Producto no encontrado',
                    'codigo' => 0
                ]);
                return;
            }
    
            // Delete the product from the database
            $resultado = $producto->eliminar();
    
            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro eliminado correctamente',
                    'codigo' => 1
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error al eliminar el registro',
                    'codigo' => 0
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
}
