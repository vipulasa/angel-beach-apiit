<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Phone;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // The index method is used to retrieve all the records from the database.

        // Retrieve all the users from the database
        $users = (new User())->paginate(20);

        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create', [
            'roles' => (new Role())->where('status', 1)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'password' => 'required',
            'street' => 'required',
            'city' => 'required',
            'province' => 'required',
            'postal_code' => 'required'
        ]);

        $request->offsetSet('is_admin', $request->has('is_admin') ? 1 : 0);

        $address = (new Address())->create([
            'street' => $request->get('street'),
            'city' => $request->get('city'),
            'province' => $request->get('province'),
            'postal_code' => $request->get('postal_code')
        ]);

        // Create a new user
        $user = (new User())->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'mobile' => $request->mobile,
            'is_admin' => $request->is_admin,
            'address_id' => $address->id,
        ]);

        // Assign the user to the role
        $user->roles()->attach($request->roles);

        return redirect()
            ->route('admin.users.show', $user->id)
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
//        dd($user->address);

        return view('admin.users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user,
            'roles' => (new Role())->where('status', 1)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'street' => 'required',
            'city' => 'required',
            'province' => 'required',
            'postal_code' => 'required'
        ]);

        $request->offsetSet('is_admin', $request->has('is_admin') ? 1 : 0);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'is_admin' => $request->is_admin,
            'password' => $request->has('password') ? Hash::make($request->password) : $user->password,
        ]);

        // update user address
        $user->address()->update([
            'street' => $request->street,
            'city' => $request->city,
            'province' => $request->province,
            'postal_code' => $request->postal_code
        ]);

        if ($request->phone_numbers && count($request->phone_numbers)) {
            foreach ($request->phone_numbers as $number) {
                if ($number) {
                    (new Phone())->updateOrCreate([
                        'user_id' => $user->id,
                        'phone_number' => $number
                    ]);
                }
            }
        }

        // Remove all the relations
        // $user->roles()->detach();

        // Attach a relationship
        // $user->roles()->attach($request->roles);

        // sync relations
        $user->roles()->sync($request->roles);

        return redirect()
            ->route('admin.users.show', $user->id)
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'The user ' . $user->email . ' has been deleted successfully');
    }
}
