@extends('layout.index')
@push('js')
    <script>
        $(document).on('click', '#btn-detail', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/link/' + id,
                type: 'GET',
                success: function(data) {
                    console.log(data)
                    $('#original-url-show').val(data.original_url);
                    $('#shortened-url-show').val('{{ url('') }}/' + data.shortened_url);
                    $('#click-url-show').val(data.click);
                    $('#title-show').val(data.title);
                    $('#title-head').text(data.title);
                    $('#editForm').attr('action', '/shorten/' + data.id);
                },
                error: function() {
                    alert('Gagal mengambil data detail!');
                }
            });
        });

        $('#editForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: $('#editForm').attr('action'),
                type: 'PUT',
                data: formData,
                success: function(data) {
                    $('#editModal').modal('hide');

                    Swal.fire({
                        icon: 'success',
                        title: 'Link berhasil diperbarui!',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                },
                error: function() {
                    alert('Gagal memperbarui data!');
                }
            });
        });


        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                const linkId = this.getAttribute('data-id');
                const form = this.closest('form.delete-form');
                if (form) {
                    Swal.fire({
                        title: 'Apakah Yakin?',
                        text: 'Link Tidak Dapat Dipulihkan setelah DIhapus!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                } else {
                    console.error('Form tidak ditemukan!');
                }
            });
        });
    </script>
@endpush
@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">SimpleLink - Shortened Link</h2>

        @if (session('success'))
            <div class="mt-4">
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8 px-3">
                <form action="{{ url('shortened-link') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Cari URL atau Judul..."
                            value="{{ $search ?? '' }}">
                        <button class="btn btn-outline-primary" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row justify-content-lg-center">
            @forelse ($links as $url)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                #{{ $loop->iteration + ($links->currentPage() - 1) * $links->perPage() }}</h5>
                                <p><strong>Original URL:</strong> {{ \Illuminate\Support\Str::limit($url->original_url, 50) }}</p>

                            <p><strong>Shortened URL:</strong>
                                <a class="text-primary" href="{{ url('s/' . $url->shortened_url) }}" target="_blank"
                                    rel="nofollow noreferrer">
                                    {{ url('s/' . $url->shortened_url) }}
                                </a>
                            </p>
                            <p>
                                <strong>Title:</strong> {{ $url->title }}
                            </p>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-info btn-sm" data-id="{{ $url->id }}" id="btn-detail"
                                    data-bs-toggle="modal" data-bs-target="#detailModal">Detail</button>

                                <form action="{{ url('shorten/' . $url->id . '/delete') }}" method="POST"
                                    class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm delete-btn"
                                        data-id="{{ $url->id }}">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h5 class="text-danger text-center">Maaf Data Tidak Di temukan atau tidak tersedia</h5>
            @endforelse
        </div>
        <div>
            {{ $links->links('pagination::bootstrap-5') }}
        </div>
        @include('components.detail-modal')
        @include('components.create-modal')
    @endsection
