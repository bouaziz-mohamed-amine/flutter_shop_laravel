<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Http\Resources\UsersResource;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * @return UsersResource
     */
    public function index()
    {
        $users= User::all();
        return new UserCollection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hashed = Hash::make($request->password, [
            'rounds' => 12,
        ]);
        User::create([
            "name"=> $request->get("name"),
            "email"=> $request->get("email"),
            "password"=>$hashed
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //$user->update($request->all());
        if ($request->has("email")){

            $user->email=$request->get('email');
        }
        $user->save();

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->delete();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function login(Request $request){

        $user=User::where('email','=',$request->get('email'))->first();
        if (Hash::check($request->get('password'), $user->password)) {
            // The passwords match...
            $user->roles;
            return new UserResource($user);
        }else
            return response('not found',404);

    }
    /**
     * @param $userId
     * @param $roleId
     * @return string
     */
    public function addRoleToUser($userId,$roleId)
    {
        $user=User::find($userId);
        $role=Role::find($roleId);
        $user->roles()->attach($role);
        return  response(["message"=>"success"]);
    }

}
