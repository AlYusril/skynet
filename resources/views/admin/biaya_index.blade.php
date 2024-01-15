@extends('layouts.app_corona')
@section('js')
<script>
    $(document).ready(function () {
        $("#btn-status").hide();
        // Fungsi untuk menampilkan atau menyembunyikan tombol "btn-status"
        function toggleButtonVisibility() {
            if ($(".check-biaya-id:checked").length > 0) {
                $("#btn-status").show();
            } else {
                $("#btn-status").hide();
            }
        }

        $('.check-biaya-id').change(function (e) { 
            var maxChecked = 4; // Batas maksimal checkbox yang bisa dicentang

            // Hitung jumlah checkbox yang sudah dicentang
            var checkedCount = $(".check-biaya-id:checked").length;

            if ($(this).prop('checked')) {
                $("#btn-status").show();
                // Setel status "aktif" jika "status promo" dicentang
                var statusCheckbox = $(this).closest('tr').find('.check-biaya-status-id');
                if ($(this).data('status') === 'promo') {
                    statusCheckbox.prop('checked', true);
                }
            }

            if (checkedCount >= maxChecked) {
                // Jika jumlah checkbox yang dicentang melebihi batas, hapus centangan dari checkbox terakhir
                $('.check-biaya-id:checked').eq(maxChecked - 1).prop('checked', false);
            }

            // Cek apakah batas maksimal tercapai untuk menentukan apakah checkbox selanjutnya harus dinonaktifkan
            $('.check-biaya-id:not(:checked)').prop('disabled', checkedCount >= maxChecked);

            toggleButtonVisibility();
        });


        
        $('.check-biaya-status-id').change(function (e) { 
            // Untuk koding checkbox Status Paket (aktif or nonaktif)
            if ($(this).prop('checked')) {
                $("#btn-status").show();
            }
            toggleButtonVisibility();
        });

        toggleButtonVisibility();

        // Fungsi untuk menandai checkbox jika status adalah "promo"
        $('.check-biaya-id').each(function () {
            if ($(this).data('status') === 'promo') {
                $(this).prop('checked', true);
            }
        });

        // Fungsi untuk menandai checkbox jika status adalah "aktif" (untuk status paket)
        $('.check-biaya-status-id').each(function () {
            if ($(this).data('status') === 'aktif') {
                $(this).prop('checked', true);
            }
        });


        $("#btn-status").click(function (e) { 
            $.ajax({
                headers : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('biayaupdate.status') }}",
                data: $(".check-biaya-id, .check-biaya-status-id").serialize(),
                dataType: "json",
                success: function (response) {
                    $("#alert-message").removeClass('d-none');
                    $("#alert-message").html(response.message);
                    location.reload();
                },
                error: function (xhr, status, error) { 
                    $("#alert-message").removeClass('d-none');
                    $("#alert-message").removeClass('alert-success');
                    $("#alert-message").addClass('alert-danger');
                    $("#alert-message").html(xhr.responseJSON.message);
                }
            });
        });
    });
</script>

{{-- Hidden button info --}}
<script>
    $(document).ready(function () {
        $("#div-import").hide();
        $("#btn-div").click(function (e) { 
            $("#div-import").toggle();
        });
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
                    <div class="col-md-6">
                        <a href="{{ route($routePrefix . '.create') }}" class="btn btn-primary">Tambah Data</a>
                        <a href="#" class="btn btn-secondary" id="btn-div">Info?</a>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
                
                <div class="row mt-3" id="div-import">
                        
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            <p>Status <b>promo</b> : Akan ditampilkan di halaman awal landing page</p>
                            <p>Status <b>aktif</b> : Akan ditampilkan di halaman list paket internet </p>
                            <p>Jika ingin mengaktifkan promo maka centang keduanya | Batas promo 3 paket</p>
                        </div>
                    </div>
                </div>
                <button type="button" id="btn-status" class="btn btn-info btn-sm mt-3">Update Promo</button>
                <div class="table-responsive mt-2">
                    <table class="{{ config('app.table_style') }}">
                        <thead class="{{ config('app.thead_style') }}">
                            <tr>
                                <th width="1%">No</th>
                                <th>Nama Paket</th>
                                <th>Tagihan</th>
                                <th>Created By</th>
                                <th>Status Promo</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($models as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ formatRupiah($item->total_tagihan) }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>
                                        {!! Form::checkbox('biaya_id[]', $item->id, null, [
                                            'class' => 'check-biaya-id',
                                            'data-status' => $item->status,
                                            'value' => 'promo' // Menambahkan promo saat dicentang
                                        ]) !!} 
                                        {{ $item->status }}
                                    </td>
                                    
                                    <td>
                                        {!! Form::checkbox('biaya_status_id[]', $item->id, null, [
                                            'class' => 'check-biaya-status-id',
                                            'data-status' => $item->status_paket,
                                            'value' => 'aktif' // Menambahkan aktif saat dicentang
                                        ]) !!} 
                                        {{ $item->status_paket }}
                                    </td>
                                    

                                    <td class="text-center">
                                        {!! Form::open([
                                            'route' => [$routePrefix . '.destroy', $item->id],
                                            'method' => 'DELETE',
                                            'onsubmit' => 'return confirm("Yakin menghapus data ini?")',
                                        ]) !!}

                                        <a href="{{ route($routePrefix . '.create', ['parent_id' => $item->id]) }}" 
                                            class="btn btn-primary btn-sm">
                                            <i class="fa fa-plus"></i>Item
                                        </a>

                                        <a href="{{ route($routePrefix . '.edit', $item->id) }}" 
                                            class="btn btn-warning btn-sm ml-2 mr-2">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>

                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Data kosong</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {!! $models->links() !!}
               </div>
            </div>
        </div>
    </div>
</div>
@endsection
