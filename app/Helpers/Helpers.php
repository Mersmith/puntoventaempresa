<?php

use App\Models\Producto;
use App\Models\Medida;
use Gloudemans\Shoppingcart\Facades\Cart;

//Laravel incluye una variedad de funciones PHP "Helpers" globales. Muchas de estas funciones son utilizadas por el marco mismo.

/*A veces puede ser necesario eliminar un rol de un usuario.
Para eliminar un registro de relación de varios a varios, utilice el detach método.
El detach método eliminará el registro apropiado de la tabla intermedia; sin embargo, ambos modelos permanecerán en la base de datos.*/

/*Por ejemplo, imaginemos que un usuario puede tener muchos roles y un rol puede tener muchos usuarios.
Puede usar el attachmétodo para adjuntar un rol a un usuario insertando un registro en la tabla intermedia de la relación.*/

//Calculamos el stock de los productos
function calculandoStockProductos($producto_id, $color_id = null, $medida_id = null)
{
    $producto = Producto::find($producto_id);
    //Medida y Color
    if ($medida_id && $color_id) {
        $medida = Medida::find($medida_id);
        $cantidad = $medida->colores->find($color_id)->pivot->stock;
    }
    //Solo Medida
    elseif ($medida_id) {
        $cantidad = $producto->medida_producto->find($medida_id)->pivot->stock;
    }
    //Solo Color
    elseif ($color_id) {
        $cantidad = $producto->colores->find($color_id)->pivot->stock;
    }
    //Sin variación
    else {
        $cantidad = $producto->stock_total;
    }
    return $cantidad;
}

//Calculamos la cantidad de productos agregados
function calculandoProductosAgregados($producto_id, $color_id = null, $medida_id = null)
{
    $carrito = Cart::instance('shopping')->content();
    $item = $carrito->where('id', $producto_id)
        ->where('options.color_id', $color_id)
        ->where('options.medida_id', $medida_id)
        ->first();
    if ($item) {
        //dump("item->qty", $item->qty);
        return $item->qty;
    } else {
        //dump("0", 0);
        return 0;
    }
}

//Calculamos la cantidad que aun puedo agregar al carrito
function calculandoProductosDisponibles($producto_id, $color_id = null, $medida_id = null)
{
    //dump("producto_id", $producto_id);

    return calculandoStockProductos($producto_id, $color_id, $medida_id) - calculandoProductosAgregados($producto_id, $color_id, $medida_id);
}

//Actualizar en descontar el Stock
function stockActualizar($itemCarrito)
{
    $producto = Producto::find($itemCarrito->id);
    $calculandoProductosDisponibles = calculandoProductosDisponibles($itemCarrito->id, $itemCarrito->options->color_id, $itemCarrito->options->medida_id);

    //Medida y Color
    if ($itemCarrito->options->medida_id && $itemCarrito->options->color_id) {
        $medida = Medida::find($itemCarrito->options->medida_id);
        $medida->colores()->detach($itemCarrito->options->color_id);
        $medida->colores()->attach([
            $itemCarrito->options->color_id => ['stock' => $calculandoProductosDisponibles]
        ]);
    }

    //Solo Color
    elseif ($itemCarrito->options->color_id) {
        $producto->colores()->detach($itemCarrito->options->color_id);
        $producto->colores()->attach([
            $itemCarrito->options->color_id => ['stock' => $calculandoProductosDisponibles]
        ]);
    }

    //Solo Medida
    elseif ($itemCarrito->options->medida_id) {
        $producto->medida_producto()->detach($itemCarrito->options->medida_id);
        $producto->medida_producto()->attach([
            $itemCarrito->options->medida_id => ['stock' => $calculandoProductosDisponibles]
        ]);
    }

    //Sin variación
    else {
        $producto->stock_total = $calculandoProductosDisponibles;
        $producto->save();
    }
}

//Anular el Orden
function anularOrden($itemCarrito)
{
    $producto = Producto::find($itemCarrito->id);
    $calculandoStockProductos = calculandoStockProductos($itemCarrito->id, $itemCarrito->options->color_id, $itemCarrito->options->medida_id) + $itemCarrito->qty;

    //Medida y Color
    if ($itemCarrito->options->medida_id && $itemCarrito->options->color_id) {
        $medida = Medida::find($itemCarrito->options->medida_id);
        $medida->colores()->detach($itemCarrito->options->color_id);
        $medida->colores()->attach([
            $itemCarrito->options->color_id => ['stock' => $calculandoStockProductos]
        ]);
    }
    //Solo Medida
    elseif ($itemCarrito->options->medida_id) {
        $producto->medida_producto()->detach($itemCarrito->options->medida_id);
        $producto->medida_producto()->attach([
            $itemCarrito->options->medida_id => ['stock' => $calculandoStockProductos]
        ]);
    }
    //Solo Color
    elseif ($itemCarrito->options->color_id) {
        $producto->colores()->detach($itemCarrito->options->color_id);
        $producto->colores()->attach([
            $itemCarrito->options->color_id => ['stock' => $calculandoStockProductos]
        ]);
    }
    //Sin variación
    else {
        $producto->stock_total = $calculandoStockProductos;
        $producto->save();
    }
}
