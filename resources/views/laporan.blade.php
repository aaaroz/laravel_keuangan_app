@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Filter Laporan Keuangan</h5>
                    </div>

                    <div class="card-body">
                        <form action="{{ url('/laporan/aksi') }}" method="get">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="dari">Dari tanggal</label>
                                        <input type="date" name="dari" class="form-control" <?php if (isset($dari)) {
                                            echo "value='$dari'";
                                        } ?> />

                                        @if ($errors->has('dari'))
                                            <span class="text-danger">
                                                <strong>Tanggal dari harus diisi!</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="sampai">Sampai tanggal</label>
                                        <input type="date" name="sampai" class="form-control" <?php if (isset($sampai)) {
                                            echo "value='$sampai'";
                                        } ?> />

                                        @if ($errors->has('sampai'))
                                            <span class="text-danger">
                                                <strong>Tanggal sampai harus diisi!</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="kategori">Kategori</label>
                                        <select name="kategori" id="kategori" class="form-control">
                                            <option value="semua">Semua kategori</option>
                                            @foreach ($kategori as $k)
                                                @if (isset($kategori_id))
                                                    <option <?php if ($k->id == $kategori_id) {
                                                        echo "selected='selected'";
                                                    } ?> value="{{ $k->id }}">
                                                        {{ $k->kategori }}
                                                    </option>
                                                    @else
                                                    <option value="{{ $k->id }}">{{ $k->kategori }}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                        @if ($errors->has('kategori'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('kategori') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary mt-4">Tampilkan Laporan</button>
                                </div>
                            </div>
                        </form>
                        @if (isset($laporan))
                            <div class="mt-4">
                                <a href="{{ url('/laporan/print?dari=' . $dari . '&sampai=' . $sampai . '&kategori=' . $kategori_id) }}"
                                    target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-secondary">Print</a>
                                <a href="{{ url('/laporan/excel?dari=' . $dari . '&sampai=' . $sampai . '&kategori=' . $kategori_id) }}"
                                    target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-success">Export to
                                    Excel</a>

                            </div>
                            <table class="table table-bordered mt-4">
                                <thead>
                                    <tr>
                                        <th class="text-center" rowspan="2" width='11%'>Tanggal</th>
                                        <th class="text-center" rowspan="2" width='5%'>Jenis</th>
                                        <th class="text-center" rowspan="2">Keterangan</th>
                                        <th class="text-center" rowspan="2">Kategori</th>
                                        <th class="text-center" colspan="2">Transaksi</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Pemasukan</th>
                                        <th class="text-center">Pengeluaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total_pemasukan = 0;
                                        $total_pengeluaran = 0;
                                    @endphp
                                    @foreach ($laporan as $l)
                                        <tr>
                                            <td class="text-center">{{ date('d-m-Y', strtotime($l->tanggal)) }}</td>
                                            <td class="text-center">{{ $l->jenis }}</td>
                                            <td class="text-center">{{ $l->keterangan }}</td>
                                            <td class="text-center">{{ $l->kategori->kategori }}</td>
                                            <td class="text-center">
                                                @if ($l->jenis == 'pemasukan')
                                                    {{ 'Rp.' . number_format($l->nominal) . ',-' }}
                                                    @php
                                                        $total_pemasukan += $l->nominal;
                                                    @endphp
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($l->jenis == 'pengeluaran')
                                                    {{ 'Rp.' . number_format($l->nominal) . ',-' }}
                                                    @php
                                                        $total_pengeluaran += $l->nominal;
                                                    @endphp
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="text-center fw-bold" colspan="4">TOTAL</td>
                                        <td class="text-center bg-success text-white">
                                            {{ 'Rp.' . number_format($total_pemasukan) . ',-' }}</td>
                                        <td class="text-center bg-danger text-white">
                                            {{ 'Rp.' . number_format($total_pengeluaran) . ',-' }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
