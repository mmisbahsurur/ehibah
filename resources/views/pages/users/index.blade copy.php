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
@endpush
@section('content')

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Tabel</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Pengguna</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Data Pengguna</h6>
                <button type="button" class="btn btn-success btn-icon-text btn-xs" id="createNewUser">
                    <i class="btn-icon-prepend" data-feather="plus"></i>
                    Tambah Pengguna
                  </button>
                <!-- Tambah Data -->
                <div class="modal fade " tabindex="-1" aria-labelledby="myLargeModalLabel"  aria-hidden="true" id="FormUser">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title h4" id="modelHeading"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                            </div>
                            <div class="modal-body">
                                {!! Form::open(array('route' => 'users.store','method'=>'POST','id' => 'sumbitForm')) !!}
                                <input type="hidden" name="user_id" id="user_id">

                                <div class="alert alert-danger alert-dismissible fade show print-error-msg" role="alert" style="display:none">
                                  <ul></ul>
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
                                </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama</label>
                                        <input id="name" class="form-control " name="name" type="text" placeholder="Masukkan Nama" required>

                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        {!! Form::text('email', null, array('placeholder' => 'name@example.com','class' => 'form-control','id' => 'email')) !!}
                                    </div>
                                    <div class="mb-3">
                                        <label for="ageSelect" class="form-label">Role</label>
                                        <select class="form-select js-example-basic-single" name="type" id="ageSelect" data-width="100%" >
                                            <option >Select Role</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Bidang/Balai</option>

                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input id="password" class="form-control" name="password" type="password" placeholder="Masukkan Password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirm_password" class="form-label">Confirm password</label>
                                        <input id="confirm_password" class="form-control" name="confirm_password" type="password" placeholder="Konfirmasi Password">
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
                                <th>Email</th>
                                <th>Role</th>
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
          ajax: "{{ route('users.index') }}",
          columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'email', name: 'email'},
              {data: 'type', name: 'type'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });

    /*------------------------------------------
    --------------------------------------------
    Click to Button
    --------------------------------------------
    --------------------------------------------*/
      $('#createNewUser').click(function () {
        $('#saveBtn').val("create-user");
        $('#user_id').val('');
        $('#sumbitForm').trigger("reset");
        $('#modelHeading').html("Tambah Pengguna");
        $('#FormUser').modal('show');
    });

    /*------------------------------------------
    --------------------------------------------
    Click to Edit Button
    --------------------------------------------
    --------------------------------------------*/
    $('body').on('click', '.editUser', function () {
      var user_id = $(this).data('id');
      $.get("{{ route('users.index') }}" +'/' + user_id +'/edit', function (data) {
          $('#modelHeading').html("Edit Pengguna");
          $('#saveBtn').val("edit-user");
          $('#FormUser').modal('show');
          $('#user_id').val(data.id);
          $('#name').val(data.name);
          $('#email').val(data.email);
          $('#type').val(data.type);
      })
    });

    /*------------------------------------------
    --------------------------------------------
    Create User Code
    --------------------------------------------
    --------------------------------------------*/
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        // $(this).html('Sending..');
        var formData = {
        name: $("#name").val(),
        email: $("#email").val(),

        };
        $.ajax({
          data: $('#sumbitForm').serialize(),
          url: "{{ route('users.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
            if($.isEmptyObject(data.error)){
                    alert(data.success);
                    location.reload();
                }else{
                    console.log(data);
                    // printErrorMsg(data.error);

                }
              $('#sumbitForm').trigger("reset");
            //   $('#FormUser').modal('hide');
              table.draw();

          },

          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
    });
    function printErrorMsg (msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
    }
    /*------------------------------------------
    --------------------------------------------
    Delete User Code
    --------------------------------------------
    --------------------------------------------*/
    $('body').on('click', '.deleteUser', function () {

        var user_id = $(this).data("id");
        confirm("Are You sure want to delete !");

        $.ajax({
            type: "DELETE",
            url: "{{ route('users.store') }}"+'/'+user_id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
    // validate signup form on keyup and submit
    $("#sumbitForm").validate({
      rules: {
        name: {
          required: true,
          minlength: 3
        },
        email: {
          required: true,
          email: true ,

        },
        type: {
          required: true
        },
        password: {
          required: true,
          minlength: 5
        },
        confirm_password: {
          required: true,
          minlength: 5,
          equalTo: "#password"
        },
      },
      messages: {
        name: {
          required: "Masukkan nama anda",
          minlength: "Nama minimal 3 karakter"
        },
        email: "Masukkan email valid",
        type: "Pilih role user",
        password: {
          required: "Silahkan masukkan password",
          minlength: "Password Minimal 5 Karakter"
        },
        confirm_password: {
          required: "Konfirmasi Password",
          minlength: "Password Minimal 5 Karakter",
          equalTo: "Konfirmasi password salah"
        },

      },
      errorPlacement: function(error, element) {
        error.addClass( "invalid-feedback" );

        if (element.parent('.input-group').length) {
          error.insertAfter(element.parent());
        }

        else {
          error.insertAfter(element);
        }
      },
      highlight: function(element, errorClass) {
        if ($(element).prop('type') != 'checkbox' && $(element).prop('type') != 'radio') {
          $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
        }
      },
      unhighlight: function(element, errorClass) {
        if ($(element).prop('type') != 'checkbox' && $(element).prop('type') != 'radio') {
          $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
        }
      }
    });
  });
});
</script>
<script>

    $(document).ready(function() {
      $(".js-example-basic-single").select2({
        dropdownParent: $("#FormUser")
      });
    });

    </script>
@endpush
