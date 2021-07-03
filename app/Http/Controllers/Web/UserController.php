<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UserController extends Controller
{
    public const NUMBER_OF_RECORDS = 5;

    /**
     * Display a listing of the user resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(self::NUMBER_OF_RECORDS);
        $trashedUsers = User::onlyTrashed()->latest()->paginate(self::NUMBER_OF_RECORDS);

        return Inertia::render('Users/Index', [
            'users' => $users,
            'trashedUsers' => $trashedUsers
        ]);
    }

    /**
     * Show the form for creating a new user resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Users/Create');
    }

    /**
     * Store a newly created user resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $validatedData = $request->validated();
        User::create($validatedData);
        return Redirect::route('users.index')->with('success', 'User successfully added.');
    }

    /**
     * Show the form for editing the specified user resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return Inertia::render('Users/Edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified user resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $validatedData = $request->validated();
        $user = User::find($id);
        $user->update($validatedData);
        return Redirect::route('users.index')->with('success', 'User successfully updated.');
    }

    /**
     * Remove the specified user resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return Redirect::route('users.index')->with('success', 'User successfully deleted.');
    }

    /**
     * Restore the specified user resource from trash.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $user = User::withTrashed()->find($id);
        $user->restore();
        return Redirect::route('users.index')->with('success', 'User successfully restored.');
    }
}
