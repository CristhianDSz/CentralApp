<?php

namespace App\Http\Controllers;

use App\MandatoryArea;
use App\Role;
use App\User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * List de current resources
     *
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->id == '1') {
            $users = User::all();
        }
        else {
            $users = User::where('id','!=','1')->get();
        }
        return view('users.index',compact('users'));
    }

    /**
     * Show the editing form of the current resource
     *
     * @param User $user
     * @return Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        $roles = Role::all();
        $areas = MandatoryArea::all();
        return view('users.edit',compact('user','roles','areas'));
    }

    /**
     * Updating the incomming resource
     *
     * @param User $user
     * @return Illuminate\Http\Response
     */
    public function update(User $user)
    {
        $this->authorize('update', $user);

        $attributes = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id
            ],
            'password' => ['required','confirmed'],
            'role_id' => ['required','numeric'],
            'areas' => ['required','array']
        ]);

        $attributes['password'] =  bcrypt($attributes['password']);
        $user->update($attributes);
        $user->mandatoryAreas()->sync(request('areas'));
        return redirect()->route('users.index');
    }

    /**
     * Deleting the incomming resource
     *
     * @param User $user
     * @return Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();
        return redirect()->route('users.index');
    }
}
