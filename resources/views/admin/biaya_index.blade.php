@extends('layouts.app_corona')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $title }}</h5>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <a href="{{ route($routePrefix . '.create') }}" class="btn btn-primary">Tambah Data</a>
                    </div>
                    <div class="col-md-6">
                        {!! Form::open(['route' => $routePrefix . '.index', 'method' => 'GET']) !!}
                        <div class="input-group">
                            <input name="q" type="text" class="form-control" placeholder="Cari Nama Member" 
                            aria-label="cari member" aria-describedby="basic-addon2" value="{{ request('q') }}">
                            <div class="input-group-append">
                            <button class="btn btn-sm btn-primary" type="submit">Search</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="table-responsive mt-2">
                    <table class="{{ config('app.table_style') }}">
                        <thead class="{{ config('app.thead_style') }}">
                            <tr>
                                <th width="1%">No</th>
                                <th>Nama Paket</th>
                                <th>Tagihan</th>
                                <th>Created By</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($models as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ formatRupiah($item->total_tagihan) }}</td>
                                    <td>{{ $item->user->name }}</td>

                                    <td class="text-center">
                                        {!! Form::open([
                                            'route' => [$routePrefix . '.destroy', $item->id],
                                            'method' => 'DELETE',
                                            'onsubmit' => 'return confirm("Yakin menghapus data ini?")',
                                        ]) !!}

                                        <a href="{{ route($routePrefix . '.create', ['parent_id' => $item->id]) }}" 
                                            class="btn btn-info btn-sm">
                                            <i class="fa fa-plus"></i>Item
                                        </a>

                                        <a href="{{ route($routePrefix . '.edit', $item->id) }}" 
                                            class="btn btn-warning btn-sm ml-2 mr-2">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>

                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i> Delete
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
