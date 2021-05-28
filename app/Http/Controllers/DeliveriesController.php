<?php

namespace App\Http\Controllers;

use App\Delivery;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\DeliveryStore;
use App\Http\Requests\DeliveryUpdate;


class DeliveriesController extends Controller
{
	public $status = 200;

    public function index(User $user)
    {
        return response()->json(Delivery::deliveries($user)->get());
    }

    public function create()
    {
        
    }

    public function store(DeliveryStore $request)
    {
        $create = function() use ($request){
			try{
				$delivery = Delivery::create($request->all());
				return 'Se ha creado correctamente';
			}catch(\Exception $e){
				dd($e);
				$this->status = 500;
				return 'Hubo un error al registrar, intentelo nuevamente';
			}
		};
	    return response()->json(['message' => \DB::transaction($create), 'status' => $this->status], $this->status);
    }
    
    //Editar campos de Delivery
    public function edit(Delivery $delivery)
    {
        if($delivery) return $delivery;
        else return response()->json(['Message'=> 'Not found','status' => $this->status], $this->status);
    }

    //Actualizar los campos de Sale 
    public function update(DeliveryUpdate $request, Delivery $delivery)
    {
        $create = function() use ($request, $delivery)
        {
            try{
				$delivery->fill($request->all());
				$delivery->save();
				$this->status = 200;
				return 'Se ha actualizado correctamente';
			}catch(\Exception $e){
				$this->status = 500;
				dd($e);
				return 'Hubo un error al actualizar, intentelo nuevamente';
			}
		};
		return response()->json(['message'=>\DB::transaction($create), 'status' => $this->status], $this->status);
    }

    public function destroy(Delivery $delivery)
    {
        $create = function() use ($delivery){
			try{
				$delivery->delete();
				return 'Se ha eliminado correctamente';
			}catch(\Exception $e){
				dd($e);
				$this->status = 500;
				return 'Hubo un error al eliminar, intentelo nuevamente';
			}
		};
		return response()->json(['message'=>\DB::transaction($create), 'status' => $this->status]);
    }
}