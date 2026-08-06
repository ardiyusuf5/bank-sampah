@extends('layouts.app')

@section('title', 'Tarik Saldo')

@push('style')
    <!-- CSS Libraries -->
    {{-- <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}"> --}}
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

                        <div class="form-group mb-3">
                            <label for="nasabah_id">Nasabah</label>
                            <select name="nasabah_id" id="nasabah_id" class="form-control" required>
                                <option value="">-- Pilih Nasabah --</option>
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
                            <input type="text" id="saldo_info" class="form-control" value="Rp 0" disabled>
                        </div>

                        <div class="form-group mb-3">
                            <label for="jumlah_pencairan">Jumlah Pencairan</label>
                            <input type="number" name="jumlah_pencairan" id="jumlah_pencairan" class="form-control"
                                min="1" required value="{{ old('jumlah_pencairan') }}">
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
    <script>
        const nasabahSelect = document.getElementById('nasabah_id');
        const saldoInfo = document.getElementById('saldo_info');

        function muatSaldoNasabah(nasabahId) {
            saldoInfo.value = 'Memuat...';

            if (!nasabahId) {
                saldoInfo.value = 'Rp 0';
                return;
            }

            fetch(`/admin/tarik-saldo/saldo/${nasabahId}`)
                .then(res => res.json())
                .then(data => {
                    saldoInfo.value = 'Rp ' + new Intl.NumberFormat('id-ID').format(data.saldo);
                })
                .catch(() => {
                    saldoInfo.value = 'Rp 0';
                });
        }

        nasabahSelect.addEventListener('change', function() {
            muatSaldoNasabah(this.value);
        });

        if (nasabahSelect.value) {
            muatSaldoNasabah(nasabahSelect.value);
        }
    </script>
@endpush
