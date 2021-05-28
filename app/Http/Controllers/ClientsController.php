<?php

namespace App\Http\Controllers;

use Auth;
use App\Client;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\ClientStore;
use App\Http\Requests\ClientUpdate;


class ClientsController extends Controller
{
    public $status = 200;

    public function index(User $user)
    {
        return response()->json(Client::clients($user)->get());
    }

    public function store(ClientStore $request)
    {
        $create = function() use ($request){
			try{
				$client = Client::create($request->all());
				return 'Se ha creado correctamente';
			}catch(\Exception $e){
				dd($e);
				$this->status = 500;
				return 'Hubo un error al registrar, intentelo nuevamente';
			}
		};
	    return response()->json(['message' => \DB::transaction($create), 'status' => $this->status], $this->status);
    }

    public function edit(Client $client)
    {
        if($client) return $client;
        else return response()->json(['Message'=> 'Not found','status' => $this->status], $this->status);
    }

    public function update(ClientUpdate $request, Client $client)
    {
        $create = function() use ($request, $client){
			try{
				$client->fill($request->all());
				$client->save();
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

	public function destroy(Client $client)
	{
		$create = function() use ($client){
			try{
				$client->delete();
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
