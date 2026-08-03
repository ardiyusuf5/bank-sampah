@extends('layouts.web')

@section('title',$artikel->judul_postingan)

@section('content')

<section class="py-5 mt-5">

    <div class="container">

        <a href="{{ route('home') }}" class="btn btn-outline-success mb-4">
    <i class="bi bi-arrow-left"></i>
    Kembali
</a>

        <div class="card border-0 shadow">

            {{-- Thumbnail --}}
            @if($artikel->thumbnail)

                <img
                    src="{{ asset('storage/thumbnail/'.$artikel->thumbnail) }}"
                    class="card-img-top"
                    style="height:450px;object-fit:cover;">

            @endif

            <div class="card-body p-5">

                <small class="text-muted">

                    <i class="bi bi-calendar-event"></i>

                    {{ $artikel->created_at->format('d F Y') }}

                </small>

                <h2 class="fw-bold mt-3 mb-4">

                    {{ $artikel->judul_postingan }}

                </h2>

                <div class="artikel-content">

                    {!! $artikel->isi_postingan !!}

                </div>

            </div>

        </div>

        {{-- Galeri --}}
        @if($artikel->media->count())

        <div class="mt-5">

            <h3 class="fw-bold mb-4">

                Galeri Kegiatan

            </h3>

            <div class="row g-4">

                @foreach($artikel->media as $media)

                <div class="col-lg-4 col-md-6">

                    <img
                        src="{{ asset('storage/media/'.$media->file_gambar) }}"
                        class="img-fluid rounded shadow-sm">

                </div>

                @endforeach

            </div>

        </div>

        @endif

    </div>

</section>

@endsection