<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;
use DB;
use DataTables;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Kota(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('tbl_kota')->where('province_id',33)->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('pages.lokasi.kota');
    }

    public function Kecamatan(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('tbl_kecamatan')->join('tbl_kota','tbl_kota.id','=','tbl_kecamatan.regency_id')->select('tbl_kecamatan.*','tbl_kota.name as nmkot','tbl_kota.id as kode')->where('tbl_kecamatan.regency_id','like','33%')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('pages.lokasi.kecamatan');
    }

    public function Kelurahan(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('tbl_desa')->join('tbl_kecamatan','tbl_kecamatan.id','=','tbl_desa.district_id')->join('tbl_kota','tbl_kota.id','=','tbl_kecamatan.regency_id')->select('tbl_desa.*','tbl_kecamatan.name as nmkec','tbl_kecamatan.id as kodekec','tbl_kota.name as nmkot','tbl_kota.id as kode')->where('tbl_desa.district_id','like','33%')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('pages.lokasi.kelurahan');
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
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function show(Lokasi $lokasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Lokasi $lokasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lokasi $lokasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lokasi $lokasi)
    {
        //
    }
}
