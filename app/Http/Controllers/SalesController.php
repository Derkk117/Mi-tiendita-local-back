<?php

namespace App\Http\Controllers;

use App\Sale;
use App\User;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\SaleStore;
use App\Http\Requests\SaleUpdate;


class SalesController extends Controller
{
	public $status = 200;

    public function index(User $user)
    {
        return response()->json(Sale::sales($user)->get());
    }

    public function store(SaleStore $request)
    {
        $create = function() use ($request){
			try{
				$sale = Sale::create($request->all());
				return 'Se ha creado correctamente';
			}catch(\Exception $e){
				dd($e);
				$this->status = 500;
				return 'Hubo un error al registrar, intentelo nuevamente';
			}
		};
	    return response()->json(['message' => \DB::transaction($create), 'status' => $this->status], $this->status);
    }
    
    //Edita los elementos de Sale

    public function edit(Sale $sale)
    {
        if($sale) return $sale;
        else return response()->json(['Message'=> 'Not found','status' => $this->status], $this->status);
    }
    
    public function update(SaleUpdate $request, Sale $sale)
    {
        $create = function() use ($request, $sale){
			try{
				$sale->fill($request->all());
				$sale->save();
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

	public function destroy(Sale $sale)
	{
		$create = function() use ($sale){
			try{
				$sale->delete();
				return 'Se ha eliminado correctamente';
			}catch(\Exception $e){
				dd($e);
				$this->status = 500;
				return 'Hubo un error al eliminar, intentelo nuevamente';
			}
		};
		return response()->json(['message'=>\DB::transaction($create), 'status' => $this->status]);
	}
    //Actualiza los elementos de Sale 
    /*public function update(SaleUpdate $request, Sale $sale)
    {
        $create = function() use ($request, $sale)
        {
            try{
				$sale->fill($request->all());
				$sale->save();
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

    }*/
}
