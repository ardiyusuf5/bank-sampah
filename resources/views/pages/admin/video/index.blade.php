@extends('layouts.app')

@section('title', 'Daftar Video Edukasi')

@push('style')
@endpush

@section('main')
<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
    <div>
        <h3 class="fw-bold mb-3">Video Edukasi</h3>
        <h6 class="op-7 mb-2">
            Anda dapat mengelola semua video edukasi seperti menambah, mengubah, dan menghapus video.
        </h6>
    </div>

    <div class="ms-md-auto py-2 py-md-0">
        <a href="{{ route('admin.video.create') }}"
            class="btn btn-primary btn-round">
            Tambah Video
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12">

        <div class="card">

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover table-bordered table-head-bg-primary">

                        <thead>

                            <tr>
                                <th width="5%">No</th>
                                <th width="25%">Judul</th>
                                <th width="15%">Kategori</th>
                                <th width="20%">Deskripsi</th>
                                <th width="15%">Link Youtube</th>
                                <th width="20%">Aksi</th>
                            </tr>

                        </thead>

                        <tbody>

                            @forelse($videos as $index => $video)

                            <tr>

                                <td>
                                    {{ $videos->firstItem() + $index }}
                                </td>

                                <td>
                                    {{ $video->judul }}
                                </td>

                                <td>
                                    <span class="badge bg-success">
                                        {{ $video->kategori }}
                                    </span>
                                </td>

                                <td>
                                    {{ $video->deskripsi }}
                                </td>
                                <td>
                                <img
                                        src="https://img.youtube.com/vi/{{ $video->youtube_id }}/hqdefault.jpg"
                                        width="120">
                                </td>
                                <td>

                                    <a href="{{ route('admin.video.show',$video->id) }}"
                                        class="btn btn-info btn-sm">

                                        Detail

                                    </a>

                                    <a href="{{ route('admin.video.edit',$video->id) }}"
                                        class="btn btn-primary btn-sm">

                                        Edit

                                    </a>

                                    <form
                                        action="{{ route('admin.video.destroy',$video->id) }}"
                                        method="POST"
                                        style="display:inline">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            onclick="return confirm('Yakin ingin menghapus video ini?')"
                                            class="btn btn-danger btn-sm">

                                            Hapus

                                        </button>

                                    </form>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="6" class="text-center">

                                    Belum ada data video edukasi.

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="float-end">

                    {{ $videos->links() }}

                </div>

            </div>

        </div>

    </div>
</div>

@endsection

@push('scripts')
@endpush
