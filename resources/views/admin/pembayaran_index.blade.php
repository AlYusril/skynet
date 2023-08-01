@extends('layouts.app_corona')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">DATA PEMBAYARAN</h5>
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::open(['route' => 'pembayaran.index', 'method' => 'GET']) !!}
                        <div class="row gx-2">
                            <div class="col-md-3 col-sm-12">
                                {!! Form::text('q', request('q'), ['class' => 'form-control', 'placeholder' => 'Pencarian data member']) !!}
                            </div>
                            <div class="col-md-3 col-sm-12">
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
                                {!! Form::selectMonth('bulan', request('bulan'), ['class' => 'form-control', 'placeholder' => 'Pilih Bulan']) !!}
                            </div>
                            <div class="col-md-2 col-sm-12">
                                {!! Form::selectRange('tahun', 2022, date('Y') + 1, request('tahun'), ['class' => 'form-control', 'placeholder' => 'Pilih Tahun']) !!}
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <button class="btn btn-primary" type="submit">Tampil</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                
                <div class="table-responsive mt-3">
                    <table class="{{ config('app.table_style') }}">
                        <thead class="{{ config('app.thead_style') }}">
                        <tr>
                            <th width="1%" >No</th>
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
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->tagihan->member->nama }}</td>
                                <td>{{ $item->tagihan->member->idpel }}</td>
                                <td>{{ $item->tagihan->member->client->name ?? 'Belum ada'}}</td>
                                {{-- <td>{{ $item->client->name }}</td> --}}
                                <td>{{ $item->metode_pembayaran }}</td>
                                <td>
                                    <span class="badge badge-outline-{{ $item->status_style }}">{{ $item->status_konfirmasi }}</span>
                                </td>

                                <td>
                                    {!! Form::open([
                                        'route' => [ 'pembayaran.destroy', $item->id],
                                        'method' => 'DELETE',
                                        'onsubmit' => 'return confirm("Yakin menghapus data ini?")',
                                    ]) !!}

                                    <a href="{{ route('pembayaran.show', $item->id) }}" 
                                        class="btn btn-info btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    {{-- <a href="{{ route($routePrefix . '.edit', $item->id) }}" 
                                        class="btn btn-warning btn-sm ml-2 mr-2">
                                        <i class="fa fa-edit"></i>
                                    </a> --}}

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
@endsection
