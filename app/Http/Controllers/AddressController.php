<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;

class AddressController extends Controller
{
    // List all addresses for a user
    public function index($userId)
    {
        $user = User::findOrFail($userId);
        return response()->json($user->addresses);
    }

    // Add a new address for a user
    public function store(Request $request, $userId)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $user = User::findOrFail($userId);

        $address = $user->addresses()->create($request->all());

        return response()->json($address, 201);
    }

    // Update an address
    public function update(Request $request, $addressId)
    {
        $address = Address::findOrFail($addressId);

        $address->update($request->all());

        return response()->json($address);
    }

    // Delete an address
    public function destroy($addressId)
    {
        $address = Address::findOrFail($addressId);

        $address->delete();

        return response()->json(['message' => 'Address deleted successfully']);
    }
}
