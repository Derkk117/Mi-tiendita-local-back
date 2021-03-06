<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientStore;
use Illuminate\Http\Request;
use App\Client;
use Auth;


class ClientsController extends Controller
{
    public $status = 200;
    public function create()
    {
        //
    }

    public function store(ClientStore $request)
    {
        $create = function() use ($request){
			try{
				$client = Client::create($request->all());
				return 'Se ha creado correctamente';
			}catch(\Exception $e){
				//dd($e);
				$this->status = 500;
				return 'Hubo un error al registrar, intentelo nuevamente';
			}
		};
	    return response()->json(['message' => \DB::transaction($create), 'status' => $this->status], $this->status);
    }

    public function edit($id)
    {
        $client = Client::where('id', $id)->select('name', 'email', 'id as sku')->first();
        if($client) return $client;
        else {
            $this->status = 404;
            return response()->json(['Message'=> 'Not found','status' => $this->status], $this->status);
        }
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
}
