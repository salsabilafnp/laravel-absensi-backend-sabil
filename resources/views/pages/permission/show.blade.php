@extends('layouts.app')

@section('title', 'Permission Detail')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/assets/css/bootstrap.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Permission Detail</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Permission Detail</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Permission Detail</h2>
                <p class="section-lead">
                    Information about the employee's permission detail.
                </p>

                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Name</label>
                                        <p>{{ $permission->user->name }}</p>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Phone Number</label>
                                        <p>{{ $permission->user->phone_number }}</p>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Position - Department</label>
                                        <p>{{ $permission->user->position }} at {{ $permission->user->department }}</p>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Permission Type</label>
                                        <p class="text-uppercase">{{ $permission->permit_type }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Date Permission</label>
                                        <p>{{ $permission->leave_date }} for {{ $permission->duration}} day(s) </p>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Reason</label>
                                        <p>{{ $permission->reason }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Supporting Document</label>
                                        @if ($permission->file_url)
                                            <!-- Jika file_url tersedia, tampilkan gambar -->
                                            <div>
                                                <img src="{{ asset('storage/permissions/' . $permission->file_url) }}"
                                                    alt="Supporting Document" class="img-thumbnail mb-3" style="max-width: 200px;">
                                            </div>
                                        @else
                                            <!-- Jika file_url kosong, tampilkan teks -->
                                            <p>No Document</p>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Status</label>
                                        <p class="text-capitalize font-weight-bold">{{ $permission->status }}</p>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-primary">Edit
                                    Permission For Approve</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>

    <!-- Page Specific JS File -->
@endpush