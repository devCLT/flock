<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use DB;
use Session;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('manage.permissions.index')->withPermissions($permissions);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->permission_options == 'basic')
        {
           return $this->store_one($request);
        }
        elseif ($request->permission_options == 'crud')
        {
           return $this->store_crud($request);
        }
        else
        {
            redirect()->route('permissions.create')->withInput();
        }

    }


    protected function store_one(Request $request)
    {        
          $this->validate($request, [
            'name' => 'required|max:255',
            'disp_name' => 'required|max:255|alphadash|unique:permissions,name',
            'description' => 'sometimes|max:255'
        ]);
            
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->display_name = $request->disp_name;
        $permission->description = $request->description;
        if ($permission->save())
        {
            return redirect()->route('permissions.show', $permission->id);
        }
        else
        {
            Session::flash('danger', 'Sorry a problem occured while creating this permission');
            return redirect()->route('permissions.create');   
        }

    }

    protected function store_crud(Request $request)
    {        
          $this->validate($request, [
            'resource' => 'required|min:3|max:100|alpha'
        ]);
          
          $success = 1;
        $crud = explode(',', $request->crud_selected);
        if (count($crud) > 0)
        {
            foreach($crud as $x)
            {
                $slug = strtolower($x) . '-' . strtolower($request->resource);
                $display_name = ucwords($x . " " . $request->resource);
                $description = "Allows a user to " . strtoupper($x) . " a " . ucwords($request->resource);

                $permission = new Permission();
                $permission->name = $slug;
                $permission->display_name = $display_name;
                $permission->description = $description;
                if (!$permission->save())
                {
                    $success = 0;
                }
            }

            if ($success == 1)
            {
                return redirect()->route('permissions.index');
            }
            else
            {
                Session::flash('danger', 'Sorry a problem occured while creating this permission');
                return redirect()->route('permissions.create');   
            }
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = permission::findOrFail($id);
        return view('manage.permissions.show')->withpermission($permission);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = permission::findOrFail($id);
        return view('manage.permissions.edit')->withpermission($permission);
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
            'description' => 'sometimes:max:255'
        ]);
            
        $permission = permission::findOrFail($id);      
        $permission->display_name = $request->disp_name;
        $permission->description = $request->description;
        if ($permission->save())
        {
            return redirect()->route('permissions.show', $permission->id);
        }
        else
        {
            Session::flash('danger', 'Sorry a problem occured while creating this permission');
            return redirect()->route('permissions.edit');   
        }        
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
