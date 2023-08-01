@extends('layouts.app_corona',['title' => 'Setting Web | '])

@section('content')
@include('admin.headersetting_index')
<div class="row justify-content-center">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                {!! Form::open(['route' => 'setting.store', 'method' => 'POST', 'files' => true]) !!}
                <h6 class="card-title">Pengaturan Aplikasi</h6>
                <div class="form-group mt-3">
                    <label for="app_pagination">Data Per Halaman</label>
                    {!! Form::number('app_pagination', settings()->get('app_pagination'), ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('app_pagination') }}</span>
                </div>
                <div class="form-group mt-3">
                    <label for="pesan_bulan">Jadwal Pengingat Pesan Tagihan</label>
                    <div class="form-group row">
                        <div class="col">
                            <label>Date:</label>
                            {{ Form::selectRange('tanggal_st', 1, 31, Settings('tanggal_st'),[
                                'class' => 'form-control',
                                'placeholder' => 'Pilih Tanggal Pengingat Pertama',
                            ]) }}
                        </div>
                        <div class="col">
                            <label>Date:</label>
                            {{ Form::selectRange('tanggal_nd', 1, 31, Settings('tanggal_nd'),[
                                'class' => 'form-control',
                                'placeholder' => 'Pilih Tanggal Pengingat Kedua',
                            ]) }}
                        </div>
                        <div class="col">
                            <label>time:</label>
                            {!! Form::time('jam_ke', Settings('jam_ke'), [
                                'class' => 'form-control',
                                'placeholder' => 'Pilih Jam Pengingat'
                            ]) !!}
                        </div>
                    </div>
                </div>
                <hr class="bg-white">
                <div class="form-group mt-3">
                    <div class="alert alert-primary">
                        <span>
                            <h6>Format Pesan Whatsapp:</h6>
                            <div class="row">
                                <div class="col-md-3">
                                    <p class="text-sm">
                                        {bulan} : Bulan tagihan <br>
                                        {tahun} : Tahun tagihan <br>
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <p class="text-sm">
                                        {nama} : Nama Member <br>
                                        {tagihan} : Jumlah tagihan <br>
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <p class="text-sm">
                                        {idpel} : ID Pelanggan <br>
                                        {rincianTagihan} : Item Tagihan <br>
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <p class="text-sm">
                                        *text* : huruf tebal
                                    </p>
                                </div>
                            </div>
                            <h6>Contoh Template</h6>
                            <p>
                                Yth. Pelanggan Skytama <br>
                                Kami informasikan jumlah tagihan Internet Anda untuk nomor {idpel} a.n {nama} dibulan 
                                {bulan}-{tahun} sebesar {tagihan}, rincian sebagai berikut : <br><br>
                                {rincianTagihan} <br><br>
                                lakukan pembayaran sebelum tanggal 20-{bulan}-{tahun} untuk terus dapat menikmati layanan Internet Anda <br>
                                *Abaikan pesan ini jika telah melakukan pembayaran* <br>
                                Terima kasih. <br>
                            </p>
                        </span>

                    </div>
                    <label for="pesan_tagihan">Template Whatsapp Pengingat Tagihan</label>
                    {!! Form::textarea('pesan_tagihan', str_replace('\n', PHP_EOL, Settings('pesan_tagihan')), [
                        'class' => 'form-control',
                        'rows' => 10,
                        'id' => 'my-textarea',
                    ]) !!}
                    <span class="text-danger">{{ $errors->first('pesan_tagihan') }}</span>
                </div>
                {!! Form::submit('UPDATE', ['class' => 'btn btn-primary mt-3', 'id' => 'my-form']) !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
{{-- <script>
    document.getElementById('my-textarea').addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            var text = this.value;
            var selectionStart = this.selectionStart;
            var selectionEnd = this.selectionEnd;
            var firstPart = text.slice(0, selectionStart);
            var secondPart = text.slice(selectionEnd);
            this.value = firstPart + '\n' + secondPart;
            this.selectionStart = this.selectionEnd = selectionStart + 1;
        }
    });
</script> --}}
@endsection
