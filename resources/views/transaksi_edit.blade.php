@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Edit Transaksi</h5>
                        <a href="{{ url('/transaksi') }}" class="float-right btn btn-sm btn-secondary">Kembali</a>
                    </div>

                    <div class="card-body">
                        <form action="{{ url('/transaksi/edit/aksi/'.$transaksi->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="tanggal">Tanggal Transaksi</label>
                                <input type="date" name="tanggal" class="form-control" value="{{$transaksi->tanggal}}">
                                @if ($errors->has('tanggal'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('tanggal') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="jenis">Jenis</label>
                                <select name="jenis" id="jenis" class="form-control">
                                    <option value="">Pilih Jenis</option>
                                    <option <?php if($transaksi->jenis == 'pemasukan'){
                                        echo "selected='selected'";
                                    }?> value="pemasukan">Pemasukan</option>
                                    <option <?php if($transaksi->jenis == 'pengeluaran'){
                                        echo "selected='selected'";
                                    }?> value="pengeluaran">Pengeluaran</option>
                                </select>
                                @if ($errors->has('jenis'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('jenis') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select name="kategori" id="kategori" class="form-control">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($kategori as $k)
                                        <option <?php if($k-> id === $transaksi->kategori_id){
                                            echo "selected='selected'";
                                        }?> value="{{ $k->id }}">{{ $k->kategori }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('kategori'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('kategori') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="nominal">Nominal</label>
                                <input type="number" name="nominal" class="form-control" value="{{$transaksi->nominal}}">
                                @if ($errors->has('nominal'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('nominal') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="deskripsi">Keterangan</label>
                                <textarea name="keterangan" class="form-control">{{$transaksi->keterangan}}</textarea>
                                @if ($errors->has('keterangan'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('keterangan') }}</strong>
                                    </span>
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
