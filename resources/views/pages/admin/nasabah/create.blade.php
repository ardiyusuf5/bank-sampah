@extends('layouts.app')

@section('title', 'Nasabah')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Form Tambah Nasabah</h3>
            <h6 class="op-7 mb-2">
                Di halaman ini Anda dapat menambah nasabah baru.
            </h6>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Informasi Nasabah</h4>
                </div>
                <div class="card-body">
                    {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}
                    <form action="{{ route('admin.nasabah.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_registrasi">Nomor Registrasi</label>
                                    <input type="text" id="no_registrasi" class="form-control" name="no_registrasi"
                                        value="{{ $nomorRegistrasi }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_lengkap">Nama Lengkap</label>
                                    <input type="text" id="nama_lengkap"
                                        class="form-control @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap"
                                        value="{{ old('nama_lengkap') }}" required>
                                    @error('nama_lengkap')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alamat_lengkap">Alamat Lengkap</label>
                            <textarea class="form-control @error('alamat_lengkap') is-invalid @enderror" data-height="150" name="alamat_lengkap"
                                required>{{ old('alamat_lengkap') }}</textarea>
                            @error('alamat_lengkap')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.nasabah.index') }}" class="btn btn-secondary">Batal</a>
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
