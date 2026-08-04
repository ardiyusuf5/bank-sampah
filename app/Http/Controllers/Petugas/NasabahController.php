<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Nasabah;
use App\Models\Saldo;
use App\Models\Transaksi;
use App\Models\PencairanSaldo;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class NasabahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Nasabah::with('saldo');

        if ($request->filled('nama_nasabah')) {
            $query->where('nama_lengkap', 'like', '%' . $request->input('nama_nasabah') . '%');
        }

        $nasabahs = $query->paginate(10);

        return view('pages.petugas.nasabah.index', compact('nasabahs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tanggal = Carbon::now()->format('YmdHis');
        $randomNumber = Str::padLeft(mt_rand(0, 9999), 4, '0');
        $nomorRegistrasi = "NSB-{$tanggal}-{$randomNumber}";

        return view('pages.petugas.nasabah.create', compact('nomorRegistrasi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi hanya field yang benar-benar dikirim dari form
        $request->validate([
            'no_registrasi'  => 'required|string|unique:nasabah,no_registrasi',
            'nama_lengkap'   => 'required|string|max:255',
            'alamat_lengkap' => 'required|string',
            'username'       => 'nullable|string|max:255|unique:nasabah,username',
            'password'       => 'nullable|string|min:8',
        ]);

        // 2. Susun data. Field opsional akan bernilai null secara otomatis
        $data = [
            'no_registrasi'  => $request->no_registrasi,
            'nama_lengkap'   => $request->nama_lengkap,
            'alamat_lengkap' => $request->alamat_lengkap,
            'status'         => 'aktif',
        ];

        // 3. Simpan data Nasabah
        $nasabah = Nasabah::create($data);

        // 4. Inisialisasi Saldo Awal
        Saldo::create([
            'nasabah_id' => $nasabah->id,
            'saldo'      => 0
        ]);

        Alert::success('Berhasil!', 'Nasabah berhasil ditambahkan!')->autoclose(3000);

        // Redirect disesuaikan dengan route admin
        return redirect()->route('admin.nasabah.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nasabah $nasabah)
    {
        echo "asasa";
        $nasabah->delete();
        $nasabah->saldo()->delete();

        return redirect()->route('petugas.nasabah.index')->with('success', 'Nasabah berhasil dihapus.');
    }
}
