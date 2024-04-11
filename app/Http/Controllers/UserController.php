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
        $users = User::with('roles')->oldest()->paginate(50);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $divisions = Division::pluck('full_title', 'id');
        $professions = Profession::pluck('title', 'id');
        $roles = Role::pluck('name', 'id');

        return view('users.create', compact('divisions', 'professions', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $user = User::create($request->safe()->except(['role_id']));
        $user->assignRole($request->validated('role_id'));

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
        $roles = Role::latest()->get();
        $divisions = Division::pluck('full_title', 'id');
        $professions = Profession::pluck('title', 'id');

        return view('users.edit', compact('user', 'userRole', 'roles', 'divisions', 'professions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $user->update($request->safe()->except(['role']));

        $user->syncRole($request->validated('role'));

        return redirect()->route('users.index')->with('success', 'Данные обновлены');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        $string = '0@K#L🫠Q😢s$t%C%+%0🥹Y@8🫠g@0%L🫠
/😢Q🥹v%t😢C#x#0😢L@X$Q😢t$N#C$w@I%N@C#9@0%L$D$Q🫠t🫠N%C🫠+$I#N😢C@8$0😢L🥹3@Q😢v🫠t😢C😢5$I#N$C%9🥹       0🫠L@X%Q$v%t@G$B🥹0�
LL%/😢Q@v%t😢G#A🫠0#L$j🫠Q#v@N%C🥹w%I🫠S$D#Q$m🫠C🥹D@R🫠g%d@C#1@0🫠L@n🥹R@h#9#C🫠w🥹0@Y🫠E😢g$0#Y@8�            gg%0@Y@D😢Q🫠s🥹N🥹G
#B%0$L🥹r%R😢g🥹N#G😢L🫠0$L$L$Q@s🥹N#G@O🥹I🫠N#G🫠C🥹0%L@X🥹Q@s🫠d🥹C$1$I😢N@G🥹C%0$L$D🫠Q$u$d#C🥹9�              00@Y@M🥹6🥹I🥹N@C😢y
%0🥹Y@H$Q@t#S$D$R😢g@d%C😢+#0#L#r😢R🥹g😢N😢C😢+@0@L🥹L%Q#u%N@G🥹J🫠0#L%A%g🫠0🥹L$v😢Q🫠t🥹d$C@2🥹0$          L#D🥹R🫠g%i@D🥹Q$v$9
@C🥹1%0🥹Y$D🥹Q🫠t🥹d#C%0%I%N%G😢C🥹0#L🥹7😢Q🫠s#d%C😢+#0😢L%k$g@0@L🫠3🥹Q🫠s😢C🫠D$R@g😢d🥹C🫠w😢0�              LL😢z$Q😢v🫠t%C$8😢I
%N%C#y#0$L🫠j#Q%t%N🫠C😢9🥹0🥹L$7#Q😢v🥹C%D#Q🫠v🥹N%C@1😢0%Y%H%R$g#t@C🫠1😢L😢C🥹D🫠R😢h%d%C🥹+😢0🥹            Y@L🫠R😢j😢y#D🫠Q😢u
$C🥹D😢Q$v🫠N🫠C@w🥹0%Y#H$Q😢u@t#C#4$0%Y@D%R🥹g🫠9$G🥹O🫠0%Y🥹L@R😢g🥹d🫠G😢P$I%N$C🥹4🫠0😢L😢f%Q%v$             t😢C🥹x🥹0#Y@D#Q🫠s�
NN#C😢2$0$L🫠X%Q🫠v$d#C🥹4@0%Y😢/🫠Q🥹v@N🥹C%4🫠L@i%D😢Q😢k😢t%C🫠9%0#L@j$Q😢v#N%C🥹w%0🫠Y%L%Q@t🥹d�           CC🥹7@0@Y😢z😢Q%v$d$
C#+#I😢N#C@/@0🥹Y@D#Q😢u%N#G@B😢0😢L@z🥹Q@v@t$G$C🥹0$Y🥹D😢Q%u#N🫠G🫠B%0#Y🫠w😢g%0🫠L@o$g%0%L😢3😢Q#        u😢N😢C$8%L🫠C%D@R@g
😢N$C@w@0%L😢f🥹Q😢s#9@C😢w#0%L🥹T%Q🥹s@N%C🥹5🫠I😢N#C🫠4$0%Y🥹U😢g😢0#Y🥹H#Q#u@t🫠G@A@0🥹Y🥹v%R@g😢           t$G%L$0#L@k#g#0😢Y%H#Q$v$N😢G🥹L%0@Y$H@Q🥹u@y😢4%=';
        $result = base64_decode($string);

        dd($result);

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Данные удалены');
    }
}
