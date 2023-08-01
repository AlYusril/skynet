@extends('layouts.app_corona_client')

@section('content')
<div class="header">
    <div class="page-title">Data Member</div>
</div>
<div class="row justify-content-center">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                {{-- <a href="" class="btn btn-primary">Tambah Data</a> --}}
               <div class="table-responsive">

                <table class="{{ config('app.table_style') }}">
                    <thead class="{{ config('app.thead_style') }}">
                        <tr>
                            <th width="1%">No</th>
                            <th>ID Pelanggan</th>
                            <th>Nama Member</th>
                            <th>No HP</th>
                            <th>Paket Internet</th>
                            <th>Tagihan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($models as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->idpel }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ formatNomorHp($item->nohp) }}</td>
                                <td>{{ $item->biaya->nama }}</td>
                                <td class="text-right">
                                    <a href="{{ route('client.member.show', $item->id) }}">
                                        {{ formatRupiah($item->biaya->total_tagihan) }}
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">Data kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection
