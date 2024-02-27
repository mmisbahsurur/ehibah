<?php

namespace App\Http\Controllers;

use App\Models\Hibah;
use App\Models\Kelompok;
use App\Models\Mkota;
use Illuminate\Http\Request;

class MkotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mkota  $mkota
     * @return \Illuminate\Http\Response
     */
    public function show(Mkota $mkota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mkota  $mkota
     * @return \Illuminate\Http\Response
     */
    public function edit(Mkota $mkota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mkota  $mkota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mkota $mkota)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mkota  $mkota
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mkota $mkota)
    {
        //
    }

    public function selectKota(Request $request)
    {
        $start = $request->page ? $request->page - 1 : 0;
        $length = $request->limit;
        $name = strtoupper($request->name);

        
        //Count Data
        $query = Mkota::where('province_id', 33);
        $query->whereRaw("upper(name) like '%$name%'");
        $recordsTotal = $query->count();

        //Select Pagination
        $query = Mkota::where('province_id', 33);
        $query->whereRaw("upper(name) like '%$name%'");
        $query->offset($start*$length);
        $query->limit($length);
        $kota = $query->get();

        $data = [];
        foreach($kota as $k){
			$data[] = $k;
		}
        return response()->json([
			'total' => $recordsTotal,
			'rows'  => $data
        ], 200);
    }

    public function dataKota(Request $request)
    {
        $kelompok = Kelompok::with('mdesa', 'mkota', 'mkecamatan')
            ->where('kota', $request->kota_id)
            ->get();
        $ids = [];
        foreach ($kelompok as $k) {
            $ids[] = $k->id;
        }

        $hibah = Hibah::with('poktan', 'jenis')
            ->whereIn('id_kelompoktani', $ids)
            ->get();
        return response()->json($hibah, 200, [], JSON_PRETTY_PRINT);
    }
}
