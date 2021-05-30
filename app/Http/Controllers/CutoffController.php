<?php

namespace App\Http\Controllers;

use Auth;
use App\Cutoff;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\CutoffStore;
use App\Http\Requests\CutoffUpdate;


class CutoffController extends Controller
{
	public $status = 200;

    public function index(User $user)
    {
        return response()->json(Cutoff::cutoff($user)->get());
    }

    public function create()
    {

    }

    public function store(CutoffStore $request)
    {
        $create = function() use ($request){
			try{
				$cutoff = Cutoff::create($request->all());
				return 'Se ha creado correctamente';
			}catch(\Exception $e){
				dd($e);
				$this->status = 500;
				return 'Hubo un error al registrar, intentelo nuevamente';
			}
		};
	    return response()->json(['message' => \DB::transaction($create), 'status' => $this->status], $this->status);
    }

    //Edita los elementos de Cutoff
    public function edit(Cutoff $cutoff)
    {
        if($cutoff) return $cutoff;
        else return response()->json(['Message'=> 'Not found','status' => $this->status], $this->status);
    }

    public function update(CutoffUpdate $request, Cutoff $cutoff)
    {
        $create = function() use ($request, $cutoff){
			try{
				$cutoff->fill($request->all());
				$cutoff->save();
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

	public function destroy(Cutoff $cutoff)
	{
		$create = function() use ($cutoff){
			try{
				$cutoff->delete();
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