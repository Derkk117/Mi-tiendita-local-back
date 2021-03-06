<?php

namespace App\Http\Controllers;
use App\Supplier;
use Auth;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\SupplierStore;
use App\Http\Requests\SupplierUpdate;


class SuppliersController extends Controller
{
	public $status = 200;

    public function index()
    {
        return response()->json(Supplier::suppliers()->get());
    }

    public function create()
    {
        //
    }

    public function store(SupplierStore $request)
    {
        $create = function() use ($request){
			try{
				$supplier = Supplier::create($request->all());
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
        $supplier = Supplier::where('id', $id)->select('name', 'last_name', 'phone','email','address')->first();
        if($supplier) return $supplier;
        else {
            $this->status = 404;
            return response()->json(['Message'=> 'Not found','status' => $this->status], $this->status);
        }
    }

    public function update(SupplierUpdate $request, Supplier $supplier)
    {
        $create = function() use ($request, $supplier){
            try{
                $supplier->fill($request->all());
                $supplier->save();
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

    public function destroy($id){
        
    }
}