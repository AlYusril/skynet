@extends('layouts.app_corona_client')

@section('content')
<div class="header">
    <div class="page-title">Data Tagihan Internet</div>
</div>
<div class="row justify-content-center">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
               <div class="table-responsive">
                <table class="{{ config('app.table_style') }}">
                    <thead class="{{ config('app.thead_style') }}">
                        <tr>
                            <th width="1%">No</th>
                            <th>Id Pelanggan</th>
                            <th>Nama</th>
                            {{-- <th>Paket</th> --}}
                            <th>Tanggal Tagihan</th>
                            <th>Status Bayar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tagihan as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->member->idpel }}</td>
                                <td>{{ $item->member->nama }}</td>
                                {{-- <td>{{ $item->member->paket }}</td> --}}
                                <td>{{ $item->tanggal_tagihan->translatedFormat('F Y') }}</td>
                                <td>
                                    @if ($item->pembayaran->count() >= 1)
                                        <a href="{{ route('client.pembayaran.show', $item->pembayaran->first()->id) }}" 
                                            class="btn badge-outline-success btn-sm">
                                            {{ $item->pembayaran->first()->tanggal_konfirmasi == null ? 'Belum dikonfirmasi' : 'Sudah dibayar' }}
                                        </a>
                                    @else
                                        {{ $item->getStatusTagihanClient() }}
                                    @endif
                                </td>

                                <td>
                                    @if ($item->status == 'baru' || $item->status == 'angsur')
                                        <a href="{{ route('client.tagihan.show', $item->id) }}" class="btn btn-sm btn-primary">Lakukan Pembayaran</a>
                                    @else
                                        <a href="{{ route('client.pembayaran.show', $item->pembayaran->first()->id) }}" class="btn btn-sm btn-success">Pembayaran Sudah Lunas</a>
                                    @endif
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
