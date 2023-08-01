@extends('layouts.app_corona',['title' => 'Beranda | '])

@section('content')
<style>
  .chart-title {
      color: #FFFFFF; /* Ubah warna font judul menjadi putih */
      font-size: 18px; /* Ubah ukuran font judul sesuai kebutuhan Anda */
  }

  .chart-subtitle {
      color: #FFFFFF; /* Ubah warna font subjudul menjadi putih */
      font-size: 14px; /* Ubah ukuran font subjudul sesuai kebutuhan Anda */
  }
</style>

<div class="row">
    <div class="col-sm-4 grid-margin">
        <div class="card">
          <div class="card-body">
            <h5>Total Member</h5>
            <div class="row">
              <div class="col-8 col-sm-12 col-xl-8 my-auto">
                <div class="d-flex d-sm-block d-md-flex align-items-center">
                  <h2 class="mb-0">{{ $member }}</h2>
                  {{-- <p class="text-danger ml-2 mb-0 font-weight-medium">-2.1% </p> --}}
                </div>
                {{-- <h6 class="text-muted font-weight-normal">2.27% Since last month</h6> --}}
                <h6 class="text-muted font-weight-normal">Data Bulan {{ $bulan }} Tahun {{ $tahun }}</h6>
              </div>
              <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                <i class="icon-lg mdi mdi-account text-primary ml-auto"></i>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-sm-4 grid-margin">
        <div class="card">
          <div class="card-body">
            <h5>Total Pembayaran {{ $bulan }} {{ $tahun }}</h5>
            <div class="row">
              <div class="col-8 col-sm-12 col-xl-8 my-auto">
                <div class="d-flex d-sm-block d-md-flex align-items-center">
                  <h2 class="mb-0">{{ formatRupiah($totalPembayaran) }}</h2>
                  {{-- <p class="text-danger ml-2 mb-0 font-weight-medium">-2.1% </p> --}}
                </div>
                {{-- <h6 class="text-muted font-weight-normal">2.27% Since last month</h6> --}}
                <h6 class="text-muted font-weight-normal"> Pembayaran {{ $totalMemberBayar }} Member </h6>
              </div>
              <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                <i class="icon-lg mdi mdi-cash-multiple text-success ml-auto"></i>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-sm-4 grid-margin">
        <div class="card">
          <div class="card-body">
            <h5>Pembayaran Belum Dikonfirmasi</h5>
            <div class="row">
              <div class="col-8 col-sm-12 col-xl-8 my-auto">
                <div class="d-flex d-sm-block d-md-flex align-items-center">
                  <h2 class="mb-0">{{ $pembayaranBelumKonfirmasi->count() }} Member</h2>
                  {{-- <p class="text-danger ml-2 mb-0 font-weight-medium">-2.1% </p> --}}
                </div>
                {{-- <h6 class="text-muted font-weight-normal">2.27% Since last month</h6> --}}
                <h6 class="text-muted font-weight-normal"> Total {{ formatRupiah($nominalBelumKonfirmasi) }} </h6>
              </div>
              <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                <i class="icon-lg mdi mdi-cash-multiple text-success ml-auto"></i>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                  <h4 class="m-0 me-2">Tagihan Bulan {{ $bulan }} {{ $tahun }}</h4>
                  <small class="text-muted">{{ date('d F Y H:i:s') }}</small>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="d-flex flex-column align-items-center gap-1">
                    <h3>
                      {{ $tagihanSudahBayar->count() }}/{{ $tagihanBelumBayar->count() }}
                    </h3>
                    <small class="text-muted">Total Tagihan {{ $totalTagihan }}</small>
                  </div>
                  {{-- <canvas id="transaction-history" class="transaction-chart"></canvas> --}}
                  {!! $tagihanChart->container() !!}
                </div>
                @foreach ($tagihanPerPaket as $key => $item)
                <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                  <div class="text-md-center text-xl-left">
                      <h6 class="mb-1">Desa {{ $key }}</h6>
                      <p class="text-muted mb-0">Jumlah Member {{ $item->count() }}</p>
                  </div>
                  <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                      <h6 class="font-weight-bold mb-0">
                        {{ $item->where('status', 'lunas')->count() }} /
                        {{ $item->where('status', '<>', 'lunas')->count() }} <br>
                        <small class="text-muted">Sudah / Belum Bayar</small>
                      </h6>
                  </div>
              </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between">
                    <h5 class="card-title mb-1">Pembayaran Belum Dikonfirmasi</h5>
                    <p class="text-muted mb-1">STATUS</p>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="preview-list">
                            @foreach ($pembayaranBelumKonfirmasi->take(8) as $item)
                                <div class="preview-item border-bottom">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-primary">
                                            <i class="mdi mdi-file-document"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content d-sm-flex flex-grow">
                                        <div class="flex-grow">
                                            <h6 class="preview-subject">{{ $item->tagihan->member->nama }}</h6>
                                            <p class="text-muted mb-0">{{ formatRupiah($item->jumlah_dibayar) }}</p>
                                        </div>
                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                            <p class="text-muted">{{ $item->tanggal_bayar->diffForHumans() }}</p>
                                            <p class="text-muted mb-0">{{ $item->tagihan->status }}</p>
                                            {{-- {{ dd($item) }} --}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
      <div class="card">
          <div class="card-body">
              <div class="d-flex flex-row justify-content-between">
                  <h5 class="card-title mb-1">Belum Bayar</h5>
                  <p class="text-muted mb-1">STATUS</p>
              </div>
              <div class="row">
                  <div class="col-12">
                      <div class="preview-list">
                          @foreach ($tagihanBelumBayar->take(8) as $item)
                              <div class="preview-item border-bottom">
                                  <div class="preview-thumbnail">
                                      <div class="preview-icon bg-primary">
                                          <i class="mdi mdi-file-document"></i>
                                      </div>
                                  </div>
                                  <div class="preview-item-content d-sm-flex flex-grow">
                                      <div class="flex-grow">
                                          <h6 class="preview-subject">{{ Str::words($item->member->nama, 2) }}</h6>
                                          <p class="text-muted mb-0">{{ formatRupiah($item->tagihanDetails->sum('jumlah_biaya')) }}</p>
                                          {{-- {{ dd($item) }} --}}
                                      </div>
                                      <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                          <p class="text-muted">{{ $item->tanggal_tagihan->translatedFormat('F Y') }}</p>
                                          <p class="text-muted mb-0">{{ $item->status }}</p>
                                          {{-- {{ dd($item->pembayaran) }} --}}
                                      </div>
                                  </div>
                              </div>
                          @endforeach
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        {!! $tagihanStatusChart->container() !!}
      </div>
    </div>
  </div>
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        {!! $pembayaranStatusChart->container() !!}
      </div>
    </div>
  </div>
</div>
<script src="{{ $tagihanChart->cdn() }}"></script>
{{ $tagihanChart->script() }}
{{ $tagihanStatusChart->script() }}
{{ $pembayaranStatusChart->script() }}
@endsection