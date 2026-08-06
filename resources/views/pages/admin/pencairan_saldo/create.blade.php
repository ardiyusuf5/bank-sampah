@extends('layouts.app')

@section('title', 'Tarik Saldo')

@push('style')
    {{-- Select2 CSS & Bootstrap Theme untuk pencarian dan scroll dropdown --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-5-theme/1.2.0/select2-bootstrap.min.css" rel="stylesheet">
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

                        {{-- Tipe ubah ke text agar bisa diketik dengan titik ribuan (50.000) --}}
                        <div class="form-group mb-3">
                            <label for="jumlah_pencairan">Jumlah Pencairan (Rp)</label>
                            <input type="text" name="jumlah_pencairan" id="jumlah_pencairan" class="form-control"
                                placeholder="Contoh: 50.000">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inisialisasi Select2 dengan pencarian & scrollbar internal
            $('#nasabah_id').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: '-- Cari / Pilih Nasabah --',
                allowClear: true
            });

            const saldoInfo = document.getElementById('saldo_info');
            const inputPencairan = document.getElementById('jumlah_pencairan');

            // Helper Format Ribuan Indonesia
            function formatRibuan(angka) {
                return new Intl.NumberFormat('id-ID').format(angka);
            }

            // Load Saldo Nasabah via AJAX
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
                    .catch(() => {
                        saldoInfo.value = 'Rp 0';
                    });
            }

            // Event Listener ketika Nasabah dipilih dari Select2
            $('#nasabah_id').on('change', function() {
                muatSaldoNasabah($(this).val());
            });

            // Trigger muat saldo jika ada value lama (misal dari old input setelah validasi)
            if ($('#nasabah_id').val()) {
                muatSaldoNasabah($('#nasabah_id').val());
            }

            // Live Format Ribuan saat mengetik Jumlah Pencairan
            inputPencairan.addEventListener('input', function(e) {
                let value = this.value.replace(/\D/g, ''); // Hapus semua karakter selain angka
                if (value) {
                    this.value = formatRibuan(value);
                } else {
                    this.value = '';
                }
            });
        });
    </script>
@endpush
