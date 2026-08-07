@extends('layouts.app')

@section('title', 'Riwayat Tarik Saldo')

@push('style')
    <!-- CSS Libraries -->
    {{-- <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}"> --}}
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Riwayat Tarik Saldo</h3>
            <h6 class="op-7 mb-2">Daftar transaksi tarik saldo yang sudah diproses.</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <div class="section-header-button">
                <a href="{{ route('admin.tarik-saldo.create') }}" class="btn btn-primary btn-round">Tarik Saldo</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="clearfix mb-3"></div>

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle table-head-bg-primary">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Pengajuan</th>
                                    {{-- <th>Tanggal Proses</th> --}}
                                    <th>Nama Nasabah</th>
                                    <th class="text-end">Jumlah Tarik</th>
                                    {{-- <th>Status</th>
                                    <th>Keterangan</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pencairanSaldo as $index => $pencairan)
                                    <tr>
                                        <td>{{ $pencairanSaldo->firstItem() + $index }}</td>
                                        <td>{{ \Carbon\Carbon::parse($pencairan->tanggal_pengajuan)->translatedFormat('d F Y H:i') }}</td>
                                        {{-- <td>{{ $pencairan->tanggal_proses ? \Carbon\Carbon::parse($pencairan->tanggal_proses)->translatedFormat('d F Y H:i') : '-' }} --}}
                                        <td>{{ $pencairan->nasabah->nama_lengkap }}</td>
                                        <td class="text-end">Rp {{ number_format($pencairan->jumlah_pencairan, 0, ',', '.') }}</td>
                                        {{-- <td>
                                            <span
                                                class="badge badge-{{ $pencairan->status === 'disetujui' ? 'success' : ($pencairan->status === 'ditolak' ? 'danger' : 'warning') }}">
                                                {{ ucfirst($pencairan->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $pencairan->keterangan ?? '-' }}</td> --}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Belum ada riwayat tarik saldo.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                    <div class="float-right">
                        {{ $pencairanSaldo->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
