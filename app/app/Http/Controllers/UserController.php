<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public static function routes()
    {
        Route::get('/user/import', [__CLASS__, 'importUsersForm'])->name('user.import.show');
        Route::post('/user/collective/destruction', [__CLASS__, 'collectiveDestruction'])->name('user.collective.destruction');
        Route::post('/user/collective/change/status', [__CLASS__, 'collectiveChangeStatus'])->name('user.collective.changeStatus');
        Route::resource('user', __CLASS__);
    }

    public function index()
    {
        return view('users.index')->with('users', User::all());
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
        return view('users.create')->with('user', $user);
    }

    public function update(User $user, UpdateRequest $request)
    {
        if ($user->update(['name' => $request->name, 'surname' => $request->surname, 'phone_number' => $request->phone_number]))
            return redirect()->route('user.index')->with('message', 'updated successfully.');
        return redirect()->back()->with('message', 'updated not successfully.');
    }

    public function destroy(User $user)
    {
        if ($user->delete()) {
            redirect()->back()->with('message', 'delete successfully.');
        }
        return redirect()->back()->with('error', 'delete not successfully.');
    }

    public function collectiveDestruction(Request $request)
    {
        if (in_array(Auth::id(), $request->input('data'))) {
            return response()->json('you cant delete your self.', '403');
        }

        User::whereIn('id', $request->input('data'))->update(['deleted_at' => now()]);
        return response()->json('mission successful.', '200');
    }

    public function collectiveChangeStatus(Request $request)
    {
        if (in_array(Auth::id(), $request->input('data'))) {
            return response()->json('you cant disable your self.', '403');
        }

        $activatedUsers = User::whereIn('id', $request->input('data'))->where('has_accessed', '=', 1)->get()->pluck('id');
        $noneActivatedUsers = User::whereIn('id', $request->input('data'))->where('has_accessed', '=', 0)->get()->pluck('id');

        User::whereIn('id', $activatedUsers)->update(['has_accessed' => 0]);
        User::whereIn('id', $noneActivatedUsers)->update(['has_accessed' => 1]);

        return response()->json('mission successful.', '200');
    }
}
