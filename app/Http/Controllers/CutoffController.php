<?php

namespace App\Http\Controllers;

use App\Cutoff;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\CutoffStore;
use App\Http\Requests\CutoffUpdate;


class CutoffController extends Controller
{
	public $status = 200;

<<<<<<< HEAD
    public function index(User $user)
    {
        return response()->json(Cutoff::cutoff($user)->get());
=======
    public function index()
    {
        return response()->json(Cutoff::cutoff()->get());
>>>>>>> 6dd2a2ab73b7bf32ee9c5768125df98427a7b31a
    }

    public function create()
    {
<<<<<<< HEAD

=======
        
>>>>>>> 6dd2a2ab73b7bf32ee9c5768125df98427a7b31a
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
<<<<<<< HEAD

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
=======
    
    //Edita los elementos de Cutoff
    public function edit($id)
    {
        $cutoff = Cutoff::where('id', $id)->select('initial_date', 'final_date', 'total')->first();
        if($cutoff) return $cutoff;
        else {
            $this->status = 404;
            return response()->json(['Message'=> 'Not found','status' => $this->status], $this->status);
        }
    }

    public function destroy($id)
    {

    }
}
>>>>>>> 6dd2a2ab73b7bf32ee9c5768125df98427a7b31a
