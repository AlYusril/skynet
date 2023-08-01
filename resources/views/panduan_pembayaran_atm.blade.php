@extends('layouts.app_corona_blank')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="header">
                <h4 class="page-title">Panduan Pembayaran Melalui ATM</h4>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="instruction">
                        <h3>Langkah-langkah pembayaran:</h3>
                        <ol>
                          <li>Masukkan kartu ATM Anda ke mesin ATM</li>
                          <li>Masukkan PIN ATM Anda</li>
                          <li>Pilih menu "Transfer" atau "Pembayaran"</li>
                          <li>Pilih jenis pembayaran yang sesuai (misalnya, "Pembayaran Tagihan")</li>
                          <li>Masukkan nomor rekening tujuan pembayaran</li>
                          <li>Masukkan jumlah pembayaran yang ingin Anda bayarkan</li>
                          <li>Verifikasi informasi pembayaran yang ditampilkan di layar</li>
                          <li>Jika informasi sudah benar, lanjutkan dengan menekan "Ya" atau "Setuju"</li>
                          <li>Tunggu konfirmasi pembayaran dan simpan bukti transaksi yang diberikan</li>
                          <li>Selesai, jangan lupa ambil kartu ATM Anda sebelum meninggalkan mesin ATM</li>
                        </ol>
                      </div>
                    
                      <div class="note">
                        <h3>Catatan:</h3>
                        <ul>
                          <li>Pastikan Anda memiliki saldo yang cukup dalam rekening Anda sebelum melakukan pembayaran</li>
                          <li>Periksa nomor rekening tujuan pembayaran dengan teliti agar pembayaran Anda dikirimkan ke pihak yang benar</li>
                          <li>Simpan bukti transaksi pembayaran sebagai bukti pembayaran yang sah</li>
                          <li>Jika mengalami kendala atau kesulitan, segera hubungi layanan pelanggan bank terkait</li>
                        </ul>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
