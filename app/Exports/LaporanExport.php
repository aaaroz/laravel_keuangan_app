<?php

namespace App\Exports;

use App\Models\Transaksi;
use App\Models\Kategori;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanExport implements FromView
{
    public function view(): View
    {
        $kategori = Kategori::all();

        $dari = $_GET['dari'];
        $sampai = $_GET['sampai'];
        $kategori_id = $_GET['kategori'];

        if ($kategori_id == 'semua') {
            $laporan = Transaksi::whereDate('tanggal',  '>=', $dari)->whereDate('tanggal',  '<=', $sampai)->orderBy('id', 'desc')->get();
        } else {
            $laporan = Transaksi::whereDate('tanggal',  '>=', $dari)->whereDate('tanggal',  '<=', $sampai)->where('kategori_id', $kategori_id)->orderBy('id', 'desc')->get();
        }

        return view('laporan_excel', ['laporan' => $laporan, 'kategori' => $kategori, 'dari' => $dari, 'sampai' => $sampai, 'kategori_id' => $kategori_id]);
    }
}
