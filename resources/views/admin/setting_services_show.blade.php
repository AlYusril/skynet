@extends('layouts.app_corona')
@section('css-custom')
    <link rel="stylesheet" href="{{ asset('ayro') }}/assets/css/lineicons.css" />
    {{-- <link rel="stylesheet" href="{{ asset('ayro') }}/assets/css/bootstrap.min.css" /> --}}
@endsection

@section('content')
@include('admin.header_setting_landingpage_index')
<div class="row justify-content-center">
    <div class="badge- badge-danger">Jika Logo tidak muncul silahkan ubah dibagian edit berita</div>
</div>
<div class="row mt-2">
    @forelse ($models as $item)
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="home-1" role="tabpanel" aria-labelledby="home-tab">
                            <div class="media d-block d-sm-flex">
                                {{-- <img class="me-3 w-25 rounded" src="" alt="sample image"> --}}
                                <i class="lni lni-{{ $item->gambar }}"></i> &nbsp;
                                <div class="media-body mt-4 mt-sm-0">
                                    <h4 class="mt-0">{{ $item->judul }}</h4>
                                    <div>
                                        {!! htmlspecialchars_decode($item->konten) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        Data Kosong!!
    @endforelse
</div>
@endsection
