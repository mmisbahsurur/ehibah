@extends('layout.front.master')

@push('plugin-styles')
    <link href="{{ asset('front/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Selamat Datang di Aplikasi E-Hibah</h4>
        </div>

    </div>

    {{-- <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <form method="get">
                <div class="row">
                    <div class="col-6 mb-3">
                        <div class="mb-3">
                            <label  class="form-label">Kab/Kota</label>
                            <select class="js-example-basic-single form-select" name="kabkota" data-width="100%" id="kotaDropdown" >
                                <option value="">-- Pilih Lokasi --</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="mb-3">
                            <label  class="form-label">Kecamatan</label>
                            <select  class="js-example-basic-single form-select" id="kecDropdown" name="kecamatan" data-width="100%">
                                <option value="">-- Pilih Lokasi --</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mb-3">
                        <div class="mb-3">
                            <label  class="form-label">Kelurahan</label>
                            <select  class="js-example-basic-single form-select" id="desDropdown" name="desas" data-width="100%">
                                <option value="">-- Pilih Lokasi --</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="mb-3">
                            <label  class="form-label">Kelompok Tani</label>
                            <select  class="js-example-basic-single form-select" id="desDropdown" name="desas" data-width="100%">
                                <option value="">-- Pilih Lokasi --</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button  name="filter" id="filter"  type="button" class="btn btn-primary btn-icon-text btn-xs" >
                    <i class="btn-icon-prepend" data-feather="search"></i>
                    Cari data
                </button>
            </form>
        </div>
    </div>
</div> --}}
    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">



        </div>
    </div> <!-- row -->

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Data Table</h6>


                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <td>Kota</td>
                                    @foreach($jenis_hibahs as $jenis_hibah)
                                    <td> {{ $jenis_hibah->nama.' - '.$jenis_hibah->satuan }}</td>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalHibah = [];
                                    foreach ($jenis_hibahs as $key => $jenis_hibah) {
                                        $totalHibah[$key] = 0;
                                    }
                                @endphp
                                @if ($countKota > 0)
                                @foreach ($kotas as $kota)
                                    <tr>
                                        <td>{{ $kota->name }}</td>
                                        @foreach ($jenis_hibahs as $key => $jenis_hibah)
                                            @php
                                                $totalHibah[$key] += getHibah($kota->kelompoktani, $jenis_hibah->id);
                                            @endphp
                                            <td>{{ number_format(getHibah($kota->kelompoktani, $jenis_hibah->id)) }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total Hibah</th>
                                    @foreach($jenis_hibahs as $key => $jenis_hibah)
                                    <th>{{ number_format($totalHibah[$key]) }}</th>
                                    @endforeach
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('front/assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('front/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('front/assets/js/data-table.js') }}"></script>
@endpush
