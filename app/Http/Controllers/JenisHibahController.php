<?php

namespace App\Http\Controllers;

use App\Models\JenisHibah;
use Illuminate\Http\Request;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class JenisHibahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $y = Carbon::now()->isoformat('Y').'%';

        if ($request->ajax()) {
            $data = DB::table('tbl_jenishibah')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                    <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle btn-xs" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Act
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <a class="dropdown-item edit editJenis " type="button" href="javascript:void(0)" data-id="'.$row->id.'" data-original-title="Edit"><i class="mdi mdi-grease-pencil "></i> edit</a>
                                    <a class="dropdown-item deleteJenis" type="button" href="javascript:void(0)" data-id="'.$row->id.'" data-original-title="Delete"><i class="mdi mdi-delete-forever "></i> hapus</a>
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

        return view('pages.jenishibah.index');
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
            'nama' => 'required',
            'satuan' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                        'error' => $validator->errors()->all()
                    ]);
        }

        $kel= JenisHibah::updateOrCreate(['id' => $request->id],
                [
                    'nama' => $request->nama,
                'satuan' => $request->satuan,

            ]);
        // return $kel;
            return redirect()->back()->withErrors($validator)->withInput();
        // return response()->json(['success'=>'Data berhasil disimpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JenisHibah  $jenisHibah
     * @return \Illuminate\Http\Response
     */
    public function show(JenisHibah $jenisHibah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JenisHibah  $jenisHibah
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jenis = JenisHibah::find($id);
        return response()->json($jenis);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JenisHibah  $jenisHibah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JenisHibah $jenisHibah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JenisHibah  $jenisHibah
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JenisHibah::find($id)->delete();

        return response()->json(['success'=>'Product deleted successfully.']);
    }
}
