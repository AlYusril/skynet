@extends('layouts.app_corona_blank')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 mt-3">
        @include('admin.headerlaporan_index')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table">
                            <table class="{{ config('app.table_style') }}">
                                <thead class="{{ config('app.thead_style') }}">
                                    <tr>
                                        <th width="1%">No</th>
                                        <th width="15%">Nama Siswa</th>
                                        @foreach ($header as $bulan)
                                            <th>{{ ubahNamaBulanSingkat($bulan) }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataRekap as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $item['member']['nama'] }}</td>
                                            @foreach ($item['dataTagihan'] as $itemTagihan)
                                                <td class="text-center">
                                                    @if ($itemTagihan['tanggal_lunas'] != '-')
                                                        {{ $itemTagihan['tanggal_lunas']->format('d/m') }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <small class="mt-2 text-muted">Laporan Tagihan {{ $title }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
