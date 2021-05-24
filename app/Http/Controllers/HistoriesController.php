<?php

namespace App\Http\Controllers;

use Auth;
use App\history;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\HistoryStore;
use App\Http\Requests\HistoryUpdate;


class HistoriesController extends Controller
{
    public $status = 200;

    public function index(User $user)
    {
        return response()->json(history::histories($user)->get());
    }

    public function store(HistoryStore $request)
    {
        $create = function() use ($request){
			try{
				$history = history::create($request->all());
				return 'Se ha creado correctamente';
			}catch(\Exception $e){
				dd($e);
				$this->status = 500;
				return 'Hubo un error al registrar, intentelo nuevamente';
			}
		};
	    return response()->json(['message' => \DB::transaction($create), 'status' => $this->status], $this->status);
    }
}
