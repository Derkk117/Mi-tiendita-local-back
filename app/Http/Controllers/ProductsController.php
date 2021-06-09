<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Auth;
use Illuminate\Support\Str;
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

    //Funcion de crear un nuevo producto    
    public function store(ProductStore $request)
    {
        $create = function() use ($request){
			try{
                if($picture = $request->file('photo')){
                    $image_name = "MTL_".date("Y_m_d_H_i_s").".".$picture->extension();        
                    $picture->move("ProductImages",$image_name);
                    $request['image'] = "ProductImages/". $image_name;
                }  
                $request['slug'] = Str::slug($request->name." ".$request->category, '_');
                $product = Product::create($request->all());
                return 'Se ha creado correctamente';
			}catch(\Exception $e){
				$this->status = 500;
				return 'Hubo un error al registrar, intentelo nuevamente';
				
			}
		};
	    return response()->json(['message' => \DB::transaction($create), 'status' => $this->status], $this->status);
    }

    //Funcion de actualizar un producto
    public function update(ProductUpdate $request, Product $product)
    {
        $actualizar = function() use ($request, $product){
			try{
                if($picture = $request->file('photo')){
                    $image_name = "MTL_".date("Y_m_d_H_i_s").".".$picture->extension();        
                    $picture->move("ProductImages",$image_name);
                    $request['image'] = "ProductImages/". $image_name;
                }                
                $request['slug'] = Str::slug($request->name." ".$request->category, '_');
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

    public function userImage($path){
        return response()->file("ProductImage/".$path);
    }

    //Funcion de eliminar productos en donde muestra un cuadro de dialogo 
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

     //Funcion que muestra los datos de los productos para poder editarlos
     public function edit($id)
     {
         $product = Product::where('id', $id)->select('name', 'description', 
         'price','stock','cost', 'image', 'category')->first();

         if($product) return $product;
         else {
             $this->status = 404;
             return response()->json(['Message'=> 'Not found','status' => 
             $this->status], $this->status);
         }
     }
}