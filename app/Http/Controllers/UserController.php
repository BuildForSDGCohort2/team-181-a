<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use App\Image;
use App\Proffesional;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index', ['users' => $model->paginate(15)]);
    }

    public function show(Proffesional $model, $id)
    {
        $user = $model->find($id);
        $image = new Image();
        // $ext = pathinfo(storage_path().'/uploads/categories/featured_image.jpg', PATHINFO_EXTENSION);
        // $file_type =
        $user->image = $image->get_image($user);
        $file_ext = File::extension($user->image);

        if (in_array($file_ext, ['jpeg', 'jpg', 'png'])) {
            $user->ext = 'image';
        } else {
            $user->ext = 'pdf';
        }

        // dd();
        return $user;
    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $locations=\App\Farmer::all()->pluck('location')->toArray();
        $locations = array_unique($locations);
        return view('users.create')->with('locations',$locations);
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request, User $model)
    {
        $role = $request->input('role');
        $model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());
        $user= User::latest()->first();
        // $user->location=$request->input('location');
        $user->assignRole($role);
        $user->save();
        return redirect()->route('user.index')->withStatus(__('User successfully created.'));
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        $locations=\App\Farmer::all()->pluck('location')->toArray();
       $locations = array_unique($locations);
        return view('users.edit', compact(['user','locations']));
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User  $user)
    {
        //return $user();
        $role = $request->input('role');
    //    $new_loc = $request->location;
    //    $request->drop('location');
    //    return print($request);
        //logic to change the user roles
        if (isset($role)) {
            $user->syncRoles([$request->input('role')]);
        }
        $hasPassword = $request->get('password');
        $user->update(
            $request->merge(['password' => Hash::make($request->get('password'))])
                ->except([$hasPassword ? '' : 'password']
        ));
        // $user->location = $request->input('location');

        $user->save();
        return redirect()->route('user.index')->withStatus(__('User successfully updated.'));
    }


    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User  $user)
    {
        $user->delete();

        return redirect()->route('user.index')->withStatus(__('User successfully deleted.'));
    }
}
