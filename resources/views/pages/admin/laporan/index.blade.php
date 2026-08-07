@extends('layouts.app')

@section('title', 'Laporan Operasional')

@push('style')
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
@endpush

@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Filter Laporan</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.laporan.index') }}" method="GET" id="filterForm">
                        <div class="row">
                            {{-- Jenis Laporan --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="jenis_laporan">Jenis Laporan</label>
                                    <select name="jenis_laporan" id="jenis_laporan" class="form-control" required>
                                        <option value="">-- Pilih Jenis --</option>
                                        <option value="transaksi" {{ request('jenis_laporan') == 'transaksi' ? 'selected' : '' }}>
                                            Laporan Setoran
                                        </option>
                                        <option value="pencairan" {{ request('jenis_laporan') == 'pencairan' ? 'selected' : '' }}>
                                            Laporan Pencairan
                                        </option>
                                    </select>
                                </div>
                            </div>

                            {{-- Pilihan Periode Cepat --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="periode">Periode Waktu</label>
                                    <select name="periode" id="periode" class="form-control" required>
                                        <option value="hari_ini" {{ request('periode', 'hari_ini') == 'hari_ini' ? 'selected' : '' }}>Hari Ini</option>
                                        <option value="7_hari" {{ request('periode') == '7_hari' ? 'selected' : '' }}>7 Hari Terakhir</option>
                                        <option value="bulan_ini" {{ request('periode') == 'bulan_ini' ? 'selected' : '' }}>Bulan Ini</option>
                                        <option value="bulan_lalu" {{ request('periode') == 'bulan_lalu' ? 'selected' : '' }}>Bulan Lalu</option>
                                        <option value="tahun_ini" {{ request('periode') == 'tahun_ini' ? 'selected' : '' }}>Tahun Ini</option>
                                        <option value="custom" {{ request('periode') == 'custom' ? 'selected' : '' }}>Custom (Pilih Tanggal)</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Form Tanggal Custom (Default: Hidden via JS/CSS) --}}
                            <div class="col-md-2 custom-date-field" style="{{ request('periode') == 'custom' ? '' : 'display: none;' }}">
                                <div class="form-group">
                                    <label for="tanggal_awal">Tanggal Awal</label>
                                    <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control"
                                        value="{{ request('tanggal_awal') }}">
                                </div>
                            </div>

                            <div class="col-md-2 custom-date-field" style="{{ request('periode') == 'custom' ? '' : 'display: none;' }}">
                                <div class="form-group">
                                    <label for="tanggal_akhir">Tanggal Akhir</label>
                                    <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control"
                                        value="{{ request('tanggal_akhir') }}">
                                </div>
                            </div>

                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary btn-block mb-3">Tampilkan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Hasil Laporan --}}
    @if (request()->filled('jenis_laporan'))
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Hasil Laporan {{ ucfirst(request('jenis_laporan')) }}</h4>
                        <div class="no-print">
                            <a href="{{ route('admin.laporan.print', request()->all()) }}" target="_blank" class="btn btn-secondary btn-sm">
                                <i class="fas fa-print"></i> Cetak Laporan
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered align-middle">
                                <thead>
                                    <tr>
                                        @if (request('jenis_laporan') === 'transaksi')
                                            <th>No</th>
                                            <th>Kode Transaksi</th>
                                            <th>Nasabah</th>
                                            <th>Petugas</th>
                                            <th>Tanggal Setoran</th>
                                        @else
                                            <th>No</th>
                                            <th>Nasabah</th>
                                            <th class="text-end">Jumlah Pencairan</th>
                                            <th>Tanggal Proses</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (request('jenis_laporan') === 'transaksi')
                                        @forelse($laporanTransaksi as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->kode_transaksi }}</td>
                                                <td>{{ $item->nasabah->nama_lengkap ?? '-' }}</td>
                                                <td>{{ $item->petugas->nama ?? '-' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->tanggal_transaksi)->translatedFormat('d F Y') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">Tidak ada data setoran pada periode ini.</td>
                                            </tr>
                                        @endforelse
                                    @else
                                        @forelse($laporanPencairan as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nasabah->nama_lengkap ?? '-' }}</td>
                                                <td class="text-end">Rp {{ number_format($item->jumlah_pencairan, 0, ',', '.') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->tanggal_proses ?? $item->tanggal_pengajuan)->translatedFormat('d F Y H:i') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Tidak ada data pencairan pada periode ini.</td>
                                            </tr>
                                        @endforelse
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const periodeSelect = document.getElementById('periode');
            const customDateFields = document.querySelectorAll('.custom-date-field');
            const inputAwal = document.getElementById('tanggal_awal');
            const inputAkhir = document.getElementById('tanggal_akhir');

            function toggleCustomDate() {
                if (periodeSelect.value === 'custom') {
                    customDateFields.forEach(el => el.style.display = 'block');
                    inputAwal.setAttribute('required', 'required');
                    inputAkhir.setAttribute('required', 'required');
                } else {
                    customDateFields.forEach(el => el.style.display = 'none');
                    inputAwal.removeAttribute('required');
                    inputAkhir.removeAttribute('required');
                }
            }

            periodeSelect.addEventListener('change', toggleCustomDate);
        });
    </script>
@endpush
