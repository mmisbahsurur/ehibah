<?php

namespace App\Http\Controllers;

use App\Models\Hibah;
use Illuminate\Http\Request;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class HibahController extends Controller
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

        if ($request->ajax()) {
            $data = DB::table('tbl_hibah2')
            // ->join('tbl_satuan','tbl_satuan.id','=','tbl_hibah2.satuan')
            ->join('tbl_jenishibah','tbl_jenishibah.id','=','tbl_hibah2.jenis_hibah')
            ->join('tbl_kelompoktani','tbl_kelompoktani.id','=','tbl_hibah2.id_kelompoktani')
            ->select('tbl_hibah2.*','tbl_kelompoktani.nama_kelompok as namakelom', 'tbl_kelompoktani.nomer_register as noreg','tbl_jenishibah.satuan as namasat','tbl_jenishibah.nama as namajen')
            ->orderBy('tbl_hibah2.kegiatan','DESC')
            ->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                    <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle btn-xs" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Act
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item edit editHibah " type="button" href="javascript:void(0)" data-id="'.$row->id.'" data-original-title="Edit"><i class="mdi mdi-grease-pencil "></i> edit</a>
                                        <a class="dropdown-item deleteHibah" type="button" href="javascript:void(0)" data-id="'.$row->id.'" data-original-title="Delete"><i class="mdi mdi-delete-forever "></i> hapus</a>
                                    </div>
                                    </div>
                                </div>';
                        // $btn = '<a href="javascript:void(0)" type="button" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-xs editUser">
                        // <i class="mdi mdi-grease-pencil "></i>
                        // </a>';

                        // $btn = $btn.' <a href="javascript:void(0)" type="button" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-xs deleteUser"><i class="mdi mdi-delete-forever "></i></a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $kelompok = DB::table('tbl_kelompoktani')->join('tbl_kota','tbl_kota.id','=','tbl_kelompoktani.kota')
        ->join('tbl_kecamatan','tbl_kecamatan.id','=','tbl_kelompoktani.kecamatan')
        ->join('tbl_desa','tbl_desa.id','=','tbl_kelompoktani.desa')
        ->select('tbl_kelompoktani.*','tbl_kota.name as nmkot','tbl_kecamatan.name as nmkec','tbl_desa.name as nmdes')
        ->where('tbl_kelompoktani.nomer_register','like',$y)
        ->get();
        $jenishibah = DB::table('tbl_jenishibah')->get();
        return view('pages.hibah.index',compact('kelompok','jenishibah'));
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
            'id_kelompoktani' => 'required',
            'jenis_hibah' => 'required',
            'jumlah' => 'required',
            'kegiatan' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                        'error' => $validator->errors()->all()
                    ]);
        }

        $kel= Hibah::updateOrCreate(['id' => $request->id],
                ['id_kelompoktani' => $request->id_kelompoktani,
                'jenis_hibah' => $request->jenis_hibah,
                'jumlah' => $request->jumlah,
                'kegiatan' => $request->kegiatan,

            ]);
            return $kel;
            // return redirect()->back()->withErrors($validator)->withInput();
        // return response()->json(['success'=>'Data berhasil disimpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hibah  $hibah
     * @return \Illuminate\Http\Response
     */
    public function show(Hibah $hibah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hibah  $hibah
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hibah = Hibah::find($id);
        return response()->json($hibah);
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
        Hibah::find($id)->delete();

        return response()->json(['success'=>'Product deleted successfully.']);
    }
}
