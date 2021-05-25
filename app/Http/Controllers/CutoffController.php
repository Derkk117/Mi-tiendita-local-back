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

    public function index()
    {
        return response()->json(Cutoff::cutoff()->get());
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