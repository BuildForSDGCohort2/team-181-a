<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use App\User;
use App\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller {
	public function index()
    {
        return Role::all();
    }

	public function getUsersRole() {
		// $user_arr = json_decode(json_encode(User::where('country_id', Auth::user()->country_id)->get()), true);
		$user_arr = User::all();
		return $user_arr;

	}

	public function getPermissions($guard_name)
	{
		return Permission::where('guard_name', $guard_name)->get();
	}

	public function store(Request $request)
	{
		// return $request->all();
		// $this->Validate($request, [
		// 	'form.name' => 'required',
		// ]);
        $role = Role::create(['name' => $request->form['name'], 'guard_name' => $request->form['guard_name']]);
        $role->givePermissionTo($request->selected);

        // $role = Role::create(['name' => 'super-admin']);
		// $role->givePermissionTo(Permission::all());

		return $role;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Rolem  $role
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		// return $request->all();
		$role = Role::find($id);
		$role->name = $request->form['name'];
		$role->save();
		$role->syncPermissions($request->selected);
		return $role;
	}

	public function destroy(Role $role) {
		// return $role->id;
		Role::find($role->id)->delete();
	}

	public function getRolesPerm(Request $request)
	{
        // return $request->all();
        $guard_name = $request->guard_name;
		return Role::where('name', $request->name)->where('guard_name', $guard_name)->first()->permissions->pluck('name');
	}
}
