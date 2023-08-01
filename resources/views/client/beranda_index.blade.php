@extends('layouts.app_corona_client')

@section('content')
<div class="row">
    <div class="col-lg-9 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-8">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Selamat Datang, {{ Auth::user()->name }} 🎉</h5>
                        <p class="mb-4">
                        Kamu mendapatkan <span class="font-weight-bold">{{ auth()->user()->unreadNotifications->count() }}</span> notifikasi yang belum kamu lihat. Klik tombol dibawah untuk melihat informasi pembayaran
                        </p>

                        <a href="{{ route('client.tagihan.index') }}" class="btn btn-sm btn-outline-primary">Lihat Data Pembayaran</a>
                    </div>
                </div>
                <div class="col-sm-4 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-4">
                        {{-- <img src="{{ asset('corona') }}/assets/images/faces/face15.jpg" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png"> --}}
                        <img src="{{ asset('corona') }}/assets/images/dashboard/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3 grid-margin">
        <div class="card">
            <div class="card-body">
                <h5>Total Member</h5>
                <div class="row">
                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                            <h2 class="mb-0">{{ auth()->user()->member->count() }}</h2>
                            {{-- <p class="text-success ml-2 mb-0 font-weight-medium">+8.3%</p> --}}
                        </div>
                        <h6 class="text-muted font-weight-normal"> Data Member</h6>
                    </div>
                    <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-wallet-travel text-danger ml-auto"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Notification --}}
    {{-- <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between">
                    <h4 class="card-title mb-1">Notifikasi</h4>
                    <i class="mdi mdi-dots-vertical"></i>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="preview-list">
                            <div class="dropdown-divider"></div>
                            @foreach(Auth()->user()->unreadNotifications->take(6) as $notification)
                                <a href="{{ url($notification->data['url'] . '?id=' . $notification->id) }}" class="dropdown-item preview-item">
                                    <div class="d-flex">
                                        <div class="preview-item-content">
                                            <p class="preview-subject mb-1">{{ $notification->data['title'] }}</p>
                                            <p class="text-muted text-wrap">{{ $notification->data['messages'] }}</p>
                                            <small class="text-muted bg-white">
                                            {{ $notification->created_at->diffForHumans() }}
                                            </small>
                                        </div>
                                        <div class="flex-shrink-0 notifications-actions">
                                            {!! Form::open([
                                                'route' => ['client.notifikasi.update', $notification->id],
                                                'method' => 'PUT',
                                            ]) !!}
                                            <button class="btn" type="submit"><i class="mdi mdi-close-octagon"></i></button>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                            <p class="p-3 mb-0 text-center">See all notifications</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- End Notification --}}

    {{-- Data Kartu Member --}}
    {{-- @foreach ($dataRekap as $item)
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between">
                    <h5 class="card-title mb-1">KARTU TAGIHAN | {{ Str::words(strtoupper($item['member']['nama']), 1) }}</h5>
                    
                    <p>status</p>
                </div>
                <div class="row">
                    <div class="col-12">
                        @foreach ($item['dataTagihan'] as $itemTagihan)
                            <div class="preview-list">
                                <div class="preview-item border-bottom">
                                    <div class="preview-item-content d-sm-flex flex-grow">
                                        <div class="flex-grow">
                                            <h6 class="preview-subject">{{ $itemTagihan['bulan'] }}</h6>
                                        </div>
                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                            <p class="text-muted">{{ $itemTagihan['tanggal_konfirmasi']}}</p>
                                            @if ($itemTagihan['tagihan'] != null)
                                                @if ($itemTagihan['status_pembayaran'] == 'lunas')
                                                    <a href="{{ route('client.tagihan.show', $itemTagihan['tagihan']->id) }}">
                                                        <p class="badge badge-outline-success">Lunas</p>
                                                    </a>
                                                    @elseif($itemTagihan['status_pembayaran'] == 'baru')
                                                        <a href="{{ route('client.tagihan.show', $itemTagihan['tagihan']->id) }}">
                                                            <p class="badge badge-outline-danger">Belum Bayar</p>
                                                        </a>
                                                    @elseif($itemTagihan['status_pembayaran'] == 'angsur')
                                                        <a href="{{ route('client.tagihan.show', $itemTagihan['tagihan']->id) }}">
                                                            <p class="badge badge-outline-warning">Angsur</p>
                                                        </a>
                                                    @elseif($itemTagihan['status_pembayaran'] == 'belum')
                                                        <a href="{{ route('client.tagihan.show', $itemTagihan['tagihan']->id) }}">
                                                            <p class="badge badge-outline-warning">Belum dikonfirmasi</p>
                                                        </a>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach 
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach --}}
    {{-- End Data Kartu --}}
    
</div>
@endsection
