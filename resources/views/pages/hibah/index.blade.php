@extends('layout.master')
@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/pickr/themes/classic.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Tabel</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Hibah</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Data Hibah</h6>
                <button type="button" class="btn btn-success btn-icon-text btn-xs" id="createNewHibah">
                    <i class="btn-icon-prepend" data-feather="plus"></i>
                    Tambah Hibah
                  </button>
                <!-- Tambah Data -->
                <div class="modal fade " tabindex="-1" aria-labelledby="myLargeModalLabel"  aria-hidden="true" id="FormHibah">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title h4" id="modelHeading"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                            </div>
                            <div class="modal-body">
                                {!! Form::open(array('route' => 'data-hibah.store','method'=>'POST','id' => 'sumbitForm')) !!}
                                <input type="hidden" name="id" id="id">
                                <div class="alert alert-danger alert-dismissible fade show print-error-msg" role="alert" style="display:none">
                                    <ul></ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <div class="mb-3">
                                            <label  class="form-label">Kelompok Tani</label>
                                            <select class="form-select-modal form-select js-example-basic-single" name="id_kelompoktani" data-width="100%" id="kelompoktani" >
                                                <option value="">-- Pilih Kelompok --</option>
                                                @foreach ($kelompok as $keylok => $lok)
                                                    <option value="{{$lok->id}}" > {{strtoupper($lok->nama_kelompok)}} ( KOTA: {{$lok->nmkot}}, KEC: {{$lok->nmkec}}, KEL: {{$lok->nmdes}} )</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="mb-3">
                                            <label  class="form-label">Jenis Hibah</label>
                                            <select  class="form-select-modal form-select js-example-basic-single" id="jenishibah" name="jenis_hibah" data-width="100%">
                                                <option value="">-- Pilih Jenis --</option>
                                                @foreach ($jenishibah as $keylok => $jn)
                                                    <option value="{{$jn->id}}" >{{$jn->nama}} ( {{$jn->satuan}} )</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <div class="mb-3">
                                            <label  class="form-label">Jumlah</label>
                                            <input type="number" name="jumlah" id="jumlah" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="mb-3">
                                            <label  class="form-label">Tahun</label>
                                            <input  class="form-control " name="kegiatan" id="kegiatan" type="text" placeholder="Masukkan Nama Kelompok" required>
                                        </div>
                                    </div>

                                </div>
                                    <button type="submit" class="btn btn-success" id="saveBtn" value="create"> <i class="fa fa-check"></i> Save</button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="" class="table data-table">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th>Nama Kelompok</th>
                                <th>Nomer Register</th>
                                <th>Jenis Bantuan</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Tahun</th>
                                <th>Action</th>
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
<script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
<script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/typeahead-js/typeahead.bundle.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
<script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
<script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pickr/pickr.min.js') }}"></script>
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
@endpush
@push('custom-scripts')
<script src="{{ asset('assets/js/data-table.js') }}"></script>
{{-- <script src="{{ asset('assets/js/form-validation.js') }}"></script> --}}
<script src="{{ asset('assets/js/bootstrap-maxlength.js') }}"></script>
<script src="{{ asset('assets/js/inputmask.js') }}"></script>
<script src="{{ asset('assets/js/select2.js') }}"></script>
<script src="{{ asset('assets/js/typeahead.js') }}"></script>
<script src="{{ asset('assets/js/tags-input.js') }}"></script>
<script src="{{ asset('assets/js/dropzone.js') }}"></script>
<script src="{{ asset('assets/js/dropify.js') }}"></script>
<script src="{{ asset('assets/js/sweet-alert.js') }}"></script>

<script type="text/javascript">
    $(function() {

      $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
        });
      $(function() {
        var table = $('.data-table').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('data-hibah.index') }}",
              columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'namakelom', name: 'namakelom'},
                {data: 'noreg', name: 'noreg'},
                {data: 'namajen', name: 'namajen'},
                {data: 'jumlah', name: 'jumlah'},
                {data: 'namasat', name: 'namasat'},
                {data: 'kegiatan', name: 'kegiatan'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
          });

         /*------------------------------------------
                --------------------------------------------
                Click to Button
                --------------------------------------------
                --------------------------------------------*/
                $('#createNewHibah').click(function() {
                    $('#saveBtn').val("create-hibah");
                    $('#id').val('');
                    $('#sumbitForm').trigger("reset");
                    $('#modelHeading').html("Tambah Data Hibah");
                    $('#FormHibah').modal('show');
                });

                /*------------------------------------------
                --------------------------------------------
                Click to Edit Button
                --------------------------------------------
                --------------------------------------------*/
                $('body').on('click', '.editHibah', function() {
                    var id = $(this).data('id');
                    $.get("{{ route('data-hibah.index') }}" + '/' + id + '/edit', function(data) {
                        $('#modelHeading').html("Edit Data Hibah");
                        $('#saveBtn').val("edit-hibah");
                        $('#FormHibah').modal('show');
                        $('#id').val(data.id);
                        $('#kelompoktani').val(data.id_kelompoktani);
                        $('#jenishibah').val(data.jenis_hibah);
                        $('#jumlah').val(data.jumlah);
                        $('#kegiatan').val(data.kegiatan);
                    })
                });

                /*------------------------------------------
                --------------------------------------------
                Create User Code
                --------------------------------------------
                --------------------------------------------*/
                $('#saveBtn').click(function(e) {
                    e.preventDefault();
                    $(this).html('Save');
                    $.ajax({
                        data: $('#sumbitForm').serialize(),
                        url: "{{ route('data-hibah.store') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function(data) {
                            if ($.isEmptyObject(data.error)) {
                                // alert(data.success);

                                // location.reload();

                                const swalWithBootstrapButtons = Swal.mixin({
                                    customClass: {
                                    confirmButton: 'btn btn-success',
                                    cancelButton: false
                                    },
                                    buttonsStyling: false,
                                })
                                $('#FormHibah').modal('hide');
                                $('#sumbitForm').trigger("reset");
                                swalWithBootstrapButtons.fire({
                                    title: 'Data berhasil disimpan',
                                    text: "",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonClass: 'me-2',
                                    confirmButtonText: 'OK',
                                    // cancelButtonText: 'No, cancel!',
                                    reverseButtons: true,

                                }).then((result) => {
                                    location.reload();

                                });
                            } else {
                                printErrorMsg(data.error);
                                // $('#sumbitForm').trigger("reset");

                            }


                        },


                        error: function(data) {
                            console.log('Error:', data);
                            $('#saveBtn').html('Save Changes');
                        }
                    });
                });

                function printErrorMsg(msg) {
                    $(".print-error-msg").find("ul").html('');
                    $(".print-error-msg").css('display', 'block');
                    $.each(msg, function(key, value) {
                        $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
                    });
                }
                /*------------------------------------------
                --------------------------------------------
                Delete User Code
                --------------------------------------------
                --------------------------------------------*/
                $('body').on('click', '.deleteHibah', function() {

                    var id = $(this).data("id");
                    // confirm("Are You sure want to delete !");
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger me-2'
                        },
                        buttonsStyling: false,
                    })

                    swalWithBootstrapButtons.fire({
                        title: 'Anda yakin ingin menghapus data?',
                        text: "Data yang dihapus tidak dapat dipulihkan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonClass: 'me-2',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Tidak, batal!',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                            type: "DELETE",
                            url: "{{ route('data-hibah.store') }}" + '/' + id,
                            success: function(data) {

                                swalWithBootstrapButtons.fire({
                                    title: 'Data berhasil dihapus',
                                    text: "",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonClass: 'me-2',
                                    confirmButtonText: 'OK',
                                    reverseButtons: true,

                                }).then((result) => {
                                    location.reload();

                                });
                                table.draw();
                            },
                            error: function(data) {
                                console.log('Error:', data);
                            }

                        });

                        } else if (
                        // Read more about handling dismissals
                        result.dismiss === Swal.DismissReason.cancel
                        ) {
                        swalWithBootstrapButtons.fire(
                            'Batalkan',
                            'Data batal dihapus :)',
                            'error'
                        )
                        }
                    })


                });
        // validate signup form on keyup and submit

      });
    });
</script>

<script>

    $(document).ready(function() {
      $(".js-example-basic-single").select2({
        dropdownParent: $("#FormHibah")
      });
    });

</script>
@endpush
