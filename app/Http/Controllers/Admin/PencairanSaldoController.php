<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PencairanSaldo;
use App\Models\Saldo;
use App\Models\Nasabah;
use App\Models\MetodePencairan;
use RealRashid\SweetAlert\Facades\Alert;

class PencairanSaldoController extends Controller
{
    public function index()
    {
        $pencairanSaldo = PencairanSaldo::with(['nasabah', 'metode'])
            ->where('status', 'pending')
            ->orderBy('tanggal_pengajuan', 'desc')
            ->paginate(10);

        return view('pages.admin.pencairan_saldo.index', compact('pencairanSaldo'));
    }

    /**
     * Form untuk admin membuat pengajuan pencairan saldo baru.
     */
    public function create()
    {
        $nasabahs = Nasabah::where('status', 'aktif')
            ->orderBy('nama_lengkap')
            ->get();

        return view('pages.admin.pencairan_saldo.create', compact('nasabahs'));
    }

    /**
     * Simpan pengajuan pencairan saldo baru (status: pending).
     */
    public function store(Request $request)
    {
        $request->validate([
            'nasabah_id' => 'required|exists:nasabah,id',
            'metode_id' => 'nullable|exists:metode_pencairan,id',
            'jumlah_pencairan' => 'required|numeric|min:1',
        ]);

        $saldo = Saldo::where('nasabah_id', $request->nasabah_id)->first();

        if (!$saldo || $saldo->saldo < $request->jumlah_pencairan) {
            return redirect()->back()->withInput()->withErrors([
                'msg' => 'Saldo nasabah tidak mencukupi untuk pengajuan ini.'
            ]);
        }

        PencairanSaldo::create([
            'nasabah_id' => $request->nasabah_id,
            'metode_id' => $request->metode_id,
            'jumlah_pencairan' => $request->jumlah_pencairan,
            'tanggal_pengajuan' => now(),
            'status' => 'pending',
        ]);

        Alert::success('Berhasil!', 'Pengajuan pencairan saldo berhasil dibuat.')->autoclose(3000);
        return redirect()->route('admin.tarik-saldo.index');
    }

    /**
     * Ambil daftar metode pencairan milik nasabah tertentu beserta saldo
     * terkini (dipanggil via AJAX saat admin memilih nasabah di form create).
     */
    public function getMetodePencairan($nasabahId)
    {
        $metode = MetodePencairan::where('nasabah_id', $nasabahId)->get();
        $saldo = Saldo::where('nasabah_id', $nasabahId)->first();

        return response()->json([
            'metode' => $metode,
            'saldo' => $saldo->saldo ?? 0,
        ]);
    }

    /**
     * Simpan metode pencairan baru untuk nasabah (dipanggil via AJAX dari
     * modal "Tambah Metode Pencairan" di form create).
     */
    public function storeMetode(Request $request)
    {
        $request->validate([
            'nasabah_id' => 'required|exists:nasabah,id',
            'nama_metode_pencairan' => 'nullable|string|max:255',
            'no_rek' => 'required|string|max:255',
        ]);

        $metode = MetodePencairan::create([
            'nasabah_id' => $request->nasabah_id,
            'nama_metode_pencairan' => $request->nama_metode_pencairan,
            'no_rek' => $request->no_rek,
        ]);

        return response()->json([
            'success' => true,
            'metode' => $metode,
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

        $saldo->saldo -= $pencairan->jumlah_pencairan;
        $saldo->tanggal_update = now();
        $saldo->save();

        $pencairan->status = 'disetujui';
        $pencairan->tanggal_proses = now();
        $pencairan->save();

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

        $pencairan->status = 'ditolak';
        $pencairan->keterangan = $request->keterangan;
        $pencairan->tanggal_proses = now();
        $pencairan->save();

        return redirect()->route('admin.tarik-saldo.index')->with('error', 'Pengajuan pencairan saldo ditolak.');
    }
}
