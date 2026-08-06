<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Nasabah;
use App\Models\Saldo;
use App\Models\Sampah;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with(['nasabah', 'detailTransaksi.sampah'])->paginate(10);

        foreach ($transaksis as $transaksi) {
            $transaksi->total_berat = $transaksi->detailTransaksi->sum('berat_kg');
            $transaksi->total_transaksi = $transaksi->detailTransaksi->sum('harga_total');
        }

        return view('pages.petugas.transaksi.index', compact('transaksis'));
    }

    public function generateUniqueTransactionCode()
    {
        // Format: BS-YYYYMMDD-SET-001
        $today = now()->format('Ymd');
        $prefix = "BSR-{$today}-SET-";

        // Cari kode transaksi terakhir hari ini
        $lastTransaction = Transaksi::where('kode_transaksi', 'like', $prefix.'%')
            ->orderBy('kode_transaksi', 'desc')
            ->first();

        if (! $lastTransaction) {
            // Jika belum ada transaksi hari ini, mulai dari 001
            return $prefix.'001';
        }

        // Ekstrak nomor urut terakhir
        $lastNumber = substr($lastTransaction->kode_transaksi, -3);
        $newNumber = str_pad((int) $lastNumber + 1, 3, '0', STR_PAD_LEFT);

        return $prefix.$newNumber;
    }

    public function create()
    {
        $kodeTransaksi = $this->generateUniqueTransactionCode();
        $nasabahList = Nasabah::all();
        $stokSampah = Sampah::all();

        return view('pages.petugas.transaksi.create', compact('nasabahList', 'stokSampah', 'kodeTransaksi'));
    }

    public function store(Request $request)
    {
        // === TARUH DEBUG DI SINI ===
        // Jika ingin melihat data apa saja yang masuk dari form:
        // dd($request->all());

        try {
            $request->validate([
                'no_registrasi' => 'required|string|unique:nasabah,no_registrasi',
                'nama_lengkap' => 'required|string|max:255',
                'alamat_lengkap' => 'required|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Jika validasi gagal, ini akan MENGHENTIKAN redirect dan MENAMPILKAN pesan error pastinya di layar!
            dd($e->errors());
        }

        try {
            $data = [
                'no_registrasi' => $request->no_registrasi,
                'nama_lengkap' => $request->nama_lengkap,
                'alamat_lengkap' => $request->alamat_lengkap,
                'status' => 'aktif',
            ];

            $nasabah = Nasabah::create($data);

            Saldo::create([
                'nasabah_id' => $nasabah->id,
                'saldo' => 0,
            ]);

            Alert::success('Berhasil!', 'Nasabah berhasil ditambahkan!')->autoclose(3000);

            return redirect()->route('admin.nasabah.index');

        } catch (\Exception $e) {
            // Jika validasi lolos tapi DATABASE ERROR (misal NIK null, table error, dll):
            dd($e->getMessage());
        }
    }

    public function show($id)
    {
        $transaksi = Transaksi::with(['nasabah', 'detailTransaksi.sampah'])
            ->findOrFail($id);

        $detailTransaksi = $transaksi->detailTransaksi;

        return view('pages.petugas.transaksi.show', compact('transaksi', 'detailTransaksi'));
    }

    public function destroy($id)
    {
        // Cari transaksi beserta detailnya
        $transaksi = Transaksi::with('detailTransaksi.sampah')->findOrFail($id);

        // Lakukan penghapusan dalam satu proses
        $transaksi->load('detailTransaksi.sampah'); // Pastikan data relasi dimuat

        // Gunakan Eloquent untuk pengembalian stok
        foreach ($transaksi->detailTransaksi as $detail) {
            $detail->sampah->increment('stok_kg', $detail->berat_kg);
        }

        // Hapus detail transaksi dan transaksi utama
        $transaksi->detailTransaksi()->delete(); // Hapus semua detail transaksi
        $transaksi->delete(); // Hapus transaksi utama

        Alert::success('Hore!', 'Transaksi berhasil dihapus!')->autoclose(3000);

        return redirect()->route('petugas.transaksi.index');
    }
}
