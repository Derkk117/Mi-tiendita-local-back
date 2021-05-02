<?php

namespace App\Http\Controllers;

use App\Store;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreStore;
use App\Http\Requests\StoreUpdate;

class StoresController extends Controller{

    public $status =200;

    public function index(){
        return response()->json(Store::stores()->get());
    }

    public function create()
    {
        
    }
    
    public function store(StoreStore $request){
        $create = function() use ($request){
            try{
                $store = Store::create($request->all());
                return 'Tienda creada';
            }catch(\Exception $e){
                dd($e);
                $this->status=500;
                return 'Error al registrar';
            }
        };
        return response()->json(['message' => \DB::transaction($create), 'status' => $this->status], $this->status);
    }

    public function edit($id){
        $store=Store::where('id',$id)->select('name','thumbnails','image','address','phone')->first();
        if($store) return $store;
        else{
            $this->status=404;
            return response()->json(['Message'=> 'Not found','status' => $this->status], $this->status);
        }
    }

    public function update(StoreUpdate $request, Store $store){
        $create =function() use ($request, $store){
            try{
                $store->fill($request-all());
                $store->save();
                $this->status=200;
                return 'actualizada correctamente';
            }catch(\Exception $e){
                $this->status =500;
                dd($e);
                return 'Error al actualizar';
            }
        };
        return response()->json(['message'=>\DB::transaction($create), 'status' => $this->status], $this->status);
    }
}

?>