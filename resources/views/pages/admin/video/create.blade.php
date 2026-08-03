@extends('layouts.app')

@section('title', 'Tambah Video Edukasi')

@push('style')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@section('main')
<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
    <div>
        <h3 class="fw-bold mb-3">Form Tambah Video Edukasi</h3>
        <h6 class="op-7 mb-2">Di halaman ini Anda dapat menambahkan video edukasi baru.</h6>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">

        <div class="card">

            <div class="card-header">
                <h4>Informasi Video Edukasi</h4>
            </div>

            <div class="card-body">

                <form method="POST" action="{{ route('admin.video.store') }}">

                    @csrf

                    <div class="form-group">
                        <label>Judul Video</label>
                        <input
                            type="text"
                            class="form-control @error('judul') is-invalid @enderror"
                            name="judul"
                            value="{{ old('judul') }}"
                            required>

                        @error('judul')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>

                        <select
                            class="form-control @error('kategori') is-invalid @enderror"
                            name="kategori"
                            required>

                            <option value="">-- Pilih Kategori --</option>

                            <option value="Bank Sampah">Bank Sampah</option>
                            <option value="Pemilahan Sampah">Pemilahan Sampah</option>
                            <option value="Daur Ulang">Daur Ulang</option>
                            <option value="Kompos">Kompos</option>
                            <option value="Lingkungan">Lingkungan</option>
                            <option value="Kerajinan">Kerajinan</option>

                        </select>

                        @error('kategori')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>

                    <div class="form-group">

                        <label>Deskripsi</label>

                        <textarea
                            name="deskripsi"
                            id="summernote"
                            class="summernote form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>

                        @error('deskripsi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>

                    <div class="form-group">

                        <label>Link YouTube</label>

                        <input
                            type="url"
                            class="form-control @error('youtube_url') is-invalid @enderror"
                            name="youtube_url"
                            value="{{ old('youtube_url') }}"
                            placeholder="https://www.youtube.com/watch?v=xxxxxxxx"
                            required>

                        <small class="text-muted">
                            Masukkan link video YouTube.
                        </small>

                        @error('youtube_url')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>

                    <div class="card-footer text-end">

                        <button type="submit" class="btn btn-primary">

                            Simpan

                        </button>

                        <a href="{{ route('admin.video.index') }}"
                            class="btn btn-secondary">

                            Batal

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>

<script>
$(document).ready(function() {

    $('#summernote').summernote({

        height: 300,

        placeholder: 'Masukkan deskripsi video edukasi...',

        toolbar: [
            ['style', ['bold', 'italic', 'underline']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['view', ['fullscreen']]
        ]

    });

});
</script>

@endpush