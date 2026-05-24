@extends('layouts.app', ['title' => 'Landing Page RAB Proyek'])

@section('content')
<nav class="no-print fixed top-0 inset-x-0 z-50 bg-white/80 backdrop-blur-xl border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-5 py-4 flex items-center justify-between">
        <a href="{{ route('landing') }}" class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-amber-400 to-teal-600 grid place-items-center text-slate-950 font-black">RAB</div>
            <div>
                <div class="font-black text-lg leading-tight">DEPONSEL RAB</div>
                <div class="text-xs text-slate-500">Project Cost System</div>
            </div>
        </a>
        <div class="hidden md:flex items-center gap-7 text-sm font-semibold text-slate-600">
            <a href="#fitur" class="hover:text-primary">Fitur</a>
            <a href="#alur" class="hover:text-primary">Alur</a>
            <a href="#paket" class="hover:text-primary">Paket</a>
        </div>
        <a href="{{ route('dashboard') }}" class="rounded-2xl bg-primary text-white px-5 py-3 font-bold shadow-lg shadow-teal-700/20">Buka Dashboard</a>
    </div>
</nav>

<header class="relative overflow-hidden pt-32 pb-20">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(20,184,166,.22),_transparent_35%),radial-gradient(circle_at_bottom_right,_rgba(245,158,11,.22),_transparent_35%)]"></div>
    <div class="relative max-w-7xl mx-auto px-5 grid lg:grid-cols-2 gap-12 items-center">
        <div>
            <div class="inline-flex items-center gap-2 rounded-full bg-teal-50 border border-teal-100 px-4 py-2 text-primary font-bold text-sm">
                Sistem RAB, Invoice, dan Monitoring Proyek
            </div>
            <h1 class="mt-6 text-4xl md:text-6xl font-black tracking-tight text-slate-950">
                Buat RAB proyek lebih cepat, rapi, dan profesional.
            </h1>
            <p class="mt-6 text-lg text-slate-600 max-w-xl">
                Landing page dan dashboard Laravel untuk menghitung anggaran biaya, menampilkan invoice, rekap pekerjaan, dan jadwal pelaksanaan dalam satu sistem.
            </p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route('dashboard') }}" class="rounded-2xl bg-primary text-white px-6 py-4 font-black shadow-xl shadow-teal-700/20">Mulai Buat RAB</a>
                <a href="#fitur" class="rounded-2xl bg-white border border-slate-200 px-6 py-4 font-black shadow-soft">Lihat Fitur</a>
            </div>
        </div>

        <div class="bg-white rounded-[2rem] p-5 shadow-soft border border-slate-200">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <div class="text-sm text-slate-500">Estimasi Proyek</div>
                    <div class="text-2xl font-black">Pemasangan CCTV</div>
                </div>
                <span class="rounded-full bg-emerald-50 text-emerald-700 px-3 py-1 text-sm font-bold">Draft</span>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="rounded-3xl bg-slate-50 p-5">
                    <div class="text-sm text-slate-500">Subtotal</div>
                    <div class="text-2xl font-black mt-2">Rp 4,6 Jt</div>
                </div>
                <div class="rounded-3xl bg-amber-50 p-5">
                    <div class="text-sm text-amber-700">PPN</div>
                    <div class="text-2xl font-black mt-2">Rp 506 Rb</div>
                </div>
                <div class="rounded-3xl bg-teal-50 p-5 col-span-2">
                    <div class="text-sm text-primary">Total Akhir</div>
                    <div class="text-4xl font-black mt-2">Rp 5,33 Jt</div>
                </div>
            </div>
            <div class="mt-5 rounded-3xl bg-slate-950 text-white p-5">
                <div class="text-sm text-slate-300">Progress</div>
                <div class="mt-3 h-3 bg-white/10 rounded-full overflow-hidden">
                    <div class="h-full w-[68%] bg-gradient-to-r from-amber-400 to-teal-400 rounded-full"></div>
                </div>
                <div class="mt-3 text-sm text-slate-300">68% dokumen RAB siap diajukan</div>
            </div>
        </div>
    </div>
</header>

<section id="fitur" class="py-16">
    <div class="max-w-7xl mx-auto px-5">
        <div class="max-w-2xl">
            <h2 class="text-3xl md:text-4xl font-black text-slate-950">Fitur Utama</h2>
            <p class="mt-3 text-slate-600">Dirancang untuk toko komputer, CCTV, internet, kontraktor, dan jasa proyek umum.</p>
        </div>
        <div class="mt-9 grid md:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach ($features as $feature)
                <div class="rounded-[1.5rem] bg-white border border-slate-200 p-6 shadow-soft">
                    <div class="text-4xl">{{ $feature['icon'] }}</div>
                    <h3 class="mt-5 font-black text-xl">{{ $feature['title'] }}</h3>
                    <p class="mt-2 text-slate-600">{{ $feature['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section id="alur" class="py-16 bg-white border-y border-slate-200">
    <div class="max-w-7xl mx-auto px-5 grid lg:grid-cols-3 gap-5">
        <div class="lg:col-span-1">
            <h2 class="text-3xl font-black text-slate-950">Alur kerja</h2>
            <p class="mt-3 text-slate-600">Dari input data proyek sampai cetak dokumen PDF.</p>
        </div>
        <div class="lg:col-span-2 grid md:grid-cols-3 gap-5">
            <div class="rounded-3xl bg-slate-50 p-6 border border-slate-200"><b>01</b><h3 class="font-black mt-3">Input Data</h3><p class="text-slate-600 mt-2">Masukkan proyek, klien, lokasi, dan durasi.</p></div>
            <div class="rounded-3xl bg-slate-50 p-6 border border-slate-200"><b>02</b><h3 class="font-black mt-3">Isi RAB</h3><p class="text-slate-600 mt-2">Tambahkan material, jasa, volume, dan harga.</p></div>
            <div class="rounded-3xl bg-slate-50 p-6 border border-slate-200"><b>03</b><h3 class="font-black mt-3">Cetak</h3><p class="text-slate-600 mt-2">Cetak RAB atau simpan menjadi PDF.</p></div>
        </div>
    </div>
</section>

<section id="paket" class="py-16">
    <div class="max-w-7xl mx-auto px-5">
        <div class="rounded-[2rem] bg-slate-950 text-white p-8 md:p-12 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div>
                <h2 class="text-3xl font-black">Siap integrasi ke Laravel Anda?</h2>
                <p class="mt-3 text-slate-300">Template ini sudah memakai route, controller, Blade, CSRF, dan endpoint hitung RAB.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="rounded-2xl bg-white text-slate-950 px-6 py-4 font-black">Buka Dashboard</a>
        </div>
    </div>
</section>
@endsection
