@extends('layout.index')    
@section('content')    
    <div class="container-xxl mt-4 p-lg-3 p-1 m-1">    
        <h3 class="mb-4">Admin Dashboard - SimpleLink</h3>    
        <div class="row justify-content-center g-3">    
            <div class="col-md-6 p-0 p-lg-2">    
                <div class="card">    
                    <div class="card-header">    
                        Total Link    
                    </div>    
                    <div class="card-body">    
                        <h1>{{ $data['links'] }}</h1>    
                        <p class="card-text">    
                            Jumlah Link yang tersedia</p>    
                        <a href="{{ url('admin/shortened-link') }}" class="btn btn-primary">Go somewhere</a>    
                    </div>    
                </div>    
            </div>    
            <div class="col-md-6 p-0 p-lg-2">    
                <div class="card">    
                    <div class="card-header">    
                        Total Users    
                    </div>    
                    <div class="card-body">    
                        <h1>{{ $data['users'] }}</h1>    
                        <p class="card-text">    
                            Jumlah Pengguna Terdaftar</p>    
                        <a href="{{ url('admin/userman') }}" class="btn btn-primary">Go somewhere</a>    
                    </div>    
                </div>    
            </div>    
        </div>    
    
        <div class="row justify-content-center g-3 mt-4">    
            <div class="col-md-6 p-0 p-lg-2">      
                <div class="card">      
                    <div class="card-header d-flex align-items-center justify-content-between">      
                        <div class="flex-grow-1">    
                            Links Created     
                        </div>    
                        <form id="periodFormLinks" action="{{ url('admin/dashboard') }}" method="GET" class="d-flex">    
                            <label for="periodSelectLinks" class="form-label visually-hidden">Select Reporting Period</label>    
                            <select class="form-select" id="periodSelectLinks" name="periodLinks" aria-label="Select Reporting Period" aria-required="true" onchange="this.form.submit()">      
                                <option value="daily" {{ $periodLinks == 'daily' ? 'selected' : '' }}>Daily</option>      
                                <option value="monthly" {{ $periodLinks == 'monthly' ? 'selected' : '' }}>Monthly</option>      
                                <option value="yearly" {{ $periodLinks == 'yearly' ? 'selected' : '' }}>Yearly</option>      
                            </select>      
                        </form>      
                    </div>      
                    <div class="card-body">      
                        <canvas id="linksChart"></canvas>      
                    </div>      
                </div>      
            </div>      
               
            <div class="col-md-6 p-0 p-lg-2">      
                <div class="card">      
                    <div class="card-header d-flex align-items-center justify-content-between">      
                        <div class="flex-grow-1">  
                            Users Created  
                        </div>    
                        <form id="periodFormUsers" action="{{ url('admin/dashboard') }}" method="GET" class="d-flex">    
                            <label for="periodSelectUsers" class="form-label visually-hidden">Select Reporting Period</label>    
                            <select class="form-select" id="periodSelectUsers" name="periodUsers" aria-label="Select Reporting Period" aria-required="true" onchange="this.form.submit()">      
                                <option value="daily" {{ $periodUsers == 'daily' ? 'selected' : '' }}>Daily</option>      
                                <option value="monthly" {{ $periodUsers == 'monthly' ? 'selected' : '' }}>Monthly</option>      
                                <option value="yearly" {{ $periodUsers == 'yearly' ? 'selected' : '' }}>Yearly</option>      
                            </select>      
                        </form>      
                    </div>      
                    <div class="card-body">      
                        <canvas id="usersChart"></canvas>      
                    </div>      
                </div>      
            </div>      
               
        </div>    
    </div>    
@endsection    
    
@push('js')    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>    
    <script>    
        // Data for the links chart    
        const linksData = {    
            labels: @json($datesLinks),    
            datasets: [{    
                label: 'Links Created',    
                data: @json($linkCounts),    
                backgroundColor: 'rgba(75, 192, 192, 0.2)',    
                borderColor: 'rgba(75, 192, 192, 1)',    
                borderWidth: 1    
            }]    
        };    
    
        // Configuration for the links chart    
        const linksConfig = {    
            type: 'line',    
            data: linksData,    
            options: {    
                scales: {    
                    y: {    
                        beginAtZero: true    
                    }    
                }    
            }    
        };    
    
        // Render the links chart    
        const linksChart = new Chart(    
            document.getElementById('linksChart'),    
            linksConfig    
        );    
    
        // Data for the users chart    
        const usersData = {    
            labels: @json($datesUsers),    
            datasets: [{    
                label: 'Users Created',    
                data: @json($userCounts),    
                backgroundColor: 'rgba(153, 102, 255, 0.2)',    
                borderColor: 'rgba(153, 102, 255, 1)',    
                borderWidth: 1    
            }]    
        };    
    
        // Configuration for the users chart    
        const usersConfig = {    
            type: 'line',    
            data: usersData,    
            options: {    
                scales: {    
                    y: {    
                        beginAtZero: true    
                    }    
                }    
            }    
        };    
    
        // Render the users chart    
        const usersChart = new Chart(    
            document.getElementById('usersChart'),    
            usersConfig    
        );    
    </script>    
@endpush  
