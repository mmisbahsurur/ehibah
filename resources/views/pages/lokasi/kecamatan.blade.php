@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Tabel</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data Kecamatan</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Data Kecamatan</h6>
        <div class="table-responsive">
          <table id="" class="table data-table">
            <thead>
              <tr>
                <th style="width: 5%">No</th>
                <th>Kode Kota</th>
                <th>Kota</th>
                <th>Kode Kecamatan</th>
                <th>Kecamatan</th>

              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
  <script type="text/javascript">
    $(function () {

      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('lokasi.kecamatan') }}",
          columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'kode', name: 'kode'},
            {data: 'nmkot', name: 'nmkot'},
              {data: 'id', name: 'id'},
              {data: 'name', name: 'name'},

            //   {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });

    });
  </script>
@endpush
