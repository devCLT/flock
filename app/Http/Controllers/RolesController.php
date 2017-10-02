<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use DB;
use Session;


class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('manage.roles.index')->withRoles($roles);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
         return view('manage.roles.create')->withPermissions($permissions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'name' => 'required|max:100|alpha_dash|unique:roles,name',
            'disp_name' => 'required|max:255',
            'description' => 'max:255'
        ]);
            
        $role = new Role();
        $role->name = strtolower($request->name);
        $role->display_name = $request->disp_name;
        $role->description = $request->description;
        $role->save();
        
       if ($request->permissions_selected)
       {
        $role->syncPermissions(explode(',', $request->permissions_selected));
       }
       Session::flash('success', 'Created the new Role and new permissions');
       return redirect()->route('roles.show', $role->id);   

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::where('id', $id)->with('permissions')->first();
        return view('manage.roles.show')->withRole($role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::where('id', $id)->with('permissions')->first();
        $permissions = Permission::all();
        //dd([$role,$permissions]);
        return view('manage.roles.edit')->withRole($role)->withPermissions($permissions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $this->validate($request, [
        'disp_name' => 'required|max:255',
        'description' => 'sometimes|max:255'
        ]);

       $role = Role::findOrFail($id);
       $role->display_name = $request->disp_name;
       $role->description = $request->description;
       $role->save();


       if ($request->permissions_selected)
       {
          $role->syncPermissions(explode(',', $request->permissions_selected));
       }
       else
       {
          $role->syncPermissions([]);
       }
       Session::flash('success', 'Saved the Role and new permissions');
       return redirect()->route('roles.show', $id);   


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
