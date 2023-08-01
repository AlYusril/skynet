@extends('layouts.app_corona')
@section('js')
    <script>
        $(document).ready(function () {
            var bar = document.querySelector(".progress-bar");
            var intervalId = window.setInterval(() => {
                @if (request('job_status_id') != '')
                $.getJSON("{{ route('jobstatus.show',request('job_status_id')) }}",
                    function (data, textStatus, jqXHR) {
                        var progressPercent = data['progress_percentage'];
                        var progressNow = data['progress_now'];
                        var progressMax = data['progress_max'];
                        var isEnded = data['is_ended'];
                        var id = data['id'];
                        bar.style.width = progressPercent + "%";
                        bar.innerText = progressPercent + "%";
                        $("#progress-now" + id).text(progressNow);
                        $("#progress-max" + id).text(progressMax);
                        if (isEnded) {
                            window.location.href="{{ route('jobstatus.index') }}"
                        }
                    }
                );
                @endif
            }, 500);
        });
    </script>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $title }}</h5>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <a href="{{ route('tagihan.create') }}" class="btn btn-primary">Tambah Data</a>
                    </div>
                    {{-- <div class="col-md-6">
                        {!! Form::open(['route' => $routePrefix . '.index', 'method' => 'GET']) !!}
                        <div class="input-group">
                            <input name="q" type="text" class="form-control" placeholder="Cari Nama Member" 
                            aria-label="cari member" aria-describedby="basic-addon2" value="{{ request('q') }}">
                            <div class="input-group-append">
                            <button class="btn btn-sm btn-primary" type="submit">Search</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div> --}}
                    @if (request('job_status_id') != '')
                        <div class="col-md-12">
                            <div class="progress progress-md portfolio-progress mt-2">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="table-responsive mt-2">
                    <table class="{{ config('app.table_style') }}">
                        <thead class="{{ config('app.thead_style') }}">
                            <tr>
                                <th width="1%">No</th>
                                <th>Modul</th>
                                <th>Progress</th>
                                <th>Status</th>
                                <th>Tanggal dibuat</th>
                                <th>Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jobStatus as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($item->status == 'finished')
                                            {{ getClassName($item->type) }}
                                        @else
                                            <a href="{{ route('jobstatus.index', ['job_status_id' => $item->id]) }}">
                                                {{ getClassName($item->type) }}
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <span id="progress-now{{ $item->id }}">{{ $item->progress_now }}</span> / 
                                        <span id="progress-max{{ $item->id }}">{{ $item->progress_max }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-outline-{{ $item->status == 'finished' ? 'success':'' }}">{{ $item->status }}</span>
                                    </td>
                                    <td>{{ $item->created_at->format('d-M-Y H:i:s') }}</td>
                                    <td>{{ json_encode($item->output) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Data kosong</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {!! $jobStatus->links() !!}
               </div>
            </div>
        </div>
    </div>
</div>
@endsection
