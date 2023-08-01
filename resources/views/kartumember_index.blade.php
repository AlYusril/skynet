@extends('layouts.app_corona_blank')

@section('content')
<script type="text/javascript">
    // window.print();
</script>
<div class="content-wraper">
    <div class="row justify-content-center">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="text-uppercase">Kartu Pelanggan</h3>
                            <div class="billed"><span class="font-weight-bold text-uppercase">pelanggan : </span>
                                <span class="ml-1">{{ $member->nama }}</span></div>
                        </div>
                        <div class="col-md-6 text-right">
                            {{-- <h4 class="text-danger mb-0">Skytama</h4> --}}
                            <img src="{{ \Storage::url(settings()->get('app_logo')) }}" alt="logo" width="120"/> <br>
                            <span>{{ settings()->get('app_email') }}</span>
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered">
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
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            Mojokerto, {{ now()->translatedFormat('d F Y') }} <br>
                            Mengetahui,
                            <br><br><br>
                            Bendahara
                        </div>
                        <div class="col-md-6 mt-2 text-right">
                            <a href="#" onclick="window.print()" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Cetak Kartu</a>
                            {{-- <br> --}}
                            {{-- <a href="{{ url()->full() . '&output=pdf' }}" class="btn btn-primary btn-sm mt-2"><i class="fa fa-download"></i> Download</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
