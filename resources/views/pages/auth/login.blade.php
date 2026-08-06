@extends('layouts.auth')

@section('title', 'Login')

@push('style')
    <!-- CSS Libraries -->
    {{-- <link rel="stylesheet" href="{{ asset('asset/library/bootstrap-social/bootstrap-social.css') }}"> --}}
@endpush

@section('main')
    <div class="wrapper wrapper-login">
        <div class="container container-login animated fadeIn">
            <h3 class="text-center">Sistem Informasi Manajemen Bank Sampah Desa Pulosari Karawang</h3>
            <div class="login-form">
                <div class="form-sub">
                    {{-- @if ($errors->any())
                        <div class="alert alert-danger mb-3">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif --}}
                    <form method="POST" action="{{ route('login.post') }}" class="needs-validation" novalidate="">
                        @csrf
                        <div class="form-floating form-floating-custom mb-3">
                            <input id="username" type="text"
                                class="form-control @error('username') is-invalid @enderror" name="username" tabindex="1"
                                value="{{ old('username') }}" required autofocus>
                            <label for="username">Username</label>
                            @error('username')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating form-floating-custom mb-3">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" tabindex="2"
                                required>
                            <label for="password">Password</label>
                            <div class="show-password">
                                <i class="icon-eye"></i>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-action mb-3">
                            <button type="submit" class="btn btn-primary w-100">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
