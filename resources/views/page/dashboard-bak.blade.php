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
        <h2 class="mb-4">SimpleLink - Dashboard</h2>
        {{-- <h2 class="mb-4">ShortKeun-Linkna Dashboard</h2> --}}

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#shortenUrlModal">
            Shorten URL
        </button>

        @if (session('success'))
            <div class="mt-4">
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        <div class="card mt-3">
            <div class="card-header">
                <h5>Your Shortened URLs</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Cari URL atau Judul..."
                            value="{{ $search ?? '' }}">
                        <button class="btn btn-outline-primary" type="submit">Cari</button>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Original URL</th>
                                <th scope="col">Shortened URL</th>
                                <th scope="col">Title</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($links as $url)
                                <tr>
                                    <th scope="row">
                                        {{ $loop->iteration + ($links->currentPage() - 1) * $links->perPage() }}
                                    </th>
                                    <td>{{ \Illuminate\Support\Str::limit($url->original_url, 50) }}</td>
                                    <td>
                                        <a class="text-primary" href="{{ url('s/' . $url->shortened_url) }}" target="_blank"
                                            rel="nofollow noreferrer">{{ url('s/' . $url->shortened_url) }}</a>
                                    </td>
                                    <td>{{ $url->title }}</td>
                                    <td class="d-flex p-2">
                                        <button class="btn btn-info btn-sm" data-id="{{ $url->id }}" id="btn-detail"
                                            data-bs-toggle="modal" data-bs-target="#detailModal">Detail</button>
                                        <form action="{{ url('shorten/' . $url->id . '/delete') }}" method="POST"
                                            style="display:inline;" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm delete-btn"
                                                data-id="{{ $url->id }}">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak Di temukan Data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="justify-content-end">
                    {{ $links->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
        @include('components.detail-modal')
        @include('components.create-modal')
    </div>
@endsection
