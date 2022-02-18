<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Http\Resources\RoleCollection;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * @Get("apii/roles")
     * @return RoleCollection
     */
    public function index()
    {
        $roles=Role::all();
        return new RoleCollection($roles);
    }

    /**
     * @Post("apii/roles")
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //Role::create($request->all());
        $role= new Role();
        $role->role=$request->get("role");
        $role->save();
    }

    /**
     * @Get("apii/roles/{id}")
     * @param $id
     * @return RoleResource
     */
    public function show($id)
    {
        $role=Role::find($id);
        return new RoleResource($role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {

        $role->role=$request->get("role");
        $role->save();
        return new RoleResource($role);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
    }

    /**
     * @return string
     * @Get("/amin")
     */
    public function addRole()
    {

        return  "successsssss";
    }



}
