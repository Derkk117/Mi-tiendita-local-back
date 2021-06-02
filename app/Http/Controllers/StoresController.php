<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Store;
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
                if($image = $request->file('logo')){
                    $image_name = "MTL_".date("Y_m_d_H_i_s").".".$image->extension();        
                    $image->move("StoreImages",$image_name);
                    $request['image'] = "StoreImages/". $image_name;
                }
                if($image = $request->file('thum')){
                    $image_name = "MTL_thum".date("Y_m_d_H_i_s").".".$image->extension();        
                    $image->move("StoreImages",$image_name);
                    $request['thumbnails'] = "StoreImages/". $image_name;
                }
                $store = Store::create($request->all());
                $user = User::where('id',$request->user_id)->first();
                $user->update(['store_id'=>$store->id]);
                return $user;
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