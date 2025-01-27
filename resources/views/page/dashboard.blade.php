@extends('layout.index')
@push('js')
    <script>
        $(document).on('click', '#btn-detail', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/link/' + id,
                type: 'GET',
                success: function(data) {
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
                        confirmButtonColor: '#0f82fc',
                        cancelButtonColor: '#fc5886',
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

        function copyLink(urlId) {
            // Ambil elemen dengan ID yang spesifik berdasarkan URL ID
            const shortLink = document.getElementById('short-link-' + urlId);

            // Buat range dan pilih teks
            const range = document.createRange();
            range.selectNode(shortLink);
            window.getSelection().removeAllRanges(); // Hilangkan selection sebelumnya
            window.getSelection().addRange(range); // Pilih teks baru

            // Salin teks ke clipboard
            try {
                document.execCommand('copy');
                Toastify({
                    text: "Link berhasil disalin!", // Pesan yang ditampilkan
                    className: "info",
                    style: {
                        background: "#3ba1e5",
                    },
                    position: "center",
                }).showToast();

            } catch (err) {
                alert('Gagal menyalin link');
            }

            // Hapus seleksi setelah menyalin
            window.getSelection().removeAllRanges();
        }
    </script>
@endpush
@section('content')
    <div class="container-xxl mt-4 p-lg-3 p-0 m-0">
        <h3 class="mb-4">SimpleLink - Dashboard</h3>
        <div class="row justify-content-lg-start justify-content-center mb-2 px-lg-3">
            <button type="button" class="btn btn-primary col-10 col-md-auto" data-bs-toggle="modal" data-bs-target="#shortenUrlModal">
                Singkatkan URL
            </button>
        </div>
        
        @if (session('success'))
            <div class="mt-4">
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        <div class="row justify-content-center p-0 mb-3">
            <div class="col-md-8 col-lg-12 mt-2 px-lg-3 px-2">
                <form action="{{ url('/') }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Cari URL atau Judul..."
                            value="{{ $search ?? '' }}">
                        <button class="btn btn-outline-primary" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row justify-content-lg-center p-0">
            @forelse ($links as $url)
                <div class="col-lg-6 px-lg-3 px-2 mb-3">
                    <div class="card mb-0 shadow-md">
                        <div class="card-body">
                            <button href="#" class="custom-edit-button" data-id="{{ $url->id }}" id="btn-detail"
                                data-bs-toggle="modal" data-bs-target="#detailModal">
                                <iconify-icon icon="mdi:pencil"></iconify-icon> Edit
                            </button>
                            <div class="custom-title">{{ $url->title ?? '-' }}</div>
                            <div class="custom-short-link" id="short-link-{{ $url->id }}">
                                {{ url('s/' . $url->shortened_url) }}</div>
                            <div class="custom-full-link">{{ $url->original_url, 50 }}</div>
                            <div class="custom-buttons">
                                <button class="custom-button custom-button-primary"
                                    onclick="copyLink({{ $url->id }})">
                                    <iconify-icon icon="mdi:content-copy"></iconify-icon> Salin Link
                                </button>
                                <form action="{{ url('shorten/' . $url->id . '/delete') }}" method="POST"
                                    class="delete-form d-flex">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="custom-button custom-button-danger btn-danger delete-btn"
                                        data-id="{{ $url->id }}">
                                        <iconify-icon icon="mdi:delete"></iconify-icon> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="custom-date-time">
                                <iconify-icon icon="mdi:calendar"></iconify-icon>
                                {{ $url->created_at->format('d M Y H:i') }}
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h5 class="text-danger text-center">Maaf Data Tidak Di temukan atau tidak tersedia</h5>
                <div class="row justify-content-center">
                    <a href="{{ url('/') }}" class="btn btn-sm btn-primary col-auto">Kembali</a>
                </div>
            @endforelse
        </div>
        <div>
            {{ $links->links('pagination::bootstrap-5') }}
        </div>
        @include('components.detail-modal')
        @include('components.create-modal')
    @endsection
