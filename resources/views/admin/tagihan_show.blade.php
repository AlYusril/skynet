@extends('layouts.app_corona')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data Tagihan Pelanggan {{ $periode }}</h5>
                <table class="table table-bordered">
                    <tr>
                        <td rowspan="3" width="80">
                            <img src="{{ asset('corona') }}/assets/images/profil/profil.png" alt="{{ $member->nama }}">
                        </td>
                    </tr>
                    <tr>
                        <td width="50">Id Pelanggan</td>
                        <td>: {{ $member->idpel }}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>: {{ $member->nama }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-5">
        <div class="card grid-margin stretch-card">
            <div class="card-body">
                <h5 class="card-title">Data Tagihan {{ $periode }}</h5>
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tagihan</th>
                            <th>Jumlah Tagihan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tagihan->tagihanDetails as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_biaya }}</td>
                                <td class="text-right">{{ formatRupiah($item->jumlah_biaya) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" class="text-right">Total Tagihan</td>
                            <td class="text-right">{{formatRupiah($tagihan->total_tagihan) }}</td>
                        </tr>
                    </tfoot>
                </table>
                {{-- <div class="card-footer">
                    <a href="{{ route('invoice.show'), $model->tagihan_id }}"></a>
                </div> --}}
                
            </div>
            <div class="card-header" style="margin-bottom:-1rem">Form Pembayaran</div>
            <div class="card-body">
                {!! Form::model($model, ['route' => 'pembayaran.store', 'method' => 'POST']) !!}
                {!! Form::hidden('tagihan_id', $tagihan->id, []) !!}
                <div class="form-group">
                    <label for="tanggal_bayar">Tanggal Pembayaran</label>
                    {!! Form::date('tanggal_bayar', $model->tanggal_bayar ?? \Carbon\Carbon::now(), [
                        'class' => 'form-control'
                    ]) !!}
                    <span class="text-danger">{{ $errors->first('tanggal_bayar') }}</span>
                </div>
                <div class="form-group">
                    <label for="jumlah_dibayar">Jumlah Yang Dibayarkan</label>
                    {!! Form::text('jumlah_dibayar', $tagihan->total_tagihan, ['class' => 'form-control rupiah']) !!}
                    {{-- {!! Form::text('jumlah_dibayar', null, ['class' => 'form-control rupiah']) !!} --}}
                    <span class="text-danger">{{ $errors->first('jumlah_dibayar') }}</span>
                </div>
                {!! Form::submit('SIMPAN', ['class' => 'btn btn-primary mt-2']) !!}
                {!! Form::close() !!}
            </div>
        </div>
        <div class="card">
            <h5 class="card-header pb-0">Informasi Pembayaran</h5>
            <div class="card-body pt-3">
                {{-- <h5 class="card-header pt-0 pb-0 px-0">Data Pembayaran</h5> --}}
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th width="1%">#</th>
                            <th>Tanggal</th>
                            <th>Metode</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tagihan->pembayaran as $item)
                        <tr>
                            <td>
                                {!! Form::open([
                                    'route' => [ 'pembayaran.destroy', $item->id],
                                    'method' => 'DELETE',
                                    'onsubmit' => 'return confirm("Yakin menghapus data ini?")',
                                ]) !!}
                                <button type="submit" class="btn m-0 p-0">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <a href="{{ route('kwitansipembayaran.show', $item->id) }}" target="_blank"><i class="fa fa-print"></i></a>
                                {!! Form::close() !!}
                            </td>
                            <td>{{ $item->tanggal_bayar->translatedFormat('d-m-Y') }}</td>
                            <td>{{ $item->metode_pembayaran }}</td>
                            <td class="text-right">{{ formatRupiah($item->jumlah_dibayar) }}</td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Data kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <td colspan="3" class="text-right">Total Pembayaran</td>
                        <td class="text-right">{{ formatRupiah($tagihan->total_pembayaran) }}</td>
                    </tfoot>
                </table>
                <h5 class="pt-1">Status Pembayaran : {{ strtoupper($tagihan->status) }}</h5>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tabel Tagihan Pelanggan</h5>
                <div class="table-responsive mt-3">
                    <table class="table table-sm table-bordered">
                        <thead class="table-dark">
                            <tr class="text-center">
                                <th>No</th>
                                <th>Bulan Tagihan</th>
                                <th>Jumlah Tagihan</th>
                                <th>Paraf</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kartuMember as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td style="white-space: nowrap;">{{ $item['bulan'] . ' ' . $item['tahun'] }}</td>
                                    <td class="text-right" style="white-space: nowrap;">{{ formatRupiah($item['total_tagihan']) }}</td>
                                    <td></td>
                                    <td>{{ $item['status_pembayaran'] . ' ' . $item['tanggal_bayar'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('kartumember.index',[
                        'member_id' => $member->id,
                        'tahun' => request('tahun'),
                        ]) }}" 
                        class="btn btn-sm" target="_blank"><i class="fa fa-print mt-2"></i> Cetak Kartu {{ request('tahun') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
