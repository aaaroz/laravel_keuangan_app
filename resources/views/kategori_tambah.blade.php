@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Tambah Kategori</h5>
                        <a href="{{url('/kategori')}}" class="float-right btn btn-sm btn-secondary">Kembali</a>
                    </div>

                    <div class="card-body">
                        <form action="{{url('/kategori/aksi')}}" method="POST">
                        @csrf
                            <div class="form-group">
                                <label for="kategori">Nama Kategori</label>
                                <input type="text" name="kategori" class="form-control">
                                @if ($errors->has('kategori'))
                                <span class="text-danger"><strong>{{ $errors->first('kategori') }}</strong></span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
