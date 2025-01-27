<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shortlink -- Tugas Web Framework --</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
    <meta name="robots" content="noindex, nofollow">
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden text-bg-light min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-5 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="{{ url('') }}"
                                    class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="40"
                                        height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-link">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M9 15l6 -6" />
                                        <path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464" />
                                        <path
                                            d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" />
                                    </svg>
                                </a>
                                <p class="text-center">Simple Short Link</p>
                                @if ($errors->any())
                                    <div class="mt-4 px-1">
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            @foreach ($errors->all() as $error)
                                                {{ $error }}
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="username" class="form-control" id="username" name="username"
                                            aria-describedby="username">
                                    </div>
                                    <div class="mb-4">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" id="password">
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input primary" type="checkbox" value=""
                                                id="flexCheckChecked" name="remember">
                                            <label class="form-check-label text-dark" for="flexCheckChecked">
                                                Remeber me
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit"
                                        class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Login</button>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-2 mb-0 fw-semibold">Powered By:
                                            <a href="#" class="text-link"
                                                target="_blank">
                                                Tugas Web Framework
                                            </a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- solar icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>
