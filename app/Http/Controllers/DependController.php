<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mkota;
use App\Models\Mkecamatan;
use App\Models\Mdesa;

class DependController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['kabkota'] = Mkota::get(["name", "id"]);
        return view('dropdown', $data);
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function fetchKecamatan(Request $request)
    {
        $data['kecamatan'] = Mkecamatan::where("regency_id", $request->regency_id)
                                ->get(["name", "id"]);

        return response()->json($data);
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function fetchDesa(Request $request)
    {
        $data['desa'] = Mdesa::where("district_id", $request->district_id)
                                    ->get(["name", "id"]);

        return response()->json($data);
    }
}
