<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoEdukasi extends Model
{
    protected $table = 'video_edukasi';

    protected $fillable = [
        'judul',
        'kategori',
        'deskripsi',
        'youtube_url'
    ];

    // mengambil id video youtube
    public function getYoutubeIdAttribute()
{
    preg_match(
        '/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([^?&\/]+)/',
        $this->youtube_url,
        $matches
    );

    return $matches[1] ?? '';
}}