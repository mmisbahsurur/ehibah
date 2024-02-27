
@extends('layout.master2')

@section('content')
<div class="page-content d-flex align-items-center justify-content-center">

  <div class="row w-100 mx-0 auth-page">
    <div class="col-md-8 col-xl-6 mx-auto">
      <div class="card">
        <div class="row">
          <div class="col-md-4 pe-md-0">
            <div class="auth-side-wrapper" style="background-image: url({{ url('assets/images/login.jpeg') }})">

            </div>
          </div>
          <div class="col-md-8 ps-md-0">
            <div class="auth-form-wrapper px-4 py-5">
              <a href="#" class="noble-ui-logo d-block mb-2">E-<span>Hibah</span></a>
              <h5 class="text-muted fw-normal mb-4">Selamat datang di aplikasi e-hibah.</h5>
                <form method="POST" action="{{ route('login') }}" class="forms-sample">
                    @csrf
                <div class="mb-3">
                  <label for="userEmail" class="form-label">Email</label>
                  <input id="email" type="email" id="userEmail" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="userPassword" class="form-label">Password</label>
                  <input id="userPassword" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                {{-- <div class="form-check mb-3">
                  <input type="checkbox" class="form-check-input" id="authCheck">
                  <label class="form-check-label" for="authCheck">
                    Remember me
                  </label>
                </div> --}}
                <div>
                    <button type="submit" class="btn btn-primary me-2 mb-2 mb-md-0">
                        {{ __('Login') }}
                    </button>

                </div>
                {{-- <a href="{{ url('/auth/register') }}" class="d-block mt-3 text-muted">Not a user? Sign up</a> --}}
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection
