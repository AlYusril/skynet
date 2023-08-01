@extends('layouts.app_corona')
@section('js')
<script>
    $(document).ready(function () {
        $("#loading-spinner").hide();
        // $("#form-ajax").submit(function (e) {
        //     $.ajax({
        //         type: $(this).attr('method'),
        //         url: $(this).attr('action'),
        //         data: $(this).serialize(),
        //         dataType: "json",
        //         beforeSend: function () {
        //             $("#loading-spinner").show();
        //             $("#overlay").removeClass('d-none');
        //         },
        //         success: function (response) {
        //             $("#alert-message").removeClass('d-none');
        //             $("#alert-message").html(response.message);
        //             $("#overlay").addClass('d-none');
        //             $("#loading-spinner").hide();
        //         },
        //         error: function (xhr, status, error) { 
        //             $("#alert-message").removeClass('d-none');
        //             $("#alert-message").removeClass('alert-success');
        //             $("#alert-message").addClass('alert-danger');
        //             $("#alert-message").html(xhr.responseJSON.message);
        //             $("#overlay").addClass('d-none');
        //             $("#loading-spinner").hide();
        //         }
        //     }); 
        //     e.preventDefault();
        // });
    });
  </script>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $title }}</h5>
                    {!! Form::model($model, ['route' => $route, 'method' => $method, 'id' => 'form-ajax']) !!}
                    
                    {{-- <label for="">Paket Internet</label>
                    @foreach ($biaya as $item)
                    <div class="form-check">
                        <label class="form-check-label" for="defaultCheck{{ $loop->iteration }}">
                            {{ $item->nama_biaya_full }}
                            {!! Form::checkbox('biaya_id[]', $item->id, null, [
                                'class' => 'form-check-input',
                                'id' => 'defalutCheck' . $loop->iteration,
                            ]) !!}
                        </label>
                    </div>
                    @endforeach --}}

                    {{-- <div class="form-group mt-3">
                        <label for="desa">Tagihan Pelanggan Untuk Desa</label>
                        {!! Form::select('desa', $desa, null, ['class' => 'form-control','placeholder' => 'Pilih Desa' ]) !!}
                        <span class="text-danger">{{ $errors->first('desa') }}</span>
                    </div>

                    <div class="form-group mt-1">
                        <label for="kecamatan">Tagihan Pelanggan Kecamatan</label>
                        {!! Form::select('kecamatan', $kecamatan, null, ['class' => 'form-control','placeholder' => 'Pilih Kecamatan' ]) !!}
                        <span class="text-danger">{{ $errors->first('kecamatan') }}</span>
                    </div> --}}

                    <div class="form-group"> 
                        <label for="member_id">Pelanggan</label>
                        {!! Form::select('member_id', $memberList, null, ['class' => 'form-control select2',
                        'placeholder' => 'Pilih Pelanggan',
                        ]) !!}
                        <span class="text-danger">{{ $errors->first('member_id') }}</span>
                    </div>

                    <div class="form-group mt-3"> 
                        <label for="tanggal_tagihan">Tanggal Tagihan</label>
                        {!! Form::date('tanggal_tagihan', $model->tanggal_tagihan ?? date('Y-m-').'05', 
                        ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('tanggal_tagihan') }}</span>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_jatuh_tempo">Tanggal Jatuh Tempo</label>
                        {!! Form::date('tanggal_jatuh_tempo', $model->tanggal_jatuh_tempo ?? date('Y-m-').'15', 
                        ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('tanggal_jatuh_tempo') }}</span>
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        {!! Form::textarea('keterangan', null, ['class' => 'form-control', 'rows' => 4]) !!}
                        <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                    </div>

                    {{-- {!! Form::submit($button, ['class' => 'btn btn-primary mt-3']) !!} --}}
                    <button class="btn btn-primary mt-3" type="submit">
                        <span id="loading-spinner"  class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        {{ $button }}
                    </button>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
