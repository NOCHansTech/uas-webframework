@extends('layout.index')
@push('js')
    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                const linkId = this.getAttribute('data-id');
                const form = this.closest('form.delete-form');
                if (form) {
                    Swal.fire({
                        title: 'Apakah Yakin?',
                        text: 'Akun Tidak Dapat Dipulihkan setelah Di Hapus!',
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
    </script>
@endpush
@section('content')
    <div class="container-xxl mt-4 p-lg-3 p-1 m-1">
        <h3 class="mb-4">SimpleLink - User Manager</h3>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUsersModal">
            Add Users
        </button>

        @if (session('success'))
            <div class="mt-4">
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-8 col-lg-12 mt-2 px-lg-3 p-0">
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Your Shortened URLs</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('userman.index') }}" method="GET" class="mb-4">
                            <div class="input-group">
                                <input type="text" class="form-control" name="q" placeholder="Cari Nama atau Email..."
                                    value="{{ $search ?? '' }}">
                                <button class="btn btn-outline-primary" type="submit">Cari</button>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr>
                                            <th scope="row">
                                                {{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}
                                            </th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td class="text-primary">{{ $user->email }}</td>
                                            <td class="d-flex p-2 row g-1">
                                                <div class="col-auto">

                                                    <form action="{{ route('userman.destroy', $user->id) }}" method="POST"
                                                        style="display:inline;" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm delete-btn"
                                                            data-id="{{ $user->id }}">Delete</button>
                                                    </form>
                                                </div>
                                                <div class="col-auto">

                                                    <a href="{{ route('userman.show', $user->id) }}" class="btn btn-warning btn-sm">Reset Password</a>
                                                </div>
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
                            {{ $users->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('components.detail-modal')
        @include('components.create-users-modal')
    </div>
@endsection
