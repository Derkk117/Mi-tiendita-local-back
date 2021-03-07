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

    public function index()
    {
        return response()->json(Delivery::deliveries()->get());
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
    public function edit($id)
    {
        $delivery = Delivery::where('id', $id)->select('delivery_id', 'estimated_date', 'delivered_date', 'sale_id')->first();
        if($delivery) return $delivery;
        else {
            $this->status = 404;
            return response()->json(['Message'=> 'Not found','status' => $this->status], $this->status);
        }
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

    public function destroy($id)
    {

    }
}