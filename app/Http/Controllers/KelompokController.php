<?php

namespace App\Http\Controllers;

use App\Models\Kelompok;
use Illuminate\Http\Request;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class KelompokController extends Controller
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

    public function index(Request $request)
    {

        $y = Carbon::now()->isoformat('Y').'%';
        // return $y;
        if ($request->ajax()) {

            if (!empty($request->kabkota) && empty($request->kecamatan) && empty($request->desa) && empty($request->noreg)) {
                $data = DB::table('tbl_kelompoktani')->join('tbl_kota','tbl_kota.id','=','tbl_kelompoktani.kota')
                ->join('tbl_kecamatan','tbl_kecamatan.id','=','tbl_kelompoktani.kecamatan')
                ->join('tbl_desa','tbl_desa.id','=','tbl_kelompoktani.desa')
                ->select('tbl_kelompoktani.*','tbl_kota.name as nmkot','tbl_kecamatan.name as nmkec','tbl_desa.name as nmdes')
                ->where('tbl_kelompoktani.kota',$request->kabkota)
                ->get();

            }elseif (!empty($request->kabkota) && !empty($request->kecamatan) && empty($request->desa) && empty($request->noreg)) {
                $data = DB::table('tbl_kelompoktani')->join('tbl_kota','tbl_kota.id','=','tbl_kelompoktani.kota')
                ->join('tbl_kecamatan','tbl_kecamatan.id','=','tbl_kelompoktani.kecamatan')
                ->join('tbl_desa','tbl_desa.id','=','tbl_kelompoktani.desa')
                ->select('tbl_kelompoktani.*','tbl_kota.name as nmkot','tbl_kecamatan.name as nmkec','tbl_desa.name as nmdes')
                ->where('tbl_kelompoktani.kota',$request->kabkota)
                ->where('tbl_kelompoktani.kecamatan',$request->kecamatan)
                ->get();

            }elseif (!empty($request->kabkota) && !empty($request->kecamatan) && !empty($request->desa) && empty($request->noreg)) {
                $data = DB::table('tbl_kelompoktani')->join('tbl_kota','tbl_kota.id','=','tbl_kelompoktani.kota')
                ->join('tbl_kecamatan','tbl_kecamatan.id','=','tbl_kelompoktani.kecamatan')
                ->join('tbl_desa','tbl_desa.id','=','tbl_kelompoktani.desa')
                ->select('tbl_kelompoktani.*','tbl_kota.name as nmkot','tbl_kecamatan.name as nmkec','tbl_desa.name as nmdes')
                ->where('tbl_kelompoktani.kota',$request->kabkota)
                ->where('tbl_kelompoktani.kecamatan',$request->kecamatan)
                ->where('tbl_kelompoktani.desa',$request->desa)
                ->get();

            }elseif (!empty($request->kabkota) && !empty($request->kecamatan) && !empty($request->desa) && !empty($request->noreg)) {
                $data = DB::table('tbl_kelompoktani')->join('tbl_kota','tbl_kota.id','=','tbl_kelompoktani.kota')
                ->join('tbl_kecamatan','tbl_kecamatan.id','=','tbl_kelompoktani.kecamatan')
                ->join('tbl_desa','tbl_desa.id','=','tbl_kelompoktani.desa')
                ->select('tbl_kelompoktani.*','tbl_kota.name as nmkot','tbl_kecamatan.name as nmkec','tbl_desa.name as nmdes')
                ->where('tbl_kelompoktani.kota',$request->kabkota)
                ->where('tbl_kelompoktani.kecamatan',$request->kecamatan)
                ->where('tbl_kelompoktani.desa',$request->desa)
                ->where('tbl_kelompoktani.nomer_register','like',$request->noreg.'%')
                ->get();

            }elseif (empty($request->kabkota) && empty($request->kecamatan) && empty($request->desa) && !empty($request->noreg)) {
                $data = DB::table('tbl_kelompoktani')->join('tbl_kota','tbl_kota.id','=','tbl_kelompoktani.kota')
                ->join('tbl_kecamatan','tbl_kecamatan.id','=','tbl_kelompoktani.kecamatan')
                ->join('tbl_desa','tbl_desa.id','=','tbl_kelompoktani.desa')
                ->select('tbl_kelompoktani.*','tbl_kota.name as nmkot','tbl_kecamatan.name as nmkec','tbl_desa.name as nmdes')
                ->where('tbl_kelompoktani.nomer_register','like',$request->noreg.'%')
                ->get();

            } else {
                $data = DB::table('tbl_kelompoktani')->join('tbl_kota','tbl_kota.id','=','tbl_kelompoktani.kota')
                ->join('tbl_kecamatan','tbl_kecamatan.id','=','tbl_kelompoktani.kecamatan')
                ->join('tbl_desa','tbl_desa.id','=','tbl_kelompoktani.desa')
                ->select('tbl_kelompoktani.*','tbl_kota.name as nmkot','tbl_kecamatan.name as nmkec','tbl_desa.name as nmdes')
                ->where('tbl_kelompoktani.nomer_register','like',$y)
                ->get();
            }

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                    <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle btn-xs" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Act
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item edit editKelompok " type="button" href="javascript:void(0)" data-id="'.$row->id.'" data-original-title="Edit"><i class="mdi mdi-grease-pencil "></i> edit</a>
                                        <a class="dropdown-item deleteKelompok" type="button" href="javascript:void(0)" data-id="'.$row->id.'" data-original-title="Delete"><i class="mdi mdi-delete-forever "></i> hapus</a>
                                    </div>
                                    </div>
                                </div>';

                        // $btn = '<a href="javascript:void(0)" type="button" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-xs editKelompok">
                        // <i class="mdi mdi-grease-pencil "></i>
                        // </a>';

                        // $btn = $btn.' <a href="javascript:void(0)" type="button" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-xs deleteKelompok"><i class="mdi mdi-delete-forever "></i></a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $kab = DB::table('tbl_kota')->where('province_id',33)->get();
        $kec = DB::table('tbl_kecamatan')->where('regency_id','like','33%')->get();
        $des = DB::table('tbl_desa')->where('district_id','like','33%')->get();
        return view('pages.kelompok.index',compact('kab','kec','des','request'));
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
        $validator = Validator::make($request->all(), [
            'nama_kelompok' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'nomer_register' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                        'error' => $validator->errors()->all()
                    ]);
        }

        $kel= Kelompok::updateOrCreate(['id' => $request->id],
                ['nama_kelompok' => $request->nama_kelompok,
                'kota' => $request->kota,
                'kecamatan' => $request->kecamatan,
                'desa' => $request->desa,
                'nomer_register' => $request->nomer_register

            ]);
            // return $kel;
            return redirect()->back()->withErrors($validator)->withInput();
        // return response()->json(['success'=>'Data berhasil disimpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelompok  $kelompok
     * @return \Illuminate\Http\Response
     */
    public function show(Kelompok $kelompok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelompok  $kelompok
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kelompok = Kelompok::find($id);
        return response()->json($kelompok);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelompok  $kelompok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelompok $kelompok)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelompok  $kelompok
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kelompok::find($id)->delete();

        return response()->json(['success'=>'Product deleted successfully.']);
    }
}
