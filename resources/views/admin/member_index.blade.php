@extends('layouts.app_corona')
@section('js')
    <script>
        $(document).ready(function () {
            $("#div-import").hide();
            $("#btn-div").click(function (e) { 
                $("#div-import").toggle();
            });
        });
    </script>
@endsection
@section('content')
<style>
    .link-center {
    display: flex;
    align-items: center;
    }
</style>
<div class="header">
    <div class="page-title">{{ $title }}</div>
</div>

{{-- <div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                {!! $memberPaketChart->container() !!}
            </div>
        </div>
    </div>
</div> --}}

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card">   
            <div class="card-body">
                <div class="card-title">
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-center">
                            <a href="{{ route($routePrefix . '.create') }}" class="btn btn-primary">Tambah Data</a> &nbsp;&nbsp;
                            <a href="#" class="btn btn-secondary" id="btn-div">Import dari Excel</a>
                        </div>
                        <div class="col-md-6">
                            {!! Form::open(['route' => $routePrefix . '.index', 'method' => 'GET']) !!}
                                <div class="input-group">
                                    <input name="q" type="text" class="form-control" placeholder="Cari Nama Member" 
                                    aria-label="cari member" aria-describedby="basic-addon2" value="{{ request('q') }}">
                                    <div class="input-group-append">
                                    <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-search"></i>Search</button>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="row mt-3" id="div-import">
                        
                        <div class="col-md-12">
                            <div class="alert alert-info">
                                <small>Download file template, dan isi sesuai format</small>
                            </div>
                            {!! Form::open(['route' => 'memberimport.store', 'method' => 'POST','files' => true]) !!}
                                <div class="input-group">
                                    <input name="template" type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                    <button class="btn btn-primary" type="submit" id="inputGroupFileAddon04">
                                        Upload Excel
                                    </button>&nbsp;
                                    <a href="{{ asset('template.xlsx') }}" class="btn btn-outline-secondary link-center" target="blank">
                                        <i class="fa fa-download"></i> Download Template Excel
                                    </a>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
               <div class="table-responsive">
                    <table class="{{ config('app.table_style') }} mb-3 table-wrapper">
                        <thead class="{{ config('app.thead_style') }}">
                            <tr>
                                <th width="1%">No</th>
                                <th>Akun</th>
                                <th>Nama Member</th>
                                <th>No HP</th>
                                <th>Alamat</th>
                                <th>ID Pelanggan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($models as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->client->name ?? 'Belum ada' }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ formatNomorHp($item->nohp) }}</td>
                                    <td>{{ $item->alamat_lengkap }}</td>
                                    <td>{{ $item->idpel }}</td>
                                    <td>
                                        @if ($item->status == 'aktif')
                                            <span class="text-primary">{{ $item->status }}</span>
                                        @elseif($item->status == 'non-aktif')
                                            <span class="text-danger">{{ $item->status }}</span>
                                        @endif
                                    </td>

                                    <td>
                                        {!! Form::open([
                                            'route' => [$routePrefix . '.destroy', $item->id],
                                            'method' => 'DELETE',
                                            'onsubmit' => 'return confirm("Yakin menghapus data ini?")',
                                        ]) !!}

                                        <a href="{{ route($routePrefix . '.show', $item->id) }}" 
                                            class="btn btn-info btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </a>

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
<script src="{{ $memberPaketChart->cdn() }}"></script>
{{ $memberPaketChart->script() }}
@endsection
