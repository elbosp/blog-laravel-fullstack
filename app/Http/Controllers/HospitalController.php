<?php

namespace App\Http\Controllers;

use App\Hospital;
use Illuminate\Http\Request;

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
}
