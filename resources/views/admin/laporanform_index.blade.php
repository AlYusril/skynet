@extends('layouts.app_corona')

@section('content')
<div class="header">
    <div class="page-title">Rekap Laporan</div>
</div>
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="card-title">Laporan Tagihan</h5>
                        {!! Form::open(['route' => 'laporantagihan.index', 'method' => 'GET', 'target' => 'blank']) !!}
                        <div class="row"> 
                            <div class="col-md-2 col-sm-12">
                                <label for="paket">Paket Internet</label>
                                {{-- {!! Form::selectMonth('bulan', request('bulan'), ['class' => 'form-control', 'placeholder' => 'Paket Internet']) !!} --}}
                                {!! Form::select('biaya', $listBiaya, null, ['class' => 'form-control', 'placeholder' => 'Paket Internet']) !!}
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label for="status">Status</label>
                                {!! Form::select(
                                    'status', 
                                    [
                                        '' => 'Pilih Status',
                                        'lunas' => 'Lunas',
                                        'baru' => 'Baru',
                                        'angsur' => 'Angsur',
                                ],
                                request('status'),
                                ['class' => 'form-control'],
                                ) !!}
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <label for="bulan">Bulan</label>
                                {!! Form::selectMonth('bulan', request('bulan'), ['class' => 'form-control', 'placeholder' => 'Pilih Bulan']) !!}
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <label for="tahun">Tahun</label>
                                {!! Form::selectRange('tahun', 2022, date('Y') + 1, request('tahun'), ['class' => 'form-control', 'placeholder' => 'Pilih Tahun']) !!}
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <label for="submit"></label>
                                <button class="btn btn-primary" style="margin-top:2.5rem;" type="submit">Tampil</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <hr class="bg-white">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <h5 class="card-title">Laporan Pembayaran</h5>
                        {!! Form::open(['route' => 'laporanpembayaran.index', 'method' => 'GET', 'target' => 'blank']) !!}
                        <div class="row gx-2">
                            <div class="col-md-2 col-sm-12">
                                <label for="paket">Paket Internet</label>
                                {{-- {!! Form::selectMonth('bulan', request('bulan'), ['class' => 'form-control', 'placeholder' => 'Paket Internet']) !!} --}}
                                {!! Form::select('biaya', $listBiaya, null, ['class' => 'form-control', 'placeholder' => 'Paket Internet']) !!}
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label for="status">Status</label>
                                {!! Form::select(
                                    'status', 
                                    [
                                        '' => 'Pilih Status',
                                        'sudah' => 'Sudah Dikonfirmasi',
                                        'belum' => 'Belum Dikonfirmasi',
                                ],
                                request('status'),
                                ['class' => 'form-control'],
                                ) !!}
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <label for="bulan">Bulan</label>
                                {!! Form::selectMonth('bulan', request('bulan'), ['class' => 'form-control', 'placeholder' => 'Pilih Bulan']) !!}
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <label for="tahun">Tahun</label>
                                {!! Form::selectRange('tahun', 2022, date('Y') + 1, request('tahun'), ['class' => 'form-control', 'placeholder' => 'Pilih Tahun']) !!}
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <label for="submit"></label>
                                <button class="btn btn-primary" style="margin-top:2.5rem;" type="submit">Tampil</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <hr class="bg-white">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <h5 class="card-title">Laporan Pembayaran</h5>
                        {!! Form::open(['route' => 'rekappembayaran.index', 'method' => 'GET', 'target' => 'blank']) !!}
                        <div class="row gx-2">
                            <div class="col-md-2 col-sm-12">
                                <label for="paket">Paket Internet</label>
                                {{-- {!! Form::selectMonth('bulan', request('bulan'), ['class' => 'form-control', 'placeholder' => 'Paket Internet']) !!} --}}
                                {!! Form::select('biaya', $listBiaya, null, ['class' => 'form-control', 'placeholder' => 'Paket Internet']) !!}
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <label for="tahun">Tahun</label>
                                {!! Form::selectRange('tahun', 2022, date('Y') + 1, request('tahun') ?? date('Y'), ['class' => 'form-control', 'placeholder' => 'Pilih Tahun']) !!}
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <label for="submit"></label>
                                <button class="btn btn-primary" style="margin-top:2.5rem;" type="submit">Tampil</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
