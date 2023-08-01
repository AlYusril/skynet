@extends('layouts.app_corona')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $title }}</h5>
                {!! Form::model($model, ['route' => $route, 'method' => $method]) !!}
                
                @if (request()->filled('parent_id'))
                    <h3>Paket {{ $parentData->nama }}</h3>
                    {!! Form::hidden('parent_id', $parentData->id, []) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <table  class="table table-sm table-hover table-dark table-bordered mb-3">
                                <thead>
                                    <tr class="text-center">
                                        <td width="8%">No</td>
                                        <td>Nama Biaya</td>
                                        <td>Jumlah</td>
                                        <td>Aksi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($parentData->children as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td class="text-right">{{ formatRupiah($item->jumlah) }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('delete-biaya.item', $item->id) }}" 
                                                    class="btn btn-danger btn-sm" 
                                                    onclick="return confirm('Anda Yakin ?')">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                <h4>Tambahkan Item Tagihan</h4>
                <div class="form-group mt-1">
                    <label for="nama">Paket Internet</label>
                    {!! Form::text('nama', null, ['class' => 'form-control', 'autofocus']) !!}
                    <span class="text-danger">{{ $errors->first('nama') }}</span>
                </div>

                <div class="form-group mt-3">
                    <label for="jumlah">Nominal</label>
                    {!! Form::text('jumlah', null, ['class' => 'form-control rupiah']) !!}
                    <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                </div>

                @if (request()->filled('parent_id'))
                    
                @else
                    <div class="form-group mt-3">
                        <label for="keterangan">Berita</label>
                        {!! Form::textarea('keterangan', null, [
                            'class' => 'form-control',
                            'rows' => 5,
                        ]) !!}
                        <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                    </div>
                @endif

                {!! Form::submit($button, ['class' => 'btn btn-primary mt-3']) !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
