@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ganti Password') }}</div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/ganti_password/aksi') }}">
                        {{csrf_field()}}

                        <div class="form-group mt-3">
                            <label for="password_now">Masukan Password Sekarang</label>
                            <input type="password" name="password_now" id="password_now" class="form-control" placeholder="********" required>
                            @if($errors->has('password_now'))
                            <span class="help-block">
                                <strong class="help-block">
                                    <strong>{{ $errors->first('password_now') }}</strong>
                                </strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group mt-3">
                            <label for="password">Masukan Password Baru</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="********" required>
                            @if($errors->has('password'))
                            <span class="help-block">
                                <strong class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group mt-3">
                            <label for="password_confirmation">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="********" required>
                            @if($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Ganti Password</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection