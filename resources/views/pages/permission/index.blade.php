@extends('layouts.app')

@section('title', 'Permissions')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Permissions</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Permissions</a></div>
                    <div class="breadcrumb-item">All Permissions</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <h2 class="section-title">Permissions</h2>
                <p class="section-lead">
                    You can manage all the permission, such as give approval for the permit.
                </p>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="float-right">
                                    <form method="GET" action="{{ route('permissions.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="name">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Permission Type</th>
                                            <th>Date Permission</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        @foreach ($permissions as $permit)
                                            <tr>
                                                <td>{{ $permit->user->name }}
                                                </td>
                                                <td>
                                                    {{ $permit->user->position }}
                                                </td>
                                                <td class="text-uppercase">
                                                    {{ $permit->permit_type }}
                                                </td>
                                                <td>
                                                    {{ $permit->leave_date }} for {{ $permit->duration }} day(s)
                                                </td>
                                                <td class="text-capitalize">
                                                    {{ $permit->status }}
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='{{ route('permissions.show', $permit->id) }}'
                                                            class="btn btn-sm btn-info btn-icon">
                                                            <i class="fas fa-circle-info"></i>
                                                            Detail
                                                        </a>

                                                        <form action="{{ route('permissions.destroy', $permit->id) }}"
                                                            method="POST" class="ml-2">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}" />
                                                            <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                <i class="fas fa-times"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $permissions->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
