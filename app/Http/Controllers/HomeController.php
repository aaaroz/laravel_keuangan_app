<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function kategori()
    {
        $kategori = Kategori::all();
        return view('kategori', ['kategori' => $kategori]);
    }
    public function kategori_tambah()
    {
        return view('kategori_tambah');
    }
    public function kategori_aksi(Request $data)
    {
        $data->validate([
            'kategori' => "required"
        ]);

        $kategori = $data->kategori;

        Kategori::insert([
            'kategori' => $kategori,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        return redirect('kategori')->with('sukses', 'kategori berhasil ditambahkan!');
    }
    public function kategori_edit_aksi(Request $data, $id)
    {
        $data->validate([
            'kategori' => "required"
        ]);

        $nama_kategori = $data->kategori;

        $kategori = Kategori::find($id);
        $kategori->kategori = $nama_kategori;
        $kategori->save();

        return redirect('kategori')->with('sukses', 'kategori berhasil diubah!');
    }
    public function kategori_edit($id)
    {
        $kategori = Kategori::find($id);
        return view('kategori_edit', ['kategori' => $kategori]);
    }
    public function kategori_hapus($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();

        $transaksi = Transaksi::where('kategori_id', $id);
        $transaksi->delete();

        return redirect('kategori')->with('sukses', 'Kategori berhasil di hapus!');
    }
    public function transaksi()
    {
        $transaksi = Transaksi::orderBy('id', 'desc')->paginate(5);
        return view('transaksi', ['transaksi' => $transaksi]);
    }
    public function transaksi_tambah()
    {
        $kategori = Kategori::all();
        return view('transaksi_tambah', ['kategori' => $kategori]);
    }
    public function transaksi_aksi(Request $data)
    {
        $data->validate([
            'nominal' => "required",
            'kategori' => "required",
            'tanggal' => "required",
            'jenis' => "required",
        ]);
        $nominal = $data->nominal;
        $kategori_id = $data->kategori;
        $keterangan = $data->keterangan;
        $tanggal = $data->tanggal;
        $jenis = $data->jenis;

        Transaksi::insert([
            'tanggal' => $tanggal,
            'jenis' => $jenis,
            'kategori_id' => $kategori_id,
            'nominal' => $nominal,
            'keterangan' => $keterangan,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        return redirect('transaksi')->with('sukses', 'Transaksi berhasil ditambahkan!');
    }
    public function transaksi_edit($id)
    {
        $kategori = Kategori::all();
        $transaksi = Transaksi::find($id);
        return view('transaksi_edit', ['transaksi' => $transaksi, 'kategori' => $kategori]);
    }
    public function transaksi_edit_aksi(Request $data, $id)
    {
        $data->validate([
            'nominal' => "required",
            'kategori' => "required",
            'tanggal' => "required",
            'jenis' => "required",
        ]);
        $nominal = $data->nominal;
        $kategori_id = $data->kategori;
        $keterangan = $data->keterangan;
        $tanggal = $data->tanggal;
        $jenis = $data->jenis;

        $transaksi = Transaksi::find($id);
        $transaksi->nominal = $nominal;
        $transaksi->kategori_id = $kategori_id;
        $transaksi->keterangan = $keterangan;
        $transaksi->tanggal = $tanggal;
        $transaksi->jenis = $jenis;
        $transaksi->save();
        return redirect('transaksi')->with('sukses', 'Transaksi berhasil diubah!');
    }
    public function transaksi_hapus($id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->delete();
        return redirect('transaksi')->with('sukses', 'Transaksi berhasil di hapus!');
    }
    public function transaksi_cari(Request $data)
    {
        $cari = $data->cari;
        $transaksi = Transaksi::where(
            function ($query) use ($cari) {
                $query->where('nominal', 'like', '%' . $cari . '%')
                    ->orWhere('keterangan', 'like', '%' . $cari . '%')
                    ->orWhere('tanggal', 'like', '%' . $cari . '%')
                    ->orWhere('jenis', 'like', '%' . $cari . '%');
            }
        )->orderBy('id', 'desc')->paginate(5);
        $transaksi->appends($data->only('cari'));
        return view('transaksi', ['transaksi' => $transaksi]);
    }
    public function laporan()
    {
        $kategori = Kategori::all();
        return view('laporan', ['kategori' => $kategori]);
    }
    public function laporan_aksi(Request $req)
    {
        $req->validate([
            'dari' => "required",
            'sampai' => "required",
        ]);
        $kategori = Kategori::all();
        $dari = $req->dari;
        $sampai = $req->sampai;
        $kategori_id = $req->kategori;

        if ($kategori_id == 'semua') {
            $laporan = Transaksi::whereDate('tanggal',  '>=', $dari)->whereDate('tanggal',  '<=', $sampai)->orderBy('id', 'desc')->get();
        } else {
            $laporan = Transaksi::whereDate('tanggal',  '>=', $dari)->whereDate('tanggal',  '<=', $sampai)->where('kategori_id', $kategori_id)->orderBy('id', 'desc')->get();
        }

        return view('laporan', ['laporan' => $laporan, 'dari' => $dari, 'sampai' => $sampai, 'kategori' => $kategori, 'kategori_id' => $kategori_id]);
    }
}
