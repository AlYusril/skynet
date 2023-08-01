@extends('layouts.app_corona_client')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Tagihan Client {{ $member->nama }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td rowspan="6" width="70">
                                        <img src="{{ asset('corona') }}/assets/images/profil/profil.png" alt="{{ $member->nama }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50">Id Pelanggan</td>
                                    <td>: {{ $member->idpel }}</td>
                                </tr>
                                <tr>
                                    <td>No HP Terdaftar</td>
                                    <td>: {{ $member->nohp }}</td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>: {{ $member->nama }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat Lengkap</td>
                                    <td>: {{ $member->alamat_lengkap }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td>ID Pembayaran</td>
                                    <td>: TSMU#{{ $tagihan->id }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Jatuh Tempo</td>
                                    <td>: {{ $tagihan->tanggal_tagihan->format('d-F-Y') }}</td>
                                </tr>
                                <tr>
                                    <td>Batas Pembayaran</td>
                                    <td>: {{ $tagihan->tanggal_jatuh_tempo->format('d-F-Y') }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="{{ route('invoice.show', $tagihan->id) }}" target="_blank"><i class="fa fa-file-pdf"></i> Cetak Invoice Tagihan</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th>Tagihan</th>
                                <th>Jumlah Tagihan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tagihan->tagihanDetails as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_biaya }}</td>
                                    <td>{{ formatRupiah($item->jumlah_biaya) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" class="text-center font-weight-bold">Total Pembayaran</td>
                                <td class="font-weight-bold">{{formatRupiah($tagihan->tagihanDetails->sum('jumlah_biaya')) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="alert alert-secondary mt-4" role="alert">
                        Pembayaran bisa dilakukan dengan cara datang langsung ke Kantor, 
                        atau bisa transfer melalui bank milik PT. Skynet dibawah ini<br>
                        <u><i>Jangan melakukan transfer selain dari rekening dibawah ini</i></u><br>
                        berikut adalah tata cara pembayaran melalui <a href="{{ route('panduan.pembayaran', 'atm') }}" target="blank">ATM</a>
                        atau <a href="{{ route('panduan.pembayaran', 'internet-banking') }}" target="blank">Internet Banking</a><br>
                        <i>Setelah melakukan pembayaran via transfer, silahkan upload bukti bayar melalui tombol dibawah ini. Terimakasih!!</i>
                    </div>

                    <div class="row">
                        @foreach ($bankSkynet as $itemBank)
                            <div class="col-md-6">
                                <div class="alert alert-info" role="alert">
                                    <table class="table table-borderless table-sm" widht="100%">
                                        <tbody>
                                            <tr>
                                                <td width="30%">Bank Tujuan</td>
                                                <td>: {{ $itemBank->nama_bank }}</td>
                                            </tr>
                                            <tr>
                                                <td>Nomor Rekening</td>
                                                <td>: {{ $itemBank->norek }}</td>
                                            </tr>
                                            <tr>
                                                <td><i>A/N</i></td>
                                                <td>: {{ $itemBank->nama_rekening }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <a href="{{ route('client.pembayaran.create',[
                                        'tagihan_id' => $tagihan->id,
                                        'bank_skynet_id' => $itemBank->id,
                                    ]) }}" class="btn btn-primary btn-sm mt-2">Konfirmasi Bayar</a>
                                </div>
                            </div>
                        @endforeach
                    </div>             
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
