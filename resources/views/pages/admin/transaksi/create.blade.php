@extends('layouts.app')

@section('title', 'Setoran Sampah')

@push('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-5-theme/1.2.0/select2-bootstrap.min.css" rel="stylesheet">
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Formulir Setoran Sampah</h3>
            <h6 class="op-7 mb-2">
                Isi formulir di bawah untuk mencatat setoran sampah.
            </h6>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.transaksi.store') }}" method="POST">
                @csrf

                {{-- Card Header Info --}}
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Kode Setoran</label>
                            <input class="form-control" type="text" name="kode_transaksi" value="{{ $kodeTransaksi }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Pilih Nasabah</label>
                            <select name="nasabah_id" class="form-control select2" required>
                                <option value="">-- Pilih Nasabah --</option>
                                @foreach ($nasabahList as $nasabah)
                                    <option value="{{ $nasabah->id }}">{{ $nasabah->nama_lengkap }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- <div class="form-group">
                            <label>Tanggal Setoran</label>
                            <input type="date" name="tanggal_transaksi" value="{{ date('Y-m-d') }}" class="form-control" required>
                        </div> --}}
                    </div>
                </div>

                {{-- Card Detail Setoran --}}
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Detail Setoran</label>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered align-middle" id="setoran-detail-table">
                                    <thead>
                                        <tr>
                                            <th>Jenis Sampah</th>
                                            <th class="text-end">Berat (kg)</th>
                                            <th class="text-end">Harga per kg (Rp)</th>
                                            <th class="text-end">Total (Rp)</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="setoran-details">
                                        <tr>
                                            <td>
                                                <select name="detail_transaksi[0][sampah_id]" class="form-control select-sampah" required>
                                                    <option value="">-- Pilih Sampah --</option>
                                                    @foreach ($stokSampah as $sampah)
                                                        <option value="{{ $sampah->id }}" data-harga="{{ (int) $sampah->harga_per_kg }}">
                                                            {{ $sampah->nama_sampah }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" step="any" name="detail_transaksi[0][berat_kg]" class="form-control berat-kg text-end" placeholder="Berat (kg)" min="0" oninput="if(this.value < 0) this.value = 0;" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control harga-per-kg-display text-end" placeholder="Harga per kg" readonly>
                                                <input type="hidden" name="detail_transaksi[0][harga_per_kg]" class="harga-per-kg" value="0">
                                            </td>
                                            <td class="total-harga fw-bold text-end">0</td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm remove-row">Hapus</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" class="btn btn-success" id="add-row">Tambah Sampah</button>
                        </div>

                        <div class="form-group">
                            <label>Total Transaksi (Rp)</label>
                            <input type="text" id="total-transaksi" class="form-control fw-bold" value="0" readonly>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Simpan Setoran</button>
                    </div>
                </div>
            </form>

            @if (session('success'))
                <script>
                    alert('{{ session('success') }}');
                    window.open("{{ route('admin.transaksi.print', session('transaksi_id')) }}", '_blank');
                </script>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();

            let rowIndex = 1;

            // Helper Format Ribuan Indonesia (contoh: 40000 -> "40.000")
            function formatRibuan(angka) {
                return new Intl.NumberFormat('id-ID').format(angka);
            }

            // Hitung Ulang Total Keseluruhan
            function calculateTotalTransaksi() {
                let totalGrand = 0;
                $('#setoran-details tr').each(function() {
                    let row = $(this);
                    let harga = parseFloat(row.find('select[name*="sampah_id"] option:selected').data('harga')) || 0;
                    let berat = parseFloat(row.find('.berat-kg').val()) || 0;
                    totalGrand += (harga * berat);
                });
                $('#total-transaksi').val(formatRibuan(totalGrand));
            }

            // Update Total per Baris
            function updateRowTotal(row) {
                let selectedOption = row.find('select[name*="sampah_id"] option:selected');
                let hargaPerKg = parseFloat(selectedOption.data('harga')) || 0;
                let berat = parseFloat(row.find('.berat-kg').val()) || 0;

                row.find('.harga-per-kg-display').val(hargaPerKg ? formatRibuan(hargaPerKg) : '');
                row.find('.harga-per-kg').val(hargaPerKg);

                // Tampilkan Total Sub-Baris dengan format 80.000
                let totalHarga = hargaPerKg * berat;
                row.find('.total-harga').text(formatRibuan(totalHarga));

                calculateTotalTransaksi();
            }

            // Tambah Baris Baru
            $('#add-row').on('click', function() {
                let newRow = `
                    <tr>
                        <td>
                            <select name="detail_transaksi[${rowIndex}][sampah_id]" class="form-control select-sampah" required>
                                <option value="">-- Pilih Sampah --</option>
                                @foreach ($stokSampah as $sampah)
                                    <option value="{{ $sampah->id }}" data-harga="{{ (int)$sampah->harga_per_kg }}">
                                        {{ $sampah->nama_sampah }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="number" step="any" name="detail_transaksi[${rowIndex}][berat_kg]" class="form-control berat-kg text-end" placeholder="Berat (kg)" required></td>
                        <td>
                            <input type="text" class="form-control harga-per-kg-display text-end" placeholder="Harga per kg" readonly>
                            <input type="hidden" name="detail_transaksi[${rowIndex}][harga_per_kg]" class="harga-per-kg" value="0">
                        </td>
                        <td class="total-harga fw-bold text-end">0</td>
                        <td><button type="button" class="btn btn-danger btn-sm remove-row">Hapus</button></td>
                    </tr>`;

                $('#setoran-details').append(newRow);
                rowIndex++;
            });

            // Event Listener saat Sampah atau Berat Berubah
            $(document).on('change input', 'select[name*="sampah_id"], .berat-kg', function() {
                let row = $(this).closest('tr');
                updateRowTotal(row);
            });

            // Hapus Baris
            $(document).on('click', '.remove-row', function() {
                $(this).closest('tr').remove();
                calculateTotalTransaksi();
            });
        });
    </script>
@endpush
