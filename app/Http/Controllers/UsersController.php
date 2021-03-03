<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\UserStore;


class UsersController extends Controller
{
	public $status = 200;

    public function index()
    {
        return response()->json(User::users()->get());
    }

    public function create()
    {
        //
    }

    public function store(UserStore $request)
    {
        $create = function() use ($request){
			try{
				$user = User::create($request->all());
				return 'Se ha creado correctamente';
			}catch(\Exception $e){
				//dd($e);
				$this->status = 500;
				return 'Hubo un error al registrar, intentelo nuevamente';
			}
		};
	    return response()->json(['message' => \DB::transaction($create), 'status' => $this->status], $this->status);
    }

    public function showLoggedUser()
    {
        return Auth::user()->select('name', 'email', 'image', 'id as sku')->first();
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
