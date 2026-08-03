<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sistem Informasi Manajemen Bank Sampah Desa Pulosari Karawang</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@0,600;1,600&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,300;0,500;0,600;0,700;1,300;1,500;1,600;1,700&amp;display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;1,400&amp;display=swap"
        rel="stylesheet" />
    <link href="{{ asset('assets/web/css/styles.css') }}" rel="stylesheet" />
</head>

<body id="page-top">
    <nav class="navbar navbar-expand-lg bg-success navbar-dark fixed-top shadow-sm" id="mainNav">
        <div class="container px-5">
            <a class="navbar-brand fw-bold" href="#page-top">SIPULUNG</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="bi-list"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-white ms-auto me-4 my-3 my-lg-0">
                    <li class="nav-item"><a class="nav-link me-lg-3" href="#beranda">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link me-lg-3" href="#tentang">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link me-lg-3" href="#edukasi">Edukasi</a></li>
                    <li class="nav-item"><a class="nav-link me-lg-3" href="#artikel">Artikel</a></li>
                </ul>
            </div>
        </div>
    </nav>
  <header class="masthead" id="beranda">
    <div class="container px-5">

        <!-- ROW -->
        <div class="row gx-5 align-items-center">

            <!-- KOLOM KIRI -->
            <div class="col-lg-6">
                <div class="mb-5 mb-lg-0 text-center text-lg-start">
                    <h1 class="display-4 lh-1 mb-3">
                        SIPULUNG : Pilah Sampahnya, Tabung Rupiahnya!
                    </h1>

                    <p class="lead fw-normal text-muted mb-4" style="text-align: justify;">
                        <b>Sampah Bukan Akhir, Tapi Awal Perubahan.</b>
                            Bersama SIPULUNG, mari berkolaborasi mengelola sampah rumah tangga menjadi tabungan bernilai ekonomi untuk menciptakan Desa Pulosari yang bersih, sehat, dan berkelanjutan.</p>
                    </p>

                    <div class="d-flex flex-column flex-sm-row gap-3">
                        <a href="{{ route('login') }}" class="btn btn-success btn-lg rounded-pill">
                            <i class="bi bi-box-arrow-in-right me-2"></i>
                            Masuk
                        </a>

                        <a href="#tentang" class="btn btn-outline-success btn-lg rounded-pill">
                            <i class="bi bi-grid me-2"></i>
                            Lihat Layanan
                        </a>
                    </div>
                </div>
            </div>

            <!-- KOLOM KANAN -->
            <div class="col-lg-6">
                <div id="carouselSIPULUNG" class="carousel slide"
                    data-bs-ride="carousel"
                    data-bs-interval="3000">

                    <div class="carousel-inner rounded-4 shadow">

                        <div class="carousel-item active">
                            <img src="{{ asset('assets/web/img/desa pulosari.jpg') }}"
                                class="d-block w-100 img-fluid">
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('assets/web/img/pembersihan sungai.jpg') }}"
                                class="d-block w-100 img-fluid">
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('assets/web/img/we love pulosari.jpg') }}"
                                class="d-block w-100 img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

    <aside class="text-center bg-success">
        <div class="container px-2">
            <div class="row text-center py">
        <div class="col-md-4">
            <h1 class="fw-bold text-white">2.500+</h1>
            <small class="text-uppercase text-white">Jumlah Warga</small>
        </div>

        <div class="col-md-4">
            <h1 class="fw-bold text-white">500+</h1>
            <small class="text-uppercase text-white">Warga Diberdayakan</small>
        </div>

        <div class="col-md-4">
            <h1 class="fw-bold text-white">1.2 Ton</h1>
            <small class="text-uppercase text-white">Sampah Terkelola</small>
        </div>
    </div>
            </div>
        </aside>
    <!-- Basic features section-->
    <section class="bg-light" id="tentang">
        <div class="container px-5">
            <div class="row gx-5 align-items-center justify-content-center justify-content-lg-between">
                <div class="col-12 col-lg-5">
                    <h2 class="display-2 lh-1 mb-2">Siapa Kami?</h2>
                    <p class="small text-muted  mb-5 mb-lg-0" style="text-align: justify;"><b>SIPULUNG (Sistem Informasi Pulosari Peduli Lingkungan)</b> merupakan platform edukasi dan informasi yang dikembangkan melalui kolaborasi Mahasiswa KKN Universitas Buana Perjuangan Karawang dengan masyarakat Desa Pulosari. Platform ini bertujuan meningkatkan kesadaran masyarakat dalam mengelola sampah secara bijak melalui edukasi lingkungan dan program Bank Sampah Desa.</p>
                    <p class="small text-muted  mb-5 mb-lg-0" style="text-align:justify;">
                    Melalui SIPULUNG, masyarakat dapat memperoleh informasi mengenai pengelolaan sampah, prinsip 3R (Reduce, Reuse, Recycle), klasifikasi sampah, cara pemilahan, edukasi daur ulang, hingga kegiatan Bank Sampah Desa. Kami percaya bahwa langkah kecil yang dilakukan bersama dapat mewujudkan Desa Pulosari yang bersih, sehat, mandiri, dan berkelanjutan.
                </div>
                <div class="col-sm-8 col-md-6">
                    <div class="px-5 px-sm-0">
                        <img class="img-fluid" style="max-width: 100%; height: auto;"
                            src="{{ asset('assets/web/img/bank_logo.png') }}" alt="..." />
                    </div>
                </div>
            </div>
        </div>
    </section>
<hr>
<section class="py-5 bg-light">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Visi & Tujuan</h2>
            <p class="text-muted">
                Bersama SIPULUNG membangun Desa Pulosari yang lebih bersih, sehat, dan berkelanjutan.
            </p>
        </div>

        <div class="row g-4">

            <!-- VISI -->
            <div class="col-lg-6">
                <div class="card h-100 border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">

                        <div class="mb-3">
                            <i class="bi bi-bullseye fs-1 text-success"></i>
                        </div>

                        <h4 class="fw-bold">Visi</h4>

                        <p class="text-muted mb-0">
                            Mewujudkan Desa Pulosari yang bersih, sehat, dan peduli lingkungan melalui pengelolaan sampah yang berkelanjutan serta pemberdayaan masyarakat berbasis bank sampah. </p>
                    </div>
                </div>
            </div>

            <!-- TUJUAN -->
            <div class="col-lg-6">
                <div class="card h-100 border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">

                        <div class="mb-3">
                            <i class="bi bi-flag fs-1 text-success"></i>
                        </div>

                        <h4 class="fw-bold">Tujuan</h4>

                        <ul class="text-muted mb-0">
                            <li>Meningkatkan kesadaran masyarakat tentang pentingnya menjaga kebersihan dan mengelola sampah dengan benar.</li>
                            <li>Mengurangi jumlah sampah yang dibuang sembarangan dan mencemari lingkungan.</li>
                            <li>Menjadikan bank sampah sebagai sarana edukasi dan pemberdayaan masyarakat di bidang lingkungan.</li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light" id="edukasi">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Tentang Sampah</h2>

            <p class="text-muted mx-auto" style="text-align: justify;">
                Sampah adalah sisa material dari kegiatan manusia, baik yang berasal dari rumah tangga maupun aktivitas lainnya, yang sudah tidak digunakan lagi dan dibuang. Apabila tidak dikelola dengan baik, sampah dapat menimbulkan berbagai permasalahan, seperti pencemaran lingkungan, gangguan kesehatan, hingga menurunkan kualitas hidup masyarakat. Namun, sampah tidak selalu menjadi barang yang tidak berguna. Melalui pengelolaan yang tepat serta penerapan prinsip 3R <b>(Reduce, Reuse, Recycle)</b>, sebagian jenis sampah dapat dimanfaatkan kembali, didaur ulang, bahkan memiliki nilai ekonomi melalui program Bank Sampah.
            </p>
        </div>

        <div class="row g-4">

    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-4">
                <i class="bi bi-tree-fill fs-1 text-success"></i>
                <h4 class="mt-3">Dampak terhadap Lingkungan</h4>
                <p class="text-muted">Pencemaran tanah dan air, banjir, bau tidak sedap, dan penurunan kualitas lingkungan.</p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-4">
                <i class="bi bi-file-medical-fill fs-1 text-success"></i>
                <h4 class="mt-3">Dampak terhadap Kesehatan</h4>
                <p class="text-muted">Menjadi tempat berkembang biaknya penyakit dan mengganggu kesehatan masyarakat.</p>
            </div>
        </div>
    </div>
</div>
</section>

<section class="py-5 bg-light">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Mengapa Harus Mengelola Sampah?</h2>
            <p class="text-muted">
                Pengelolaan sampah yang baik memberikan manfaat bagi lingkungan, kesehatan, dan kesejahteraan masyarakat.
            </p>
        </div>

        <div class="row g-4">

            <!-- Card 1 -->
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100 text-center rounded-4">
                    <div class="card-body p-4">
                        <i class="bi bi-recycle fs-1 text-success"></i>
                        <h5 class="mt-3 fw-bold">Mengurangi Sampah</h5>
                        <p class="text-muted small">
                            Mengurangi jumlah sampah yang dibuang ke tempat pembuangan akhir (TPA).
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100 text-center rounded-4">
                    <div class="card-body p-4">
                        <i class="bi bi-tree-fill fs-1 text-success"></i>
                        <h5 class="mt-3 fw-bold">Menjaga Lingkungan</h5>
                        <p class="text-muted small">
                            Menciptakan lingkungan yang bersih, sehat, dan nyaman untuk masyarakat.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100 text-center rounded-4">
                    <div class="card-body p-4">
                        <i class="bi bi-cash-coin fs-1 text-success"></i>
                        <h5 class="mt-3 fw-bold">Bernilai Ekonomi</h5>
                        <p class="text-muted small">
                            Sampah yang dipilah dapat ditabung atau didaur ulang sehingga memiliki nilai ekonomi.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100 text-center rounded-4">
                    <div class="card-body p-4">
                        <i class="bi bi-people-fill fs-1 text-success"></i>
                        <h5 class="mt-3 fw-bold">Meningkatkan Kepedulian</h5>
                        <p class="text-muted small">
                            Menumbuhkan kebiasaan gotong royong dan kepedulian masyarakat terhadap lingkungan.
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<section class="py-5 bg-light" id="klasifikasi">
    <div class="container">

        <div class="row align-items-center">

            <!-- Bagian Kiri -->
            <div class="col-lg-4 mb-4 mb-lg-0">

                <h2 class="display-5 fw-bold">
                    Klasifikasi Sampah
                </h2>

                <p class="text-muted mt-3" style="text-align: justify;">
                    Kenali jenis-jenis sampah agar lebih mudah dipilah
                    dan dikelola. Dengan pemilahan yang benar,
                    sampah dapat diolah sesuai jenisnya sehingga
                    mengurangi pencemaran lingkungan dan meningkatkan
                    nilai ekonominya.
                </p>

            </div>

            <!-- Bagian Kanan -->
            <div class="col-lg-8">

                <div class="row g-4">

                    <!-- Organik -->
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-4 h-100">

                            <div class="card-body">

                                <i class="bi bi-tree-fill fs-1 text-success"></i>

                                <h4 class="mt-3">Sampah Organik</h4>

                                <p class="text-muted">
                                    Sampah yang berasal dari makhluk hidup
                                    dan dapat terurai secara alami.
                                </p>

                                <strong>Contoh:</strong>

                                <div class="mt-3">
                                    <span class="badge bg-success me-2 mb-2">Sisa Makanan</span>
                                    <span class="badge bg-success me-2 mb-2">Daun</span>
                                    <span class="badge bg-success me-2 mb-2">Buah</span>
                                    <span class="badge bg-success me-2 mb-2">Kulit Telur</span>
                                </div>

                            </div>

                        </div>
                    </div>

                    <!-- Anorganik -->
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body">
                                <i class="bi bi-recycle fs-1 text-primary"></i>
                                <h4 class="mt-3">Sampah Anorganik</h4>
                                <p class="text-muted" style="text-align: justify;">
                                    Sampah yang sulit terurai tetapi dapat
                                    dimanfaatkan kembali melalui proses daur ulang.
                                </p>
                                <strong>Contoh:</strong>
                                <div class="mt-3">
                                    <span class="badge bg-primary me-2 mb-2">Botol Plastik</span>
                                    <span class="badge bg-primary me-2 mb-2">Kaleng</span>
                                    <span class="badge bg-primary me-2 mb-2">Kardus</span>
                                    <span class="badge bg-primary me-2 mb-2">Kaca</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" id="cara-memilah">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Cara Memilah Sampah</h2>
            <p class="text-muted">
                Pemilahan sampah yang benar akan memudahkan proses pengelolaan
                dan meningkatkan nilai ekonominya melalui Bank Sampah.
            </p>
        </div>

        <div class="row text-center g-4">

            <div class="col-md-3">
                <i class="bi bi-trash-fill fs-1 text-success"></i>
                <h5 class="mt-3">1. Pisahkan</h5>
                <p class="text-muted">
                    Pisahkan sampah sesuai jenisnya sejak dari rumah.
                </p>
            </div>

            <div class="col-md-3">
                <i class="bi bi-ui-checks-grid fs-1 text-success"></i>
                <h5 class="mt-3">2. Kelompokkan</h5>
                <p class="text-muted">
                    Kelompokkan menjadi sampah organik dan anorganik.
                </p>
            </div>

            <div class="col-md-3">
                <i class="bi bi-box-seam fs-1 text-success"></i>
                <h5 class="mt-3">3. Simpan</h5>
                <p class="text-muted">
                    Simpan dalam wadah yang bersih dan terpisah.
                </p>
            </div>

            <div class="col-md-3">
                <i class="bi bi-bank fs-1 text-success"></i>
                <h5 class="mt-3">4. Setor</h5>
                <p class="text-muted">
                    Setorkan sampah ke Bank Sampah sesuai jadwal.
                </p>
            </div>

        </div>

    </div>
</section>

<section class="py-5 bg-white" id="video-edukasi">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">
                Video Edukasi
            </h2>
            <p class="text-muted">
                Pelajari pengelolaan sampah melalui berbagai video edukasi yang mudah dipahami.
            </p>
        </div>

        <div id="videoCarousel"
             class="carousel slide"
             data-bs-ride="false">
            <div class="carousel-inner">
                @foreach($videos as $index => $group)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <div class="row g-4">
                        @foreach($group as $video)
                        <div class="col-md-6">
                            <div class="card shadow-sm border-0 rounded-4 h-100">
                                <img
                                src="https://img.youtube.com/vi/{{ $video->youtube_id }}/hqdefault.jpg"
                                class="card-img-top"
                                alt="">
                                <div class="card-body">
                                    <span class="badge bg-success mb-2">
                                        {{ $video->kategori }}
                                    </span>
                                    <h5>
                                        {{ $video->judul }}
                                    </h5>
                                    <p class="text-muted small">
                                        {{ Str::limit($video->deskripsi,80) }}
                                    </p>
                                    <a href="{{ $video->youtube_url }}"
                                       target="_blank"
                                       class="btn btn-success rounded-pill">
                                        <i class="bi bi-play-circle"></i>
                                        Tonton
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev"
                    type="button"
                    data-bs-target="#videoCarousel"
                    data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-success rounded-circle p-3"></span>
            </button>
            <button class="carousel-control-next"
                    type="button"
                    data-bs-target="#videoCarousel"
                    data-bs-slide="next">
                <span class="carousel-control-next-icon bg-success rounded-circle p-3"></span>
            </button>
        </div>
    </div>
</section>
<hr>
<section class="py-5 bg-light" id="tips">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold">🌱 Tips Ramah Lingkungan</h2>
            <p class="text-muted">
                Kebiasaan kecil yang dilakukan setiap hari dapat memberikan dampak besar bagi lingkungan.
            </p>
        </div>

        <div class="row g-4">

            <!-- Card -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm bg-success bg-opacity-10">

                    <div class="card-body">

                        <div class="d-flex align-items-center mb-3">

                            <div class="rounded-circle bg-white shadow d-flex justify-content-center align-items-center"
                                style="width:70px;height:70px;">

                                <img src="{{ asset('assets/web/img/shopping bag.png') }}"
                                    width="42">

                            </div>

                            <h5 class="fw-bold ms-3 mb-0">
                                Membawa Tas Belanja
                            </h5>

                        </div>

                        <p class="text-muted mb-0">
                            Kurangi penggunaan kantong plastik sekali pakai dengan membawa tas belanja yang dapat digunakan kembali.
                        </p>

                    </div>

                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm bg-success bg-opacity-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-white shadow d-flex justify-content-center align-items-center"
                                style="width:70px;height:70px;">
                                <img src="{{ asset('assets/web/img/tumblr.png') }}"
                                    width="42">
                            </div>
                            <h5 class="fw-bold ms-3 mb-0">
                                Gunakan Botol Minum
                            </h5>
                        </div>
                        <p class="text-muted mb-0">
                            Biasakan membawa tumbler untuk mengurangi sampah botol plastik sekali pakai.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm bg-success bg-opacity-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-white shadow d-flex justify-content-center align-items-center"
                                style="width:70px;height:70px;">
                                <img src="{{ asset('assets/web/img/lunch box.png') }}"
                                    width="42">
                            </div>
                            <h5 class="fw-bold ms-3 mb-0">
                                Gunakan Tempat Makan Sendiri
                            </h5>
                        </div>
                        <p class="text-muted mb-0">
                            Bawa kotak makan dan alat makan sendiri saat bepergian.                        </p>
                    </div>
                </div>
            </div>

             <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm bg-success bg-opacity-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-white shadow d-flex justify-content-center align-items-center"
                                style="width:70px;height:70px;">
                                <img src="{{ asset('assets/web/img/trash sorting.png') }}"
                                    width="42">
                            </div>
                            <h5 class="fw-bold ms-3 mb-0">
                                Pisahkan Sampah dari Rumah
                            </h5>
                        </div>
                        <p class="text-muted mb-0">
                            Pisahkan sampah organik dan anorganik agar lebih mudah didaur ulang.
                        </p>
                    </div>
                </div>
            </div>

             <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm bg-success bg-opacity-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-white shadow d-flex justify-content-center align-items-center"
                                style="width:80px;height:60px;">
                                <img src="{{ asset('assets/web/img/botol plastik.png') }}"
                                    width="42">
                            </div>
                            <h5 class="fw-bold ms-3 mb-0">
                                Gunakan Kembali Wadah yang Masih Layak
                            </h5>
                        </div>
                        <p class="text-muted mb-0">
                            Manfaatkan botol atau toples bekas sebagai tempat penyimpanan.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm bg-success bg-opacity-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-white shadow d-flex justify-content-center align-items-center"
                                style="width:80px;height:70px;">
                                <img src="{{ asset('assets/web/img/kompos.png') }}"
                                    width="42">
                            </div>
                            <h5 class="fw-bold ms-3 mb-0">
                                Buat Kompos dari Sampah Organik
                            </h5>
                        </div>
                        <p class="text-muted mb-0">
                            Sisa sayuran dan daun kering dapat diolah menjadi pupuk kompos.
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<hr>

<section class="py-5 bg-light" id="artikel">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold">📰 Artikel & Berita Desa</h2>
            <p class="text-muted">
                Temukan berbagai informasi, edukasi, dan dokumentasi kegiatan Bank Sampah Desa Pulosari.
            </p>
        </div>

        <div class="row g-4">

            @foreach($artikelTerbaru as $artikel)

            <div class="col-lg-6">

                <div class="card h-100 border-0 shadow-sm artikel-card">

                    {{-- Thumbnail --}}
                    @if($artikel->thumbnail)

                    <img
                        src="{{ asset('storage/thumbnail/'.$artikel->thumbnail) }}"
                        class="card-img-top artikel-img">

                    @else

                    <img
                        src="{{ asset('assets/web/img/no-image.png') }}"
                        class="card-img-top artikel-img">

                    @endif

                    <div class="card-body">

                        <span class="badge bg-success mb-2">
                            Artikel
                        </span>

                        <h5 class="fw-bold">
                            {{ Str::limit($artikel->judul_postingan,60) }}
                        </h5>

                        <p class="text-muted">

                            {{ Str::limit(strip_tags($artikel->isi_postingan),120) }}

                        </p>

                    </div>

                    <div class="card-footer bg-white border-0 d-flex justify-content-between">

                        <small class="text-muted">

                            <i class="bi bi-calendar-event"></i>

                            {{ $artikel->created_at->format('d M Y') }}

                        </small>

                        <a
                            href="{{ route('artikel.show', $artikel->id) }}"
                            class="text-success fw-bold text-decoration-none">

                            Baca Selengkapnya →

                        </a>

                    </div>

                </div>

            </div>

            @endforeach

        </div>

        <div class="text-center mt-5">

            <a href="{{ route('artikel') }}"
                class="btn btn-success rounded-pill px-5">

                Lihat Semua Artikel

            </a>

        </div>

    </div>
</section>

    <footer class="bg-success text-white pt-5 pb-3">

    <div class="container">

        <div class="row">

            <!-- SIPULUNG -->
            <div class="col-lg-3 mb-4">
                <h4 class="fw-bold">SIPULUNG</h4>

                <p class="mt-3">
                    Sistem Informasi Pulosari Peduli Lingkungan sebagai Media Edukasi
                    dan Pengelolaan Bank Sampah Desa Pulosari.
                </p>
            </div>

            <!-- Menu -->
            <div class="col-lg-2 mb-4">

                <h5>Menu</h5>

                <ul class="list-unstyled mt-3">

                    <li><a href="{{ route('home') }}#beranda" class="text-white text-decoration-none">Beranda</a></li>

                    <li><a href="{{ route('home') }}#tentang" class="text-white text-decoration-none">Tentang</a></li>

                    <li><a href="{{ route('home') }}#edukasi" class="text-white text-decoration-none">Edukasi</a></li>

                    <li><a href="{{ route('artikel') }}" class="text-white text-decoration-none">Artikel</a></li>

                </ul>

            </div>

            <!-- Kontak -->
            <div class="col-lg-3 mb-4">

                <h5>Kontak</h5>

                <p class="mt-3 mb-1">
                    📍 Desa Pulosari, Kecamatan Telagasari,
                    Kabupaten Karawang
                </p>

                <p class="mb-1">
                    ✉ sipulung@gmail.com
                </p>

                <p>
                    ☎ (0267) xxxx
                </p>

            </div>

            <!-- Maps -->
            <div class="col-lg-4 mb-4">

                <h5>Lokasi Desa</h5>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1694827.9842647277!2d105.33975499999998!3d-6.256336900000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e697a65557b1029%3A0x4e03ec74f2684452!2sKantor%20DESA%20PULOSARI!5e1!3m2!1sid!2sid!4v1784778941723!5m2!1sid!2sid" 
                    width="300" height="150" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
            </div>

        </div>

        <hr class="border-light">

        <div class="text-center">

            © {{ date('Y') }} SIPULUNG | Universitas Buana Perjuangan Karawang

        </div>

    </div>

</footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>
