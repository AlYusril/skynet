@extends('layouts.app_corona')

@section('content')
<div class="header">
    <div class="page-title">{{ $title }}</div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                <a href="{{ route($routePrefix . '.create') }}" class="btn btn-primary">Tambah Data</a>
                </div>
               <div class="table-responsive">
                    <table class="{{ config('app.table_style') }}">
                        <thead class="{{ config('app.thead_style') }}">
                            <tr>
                                <th width="1%">No</th>
                                <th>Nama Bank</th>
                                <th>Kode Transfer</th>
                                <th>Pemilik Rekening</th>
                                <th>No Rekening</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($models as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_bank }}</td>
                                    <td>{{ $item->kode }}</td>
                                    <td>{{ $item->nama_rekening }}</td>
                                    <td>{{ $item->norek }}</td>

                                    <td class="text-center">
                                        {!! Form::open([
                                            'route' => [$routePrefix . '.destroy', $item->id],
                                            'method' => 'DELETE',
                                            'onsubmit' => 'return confirm("Yakin menghapus data ini?")',
                                        ]) !!}

                                        {{-- <a href="{{ route($routePrefix . '.show', $item->id) }}" 
                                            class="btn btn-info btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </a> --}}

                                        <a href="{{ route($routePrefix . '.edit', $item->id) }}" 
                                            class="btn btn-warning btn-sm ml-2 mr-2">
                                            <i class="fa fa-edit"></i>
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
@endsection
