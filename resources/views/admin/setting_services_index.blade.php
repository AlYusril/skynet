@extends('layouts.app_corona')

@section('content')
@include('admin.header_setting_landingpage_index')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('services.create') }}" class="btn btn-primary">Tambah Data</a>
                        </div>
                    </div>
                </div>
               <div class="table-responsive mt-2">
                <table class="{{ config('app.table_style') }}">
                    <thead class="{{ config('app.thead_style') }}">
                        <tr>
                            <th width="1%">No</th>
                            <th>Judul</th>
                            <th>Tanggal Buat</th>
                            <th>Tanggal Edit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($models as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->judul }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td class="text-center">
                                    {!! Form::open([
                                        'route' => ['services.destroy', $item->id],
                                        'method' => 'DELETE',
                                        'onsubmit' => 'return confirm("Yakin menghapus data ini?")',
                                    ]) !!}

                                    <a href="{{ route('services.show', $item->id) }}" 
                                        class="btn btn-info btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <a href="{{ route('services.edit', $item->id) }}" 
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
                <div class="mt-3">
                    {{-- {!! $models->links() !!} --}}
                </div>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection
