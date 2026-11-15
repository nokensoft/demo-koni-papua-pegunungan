@extends('layouts.visitor')
@section('title', 'Kontak - ' . ($situs['nama_situs'] ?? 'KONI Papua Pegunungan'))
@section('seo-title', 'Hubungi Kami - ' . ($situs['nama_situs'] ?? 'KONI Papua Pegunungan'))
@section('seo-description', 'Informasi kontak dan alamat ' . ($situs['nama_situs'] ?? 'KONI Papua Pegunungan'))

@section('content')
    @include('partials.page-banner', ['title' => 'Hubungi Kami', 'breadcrumb' => 'Kontak'])

    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ([
                    ['icon' => 'fa-map-marker-alt', 'title' => 'Alamat', 'lines' => [$situs['alamat'] ?? 'Belum diatur']],
                    ['icon' => 'fa-phone', 'title' => 'Telepon', 'lines' => [$situs['telepon'] ?? 'Belum diatur']],
                    ['icon' => 'fa-envelope', 'title' => 'Email', 'lines' => [$situs['email'] ?? 'Belum diatur']],
                    ['icon' => 'fa-clock', 'title' => 'Jam Operasional', 'lines' => ['Senin - Jumat', '08:00 - 16:00 WIT']],
                ] as $card)
                    <div class="bg-gray-50 p-8 text-center border-t-4 border-primary hover:shadow-lg transition">
                        <div class="w-14 h-14 bg-primary text-white flex items-center justify-center mx-auto mb-4">
                            <i class="fas {{ $card['icon'] }} text-xl"></i>
                        </div>
                        <h4 class="font-bold uppercase text-base mb-2">{{ $card['title'] }}</h4>
                        @foreach ($card['lines'] as $line)
                            <p class="text-gray-500 text-base">{{ $line }}</p>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-20 bg-accent">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                @php
                    $sosmedLinks = collect([
                        ['key' => 'sosmed_facebook', 'icon' => 'fa-facebook-f', 'label' => 'Facebook', 'color' => 'bg-blue-600 hover:bg-blue-700'],
                        ['key' => 'sosmed_instagram', 'icon' => 'fa-instagram', 'label' => 'Instagram', 'color' => 'bg-pink-500 hover:bg-pink-600'],
                        ['key' => 'sosmed_youtube', 'icon' => 'fa-youtube', 'label' => 'YouTube', 'color' => 'bg-red-600 hover:bg-red-700'],
                        // X (Twitter) dan TikTok disembunyikan dari halaman kontak
                    ])->filter(fn ($item) => !empty($situs[$item['key']]));
                @endphp

                @if ($sosmedLinks->isNotEmpty())
                    <div>
                        <p class="text-primary font-bold uppercase tracking-widest text-base mb-2">Sosial</p>
                        <h3 class="text-3xl font-extrabold mb-8">Media Sosial</h3>
                        <div class="space-y-4">
                            @foreach ($sosmedLinks as $sosmed)
                                <a href="{{ $situs[$sosmed['key']] }}" target="_blank" rel="noopener noreferrer"
                                   class="flex items-center space-x-4 p-4 bg-white shadow-sm hover:shadow-md transition group">
                                    <div class="w-12 h-12 {{ $sosmed['color'] }} text-white flex items-center justify-center transition">
                                        <i class="fab {{ $sosmed['icon'] }} text-xl"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-bold text-base">{{ $sosmed['label'] }}</p>
                                        <p class="text-sm text-gray-400 truncate">{{ $situs[$sosmed['key']] }}</p>
                                    </div>
                                    <i class="fas fa-external-link-alt text-gray-300 group-hover:text-primary transition"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
                @php
                    // Peta: lokasi Kantor KONI Provinsi Papua Pegunungan (alamat dari Pengaturan Situs).
                    $alamatKantor = ($situs['alamat'] ?? null) ?: 'Wamena, Jayawijaya, Papua Pegunungan';
                    $petaEmbed = 'https://maps.google.com/maps?q=' . rawurlencode($alamatKantor) . '&z=15&hl=id&output=embed';
                    $petaLink = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode($alamatKantor);
                @endphp
                <div class="{{ $sosmedLinks->isEmpty() ? 'lg:col-span-2' : '' }}">
                    <p class="text-primary font-bold uppercase tracking-widest text-base mb-2">Lokasi</p>
                    <h3 class="text-3xl font-extrabold mb-8">Kantor KONI Provinsi</h3>
                    <div class="bg-white shadow-sm">
                        <iframe src="{{ $petaEmbed }}" class="w-full h-[380px] block border-0" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                                title="Peta lokasi Kantor KONI Provinsi Papua Pegunungan" allowfullscreen></iframe>
                    </div>
                    <div class="flex flex-wrap justify-between items-center gap-2 mt-3 text-sm">
                        <span class="text-gray-500"><i class="fas fa-map-marker-alt text-primary mr-1"></i> {{ $alamatKantor }}</span>
                        <a href="{{ $petaLink }}" target="_blank" rel="noopener" class="text-primary font-bold hover:underline">Buka di Google Maps <i class="fas fa-external-link-alt ml-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
