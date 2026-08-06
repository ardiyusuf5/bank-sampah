@extends('layouts.app')

@section('title', 'Dashboard')

@push('style')
<style>
    .stat-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .stat-title {
        font-size: 0.75rem;
        font-weight: 600;
        margin-bottom: 2px;
        line-height: 1.2;
        color: #6c757d;
        /* Izinkan teks membungkus rapi ke baris kedua jika tidak muat */
        white-space: normal;
        word-break: break-word;
    }

    .stat-value {
        font-size: 1.2rem;
        font-weight: 700;
        line-height: 1.2;
        margin-bottom: 0;
    }

    /* Penyesuaian khusus layar HP (< 576px) */
    @media (max-width: 575.98px) {
        .stat-card .card-body {
            padding: 0.75rem !important;
        }
        .stat-icon {
            width: 36px;
            height: 36px;
            font-size: 0.95rem;
            border-radius: 8px;
        }
        .stat-title {
            font-size: 0.68rem;
        }
        .stat-value {
            font-size: 1rem;
        }
    }
</style>
@endpush

@section('main')
    {{-- Header Dashboard --}}
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-3">
        <div>
            <h3 class="fw-bold mb-1">Dashboard</h3>
            <p class="text-muted small mb-0">Rincian data dan transaksi Bank Sampah Desa Pulosari</p>
        </div>
    </div>

    {{-- Grid Kartu Statistik --}}
    <div class="row row-cols-2 row-cols-sm-2 row-cols-lg-4 g-2 g-md-3">

        {{-- Total Nasabah --}}
        <div class="col">
            <div class="card stat-card h-100">
                <div class="card-body p-3 d-flex align-items-center gap-2 gap-md-3">
                    <div class="stat-icon bg-primary text-white">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <div class="stat-title">Total Nasabah</div>
                        <div class="stat-value text-dark">{{ number_format($totalNasabah, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Petugas --}}
        <div class="col">
            <div class="card stat-card h-100">
                <div class="card-body p-3 d-flex align-items-center gap-2 gap-md-3">
                    <div class="stat-icon bg-info text-white">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div>
                        <div class="stat-title">Total Petugas</div>
                        <div class="stat-value text-dark">{{ number_format($totalPetugas, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Sampah Terkumpul --}}
        <div class="col">
            <div class="card stat-card h-100">
                <div class="card-body p-3 d-flex align-items-center gap-2 gap-md-3">
                    <div class="stat-icon bg-warning text-white">
                        <i class="fas fa-recycle"></i>
                    </div>
                    <div>
                        <div class="stat-title">Sampah Terkumpul</div>
                        <div class="stat-value text-dark">{{ number_format($totalSampahTerkumpul, 0, ',', '.') }} <small class="fs-6 fw-normal">Kg</small></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Transaksi Setoran --}}
        <div class="col">
            <div class="card stat-card h-100">
                <div class="card-body p-3 d-flex align-items-center gap-2 gap-md-3">
                    <div class="stat-icon bg-success text-white">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                    <div>
                        <div class="stat-title">Transaksi Setoran</div>
                        <div class="stat-value text-dark">{{ number_format($totalTransaksiSetoran, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Saldo Nasabah --}}
        <div class="col">
            <div class="card stat-card h-100">
                <div class="card-body p-3 d-flex align-items-center gap-2 gap-md-3">
                    <div class="stat-icon bg-secondary text-white">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div>
                        <div class="stat-title">Total Saldo Nasabah</div>
                        <div class="stat-value text-dark">Rp {{ number_format($totalSaldoNasabah, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Stok Sampah --}}
        <div class="col">
            <div class="card stat-card h-100">
                <div class="card-body p-3 d-flex align-items-center gap-2 gap-md-3">
                    <div class="stat-icon bg-danger text-white">
                        <i class="fas fa-box"></i>
                    </div>
                    <div>
                        <div class="stat-title">Stok Sampah</div>
                        <div class="stat-value text-dark">{{ number_format($totalStokSampah, 0, ',', '.') }} <small class="fs-6 fw-normal">Kg</small></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sampah Terkirim --}}
        <div class="col">
            <div class="card stat-card h-100">
                <div class="card-body p-3 d-flex align-items-center gap-2 gap-md-3">
                    <div class="stat-icon bg-dark text-white">
                        <i class="fas fa-truck"></i>
                    </div>
                    <div>
                        <div class="stat-title">Sampah Terkirim</div>
                        <div class="stat-value text-dark">{{ number_format($totalSampahTerkirim, 0, ',', '.') }} <small class="fs-6 fw-normal">Kg</small></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Artikel --}}
        <div class="col">
            <div class="card stat-card h-100">
                <div class="card-body p-3 d-flex align-items-center gap-2 gap-md-3">
                    <div class="stat-icon bg-info text-white">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <div>
                        <div class="stat-title">Total Artikel</div>
                        <div class="stat-value text-dark">{{ number_format($totalArtikel, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Highlight Omzet --}}
    <div class="row mt-2 mt-md-3">
        <div class="col-12">
            <div class="card stat-card bg-success text-white">
                <div class="card-body p-3 p-md-4 d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-title text-white-50">Omzet / Kas Bank Sampah</div>
                        <h2 class="stat-value text-white fs-3 fs-md-2 mt-1 mb-0">
                            Rp {{ number_format($totalKeuntungan, 0, ',', '.') }}
                        </h2>
                    </div>
                    <div class="stat-icon bg-white text-success fs-3" style="width: 50px; height: 50px;">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
