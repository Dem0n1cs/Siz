<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Division;
use App\Models\Profession;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::query()->with('roles')->oldest()->paginate(50);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $divisions = Division::query()->pluck('full_title', 'id');
        $professions = Profession::query()->pluck('title', 'id');
        $roles = Role::query()->pluck('name', 'id');
        $users = User::query()->select('id','last_name','first_name','middle_name',)->get();
        return view('users.create', compact('divisions', 'professions', 'roles','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $user = User::query()->create($request->safe()->except(['role_id','boss_position']));
        $user->assignRole($request->validated('role_id'));
        User::query()->where('id',$request->validated('boss_id'))->update(['boss_position',$request->validated('boss_position')]);
        return redirect()->route('users.index')->with('success', 'Данные сохранены');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        /*     return view('users.show', [
                 'user' => $user
             ]);*/
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $userRole = $user->roles->pluck('name')->toArray();
        $roles = Role::query()->latest()->get();
        $divisions = Division::query()->pluck('full_title', 'id');
        $professions = Profession::query()->pluck('title', 'id');
        $bosses = User::query()->select('id','last_name','first_name','middle_name')->get();
        return view('users.edit', compact('user', 'userRole', 'roles', 'divisions', 'professions','bosses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $user->update($request->safe()->except(['role','boss_position']));
        $user->syncRoles([$request->validated('role')]);
        User::query()
            ->where('id', $request->validated('boss_id'))
            ->update(['boss_position' => $request->validated('boss_position')]);
        return redirect()->route('users.index')->with('success', 'Данные обновлены');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Данные удалены');
    }
}
