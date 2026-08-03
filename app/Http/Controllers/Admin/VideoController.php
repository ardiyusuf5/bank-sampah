<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VideoEdukasi;

class VideoController extends Controller
{
    /**
     * Menampilkan semua data video
     */
    public function index()
    {
        $videos = VideoEdukasi::latest()->paginate(10);

        return view('pages.admin.video.index', compact('videos'));    
        }

    /**
     * Form tambah video
     */
    public function create()
    {
        return view('pages.admin.video.create');
    }

    /**
     * Simpan video baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'kategori' => 'required|max:100',
            'deskripsi' => 'nullable',
            'youtube_url' => 'required|url',
        ]);

        VideoEdukasi::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'youtube_url' => $request->youtube_url,
        ]);

        return redirect()
            ->route('admin.video.index')
            ->with('success', 'Video berhasil ditambahkan.');
    }

    /**
     * Detail video
     */
    public function show(string $id)
    {
        $video = VideoEdukasi::findOrFail($id);

        return view('pages.admin.video.show', compact('video'));    }

    /**
     * Form edit
     */
    public function edit(string $id)
    {
        $video = VideoEdukasi::findOrFail($id);

        return view('pages.admin.video.edit', compact('video'));
    }

    /**
     * Update video
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'kategori' => 'required|max:100',
            'deskripsi' => 'nullable',
            'youtube_url' => 'required|url',
        ]);

        $video = VideoEdukasi::findOrFail($id);

        $video->update([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'youtube_url' => $request->youtube_url,
        ]);

        return redirect()
            ->route('admin.video.index')
            ->with('success', 'Video berhasil diperbarui.');
    }

    /**
     * Hapus video
     */
    public function destroy(string $id)
    {
        $video = VideoEdukasi::findOrFail($id);

        $video->delete();

        return redirect()
            ->route('admin.video.index')
            ->with('success', 'Video berhasil dihapus.');
    }
}