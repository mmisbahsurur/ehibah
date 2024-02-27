@extends('layouts.app-master') @section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Administrator</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Administrator</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex no-block justify-content-end align-items-center">

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <!-- -------------------------------------------------------------- -->
        <!-- Start Page Content -->
        <!-- -------------------------------------------------------------- -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="border-bottom title-part-padding">
                        <h4 class="card-title mb-0">Tambah pengguna</h4>
                    </div>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Maaf!</strong> input belum sesuai.<br><br>
                            <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                        {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationDefault01">Nama</label>
                                    {!! Form::text('name', null, array('placeholder' => 'Nama','class' => 'form-control')) !!}
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationDefaultUsername">Username</label>
                                    {!! Form::text('username', null, array('placeholder' => 'Username','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationDefault03">Email</label>
                                    {!! Form::text('email', null, array('placeholder' => 'name@example.com','class' => 'form-control')) !!}
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationDefault04">Password</label>
                                    {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationDefault05">Konfirmasi Password</label>
                                    {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="inputState">Role</label>
                                    <select name="role" class="select2 form-control custom-select" style="width: 100%; height: 36px;">
                                        <option {{ $user->role == 1 ? 'selected' : '' }} value="1">Admin</option>
                                        <option  {{ $user->role == 2 ? 'selected' : '' }} value="2" >Bidang</option>
                                    </select>
                                </div>
                                @if ($user->type == "admin")

                                @else
                                <div class="col-md-6 mb-3">
                                    <label for="validationDefaultUsername">Bidang</label>
                                    <select name="type" class="select2 form-control custom-select" style="width: 100%; height: 36px;">
                                        @foreach ($bidang as $key => $x)
                                        <option value="{{$x->id}}" {{ $user->type == $x->nama_singkat ? 'selected' : '' }} >{{$x->nama}} </option>
                                        @endforeach

                                    </select>
                                </div>
                                @endif


                            </div>
                            <button class="btn btn-info rounded-pill px-4 mt-3" type="submit">
                                Submit
                            </button>
                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
        </div>
        <!-- -------------------------------------------------------------- -->
        <!-- End PAge Content -->
        <!-- -------------------------------------------------------------- -->
    </div>
</div>
@endsection
