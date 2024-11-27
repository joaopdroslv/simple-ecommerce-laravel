<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $addresses = Address::where('user_id', $user->id)->get();

        return view('address/addresses', ['addresses' => $addresses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('address/address_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'street' => ['required', 'string', 'max:255'],
            'number' => ['required', 'numeric'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
        ], [
            'street.required' => 'The street field is required.',
            'street.string' => 'The street must be a string.',
            'street.max' => 'The street must not exceed 255 characters.',

            'number.required' => 'The number field is required.',

            'city.required' => 'The city field is required.',
            'city.string' => 'The city must be a string.',
            'city.max' => 'The city must not exceed 255 characters.',

            'state.required' => 'The state field is required.',
            'state.string' => 'The state must be a string.',
            'state.max' => 'The state must not exceed 255 characters.',
        ]);

        $created = Address::create([
            'street' => $request->input('street'),
            'number' => $request->input('number'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'user_id' => $user->id,
        ]);

        if ($created) {
            return redirect()->route('addresses.index')->with('success', 'Succesfully created!');
        }

        return redirect()->route('addresses.index')->with('error', 'Failed to create!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        return view('address/address_show', ['address' => $address]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        return view('address/address_edit', ['address' => $address]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'street' => ['required', 'string', 'max:255'],
            'number' => ['required', 'numeric'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
        ], [
            'street.required' => 'The street field is required.',
            'street.string' => 'The street must be a string.',
            'street.max' => 'The street must not exceed 255 characters.',

            'number.required' => 'The number field is required.',

            'city.required' => 'The city field is required.',
            'city.string' => 'The city must be a string.',
            'city.max' => 'The city must not exceed 255 characters.',

            'state.required' => 'The state field is required.',
            'state.string' => 'The state must be a string.',
            'state.max' => 'The state must not exceed 255 characters.',
        ]);

        $data = $request->except(['_token', '_method']);

        $updated = Address::where('id', $id)->update($data);

        if ($updated) {
            return redirect()->route('addresses.index')->with('success', 'Succesfully updated!');
        }

        return redirect()->route('addresses.index')->with('error', 'Failed to update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        $address->delete();

        return redirect()->route('addresses.index')->with('success', 'Address deleted!');
    }
}
