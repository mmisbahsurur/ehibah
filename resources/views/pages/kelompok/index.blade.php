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
        <li class="breadcrumb-item active" aria-current="page">Data Kelompok Tani</li>
    </ol>
</nav>
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <form method="get">
                <div class="row">
                    <div class="col-6 mb-3">
                        <div class="mb-3">
                            <label  class="form-label">Kab/Kota</label>
                            <select class="js-example-basic-single form-select" name="kabkota" data-width="100%" id="kotaDropdown" >
                                <option value="">-- Pilih Lokasi --</option>
                                @foreach ($kab as $keylok => $lok)
                                    <option value="{{$lok->id}}" >{{$lok->name}}</option>
                                @endforeach
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
                            <label  class="form-label">Desa</label>
                            <select  class="js-example-basic-single form-select" id="desDropdown" name="desas" data-width="100%">
                                <option value="">-- Pilih Lokasi --</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="mb-3">
                            <label  class="form-label">Tahun</label>
                            <input  class="form-control " name="noreg" id="noreg" type="text" placeholder="Masukkan Tahun" required>
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
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Data Kelompok Tani</h6>
                <button type="button" class="btn btn-success btn-icon-text btn-xs" id="createNewKelompok">
                <i class="btn-icon-prepend" data-feather="plus"></i>
                Tambah Kelompok
                </button><br><br>
                <!-- Tambah Data -->
                <div class="modal fade " tabindex="-1" aria-labelledby="myLargeModalLabel"  aria-hidden="true" id="FormKelompok">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title h4" id="modelHeading"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                            </div>
                            <div class="modal-body">
                                {!! Form::open(array('route' => 'kelompok-tani.store','method'=>'POST','id' => 'sumbitForm')) !!}
                                <input type="hidden" name="id" id="id">
                                <div class="alert alert-danger alert-dismissible fade show print-error-msg" role="alert" style="display:none">
                                    <ul></ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
                                  </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <div class="mb-3">
                                            <label  class="form-label">Kab/Kota</label>
                                            <select class="form-select-modal form-select" name="kota" data-width="100%" id="kotaxDropdown" >
                                                <option value="">-- Pilih Lokasi --</option>
                                                @foreach ($kab as $keylok => $lok)
                                                    <option value="{{$lok->id}}" >{{$lok->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="mb-3">
                                            <label  class="form-label">Kecamatan</label>
                                            <select  class="form-select-modal form-select" id="kecxDropdown" name="kecamatan" data-width="100%">
                                                <option value="">-- Pilih Lokasi --</option>
                                                @foreach ($kec as $keylok => $kec)
                                                    <option value="{{$kec->id}}" >{{$kec->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <div class="mb-3">
                                            <label  class="form-label">Desa</label>
                                            <select  class="form-select-modal form-select" id="desxDropdown" name="desa" data-width="100%">
                                                <option value="">-- Pilih Lokasi --</option>
                                                @foreach ($des as $keylok => $des)
                                                    <option value="{{$des->id}}" >{{$des->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="mb-3">
                                            <label  class="form-label">Nama kelompok</label>
                                            <input  class="form-control " name="nama_kelompok" id="nama_kelompok" type="text" placeholder="Masukkan Nama Kelompok" required>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="mb-3">
                                            <label  class="form-label">No register</label>
                                            <input  class="form-control " name="nomer_register" id="nomer_register" type="text" placeholder="Masukkan Nomer Register" required>
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
                                <th>Kota</th>
                                <th>Kecamatan</th>
                                <th>Desa</th>
                                {{-- <th>CP</th>
                                <th>Telepon</th> --}}
                                <th>Nomer Register</th>
                                <th>Act</th>
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
        load_data();

        function load_data(kotaDropdown = '', kecDropdown = '', desDropdown = '',noreg ='') {
            // $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                //   ajax: "{{ route('kelompok-tani.index') }}",
                ajax: {
                    url: '{{ route('kelompok-tani.index') }}',
                    data: function(d) {
                        d.kabkota = $('#kotaDropdown').find(":selected").val();
                        d.kecamatan = $('#kecDropdown').find(":selected").val();
                        d.desa = $('#desDropdown').find(":selected").val();
                        d.noreg = $('#noreg').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama_kelompok',
                        name: 'nama_kelompok'
                    },
                    {
                        data: 'nmkot',
                        name: 'nmkot'
                    },
                    {
                        data: 'nmkec',
                        name: 'nmkec'
                    },
                    {
                        data: 'nmdes',
                        name: 'nmdes'
                    },
                    // {
                    //     data: 'cp',
                    //     name: 'cp'
                    // },
                    // {
                    //     data: 'telp',
                    //     name: 'telp'
                    // },
                    {
                        data: 'nomer_register',
                        name: 'nomer_register'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        }
            $('#filter').click(function(){
                var kabkota = $('#kotaDropdown').val();
                var kecamatan = $('#kecDropdown').val();
                var desa = $('#desDropdown').val();
                var noreg = $('#noreg').val();


                if(kabkota != '' &&  kecamatan == '' && noreg == '' && desa == ''){
                    $('.data-table').DataTable().destroy();
                    load_data(kabkota);
                }

                if(kabkota != '' &&  kecamatan != '' && noreg == '' && desa == ''){
                    $('.data-table').DataTable().destroy();
                    load_data(kabkota, kecamatan);
                }

                if(kabkota != '' &&  kecamatan != '' && desa != '' && noreg == '' ){
                    $('.data-table').DataTable().destroy();
                    load_data(kabkota, kecamatan, desa);
                }

                if(kabkota != '' &&  noreg != '' && kecamatan == '' && desa == ''){
                    $('.data-table').DataTable().destroy();
                    load_data(kabkota, noreg);
                }

                if(kabkota !== '' &&  kecamatan != '' && noreg != '' && desa == ''){
                    $('.data-table').DataTable().destroy();
                    load_data(kabkota,noreg, kecamatan);
                }

                if(kabkota != '' &&  kecamatan != '' && noreg != '' && desa == ''){
                    $('.data-table').DataTable().destroy();
                    load_data(kabkota, kecamatan, noreg);
                }


                if(kabkota != '' &&  kecamatan != '' && noreg != '' && desa != ''){
                    $('.data-table').DataTable().destroy();
                    load_data(kabkota, kecamatan, noreg, desa);
                }
                if(noreg != '' && kabkota == '' &&  kecamatan == '' && desa == ''){
                    $('.data-table').DataTable().destroy();
                    load_data(noreg);
                }
                //  else{
                //     alert('Both Date is required');
                // }

            });
            $('#refresh').click(function(){
            $('#kabkota').val('');
            $('#komoditas').val('');
            $('.data-table').DataTable().destroy();
            load_data();
            });

            /*------------------------------------------
            --------------------------------------------
            Click to Button
            --------------------------------------------
            --------------------------------------------*/
            $('#createNewKelompok').click(function() {
                $('#saveBtn').val("create-kelompok");
                $('#id').val('');
                $('#sumbitForm').trigger("reset");
                $('#modelHeading').html("Tambah Kelompok");
                $('#FormKelompok').modal('show');
            });

            /*------------------------------------------
            --------------------------------------------
            Click to Edit Button
            --------------------------------------------
            --------------------------------------------*/
            $('body').on('click', '.editKelompok', function() {
                var id = $(this).data('id');
                $.get("{{ route('kelompok-tani.index') }}" + '/' + id + '/edit', function(data) {
                    $('#modelHeading').html("Edit Kelompok");
                    $('#saveBtn').val("edit-kelompok");
                    $('#FormKelompok').modal('show');
                    $('#id').val(data.id);
                    $('#kotaxDropdown').val(data.kota);
                    $('#kecxDropdown').val(data.kecamatan);
                    $('#desxDropdown').val(data.desa);
                    $('#nama_kelompok').val(data.nama_kelompok);
                    $('#nomer_register').val(data.nomer_register);
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
                    url: "{{ route('kelompok-tani.store') }}",
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
                            $('#FormKelompok').modal('hide');
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
            $('body').on('click', '.deleteKelompok', function() {

                var user_id = $(this).data("id");
                // confirm("Are You sure want to delete !");
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger me-2'
                    },
                    buttonsStyling: false,
                })

                swalWithBootstrapButtons.fire({
                    title: 'Anda yakin ingin mengahpus data?',
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
                        url: "{{ route('kelompok-tani.store') }}" + '/' + user_id,
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
    });
</script>
<script>
    $(document).ready(function () {

        /*------------------------------------------
        --------------------------------------------
        Country Dropdown Change Event
        --------------------------------------------
        --------------------------------------------*/
        $('#kotaDropdown').on('change', function () {
            var idKota = this.value;
            $("#kecDropdown").html('');
            $.ajax({
                url: "{{url('api/fetch-kec')}}",
                type: "POST",
                data: {
                    regency_id: idKota,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#kecDropdown').html('<option value="">-- Pilih Kecamatan --</option>');
                    $.each(result.kecamatan, function (key, value) {
                        $("#kecDropdown").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                    // $('#kotaDropdown').html('<option value="">-- Pilih Kota --</option>');
                }
            });
        });

        /*------------------------------------------
        --------------------------------------------
        State Dropdown Change Event
        --------------------------------------------
        --------------------------------------------*/
        $('#kecDropdown').on('change', function () {
            var idDes = this.value;
            $("#desDropdown").html('');
            $.ajax({
                url: "{{url('api/fetch-des')}}",
                type: "POST",
                data: {
                    district_id: idDes,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (res) {
                    $('#desDropdown').html('<option value="">-- Pilih Desa --</option>');
                    $.each(res.desa, function (key, value) {
                        $("#desDropdown").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            });
        });

    });
</script>
<script>
    $(document).ready(function () {

        /*------------------------------------------
        --------------------------------------------
        Country Dropdown Change Event
        --------------------------------------------
        --------------------------------------------*/
        $('#kotaxDropdown').on('change', function () {
            var idKota = this.value;
            $("#kecxDropdown").html('');
            $.ajax({
                url: "{{url('api/fetch-kec')}}",
                type: "POST",
                data: {
                    regency_id: idKota,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#kecxDropdown').html('<option value="">-- Pilih Kecamatan --</option>');
                    $.each(result.kecamatan, function (key, value) {
                        $("#kecxDropdown").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                    // $('#kotaDropdown').html('<option value="">-- Pilih Kota --</option>');
                }
            });
        });

        /*------------------------------------------
        --------------------------------------------
        State Dropdown Change Event
        --------------------------------------------
        --------------------------------------------*/
        $('#kecxDropdown').on('change', function () {
            var idDes = this.value;
            $("#desxDropdown").html('');
            $.ajax({
                url: "{{url('api/fetch-des')}}",
                type: "POST",
                data: {
                    district_id: idDes,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (res) {
                    $('#desxDropdown').html('<option value="">-- Pilih Desa --</option>');
                    $.each(res.desa, function (key, value) {
                        $("#desxDropdown").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            });
        });

    });
</script>
{{-- <script>

    $(document).ready(function() {
      $(".form-select-modal").select2({
        dropdownParent: $("#FormKelompok")
      });
    });

</script> --}}
@endpush
