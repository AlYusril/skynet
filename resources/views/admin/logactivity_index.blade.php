@extends('layouts.app_corona')

@section('content')
<style>
    .table td,
    .table th {
        white-space: normal;
        word-wrap: break-word;
    }
</style>

<div class="header">
    <div class="page-title">{{ $title }}</div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card">   
            <div class="card-body">
                <div class="card-title">
                    <div class="row">
                        {{-- <div class="col-md-6">
                            {!! Form::open(['route' => 'logactivity.index', 'method' => 'GET']) !!}
                                <div class="input-group">
                                    <input name="q" type="text" class="form-control" placeholder="Cari Nama Member" 
                                    aria-label="cari member" aria-describedby="basic-addon2" value="{{ request('q') }}">
                                    <div class="input-group-append">
                                    <button class="btn btn-sm btn-primary" type="submit">Search</button>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div> --}}
                    </div>
                </div>
               <div class="table-responsive">
                    <table class="{{ config('app.table_style') }} mb-3 table-wrapper">
                        <thead class="{{ config('app.thead_style') }}">
                            <tr>
                                <th width="1%">No</th>
                                <th>User</th>
                                <th>Event</th>
                                <th>Before</th>
                                <th>Edited</th>
                                <th>Description</th>
                                <th>Log AT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($models as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->causer->name ?? " "}}</td>
                                    <td>{{ $item->event }}</td>
                                    <td>
                                        @if (@is_array($item->changes['old']))
                                            @foreach ($item->changes['old'] as $key => $itemChange)
                                                {{ $key }} : {{ $itemChange }} <br>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if (@is_array($item->changes['attributes']))
                                            @foreach ($item->changes['attributes'] as $key => $itemChange)
                                                {{ $key }} : {{ $itemChange }} <br>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->created_at }}</td>
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
