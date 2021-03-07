<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserStore;
use App\Http\Requests\UserUpdate;


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
				dd($e);
				$this->status = 500;
				return 'Hubo un error al registrar, intentelo nuevamente';
			}
		};
	    return response()->json(['message' => \DB::transaction($create), 'status' => $this->status], $this->status);
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->select('name', 'email', 'id as sku')->first();
        if($user) return $user;
        else {
            $this->status = 404;
            return response()->json(['Message'=> 'Not found','status' => $this->status], $this->status);
        }
    }

    public function update(UserUpdate $request, User $user)
    {
        $create = function() use ($request, $user){
			try{
				$user->fill($request->all());
				$user->save();
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
        //
    }
}
