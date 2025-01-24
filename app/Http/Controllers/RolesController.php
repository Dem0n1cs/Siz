<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $roles = Role::query()->orderBy('id','DESC')->paginate(5);
        return view('roles.index',compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $permissions = Permission::query()->get();
        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request): RedirectResponse
    {
        $role = Role::query()->create(['name' => $request->get('name')]);
        $role->syncPermissions($request->get('permission'));
        return redirect()->route('roles.index')->with('success','Role created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $rolePermissions = $role->permissions;
        return view('roles.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        $permissions = Permission::query()->get();
        return view('roles.edit', compact('role','rolePermissions','permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->safe()->only('name'));
        $role->syncPermissions($request->safe()->only('permission'));
        return redirect()->route('roles.index')->withSuccess(__('Permission updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->withSuccess(__('Permission deleted successfully.'));
    }
}
