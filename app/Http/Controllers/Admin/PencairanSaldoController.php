<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PencairanSaldo;
use App\Models\Saldo;
use App\Models\Nasabah;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class PencairanSaldoController extends Controller
{
    public function index()
    {
        $pencairanSaldo = PencairanSaldo::with(['nasabah', 'metode'])
            ->orderBy('tanggal_pengajuan', 'desc')
            ->paginate(10);

        return view('pages.admin.pencairan_saldo.index', compact('pencairanSaldo'));
    }

    /**
     * Form untuk admin membuat penarikan/pencairan saldo baru.
     */
    public function create()
    {
        $nasabahs = Nasabah::where('status', 'aktif')
            ->orderBy('nama_lengkap')
            ->get();

        return view('pages.admin.pencairan_saldo.create', compact('nasabahs'));
    }

    /**
     * Simpan penarikan saldo baru (langsung dipotong & disetujui).
     */
    public function store(Request $request)
    {
        // 1. Bersihkan format titik jika jumlah_pencairan dikirim berformat ribuan (misal "50.000")
        if ($request->has('jumlah_pencairan')) {
            $request->merge([
                'jumlah_pencairan' => str_replace('.', '', $request->jumlah_pencairan)
            ]);
        }

        // 2. Validasi input
        $request->validate([
            'nasabah_id'       => 'required|exists:nasabah,id',
            'jumlah_pencairan' => 'required|numeric|min:1',
        ]);

        // 3. Cek kecukupan saldo nasabah
        $saldo = Saldo::where('nasabah_id', $request->nasabah_id)->first();

        if (!$saldo || $saldo->saldo < $request->jumlah_pencairan) {
            return redirect()->back()->withInput()->withErrors([
                'msg' => 'Saldo nasabah tidak mencukupi untuk penarikan ini.'
            ]);
        }

        // 4. Potong Saldo & Simpan Transaksi Penarikan (Status Langsung Disetujui)
        DB::transaction(function () use ($request, $saldo) {
            // Potong saldo nasabah langsung
            $saldo->decrement('saldo', $request->jumlah_pencairan);

            // Simpan record pencairan saldo
            PencairanSaldo::create([
                'nasabah_id'        => $request->nasabah_id,
                'metode_id'         => null,
                'jumlah_pencairan'  => $request->jumlah_pencairan,
                'tanggal_pengajuan' => now(),
                'tanggal_proses'    => now(),
                'status'            => 'disetujui',
                'keterangan'        => null,
            ]);
        });

        Alert::success('Berhasil!', 'Penarikan saldo berhasil diproses.')->autoclose(3000);
        return redirect()->route('admin.tarik-saldo.index');
    }

    /**
     * Ambil saldo terkini nasabah (dipanggil via AJAX saat memilih nasabah).
     */
    public function getMetodePencairan($nasabahId)
    {
        // Cari data saldo nasabah
        $saldo = Saldo::where('nasabah_id', $nasabahId)->first();

        // Kembalikan response JSON berisi saldo murni
        return response()->json([
            'saldo' => $saldo ? (float)$saldo->saldo : 0
        ]);
    }

    public function setujui(Request $request, $id)
    {
        $pencairan = PencairanSaldo::findOrFail($id);

        if ($pencairan->status !== 'pending') {
            return redirect()->back()->withErrors(['msg' => 'Permintaan sudah diproses sebelumnya.']);
        }

        $saldo = Saldo::where('nasabah_id', $pencairan->nasabah_id)->first();

        if (!$saldo || $saldo->saldo < $pencairan->jumlah_pencairan) {
            return redirect()->back()->withErrors(['msg' => 'Saldo tidak mencukupi untuk pencairan.']);
        }

        DB::transaction(function () use ($pencairan, $saldo) {
            $saldo->decrement('saldo', $pencairan->jumlah_pencairan);

            $pencairan->update([
                'status'         => 'disetujui',
                'tanggal_proses' => now(),
            ]);
        });

        return redirect()->route('admin.tarik-saldo.index')->with('success', 'Permintaan pencairan saldo telah disetujui.');
    }

    public function tolak(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required|string|max:255',
        ]);

        $pencairan = PencairanSaldo::findOrFail($id);

        if ($pencairan->status !== 'pending') {
            return redirect()->back()->withErrors(['msg' => 'Permintaan sudah diproses sebelumnya.']);
        }

        $pencairan->update([
            'status'         => 'ditolak',
            'keterangan'     => $request->keterangan,
            'tanggal_proses' => now(),
        ]);

        return redirect()->route('admin.tarik-saldo.index')->with('error', 'Pengajuan pencairan saldo ditolak.');
    }
}
