@extends('layouts.app_corona_client')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">DATA PEMBAYARAN</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::open(['route' => 'pembayaran.index', 'method' => 'GET']) !!}
                            <div class="row">
                                <div class="col">
                                    {!! Form::selectMonth('bulan', request('bulan'), ['class' => 'form-control']) !!}
                                </div>
                                <div class="col">
                                    {!! Form::selectRange('tahun', 2022, date('Y') + 1, request('tahun'), ['class' => 'form-control']) !!}
                                </div>
                                <div class="col">
                                    <button class="btn btn-primary" type="submit">Tampil</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    
                    <div class="table-responsive mt-3">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Id Pelanggan</th>
                                <th>Nama Akun</th>
                                <th>Metode Pembayaran</th>
                                <th>Status Konfirmasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($models as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->tagihan->member->nama }}</td>
                                    <td>{{ $item->tagihan->member->idpel }}</td>
                                    <td>{{ $item->tagihan->member->client->name }}</td>
                                    {{-- <td>{{ $item->client->name }}</td> --}}
                                    <td>{{ $item->metode_pembayaran }}</td>
                                    <td>{{ $item->status_konfirmasi }}</td>

                                    <td>
                                        {!! Form::open([
                                            'route' => [ 'client.pembayaran.destroy', $item->id],
                                            'method' => 'DELETE',
                                            'onsubmit' => 'return confirm("Yakin menghapus data ini?")',
                                        ]) !!}

                                        <a href="{{ route('client.pembayaran.show', $item->id) }}" 
                                            class="btn btn-info btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Data kosong</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {!! $models->links() !!}
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
