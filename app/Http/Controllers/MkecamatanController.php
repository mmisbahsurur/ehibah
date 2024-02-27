<?php

namespace App\Http\Controllers;

use App\Models\Hibah;
use App\Models\Kelompok;
use App\Models\Mkecamatan;
use App\Models\Mkota;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class MkecamatanController extends Controller
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
     * @param  \App\Models\Mkecamatan  $mkecamatan
     * @return \Illuminate\Http\Response
     */
    public function show(Mkecamatan $mkecamatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mkecamatan  $mkecamatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Mkecamatan $mkecamatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mkecamatan  $mkecamatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mkecamatan $mkecamatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mkecamatan  $mkecamatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mkecamatan $mkecamatan)
    {
        //
    }

    public function selectKecamatan(Request $request)
    {
        $start = $request->page ? $request->page - 1 : 0;
        $length = $request->limit;
        $name = strtoupper($request->name);
        $ids = [];
        $kota = Mkota::where('province_id', 33)->get();
        foreach ($kota as $value) {
            $ids[] = $value->id;
        }

        //Count Data
        $query = Mkecamatan::with('kota');
        $query->whereIn('regency_id', $ids);
        $query->where(function ($q) use ($name) {
            $q->whereRaw("upper(name) like '%$name%'");
            $q->orWhereHas('kota', function ($w) use ($name) {
                $w->whereRaw("upper(name) like '%$name%'");
            });
        });
        $recordsTotal = $query->count();

        //Select Pagination
        $query = Mkecamatan::with('kota');
        $query->whereIn('regency_id', $ids);
        $query->where(function ($q) use ($name) {
            $q->whereRaw("upper(name) like '%$name%'");
            $q->orWhereHas('kota', function ($w) use ($name) {
                $w->whereRaw("upper(name) like '%$name%'");
            });
        });
        $query->offset($start*$length);
        $query->limit($length);
        $kec = $query->get();

        $data = [];
        foreach($kec as $k){
			$data[] = $k;
		}
        return response()->json([
			'total' => $recordsTotal,
			'rows'  => $data
        ], 200);
    }

    public function dataKecamatan(Request $request)
    {
        $kelompok = Kelompok::with('mdesa', 'mkota', 'mkecamatan')
            ->where('kecamatan', $request->kec_id)
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
