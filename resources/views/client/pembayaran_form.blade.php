@extends('layouts.app_corona_client')
@section('js')
    <script>
        $(document).ready(function () {
            $("#pilih_bank").change(function (e) {
                var bankId = $(this).find(":selected").val();
                window.location.href = "{!!  $url !!}&bank_skynet_id=" + bankId;
            });
        });
    </script>
@endsection
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">KONFIRMASI BAYAR</h5>
                <div class="card-body">
                    {{-- {!! Form::model($model, [$route, 'method' => $method, 'files' => true]) !!} --}}
                    {!! Form::model($model, ['route' => $route, 'method' => $method, 'files' => true]) !!}
                    {!! Form::hidden('tagihan_id', request('tagihan_id'), []) !!}
                    <h6 class="m-0 p-0 mb-0 pb-0"><i class="fa fa-info-circle"></i> Informasi Pembayaran</h6>
                    <div class="informasi-pembayaran">
                        <div class="form-group mt-0">
                            <label for="tanggal_bayar">Bank Tujuan Pembayaran</label>
                            {!! Form::select('bank_skynet_id', $listBank, request('bank_skynet_id'), [
                                'class' => 'form-control',
                                'placeholder' => 'Pilih Bank Tujuan Transfer',
                                'id' => 'pilih_bank'])
                                !!}
                            <span class="text-danger">{{ $errors->first('bank_skynet_id') }}</span>
                        </div>
                        @if(request('bank_skynet_id') != '')
                        <div class="alert alert-primary" role="alert">
                            <table class="table table-borderless table-sm" widht="100%">
                                <tbody>
                                    <tr>
                                        <td width="15%">Bank Tujuan</td>
                                        <td>: {{ $bankYangDipilih->nama_bank }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Rekening</td>
                                        <td>: {{ $bankYangDipilih->norek }}</td>
                                    </tr>
                                    <tr>
                                        <td><i>A/N</i></td>
                                        <td>: {{ $bankYangDipilih->nama_rekening }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif
                    </div>
                    <h6 class="m-0 p-0 mb-0 pb-0 mt-4"><i class="fa fa-info-circle"></i> Informasi Pembayaran</h6>
                    <div class="informasi-pembayaran">
                        <div class="form-group">
                            <label for="tanggal_bayar">Tanggal Bayar</label>
                            {!! Form::date('tanggal_bayar', $model->tanggal_bayar ?? date('Y-m-d'), ['class' => 'form-control']) !!}
                            <span class="text-danger">{{ $errors->first('tanggal_bayar') }}</span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="jumlah_dibayar">Jumlah Yang Dibayarkan</label>
                            {!! Form::text('jumlah_dibayar', $tagihan->tagihanDetails->sum('jumlah_biaya'), ['class' => 'form-control rupiah']) !!}
                            <span class="text-danger">{{ $errors->first('jumlah_dibayar') }}</span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="bukti_bayar">Bukti Pembayaran (<i> Ukuran File Maks 2MB. Format File : jpg, jpeg, png </i>)</label>
                            {!! Form::file('bukti_bayar', ['class' => 'form-control']) !!}
                            <span class="text-danger">{{ $errors->first('bukti_bayar') }}</span>
                        </div>
                    </div>
                    
                    {!! Form::submit('SIMPAN', ['class' => 'btn btn-primary mt-3']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
