<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserPasswordRequest;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Notifications\UserCreated;
use App\Services\YajraDataTableService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $breadcrumbs = [
            ['link' => route('users.index'), 'name' => __('locale.Users')],
            ['name' => __('locale.Index')]
        ];

        return view('content.users.index', ['breadcrumbs' => $breadcrumbs]);
    }

    /**
     *
     * @return DataTables
     */
    public function indexData(){
        return YajraDataTableService::UserTable();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $breadcrumbs = [
            ['link' => route('users.index'), 'name' => __('locale.Users')],
            ['name' => __('locale.Create User')]
        ];

        return view('content.users.create', ['breadcrumbs' => $breadcrumbs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        if($request->role == User::SUPER_ADMIN) {
            abort(403);
        }

        $user = new User();
        $userData = $request->validated();
        $userData['password'] = Hash::make($request->password);
        $user->fill($userData);
        $user->save();
        $user->assignRole($request->role);
        $user->notify(new UserCreated($request->password));
        return redirect()->route('users.index')->with(['message' => __('User created successfully.')]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return View | RedirectResponse
     */
    public function edit(User $user)
    {
        if (! Gate::allows('update-user', $user)) {
            abort(403);
        }
        $breadcrumbs = [
            ['link' => route('users.index'), 'name' => __('locale.Users')],
            ['name' => __('locale.Edit User')]
        ];

        return view('content.users.edit', ['breadcrumbs' => $breadcrumbs, 'user' => $user]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if (! Gate::allows('update-user', $user)) {
            abort(403);
        }
        $userData = $request->validated();
        $user->fill($userData);
        $user->save();
        $user->roles()->detach();
        $user->assignRole($request->role);

        return redirect()->route('users.index')->with(['message' => __('User updated successfully.')]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return RedirectResponse
     */
    public function destroy(User $user)
    {
        if (! Gate::allows('delete-user', $user)) {
            abort(403);
        }
        $user->delete();
        return redirect()->route('users.index')->with(['message' => __('User deleted successfully.')]);

    }


    public function resetPassword(User $user){

        if (! Gate::allows('update-user', $user)) {
            abort(403);
        }
        $breadcrumbs = [
            ['link' => route('users.index'), 'name' => __('locale.Users')],
            ['name' => __('locale.Reset Password')]
        ];

        return view('content.users.reset-password', ['breadcrumbs' => $breadcrumbs, 'user' => $user]);
    }

    public function updatePassword(UpdateUserPasswordRequest $request, User $user){

        if (! Gate::allows('update-user', $user)) {
            abort(403);
        }
        $data = $request->validated();
        $user->password = Hash::make($data['password']);
        $user->save();
        return redirect()->route('users.index')->with(['message' => __('User\'s password updated successfully.')]);

    }
}
