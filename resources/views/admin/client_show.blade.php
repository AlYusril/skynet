@extends('layouts.app_corona')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ $title }}</div>
            <div class="card-body">
               <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <td width="15%">ID</td>
                                <td>: {{ $model->id }}</td>
                            </tr>

                            <tr>
                                <td>Nama</td>
                                <td>: {{ $model->name }}</td>
                            </tr>

                            <tr>
                                <td>No HP</td>
                                <td>: {{ $model->nohp }}</td>
                            </tr>

                            <tr>
                                <td>Email</td>
                                <td>: {{ $model->email }}</td>
                            </tr>
                            
                            <tr>
                                <td>Tanggal Buat</td>
                                <td>: {{ $model->created_at->format('d/m/Y H:i') }}</td>
                            </tr>

                            <tr>
                                <td>Tanggal Ubah</td>
                                <td>: {{ $model->updated_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        </thead>
                    </table>
                    <h4 class="my-3">Tambah Member Internet</h4>
                    {!! Form::open(['route' => 'clientmember.store', 'method' => 'POST']) !!}
                    {!! Form::hidden('client_id', $model->id, []) !!}
                      <div class="form-group">
                        <label for="member_id">Pilih Data Member</label>
                        {!! Form::select('member_id', $member, null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('member_id') }}</span>
                      </div>
                    {!! Form::submit('Tambah', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}

                    <h4 class="my-3">Akun Pelanggan Aktif</h4>
                       <table class="table table-dark table-bordered">
                           <thead>
                               <tr class="text-center">
                                   <th width="1%">No</th>
                                   <th>Nama</th>
                                   <th>ID Pelanggan</th>
                                   <th>Aksi</th>
                               </tr>
                           </thead>
                           <tbody>
                               @foreach ($model->member as $item)
                                   <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->idpel }}</td>
                                    <td class="text-center">
                                        {!! Form::open([
                                            'route' => ['clientmember.update', $item->id],
                                            'method' => 'PUT',
                                            'onsubmit' => 'return confirm("Yakin menghapus data ini?")',
                                        ]) !!}

                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection
