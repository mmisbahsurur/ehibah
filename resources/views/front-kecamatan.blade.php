@extends('layout.front.master')

@push('plugin-styles')
    <link href="{{ asset('front/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Selamat Datang di Aplikasi E-Hibah</h4>
        </div>

    </div>

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form method="get" action="{{ route('kecamatan.index') }}">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="mb-3">
                                <label class="form-label">Kecamatan</label>
                                <select class="form-control" name="kecamatan" data-placeholder="Pilih Kecamatan" id="kotaDropdown">
                                </select>
                            </div>
                        </div>
                    </div>
                    <button id="filter" type="submit" class="btn btn-primary btn-icon-text btn-xs">
                        <i class="btn-icon-prepend" data-feather="search"></i>
                        Cari data
                    </button>
                </form>
            </div>
        </div>
    </div>
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
                                    <th>ID_Kota</th>
                                    <th>Kota</th>
                                    <th>ID Kecamatan</th>
                                    <th>Kecamatan</th>
                                    <th>Kelurahan</th>

                                    @foreach($jenis_hibahs as $jenis_hibah)
                                    <th> {{ $jenis_hibah->nama.' - '.$jenis_hibah->satuan }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    ini_set('max_execution_time', 180);
                                    $totalHibah = [];
                                    foreach ($jenis_hibahs as $key => $jenis_hibah) {
                                        $totalHibah[$key] = 0;
                                    }
                                @endphp
                                @if ($countDesa > 0)
                                @foreach ($desas as $desa)
                                    <tr>
                                        <td>{{ $desa->kecamatan->regency_id }}</td>
                                        <td>{{ $desa->kecamatan->kota->name }}</td>
                                        <td>{{ $desa->district_id }}</td>
                                        <td>{{ $desa->kecamatan->name }}</td>
                                        <td>{{ $desa->name }}</td>
                                        @foreach ($jenis_hibahs as $key => $jenis_hibah)
                                        @php
                                            $totalHibah[$key] += getHibah($desa->kelompoktani, $jenis_hibah->id);
                                        @endphp
                                            <td>{{ number_format(getHibah($desa->kelompoktani, $jenis_hibah->id)) }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="5">Total Hibah</th>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('front/assets/js/data-table.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#kotaDropdown").select2({
                ajax: {
                    url: "{{ route('selectkecamatan') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: function(params) {
                        return {
                            name: params.term,
                            page: params.page,
                            limit: 30,
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        var option = [];
                        $.each(data.rows, function(index, item) {
                            option.push({
                                id: item.id,
                                text: `${item.kota.name} | ${item.name}`
                            });
                        });
                        return {
                            results: option,
                            pagination: {
                                more: (params.page * 30) < data.total
                            },
                        };
                    },
                },
                allowClear: true,
            });
        });
    </script>
@endpush
