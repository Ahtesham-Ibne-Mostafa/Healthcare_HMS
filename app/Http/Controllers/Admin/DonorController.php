<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donor;

class DonorController extends Controller
{
    public function indexJson()
    {
        $donors = Donor::orderByDesc('created_at')->get();

        return response()->json([
            'count' => $donors->count(),
            'data' => $donors->map(function ($d) {
                return [
                    'id'          => $d->id,
                    'name'        => $d->name,
                    'email'       => $d->email,
                    'phone'       => $d->phone,
                    'blood_group' => $d->blood_group,
                    'address'     => $d->address,
                    'status'      => $d->status,
                    'created_at'  => $d->created_at,
                ];
            })
        ]);
    }

    public function destroy($id)
    {
        Donor::findOrFail($id)->delete();

        return response()->json(['success' => true]);
    }
}
