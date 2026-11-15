<footer class="relative bg-dark text-white border-t-4 border-primary pt-24 pb-8">
    {{-- Logo overlay: di tengah, menumpang di atas garis border atas footer --}}
    <a href="{{ route('beranda') }}" class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 w-32 h-32 bg-[#F4F4F4] border-4 border-primary shadow-xl flex items-center justify-center overflow-hidden p-2">
        @if (!empty($situs['logo']))
            <img src="{{ asset('storage/' . $situs['logo']) }}" class="w-full h-full object-contain" alt="Logo {{ $situs['nama_situs'] ?? 'KONI' }}">
        @else
            <img src="{{ asset('img/logo-koni-papua-pegunungan.jpeg') }}" class="w-full h-full object-contain" alt="Logo KONI">
        @endif
    </a>

    <div class="container mx-auto px-4">
        {{-- Identitas --}}
        <div class="text-center max-w-2xl mx-auto mb-12">
            <h3 class="font-extrabold text-xl uppercase tracking-wide">{{ $situs['nama_situs'] ?? 'KONI Provinsi Papua Pegunungan' }}</h3>
            <p class="text-base text-gray-400 leading-relaxed mt-3">{{ $situs['deskripsi_situs'] ?? 'Wadah pembinaan olahraga prestasi di Provinsi Papua Pegunungan.' }}</p>
        </div>

        {{-- 3 Kolom: Navigasi, Link Terkait, Hubungi Kami --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 md:gap-12 mb-12">
            <div>
                <h4 class="font-bold mb-6 uppercase text-primary tracking-wide text-lg">Navigasi</h4>
                <ul class="text-base space-y-3 text-gray-400">
                    <li><a href="{{ route('tentang') }}" class="hover:text-white transition">Tentang Kami</a></li>
                    <li><a href="{{ route('pengurusan') }}" class="hover:text-white transition">Struktur Organisasi</a></li>
                    <li><a href="{{ route('cabor') }}" class="hover:text-white transition">Cabang Olahraga</a></li>
                    <li><a href="{{ route('event') }}" class="hover:text-white transition">Event</a></li>
                    <li><a href="{{ route('berita') }}" class="hover:text-white transition">Berita</a></li>
                    <li><a href="{{ route('galeri') }}" class="hover:text-white transition">Galeri</a></li>
                    <li><a href="{{ route('kontak') }}" class="hover:text-white transition">Kontak</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-6 uppercase text-primary tracking-wide text-lg">Link Terkait</h4>
                <ul class="text-base space-y-3 text-gray-400">
                    <li><a href="https://koni.or.id" target="_blank" rel="noopener" class="hover:text-white transition">KONI Pusat</a></li>
                    <li><a href="https://kemenpora.go.id" target="_blank" rel="noopener" class="hover:text-white transition">Kemenpora RI</a></li>
                    <li><a href="#" class="hover:text-white transition">Dispora Papua Pegunungan</a></li>
                    <li><a href="#" class="hover:text-white transition">Pemerintah Provinsi</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-6 uppercase text-primary tracking-wide text-lg">Hubungi Kami</h4>
                <ul class="text-base space-y-3 text-gray-400">
                    @if (!empty($situs['alamat']))
                        <li class="flex items-start gap-3">
                            <i class="fas fa-map-marker-alt text-primary mt-1 w-4 shrink-0"></i>
                            <span>{{ $situs['alamat'] }}</span>
                        </li>
                    @endif
                    @if (!empty($situs['telepon']))
                        <li class="flex items-center gap-3">
                            <i class="fas fa-phone text-primary w-4 shrink-0"></i>
                            <span>{{ $situs['telepon'] }}</span>
                        </li>
                    @endif
                    @if (!empty($situs['email']))
                        <li class="flex items-center gap-3">
                            <i class="fas fa-envelope text-primary w-4 shrink-0"></i>
                            <a href="mailto:{{ $situs['email'] }}" class="hover:text-white transition break-all">{{ $situs['email'] }}</a>
                        </li>
                    @endif
                </ul>
                @php
                    $sosmedList = [
                        ['key' => 'sosmed_facebook', 'icon' => 'fab fa-facebook-f'],
                        ['key' => 'sosmed_instagram', 'icon' => 'fab fa-instagram'],
                        ['key' => 'sosmed_youtube', 'icon' => 'fab fa-youtube'],
                        ['key' => 'sosmed_twitter', 'icon' => 'fab fa-twitter'],
                        ['key' => 'sosmed_tiktok', 'icon' => 'fab fa-tiktok'],
                    ];
                @endphp
                <div class="flex flex-wrap gap-3 mt-6">
                    @foreach ($sosmedList as $sm)
                        @if (!empty($situs[$sm['key']]))
                            <a href="{{ $situs[$sm['key']] }}" target="_blank" rel="noopener" class="w-10 h-10 bg-gray-800 flex items-center justify-center hover:bg-primary transition text-base"><i class="{{ $sm['icon'] }}"></i></a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="border-t border-gray-800 pt-8 text-center text-sm text-gray-500 uppercase tracking-widest">
            &copy; {{ date('Y') }} {{ $situs['nama_situs'] ?? 'KONI Provinsi Papua Pegunungan' }}. All Rights Reserved.
        </div>
    </div>
</footer>
