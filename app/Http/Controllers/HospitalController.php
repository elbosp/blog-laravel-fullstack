<?php

namespace App\Http\Controllers;

use App\Hospital;

class HospitalController extends Controller
{
    public function index()
    {
        $hospitals = Hospital::orderBy(request()->sortby ?? 'id', request()->sortbydesc ?? 'asc')
                        ->when(request()->q, function($hospitals) {
                            $hospitals = $hospitals->where('name', 'LIKE', '%' . request()->q . '%')
                                                   ->orWhere('phone', 'LIKE', '%' . request()->q . '%')
                                                   ->orWhere('address', 'LIKE', '%' . request()->q . '%');
                        })->paginate(request()->per_page ?? 10);

        return response()->json([
            'status' => 'success',
            'data' => $hospitals
        ], 200);
    }

    public function destroy()
    {
        return response()->json([
            'status' => 'success',
            'data' => Hospital::destroy(request()->id)
        ], 200);
    }
}
