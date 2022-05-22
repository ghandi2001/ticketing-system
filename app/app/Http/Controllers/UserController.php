<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Exports\UsersSampleExport;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public static function routes()
    {
        Route::post('/user/collective/destruction', [__CLASS__, 'collectiveDestruction'])->name('user.collective.collective.destruction');
        Route::post('/user/collective/change/status', [__CLASS__, 'collectiveChangeStatus'])->name('user.collective.changeStatus');
        Route::post('/user/update/profile/{user}', [__CLASS__, 'updateUserProfile'])->name('user.update.profile');
        Route::get('/user/collective/export/', [__CLASS__, 'export'])->name('user.collective.export');
        Route::get('/user/collective/import', [__CLASS__, 'importUsersForm'])->name('user.import.show');
        Route::post('/user/collective/import', [__CLASS__, 'importUsers'])->name('user.import.work');
        Route::get('/user/collective/sample/export/', [__CLASS__, 'sampleExport'])->name('user.sample.export');
        Route::resource('user', __CLASS__);
    }

    public function index()
    {
        checkAccess('see users');
        return view('users.index')->with('users', User::all());
    }

    public function importUsersForm()
    {
        checkAccess('import users');
        return view('users.import');
    }

    public function importUsers(Request $request)
    {
        checkAccess('import users');
        if ($request->file('uploaded_file')) {
            $file = $request->file('uploaded_file');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('uploads/excels/'), $filename);
            Excel::import(new UsersImport(), "uploads/excels/" . $filename);
        }
        return redirect()->back('message', 'mission success full');
    }

    public function create()
    {
        checkAccess('add user');
        return view('users.create')->with('roles', Role::all());
    }

    public function store(StoreRequest $request)
    {
        checkAccess('add user');
        $user = new User();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->phone_number = $request->phone_number;
        $user->personnel_code = $request->personnel_code;
        $user->password = Hash::make($request->password);
        $user->profile_picture = 'images/avatar/man.png';
        $user->assignRole($request->role_name);

        if ($user->save()) {
            return redirect()->back()->with('message', 'insert successfully.');
        }
        return redirect()->back()->with('error', 'insert successfully.');
    }

    public function show(User $user)
    {
        checkAccess('see user');
        if ($user->id == Auth::user()->id) {
            return view('users.profile')->with([
                'user' => $user
            ]);
        } else {
            return abort(403);
        }
    }

    public function edit(User $user)
    {
        checkAccess('edit user');
        return view('users.create')->with([
            'roles' => Role::all(),
            'user' => $user
        ]);
    }

    public function update(User $user, UpdateRequest $request)
    {
        checkAccess('edit user');
        if ($user->update(['name' => $request->name, 'surname' => $request->surname, 'phone_number' => $request->phone_number]))
            return redirect()->route('user.index')->with('message', 'updated successfully.');
        return redirect()->back()->with('message', 'updated not successfully.');
    }

    public function destroy(User $user)
    {
        checkAccess('delete user');
        if ($user->delete()) {
            redirect()->back()->with('message', 'delete successfully.');
        }
        return redirect()->back()->with('error', 'delete not successfully.');
    }

    public function collectiveDestruction(Request $request)
    {
        checkAccess('delete user');
        if (in_array(Auth::id(), $request->input('data'))) {
            return response()->json('you cant delete your self.', '403');
        }

        User::whereIn('id', $request->input('data'))->update(['deleted_at' => now()]);
        return response()->json('mission successful.', '200');
    }

    public function collectiveChangeStatus(Request $request)
    {
        checkAccess('edit user');
        if (in_array(Auth::id(), $request->input('data'))) {
            return response()->json('you cant disable your self.', '403');
        }

        $activatedUsers = User::whereIn('id', $request->input('data'))->where('has_accessed', '=', 1)->get()->pluck('id');
        $noneActivatedUsers = User::whereIn('id', $request->input('data'))->where('has_accessed', '=', 0)->get()->pluck('id');

        User::whereIn('id', $activatedUsers)->update(['has_accessed' => 0]);
        User::whereIn('id', $noneActivatedUsers)->update(['has_accessed' => 1]);

        return response()->json('mission successful.', '200');
    }

    public function sampleExport()
    {
        checkAccess('import users');
        return Excel::download(new UsersSampleExport(), 'sample-users.xlsx');
    }

    public function export()
    {
        checkAccess('export users');
        return Excel::download(new UsersExport(), 'users.xlsx');
    }

    public function updateUserProfile(User $user, UpdateRequest $request)
    {
        checkAccess('see user');
        if ($user->id == Auth::user()->id) {
            $user->update(['name' => $request->name, 'surname' => $request->surname, 'phone_number' => $request->phone_number]);
            if ($request->file('profile_picture')) {
                $file = $request->file('profile_picture');
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('uploads/images/profile/'), $filename);
                $user->update(['profile_picture' => 'uploads/images/profile/' . $filename]);
            }

            if (isset($request->password)) {
                $user->update(['password' => Hash::make($request->password)]);
            }

            return redirect()->back()->with('message', 'user profile updated successfully');
        }
        return abort(403);
    }
}
