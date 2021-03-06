<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\ProductStore;
use App\Http\Requests\ProductUpdate;

class ProductsController extends Controller
{
    public $status = 200;
    
    public function index(User $user)
    {
        //Para obtener todos los productos del usuario
        return response()->json(Product::products($user)->get());
    }

    public function store(ProductStore $request)
    {
        $create = function() use ($request){
			try{
                if($image = $request->file('file')){
                    $image_name = "MiTienditaLocalProduct".date("Y_m_d_H_i_s").".".$image->extension();
                    $image->move("ProductImages",$image_name);
                    $request['image'] = "ProductImages/". $image_name;
                }
				$product = Product::create($request->all());
				return 'Se ha creado correctamente';
			}catch(\Exception $e){
				dd($e);
				$this->status = 500;
				return 'Hubo un error al registrar, intentelo nuevamente';
			}
		};
	    return response()->json(['message' => \DB::transaction($create), 
        'status' => $this->status], $this->status);
    }

    //Funcion para editar los productos
    public function edit($id)
    {
        $product = Product::where('id', $id)->select('name', 'description', 
        'price','stock','cost', 'image', 'category')->first();
        if($product) return $product;
        else {
            $this->status = 404;
            return response()->json(['Message'=> 'Not found','status' => $this->status], $this->status);
        }
    }

    public function update(ProductUpdate $request, Product $product)
    {
        $actualizar = function() use ($request, $product){
			try{
                if($image = $request->file('file')){
                    $image_name = "MiTienditaLocalProduct".date("Y_m_d_H_i_s").".".$image->extension();
                    $image->move("ProductImages",$image_name);
                    $request['image'] = "ProductImages/". $image_name;
                }
                $product->fill($request->all());
                $product->save();
                $this->status = 200;
                return 'Se ha actualizado correctamente';
			}catch(\Exception $e){
				dd($e);
				$this->status = 500;
				return 'Hubo un error al registrar, intentelo nuevamente';
			}
		};
	    return response()->json(['message' => \DB::transaction($actualizar), 
        'status' => $this->status], $this->status);
    }

    //Funcion de eliminar productos 
    public function destroy(Product $product)
	{
		$eliminar = function() use ($product){
			try
            {
				$product->delete();
				return 'Se ha eliminado correctamente el producto';
			}catch(\Exception $e)
            {
				dd($e);
				$this->status = 500;
				return 'Hubo un error al eliminar, intentelo nuevamente';
			}
		};
		return response()->json(['message'=>\DB::transaction($eliminar), 'status' => $this->status]);
	}



}
