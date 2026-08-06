<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PencairanSaldo;
use App\Models\Transaksi;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $laporanTransaksi = collect();
        $laporanPencairan = collect();

        if ($request->filled('jenis_laporan')) {
            $jenisLaporan = $request->input('jenis_laporan');
            [$startDate, $endDate] = $this->getFilterDates($request);

            if ($startDate && $endDate) {
                if ($jenisLaporan === 'transaksi') {
                    $laporanTransaksi = Transaksi::whereBetween('created_at', [$startDate, $endDate])
                        ->with(['nasabah', 'petugas'])
                        ->orderBy('created_at', 'desc')
                        ->get();
                } elseif ($jenisLaporan === 'pencairan') {
                    $laporanPencairan = PencairanSaldo::whereBetween('tanggal_proses', [$startDate, $endDate])
                        ->with('nasabah')
                        ->where('status', 'disetujui')
                        ->orderBy('tanggal_proses', 'desc')
                        ->get();
                }
            }
        }

        return view('pages.admin.laporan.index', compact('laporanTransaksi', 'laporanPencairan'));
    }

    public function print(Request $request)
    {
        $jenisLaporan = $request->input('jenis_laporan');
        [$startDate, $endDate] = $this->getFilterDates($request);

        $data = collect();

        if ($startDate && $endDate) {
            if ($jenisLaporan === 'transaksi') {
                $data = Transaksi::whereBetween('created_at', [$startDate, $endDate])
                    ->with(['nasabah', 'petugas'])
                    ->orderBy('created_at', 'desc')
                    ->get();
            } elseif ($jenisLaporan === 'pencairan') {
                $data = PencairanSaldo::whereBetween('tanggal_proses', [$startDate, $endDate])
                    ->with('nasabah')
                    ->where('status', 'disetujui')
                    ->orderBy('tanggal_proses', 'desc')
                    ->get();
            }
        }

        return view('pages.admin.laporan.print', compact('data', 'jenisLaporan', 'startDate', 'endDate'));
    }

    /**
     * Helper untuk menentukan rentang tanggal berdasarkan preset periode.
     */
    private function getFilterDates(Request $request): array
    {
        $periode = $request->input('periode', 'hari_ini');
        $startDate = null;
        $endDate = null;

        switch ($periode) {
            case 'hari_ini':
                $startDate = now()->startOfDay();
                $endDate = now()->endOfDay();
                break;

            case '7_hari':
                $startDate = now()->subDays(6)->startOfDay();
                $endDate = now()->endOfDay();
                break;

            case 'bulan_ini':
                $startDate = now()->startOfMonth();
                $endDate = now()->endOfMonth();
                break;

            case 'bulan_lalu':
                $startDate = now()->subMonth()->startOfMonth();
                $endDate = now()->subMonth()->endOfMonth();
                break;

            case 'tahun_ini':
                $startDate = now()->startOfYear();
                $endDate = now()->endOfYear();
                break;

            case 'custom':
                if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
                    $startDate = Carbon::parse($request->tanggal_awal)->startOfDay();
                    $endDate = Carbon::parse($request->tanggal_akhir)->endOfDay();
                }
                break;
        }

        return [$startDate, $endDate];
    }
}
