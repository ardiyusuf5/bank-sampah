@extends('layouts.app')

@section('title', 'Edit Video Edukasi')

@push('style')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@section('main')
<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
    <div>
        <h3 class="fw-bold mb-3">Form Edit Video Edukasi</h3>
        <h6 class="op-7 mb-2">
            Di halaman ini Anda dapat mengubah informasi video edukasi.
        </h6>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">

        <div class="card">

            <div class="card-header">
                <h4>Informasi Video Edukasi</h4>
            </div>

            <div class="card-body">

                <form method="POST" action="{{ route('admin.video.update', $video->id) }}">

                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Judul Video</label>
                        <input
                            type="text"
                            class="form-control @error('judul') is-invalid @enderror"
                            name="judul"
                            value="{{ old('judul', $video->judul) }}"
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
                            name="kategori"
                            class="form-control @error('kategori') is-invalid @enderror"
                            required>

                            <option value="">-- Pilih Kategori --</option>

                            <option value="Bank Sampah"
                                {{ $video->kategori == 'Bank Sampah' ? 'selected' : '' }}>
                                Bank Sampah
                            </option>

                            <option value="Pemilahan Sampah"
                                {{ $video->kategori == 'Pemilahan Sampah' ? 'selected' : '' }}>
                                Pemilahan Sampah
                            </option>

                            <option value="Daur Ulang"
                                {{ $video->kategori == 'Daur Ulang' ? 'selected' : '' }}>
                                Daur Ulang
                            </option>

                            <option value="Kompos"
                                {{ $video->kategori == 'Kompos' ? 'selected' : '' }}>
                                Kompos
                            </option>

                            <option value="Lingkungan"
                                {{ $video->kategori == 'Lingkungan' ? 'selected' : '' }}>
                                Lingkungan
                            </option>

                            <option value="Kerajinan"
                                {{ $video->kategori == 'Kerajinan' ? 'selected' : '' }}>
                                Kerajinan
                            </option>

                        </select>

                    </div>

                    <div class="form-group">

                        <label>Deskripsi</label>

                        <textarea
                            name="deskripsi"
                            id="summernote"
                            class="summernote form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $video->deskripsi) }}</textarea>

                    </div>

                    <div class="form-group">

                        <label>Link YouTube</label>

                        <input
                            type="url"
                            class="form-control @error('youtube_url') is-invalid @enderror"
                            name="youtube_url"
                            value="{{ old('youtube_url', $video->youtube_url) }}"
                            required>

                    </div>

                    <div class="form-group mt-4">

                        <label>Preview Video</label>

                        @php
                            preg_match('/(?:youtu\.be\/|youtube\.com\/watch\?v=)([^&]+)/', $video->youtube_url, $matches);
                            $youtubeId = $matches[1] ?? '';
                        @endphp

                        @if($youtubeId)

                            <div class="mt-3">

                                <iframe
                                    width="420"
                                    height="250"
                                    src="https://www.youtube.com/embed/{{ $youtubeId }}"
                                    frameborder="0"
                                    allowfullscreen>
                                </iframe>

                            </div>

                        @endif

                    </div>

                    <div class="card-footer text-end">

                        <button type="submit" class="btn btn-primary">
                            Simpan Perubahan
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
$(document).ready(function () {

    $('#summernote').summernote({

        height: 300,

        placeholder: 'Masukkan deskripsi video...',

        toolbar: [
            ['style', ['bold', 'italic', 'underline']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['view', ['fullscreen']]
        ]

    });

});
</script>

@endpush