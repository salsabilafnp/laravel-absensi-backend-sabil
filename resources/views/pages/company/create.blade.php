@extends('layouts.app')

@section('title', 'Create Company')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Create New Company</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Companies</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Companies</h2>
                <div class="card">
                    <form action="{{ route('companies.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col">
                                    <label>Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <label>Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label>Address</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                        name="address">
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <label>Radius (KM)</label>
                                    <input type="text" class="form-control @error('radius_km') is-invalid @enderror"
                                        name="radius_km">
                                    @error('radius_km')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label>Latitude</label>
                                    <input type="text" class="form-control @error('latitude') is-invalid @enderror"
                                        name="latitude">
                                    @error('latitude')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <label>Longitude</label>
                                    <input type="text" class="form-control @error('longitude') is-invalid @enderror"
                                        name="longitude">
                                    @error('longitude')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label>Time In</label>
                                    <input type="text" class="form-control @error('time_in') is-invalid @enderror"
                                        name="time_in">
                                    @error('time_in')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <label>Time Out</label>
                                    <input type="text" class="form-control @error('time_out') is-invalid @enderror"
                                        name="time_out">
                                    @error('time_out')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </section>
    </div>
@endsection

@push('scripts')
@endpush
