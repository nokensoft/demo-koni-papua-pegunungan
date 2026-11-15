@extends('layouts.visitor')
@section('title', ($situs['nama_situs'] ?? 'KONI Provinsi Papua Pegunungan'))
@section('seo-title', ($situs['nama_situs'] ?? 'KONI Provinsi Papua Pegunungan'))
@section('seo-description', ($situs['seo_meta_description'] ?? 'Website resmi KONI Provinsi Papua Pegunungan'))

@section('content')

    <!-- Hero: Sekilas Tentang -->
    <section class="relative min-h-[50vh] flex items-center bg-dark overflow-hidden py-12 lg:py-16">
        <img src="{{ asset('img/bg/honai-papua-pegunungan.png') }}" class="absolute inset-0 w-full h-full object-cover opacity-15" alt="">
        <div class="absolute inset-0 bg-gradient-to-r from-dark via-dark/90 to-dark/60"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 lg:gap-16 items-center">
                {{-- Teks --}}
                <div class="text-white">
                    <p class="text-primary font-bold uppercase tracking-widest mb-3 text-sm lg:text-base">Profil Organisasi</p>
                    <h2 class="text-3xl lg:text-5xl font-extrabold mb-4 uppercase leading-tight">KONI Provinsi <br><span class="text-primary">Papua Pegunungan</span></h2>
                    <p class="max-w-xl mb-6 text-gray-300 leading-relaxed text-base lg:text-lg text-justify">
                        Induk organisasi olahraga di Daerah Otonom Baru (DOB) Papua Pegunungan yang bertanggung jawab mengoordinasikan, membina, dan mengembangkan olahraga prestasi di seluruh wilayah provinsi. Debut perdana di PON XXI Aceh-Sumut 2024 menjadi bukti bahwa Papua Pegunungan mampu bersaing di pentas nasional.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('tentang') }}" class="bg-primary px-7 py-3 font-bold no-round hover:bg-red-700 transition inline-block text-base">Selengkapnya <i class="fas fa-arrow-right ml-2"></i></a>
                        <a href="{{ route('berita') }}" class="border border-white px-7 py-3 font-bold no-round hover:bg-white hover:text-dark transition inline-block text-base">Informasi Terbaru</a>
                    </div>
                </div>

            </div>
        </div>

        {{-- Gambar: menempel penuh ke tepi atas, bawah, dan kanan hero --}}
        <div class="hidden md:block absolute inset-y-0 right-0 w-1/2">
            <img src="{{ asset('img/Gubernur Jhon Tabo, KONI Papua Pegunungan.jpeg') }}" alt="Pelantikan KONI Papua Pegunungan" class="w-full h-full object-cover">
        </div>
    </section>




    <!-- Postingan Terbaru: Berita Terkini & Galeri Terbaru (2 kolom seimbang) -->
    <section class="py-20 bg-accent">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Berita Terkini -->
                <div>
                    <div class="flex justify-between items-center mb-8">
                        <h3 class="text-2xl font-extrabold flex items-center">
                            <span class="w-8 h-1 bg-primary mr-3"></span> Berita Terkini
                        </h3>
                        <a href="{{ route('berita') }}" class="text-primary text-base font-bold uppercase hover:underline">Semua <i class="fas fa-arrow-right"></i></a>
                    </div>
                    <div class="space-y-5">
                        @forelse ($beritaTerbaru as $b)
                            <a href="{{ route('berita.detail', $b->slug) }}" class="group flex bg-white shadow-md hover:shadow-lg transition">
                                <div class="w-36 sm:w-48 shrink-0 overflow-hidden">
                                    <img src="{{ $b->gambar }}" class="w-full h-full aspect-video object-cover group-hover:scale-105 transition duration-500" alt="{{ $b->judul }}">
                                </div>
                                <div class="p-4 flex flex-col justify-center min-w-0">
                                    <span class="text-xs text-primary font-bold uppercase">{{ $b->kategori?->nama ?? '-' }}</span>
                                    <h4 class="text-base font-bold mt-1 line-clamp-2">{{ $b->judul }}</h4>
                                    <p class="mt-2 text-sm text-gray-400"><i class="far fa-calendar-alt mr-1"></i> {{ $b->tanggal_terbit?->translatedFormat('d M Y') }}</p>
                                </div>
                            </a>
                        @empty
                            <p class="text-gray-400 text-center py-8">Belum ada berita.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Galeri Terbaru -->
                <div>
                    <div class="flex justify-between items-center mb-8">
                        <h3 class="text-2xl font-extrabold flex items-center">
                            <span class="w-8 h-1 bg-primary mr-3"></span> Galeri Terbaru
                        </h3>
                        <a href="{{ route('galeri') }}" class="text-primary text-base font-bold uppercase hover:underline">Semua <i class="fas fa-arrow-right"></i></a>
                    </div>
                    <div class="space-y-5">
                        @forelse ($galeriTerbaru as $g)
                            @php $cover = $g->media->first(); @endphp
                            <a href="{{ route('galeri.detail', $g->slug) }}" class="group flex bg-white shadow-md hover:shadow-lg transition">
                                <div class="relative w-36 sm:w-48 shrink-0 overflow-hidden bg-dark">
                                    @if ($cover)
                                        <img src="{{ asset('storage/' . $cover->file_path) }}" class="w-full h-full aspect-video object-cover group-hover:scale-105 transition duration-500" alt="{{ $g->judul }}">
                                    @else
                                        <div class="w-full h-full aspect-video flex items-center justify-center text-gray-500"><i class="fas fa-images text-2xl"></i></div>
                                    @endif
                                    <span class="absolute bottom-2 right-2 bg-dark/80 text-white text-xs font-bold px-2 py-1"><i class="fas fa-camera mr-1"></i>{{ $g->media->count() }}</span>
                                </div>
                                <div class="p-4 flex flex-col justify-center min-w-0">
                                    <span class="text-xs text-primary font-bold uppercase">{{ $g->kategori ?: 'Galeri' }}</span>
                                    <h4 class="text-base font-bold mt-1 line-clamp-2">{{ $g->judul }}</h4>
                                    <p class="mt-2 text-sm text-gray-400"><i class="far fa-calendar-alt mr-1"></i> {{ $g->created_at?->translatedFormat('d M Y') }}</p>
                                </div>
                            </a>
                        @empty
                            <p class="text-gray-400 text-center py-8">Belum ada galeri.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- <!-- Tentang Preview -->
    <section class="py-20 bg-accent">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <p class="text-primary font-bold uppercase tracking-widest text-base mb-2">Tentang Kami</p>
                    <h3 class="text-3xl font-extrabold mb-6 leading-tight">KONI Provinsi<br>Papua Pegunungan</h3>
                    <p class="text-gray-600 leading-relaxed mb-4 text-lg">Komite Olahraga Nasional Indonesia (KONI) Provinsi Papua Pegunungan merupakan organisasi yang mengoordinasikan dan membina olahraga prestasi di wilayah Papua Pegunungan.</p>
                    <p class="text-gray-600 leading-relaxed mb-8 text-lg">Berdiri sebagai wadah pemersatu seluruh cabang olahraga, KONI Papua Pegunungan berperan aktif dalam mencetak atlet-atlet berprestasi dari Tanah Papua.</p>
                    <a href="{{ route('tentang') }}" class="bg-primary text-white px-8 py-4 font-bold no-round hover:bg-red-700 transition inline-block text-base uppercase tracking-wide">Selengkapnya <i class="fas fa-arrow-right ml-2"></i></a>
                </div>
                <div class="relative">
                    <img src="{{ asset('img/bg/gubernur-papua-pegunungan.png') }}" alt="Tentang KONI" class="w-full shadow-lg">
                    <div class="absolute -bottom-6 -left-6 bg-primary text-white p-6 shadow-lg hidden lg:block">
                        <p class="text-3xl font-extrabold">2022</p>
                        <p class="text-base uppercase tracking-wide">Tahun Berdiri</p>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    {{-- Pencapaian Sejarah: PON XXI 2024 (disembunyikan dari beranda)
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <p class="text-primary font-bold uppercase tracking-widest text-base mb-2">Pencapaian Sejarah</p>
                <h3 class="text-3xl font-extrabold">PON XXI Aceh-Sumut 2024</h3>
                <p class="text-gray-500 mt-3 text-lg max-w-2xl mx-auto">Partisipasi pertama Papua Pegunungan dengan masa persiapan hanya satu tahun.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="bg-white p-8 shadow-sm border-t-4 border-primary text-center">
                    <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">Peringkat Nasional</p>
                    <p class="text-5xl font-extrabold text-primary">23</p>
                    <p class="text-gray-500 text-base mt-2">Nasional</p>
                </div>
                <div class="bg-white p-8 shadow-sm border-t-4 border-primary text-center">
                    <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">Medali Emas</p>
                    <p class="text-5xl font-extrabold text-yellow-500">6</p>
                    <p class="text-gray-500 text-base mt-2">Medali Emas</p>
                </div>
                <div class="bg-white p-8 shadow-sm border-t-4 border-primary text-center">
                    <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">Medali Perunggu</p>
                    <p class="text-5xl font-extrabold text-orange-400">3</p>
                    <p class="text-gray-500 text-base mt-2">Medali Perunggu</p>
                </div>
            </div>

            <div class="mt-10">
                <h4 class="text-xl font-extrabold uppercase tracking-wide mb-5 text-center">Cabang Olahraga Unggulan (Peraih Emas)</h4>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                    @foreach (['Terbang Layang', 'Catur', 'Biliar', 'Sepak Bola', 'Dayung'] as $cabor)
                        <div class="bg-white border border-gray-200 p-4 text-center shadow-sm">
                            <p class="font-bold text-base text-dark">{{ $cabor }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    --}}
@endsection
