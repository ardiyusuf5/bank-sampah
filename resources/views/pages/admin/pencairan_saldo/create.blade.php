@extends('layouts.app')

@section('title', 'Buat Pengajuan Tarik Saldo')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Buat Pengajuan Pencairan Saldo</h3>
            <h6 class="op-7 mb-2">Admin membuat pengajuan penarikan saldo atas nama nasabah.</h6>
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
                                    <option value="{{ $nasabah->id }}" {{ old('nasabah_id') == $nasabah->id ? 'selected' : '' }}>
                                        {{ $nasabah->nama_lengkap }} ({{ $nasabah->no_registrasi }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="saldo_info">Saldo Tersedia</label>
                            <input type="text" id="saldo_info" class="form-control" value="Rp 0" disabled>
                        </div>

                        <div class="form-group mb-2">
                            <label for="metode_id">Metode Pencairan</label>
                            <select name="metode_id" id="metode_id" class="form-control" required>
                                <option value="">-- Pilih Nasabah Terlebih Dahulu --</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <button type="button" class="btn btn-sm btn-outline-primary" id="btnTambahMetode" disabled>
                                + Tambah Metode Pencairan
                            </button>
                        </div>

                        <div class="form-group mb-3">
                            <label for="jumlah_pencairan">Jumlah Pencairan</label>
                            <input type="number" name="jumlah_pencairan" id="jumlah_pencairan"
                                class="form-control" min="1" required value="{{ old('jumlah_pencairan') }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Ajukan Pencairan</button>
                        <a href="{{ route('admin.tarik-saldo.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Metode Pencairan -->
    <div class="modal fade" id="modalTambahMetode" tabindex="-1" role="dialog" aria-labelledby="modalTambahMetodeLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahMetodeLabel">Tambah Metode Pencairan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="metodeAlert" class="alert alert-danger d-none"></div>
                    <div class="form-group mb-3">
                        <label for="nama_metode_pencairan">Nama Metode (Bank/E-Wallet)</label>
                        <input type="text" id="nama_metode_pencairan" class="form-control" placeholder="Contoh: BCA, DANA, OVO">
                    </div>
                    <div class="form-group mb-3">
                        <label for="no_rek">Nomor Rekening/HP</label>
                        <input type="text" id="no_rek" class="form-control" placeholder="Contoh: 1234567890">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="btnSimpanMetode">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const nasabahSelect = document.getElementById('nasabah_id');
        const metodeSelect = document.getElementById('metode_id');
        const saldoInfo = document.getElementById('saldo_info');
        const btnTambahMetode = document.getElementById('btnTambahMetode');

        function muatMetodeNasabah(nasabahId) {
            metodeSelect.innerHTML = '<option value="">Memuat...</option>';
            saldoInfo.value = 'Memuat...';

            if (!nasabahId) {
                metodeSelect.innerHTML = '<option value="">-- Pilih Nasabah Terlebih Dahulu --</option>';
                saldoInfo.value = 'Rp 0';
                btnTambahMetode.disabled = true;
                return;
            }

            btnTambahMetode.disabled = false;

            fetch(`/admin/tarik-saldo/metode/${nasabahId}`)
                .then(res => res.json())
                .then(data => {
                    if (data.metode.length === 0) {
                        metodeSelect.innerHTML = '<option value="">Nasabah belum punya metode pencairan</option>';
                    } else {
                        metodeSelect.innerHTML = '<option value="">-- Pilih Metode --</option>';
                        data.metode.forEach(m => {
                            metodeSelect.innerHTML += `<option value="${m.id}">${m.nama_metode_pencairan} - ${m.no_rek}</option>`;
                        });
                    }
                    saldoInfo.value = 'Rp ' + new Intl.NumberFormat('id-ID').format(data.saldo);
                })
                .catch(() => {
                    metodeSelect.innerHTML = '<option value="">Gagal memuat data</option>';
                    saldoInfo.value = 'Rp 0';
                });
        }

        nasabahSelect.addEventListener('change', function () {
            muatMetodeNasabah(this.value);
        });

        btnTambahMetode.addEventListener('click', function () {
            if (!nasabahSelect.value) return;
            document.getElementById('metodeAlert').classList.add('d-none');
            document.getElementById('nama_metode_pencairan').value = '';
            document.getElementById('no_rek').value = '';
            $('#modalTambahMetode').modal('show');
        });

        document.getElementById('btnSimpanMetode').addEventListener('click', function () {
            const nama = document.getElementById('nama_metode_pencairan').value.trim();
            const noRek = document.getElementById('no_rek').value.trim();
            const alertBox = document.getElementById('metodeAlert');

            if (!nama || !noRek) {
                alertBox.textContent = 'Nama metode dan nomor rekening wajib diisi.';
                alertBox.classList.remove('d-none');
                return;
            }

            fetch(`{{ route('admin.tarik-saldo.metode.store') }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    nasabah_id: nasabahSelect.value,
                    nama_metode_pencairan: nama,
                    no_rek: noRek,
                }),
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        $('#modalTambahMetode').modal('hide');
                        muatMetodeNasabah(nasabahSelect.value);
                    } else {
                        alertBox.textContent = 'Gagal menyimpan metode pencairan.';
                        alertBox.classList.remove('d-none');
                    }
                })
                .catch(() => {
                    alertBox.textContent = 'Terjadi kesalahan, coba lagi.';
                    alertBox.classList.remove('d-none');
                });
        });
    </script>
@endpush