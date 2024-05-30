<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // index
    public function index(Request $request)
    {
        //get all users with pagination
        $users = DB::table('users')
            ->when($request->input('name'), function ($query, $name) {
                $query->where('name', 'like', '%' . $name . '%')
                    ->orWhere('email', 'like', '%' . $name . '%');
            })
            ->paginate(10);
        return view('owner.pages.users.index', compact('users'));
    }

    public function indexUsersView()
    {
        $totalOwner = User::where('role', 'owner')->count();
        $totalKolektor = User::where('role', 'kolektor')->count();
        $totalInputer = User::where('role', 'inputer')->count();
        $totalGudang = User::where('role', 'gudang')->count();
        $totalMarketing = User::where('role', 'marketing')->count();

        return view('owner.pages.dashboard', compact('totalOwner', 'totalKolektor', 'totalInputer', 'totalGudang', 'totalMarketing'));
    }


    // create
    public function create()
    {
        return view('owner.pages.users.create');
    }

    // store
    public function store(Request $request)
    {
        // validate the request...
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|in:owner,sales,marketing,kolektor,inputer,gudang',
            'kode_salesman' => 'nullable',
        ]);

        // store the request...
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->kode_salesman = $request->kode_salesman;
        $user->save();

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    // show
    public function show($id)
    {
        return view('owner.pages.users.show');
    }

    // edit
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('owner.pages.users.edit', compact('user'));
    }

    // update
    public function update(Request $request, $id)
    {
        // validate the request...
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required|in:owner,sales,marketing,kolektor,inputer,gudang',
            'kode_salesman' => 'nullable',
        ]);

        // update the request...
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->kode_salesman = $request->kode_salesman;
        $user->save();

        //if password is not empty
        if ($request->password) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    // destroy
    public function destroy($id)
    {
        // delete the request...
        $user = User::find($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
