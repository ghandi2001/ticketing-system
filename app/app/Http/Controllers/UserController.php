<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public static function routes()
    {
        Route::get('/user/import', [__CLASS__, 'importUsersForm'])->name('user.import.show');
        Route::resource('user', __CLASS__);
    }

    public function index()
    {
        return view('users.index')->with('users',User::all());
    }

    public function importUsersForm()
    {
        return view('users.import');
    }

    public function importUsers()
    {

    }

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->phone_number = $request->phone_number;
        $user->personnel_code = $request->personnel_code;
        $user->password = Hash::make($request->password);

        $path = Storage::putFileAs(
            'uploads/avatars', $request->file('profile_picture'), time()
        );
        $user->profile_picture = $path;

        if ($user->save()) {
            return redirect()->back()->with('message', 'insert successfully.');
        }
        return redirect()->back()->with('error', 'insert successfully.');
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        //
    }

    public function update(User $user, UpdateRequest $request)
    {
        //
    }

    public function destroy(User $user)
    {
        if($user->delete())
            redirect()->back()->with('message','delete successfully.');
        return redirect()->back()->with('error','delete not successfully.');
    }
}
