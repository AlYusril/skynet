@extends('layouts.app_corona_client')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                {!! Form::open(['route' => 'client.laporkerusakan.store', 'method' => 'POST']) !!}
                <h6 class="card-title">Kirim Pesan Laporan</h6>
                
                <div class="form-group">
                    <label for="member_id">Pilih Member</label>
                    {!! Form::select('member_id', $members, null, ['class' => 'form-control select2']) !!}
                    <span class="text-danger">{{ $errors->first('member_id') }}</span>
                </div>
                <div class="form-group">
                    <label for="pesan">Kirim pesan: </label>
                    {!! Form::textarea('pesan', null, [
                        'class' => 'form-control', 
                        'rows' => 3,
                        'id' => 'my-textarea',
                    ]) !!}
                    <span class="text-danger">{{ $errors->first('pesan') }}</span>
                </div>
                {{ Form::submit('KIRIM', ['class' => 'btn btn-sm btn-primary mt-1']) }}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">List Laporan</h6>
                <table class="{{ config('app.table_style') }} mb-3 table-responsive">
                    <thead class="{{ config('app.thead_style') }}">
                        <tr>
                            <th width=1%>No</th>
                            <th>Member</th>
                            <th>Tiket</th>
                            <th>Tanggal Laporan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($laporan as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->member->nama }}</td>
                                <td>#{{ $item->tiket_id }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td class="text-center">
                                    <span class="badge badge-outline-{{ $item->status_style }}">{{ $item->status }}</span>
                                </td>
                                <td class="text-center">
                                    @if($item->status === 'Belum')
                                        {!! Form::open([
                                            'route' => ['client.laporkerusakan.destroy', $item->id],
                                            'method' => 'DELETE',
                                            'onsubmit' => 'return confirm("Yakin menghapus data ini?")',
                                        ]) !!}

                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        {!! Form::close() !!}
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Data Kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
