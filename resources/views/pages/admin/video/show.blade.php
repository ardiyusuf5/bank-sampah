@extends('layouts.app')

@section('title', 'Detail Video Edukasi')

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Detail Video Edukasi
            </h3>
            <h6 class="op-7 mb-2">Di halaman ini Anda dapat melihat detail video edukasi</h6>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Informasi Video Edukasi</h4>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" class="form-control" name="judul"
                                value="{{ $video->judul }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Kategori</label>
                            <input type="text" class="form-control" name="kategori"
                                value="{{ $video->kategori }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control" rows="6" readonly>{{ $video->deskripsi }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Link Youtube</label>
                            <input type="text" class="form-control" name="youtube_url"
                                value="{{ $video->youtube_url }}" readonly>
                        </div>

                        <a href="{{ route('admin.video.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
    <label>Preview Video</label>

    <br>

    <img
        src="https://img.youtube.com/vi/{{ $video->youtube_id }}/hqdefault.jpg"
        class="img-fluid rounded shadow"
        style="max-width:400px">

</div>
@endsection
