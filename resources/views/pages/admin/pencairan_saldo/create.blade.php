@extends('layouts.app')

@section('title', 'Tarik Saldo')

@push('style')
    {{-- Select2 CSS & Corrected Bootstrap 5 Theme CDN --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    {{-- Fix Scrollbar & Max Height Dropdown Select2 --}}
    <style>
        .select2-container--bootstrap-5 .select2-dropdown .select2-results__options,
        .select2-results__options {
            max-height: 220px !important;
            overflow-y: auto !important;
            -webkit-overflow-scrolling: touch;
        }
    </style>
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Tarik Saldo</h3>
            <h6 class="op-7 mb-2">Admin dapat langsung menarik saldo nasabah yang dipilih.</h6>
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

                    <form action="{{ route('admin.tarik-saldo.store') }}" method="POST">
                        @csrf

                        {{-- Dropdown Nasabah dengan Fitur Search & Scroll via Select2 --}}
                        <div class="form-group mb-3">
                            <label for="nasabah_id">Nasabah</label>
                            <select name="nasabah_id" id="nasabah_id" class="form-control select2" required>
                                <option value="">-- Cari / Pilih Nasabah --</option>
                                @foreach ($nasabahs as $nasabah)
                                    <option value="{{ $nasabah->id }}"
                                        {{ old('nasabah_id') == $nasabah->id ? 'selected' : '' }}>
                                        {{ $nasabah->nama_lengkap }} ({{ $nasabah->no_registrasi }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="saldo_info">Saldo Tersedia</label>
                            <input type="text" id="saldo_info" class="form-control fw-bold" value="Rp 0" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="jumlah_pencairan_display">Jumlah Pencairan (Rp)</label>
                            <input type="text" id="jumlah_pencairan_display" class="form-control"
                                value="{{ old('jumlah_pencairan') ? number_format((int) old('jumlah_pencairan'), 0, ',', '.') : '' }}"
                                placeholder="Contoh: 50.000" required>
                            <input type="hidden" name="jumlah_pencairan" id="jumlah_pencairan"
                                value="{{ old('jumlah_pencairan') }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Tarik Saldo</button>
                        <a href="{{ route('admin.tarik-saldo.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- Select2 JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inisialisasi Select2
            $('#nasabah_id').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: '-- Cari / Pilih Nasabah --',
                allowClear: true
            });

            const saldoInfo = document.getElementById('saldo_info');
            const inputPencairanDisplay = document.getElementById('jumlah_pencairan_display');
            const inputPencairan = document.getElementById('jumlah_pencairan');

            function formatRibuan(angka) {
                return new Intl.NumberFormat('id-ID').format(angka);
            }

            function muatSaldoNasabah(nasabahId) {
                saldoInfo.value = 'Memuat...';

                if (!nasabahId) {
                    saldoInfo.value = 'Rp 0';
                    return;
                }

                fetch(`/admin/tarik-saldo/saldo/${nasabahId}`)
                    .then(res => res.json())
                    .then(data => {
                        saldoInfo.value = 'Rp ' + formatRibuan(data.saldo);
                    })
                    .catch((error) => {
                        console.error('Gagal memuat saldo nasabah:', error);
                        saldoInfo.value = 'Gagal memuat saldo';
                    });
            }

            $('#nasabah_id').on('change', function() {
                muatSaldoNasabah($(this).val());
            });

            if ($('#nasabah_id').val()) {
                muatSaldoNasabah($('#nasabah_id').val());
            }

            inputPencairanDisplay.addEventListener('input', function() {
                let value = this.value.replace(/\D/g, '');
                if (value) {
                    this.value = formatRibuan(value);
                    inputPencairan.value = value;
                } else {
                    this.value = '';
                    inputPencairan.value = '';
                }
            });
        });
    </script>
@endpush
