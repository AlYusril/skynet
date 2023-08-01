@extends('layouts.app_corona')

@section('content')
<div class="header">
    <div class="page-title">{{ $title }}</div>
</div>
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <div class="row">
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
                </div>
               <div class="table-responsive mt-2">
                <table class="{{ config('app.table_style') }}">
                    <thead class="{{ config('app.thead_style') }}">
                        <tr>
                            <th width="1%">No</th>
                            <th>Nama</th>
                            <th>No.HP</th>
                            <th>Email</th>
                            {{-- <th>Akses</th> --}}
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($models as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ formatNomorHp($item->nohp) }}</td>
                                <td>{{ $item->email }}</td>
                                {{-- <td>{{ $item->akses }}</td> --}}
                                <td class="text-center">
                                    {!! Form::open([
                                        'route' => [$routePrefix . '.destroy', $item->id],
                                        'method' => 'DELETE',
                                        'onsubmit' => 'return confirm("Yakin menghapus data ini?")',
                                    ]) !!}

                                    <a href="{{ route($routePrefix . '.show', $item->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-eye"></i> Show
                                    </a>

                                    <a href="{{ route($routePrefix . '.edit', $item->id) }}" class="btn btn-warning btn-sm mx-2">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>

                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> Hapus
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
                <div class="mt-3">
                    {!! $models->links() !!}
                </div>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection
