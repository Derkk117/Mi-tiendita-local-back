<?php

namespace App\Http\Controllers;

use App\Address;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\AddressStore;
use App\Http\Requests\AddressUpdate;


class AddressesController extends Controller
{
	public $status = 200;

    public function index()
    {
        return response()->json(Address::addresses()->get());
    }

    public function create()
    {
        
    }

    public function store(AddressStore $request)
    {
        $create = function() use ($request){
			try{
				$address = Address::create($request->all());
				return 'Se ha creado correctamente';
			}catch(\Exception $e){
				dd($e);
				$this->status = 500;
				return 'Hubo un error al registrar, intentelo nuevamente';
			}
		};
	    return response()->json(['message' => \DB::transaction($create), 'status' => $this->status], $this->status);
    }
    
    
    public function edit($id)
    {
        $address = Address::where('id', $id)->select('street', 'street2', 'external_number','internal_number', 'neighborhood','country','state','zip_code')->first();
        if($address) return $address;
        else {
            $this->status = 404;
            return response()->json(['Message'=> 'Not found','status' => $this->status], $this->status);
        }
    }

    
    public function update(AddressUpdate $request, Address $address)
    {
        $create = function() use ($request, $address)
        {
            try{
				$address->fill($request->all());
				$address->save();
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
