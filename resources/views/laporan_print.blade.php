<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan Keuangan</title>

    @vite('resources/css/app.css')
    <style type="text/css">
        table{
            border-collapse: collapse;
        }

        table, th, td{
            border: 1px solid black;
            text-align: center;
        }
        @media print {
            @page {
                size: landscape;
            }
        }
    </style>
</head>
<body>
    <center>
        <h1 class="text-xl font-bold py-2">LAPORAN TRANSAKSI KEUANGAN</h1>
    </center>
    <?php
    $dari = $_GET['dari'];
    $sampai = $_GET['sampai'];
    $kategori = $_GET['kategori'];
    ?>
    <table>
     <thead>
        <tr>
            <th rowspan="2" width="11%">Tanggal</th>
            <th rowspan="2" width="5%">Jenis</th>
            <th rowspan="2">Keterangan</th>
            <th rowspan="2">kategori</th>
            <th colspan="2">Transaksi</th>
         </tr>
         <tr>
            <th>Pemasukan</th>
            <th>Pengeluaran</th>
         </tr>
     </thead>
     <tbody>
        @php
         $total_pemasukan = 0;
         $total_pengeluaran = 0;   
        @endphp

        @foreach ($laporan as $l)
        <tr>
            <td>{{date('d-m-Y', strtotime($l->tanggal))}}</td>
            <td>{{$l->jenis}}</td>
            <td>{{$l->keterangan}}</td>
            <td>{{$l->kategori->kategori}}</td>
            <td>
                @if ($l->jenis == 'pemasukan')
                    {{'Rp.'.number_format($l->nominal).",-"}}
                    @php
                        $total_pemasukan += $l->nominal;
                    @endphp
                @else
                    -
                @endif
            </td>
            <td>
                @if ($l->jenis == 'pengeluaran')
                    {{'Rp.'.number_format($l->nominal).",-"}}
                    @php
                        $total_pengeluaran += $l->nominal;
                    @endphp
                @else
                    -
                @endif
            </td>
        </tr>
        @php
            $total_pemasukan += $l->nominal;
            $total_pengeluaran += $l->nominal;
        @endphp
        @endforeach
     </tbody>
     <tfoot>
        <tr>
            <td colspan="4">TOTAL</td>
            <td>{{'Rp.'.number_format($total_pemasukan).",-"}}</td>
            <td>{{'Rp.'.number_format($total_pengeluaran).",-"}}</td>
        </tr>
     </tfoot>
    </table> 
    <script>
        window.print();
    </script>   
</body>
</html>