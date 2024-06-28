@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Data Transaksi</h5>
                        <a href="{{url('/transaksi/tambah')}}" class="float-right btn btn-sm btn-primary">Tambah Transaksi</a>
                    </div>

                    <div class="card-body">
                        @if ((Session::has('sukses')))
                        <div class="alert alert-info">
                            {{Session::get('sukses')}}
                        </div>
                        @endif

                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <form action="{{url('/transaksi/cari')}}" method="get" class="d-flex justify-content-between ">
                                    <input type="text" name="cari" class="form-control" id="cari" placeholder="Cari data transaksi..." value="<?php if(isset($_GET['cari'])){echo $_GET['cari'];}?>">
                                    <button type="submit" class="ms-2 float-right btn btn-primary">Cari</button>
                                </form>
                            </div>
                        </div>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" rowspan="2" width="11%">Tanggal</th>
                                    <th class="text-center" rowspan="2" width="5%">Jenis</th>
                                    <th class="text-center" rowspan="2">Keterangan</th>
                                    <th class="text-center" rowspan="2">Kategori</th>
                                    <th class="text-center" colspan="2">Transaksi</th>
                                    <th class="text-center" rowspan="2" width="13%">Opsi</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Pemasukan</th>
                                    <th class="text-center">Pengeluaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $t)
                                <tr>
                                    <td class="text-center">{{date('d-m-Y', strtotime($t->tanggal))}}</td>
                                    <td class="text-center">{{$t->jenis}}</td>
                                    <td class="text-center">{{$t->keterangan}}</td>
                                    <td class="text-center">{{$t->kategori->kategori}}</td>
                                    <td class="text-center">
                                        @if ($t->jenis == 'pemasukan')
                                        {{"Rp.".number_format($t->nominal).",-"}}
                                        @else 
                                        -
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($t->jenis == 'pengeluaran')
                                        {{"Rp.".number_format($t->nominal).",-"}}
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{url('/transaksi/edit/'.$t->id)}}" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="{{url('/transaksi/hapus/'.$t->id)}}" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$transaksi->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
