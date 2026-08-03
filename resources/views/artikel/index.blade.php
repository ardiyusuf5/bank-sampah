@extends('layouts.web')

@section('title','Semua Artikel')

@section('content')

<section class="py-5">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold">Artikel & Berita</h2>
            <p class="text-muted">
                Informasi terbaru mengenai kegiatan Bank Sampah SIPULUNG.
            </p>
        </div>

        <div class="row g-4">

            @foreach($artikels as $artikel)

            <div class="col-lg-6">

                <div class="card h-100 shadow-sm border-0">

                    <img src="{{ asset('storage/thumbnail/'.$artikel->thumbnail) }}"
                        class="card-img-top"
                        style="height:240px;object-fit:cover;">

                    <div class="card-body d-flex flex-column">

                        <small class="text-muted mb-2">
                            {{ $artikel->created_at->format('d F Y') }}
                        </small>

                        <h5 class="fw-bold">
                            {{ $artikel->judul_postingan }}
                        </h5>

                        <p class="text-muted">
                            {{ Str::limit(strip_tags($artikel->isi_postingan),120) }}
                        </p>

                        <div class="mt-auto">
                            <a href="{{ route('artikel.show',$artikel->id) }}"
                                class="btn btn-success rounded-pill">
                                Baca Selengkapnya
                            </a>
                        </div>

                    </div>

                </div>

            </div>

            @endforeach

        </div>

        <div class="mt-5 d-flex justify-content-center">

            {{ $artikels->links() }}

        </div>

    </div>
</section>

@endsection