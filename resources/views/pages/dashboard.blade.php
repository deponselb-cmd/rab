@extends('layouts.app', ['title' => 'Dashboard RAB Proyek'])

@section('content')
<div class="min-h-screen flex">
    <aside class="no-print hidden lg:flex w-72 bg-slate-950 text-white p-6 flex-col fixed inset-y-0">
        <a href="{{ route('landing') }}" class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-400 to-teal-500 grid place-items-center text-slate-950 font-black">RAB</div>
            <div>
                <div class="font-black text-lg">DEPONSEL RAB</div>
                <div class="text-xs text-slate-400">Dashboard Proyek</div>
            </div>
        </a>

        <nav class="mt-10 grid gap-2 text-sm font-semibold text-slate-300">
            <a href="#ringkasan" class="rounded-2xl px-4 py-3 hover:bg-white/10">Ringkasan</a>
            <a href="#proyek" class="rounded-2xl px-4 py-3 hover:bg-white/10">Data Proyek</a>
            <a href="#rab" class="rounded-2xl px-4 py-3 hover:bg-white/10">RAB Detail</a>
            <a href="#rekap" class="rounded-2xl px-4 py-3 hover:bg-white/10">Rekapitulasi</a>
            <a href="#invoice" class="rounded-2xl px-4 py-3 hover:bg-white/10">Invoice</a>
            <a href="{{ route('landing') }}" class="rounded-2xl px-4 py-3 bg-white/10">← Landing Page</a>
        </nav>

        <div class="mt-auto rounded-3xl bg-white/10 p-5">
            <div class="text-xs text-slate-400">Status Dokumen</div>
            <div class="font-black text-xl mt-1">{{ $project['status'] }}</div>
        </div>
    </aside>

    <main class="w-full lg:ml-72 p-5 md:p-8">
        <div class="no-print flex flex-col md:flex-row gap-4 md:items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl md:text-4xl font-black text-slate-950">Dashboard RAB Proyek</h1>
                <p class="text-slate-500 mt-1">Kelola data biaya, rekap, invoice, dan jadwal pekerjaan.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <button onclick="addRow()" class="rounded-2xl bg-primary text-white px-5 py-3 font-black shadow-lg shadow-teal-700/20">+ Tambah Item</button>
                <button onclick="calculateRab()" class="rounded-2xl bg-amber-500 text-slate-950 px-5 py-3 font-black">Hitung</button>
                <button onclick="window.print()" class="rounded-2xl bg-slate-950 text-white px-5 py-3 font-black">Cetak / PDF</button>
            </div>
        </div>

        <section id="ringkasan" class="grid md:grid-cols-2 xl:grid-cols-4 gap-5 mb-6">
            <div class="print-card rounded-[1.5rem] bg-white border border-slate-200 p-6 shadow-soft">
                <div class="text-sm font-bold text-slate-500">Subtotal</div>
                <div id="subtotalMetric" class="text-2xl font-black mt-2">Rp 0</div>
            </div>
            <div class="print-card rounded-[1.5rem] bg-white border border-slate-200 p-6 shadow-soft">
                <div class="text-sm font-bold text-slate-500">PPN</div>
                <div id="taxMetric" class="text-2xl font-black mt-2">Rp 0</div>
            </div>
            <div class="print-card rounded-[1.5rem] bg-white border border-slate-200 p-6 shadow-soft">
                <div class="text-sm font-bold text-slate-500">Cadangan</div>
                <div id="reserveMetric" class="text-2xl font-black mt-2">Rp 0</div>
            </div>
            <div class="print-card rounded-[1.5rem] bg-gradient-to-br from-teal-700 to-slate-950 text-white p-6 shadow-soft">
                <div class="text-sm font-bold text-white/70">Total Akhir</div>
                <div id="grandMetric" class="text-2xl font-black mt-2">Rp 0</div>
            </div>
        </section>

        <section id="proyek" class="print-card rounded-[1.5rem] bg-white border border-slate-200 p-6 shadow-soft mb-6">
            <h2 class="text-xl font-black mb-5">Data Proyek</h2>
            <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-4">
                <label class="grid gap-2 text-sm font-bold text-slate-500">Nama Proyek
                    <input id="projectName" class="rounded-2xl border border-slate-200 px-4 py-3 text-slate-800" value="{{ $project['name'] }}">
                </label>
                <label class="grid gap-2 text-sm font-bold text-slate-500">Klien / Instansi
                    <input class="rounded-2xl border border-slate-200 px-4 py-3 text-slate-800" value="{{ $project['client'] }}">
                </label>
                <label class="grid gap-2 text-sm font-bold text-slate-500">Penyedia
                    <input class="rounded-2xl border border-slate-200 px-4 py-3 text-slate-800" value="{{ $project['vendor'] }}">
                </label>
                <label class="grid gap-2 text-sm font-bold text-slate-500">Lokasi
                    <input class="rounded-2xl border border-slate-200 px-4 py-3 text-slate-800" value="{{ $project['location'] }}">
                </label>
                <label class="grid gap-2 text-sm font-bold text-slate-500">Nomor Dokumen
                    <input class="rounded-2xl border border-slate-200 px-4 py-3 text-slate-800" value="{{ $project['document_no'] }}">
                </label>
                <label class="grid gap-2 text-sm font-bold text-slate-500">Durasi
                    <input class="rounded-2xl border border-slate-200 px-4 py-3 text-slate-800" value="{{ $project['duration'] }}">
                </label>
            </div>
        </section>

        <section id="rab" class="print-card rounded-[1.5rem] bg-white border border-slate-200 p-6 shadow-soft mb-6">
            <h2 class="text-xl font-black mb-5">RAB Detail</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-sm" id="rabTable">
                    <thead>
                        <tr class="bg-slate-50 text-left text-slate-500">
                            <th class="p-3">No</th>
                            <th class="p-3">Kategori</th>
                            <th class="p-3">Uraian</th>
                            <th class="p-3">Spesifikasi</th>
                            <th class="p-3">Volume</th>
                            <th class="p-3">Satuan</th>
                            <th class="p-3">Harga</th>
                            <th class="p-3 text-right">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr class="border-t border-slate-100">
                                <td class="p-2 row-no">{{ $loop->iteration }}</td>
                                <td class="p-2"><input class="field category" value="{{ $item['category'] }}"></td>
                                <td class="p-2"><input class="field name" value="{{ $item['name'] }}"></td>
                                <td class="p-2"><input class="field spec" value="{{ $item['spec'] }}"></td>
                                <td class="p-2"><input type="number" class="field qty" value="{{ $item['qty'] }}"></td>
                                <td class="p-2"><input class="field unit" value="{{ $item['unit'] }}"></td>
                                <td class="p-2"><input type="number" class="field price" value="{{ $item['price'] }}"></td>
                                <td class="p-2 amount text-right font-bold">Rp 0</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <p class="mt-4 text-sm text-slate-500">Data dihitung melalui endpoint Laravel <b>POST /dashboard/rab/calculate</b> memakai CSRF token.</p>
        </section>

        <section id="rekap" class="print-card rounded-[1.5rem] bg-white border border-slate-200 p-6 shadow-soft mb-6">
            <h2 class="text-xl font-black mb-5">Rekapitulasi</h2>
            <div class="grid md:grid-cols-2 gap-4 mb-5">
                <label class="grid gap-2 text-sm font-bold text-slate-500">PPN / Pajak (%)
                    <input id="taxRate" type="number" class="rounded-2xl border border-slate-200 px-4 py-3 text-slate-800" value="11">
                </label>
                <label class="grid gap-2 text-sm font-bold text-slate-500">Biaya Cadangan (%)
                    <input id="reserveRate" type="number" class="rounded-2xl border border-slate-200 px-4 py-3 text-slate-800" value="5">
                </label>
            </div>
            <div class="rounded-3xl bg-slate-50 border border-slate-200 overflow-hidden">
                <div class="flex justify-between p-4 border-b border-slate-200"><span>Subtotal</span><b id="subtotalCell">Rp 0</b></div>
                <div class="flex justify-between p-4 border-b border-slate-200"><span>PPN</span><b id="taxCell">Rp 0</b></div>
                <div class="flex justify-between p-4 border-b border-slate-200"><span>Cadangan</span><b id="reserveCell">Rp 0</b></div>
                <div class="flex justify-between p-4 bg-slate-950 text-white"><span>Total Akhir</span><b id="grandCell">Rp 0</b></div>
            </div>
        </section>

        <section id="invoice" class="print-card rounded-[1.5rem] bg-white border border-slate-200 p-6 shadow-soft mb-6">
            <div class="flex flex-col md:flex-row md:items-start justify-between gap-5 border-b border-slate-200 pb-5 mb-5">
                <div>
                    <h2 class="text-3xl font-black text-primary">INVOICE</h2>
                    <p class="text-slate-500">INV/001/V/2026</p>
                </div>
                <div class="md:text-right">
                    <b>DEPONSEL NET</b>
                    <p class="text-slate-500">Layanan Internet • CCTV • Komputer</p>
                    <p class="text-slate-500">Teluk Bintuni, Papua Barat</p>
                </div>
            </div>
            <div class="grid md:grid-cols-2 gap-5">
                <div class="rounded-3xl bg-slate-50 p-5 border border-slate-200">
                    <div class="text-sm text-slate-500">Ditagihkan kepada</div>
                    <div class="font-black mt-1">{{ $project['client'] }}</div>
                </div>
                <div class="rounded-3xl bg-teal-50 p-5 border border-teal-100">
                    <div class="text-sm text-primary">Total tagihan</div>
                    <div id="invoiceTotal" class="font-black text-3xl mt-1">Rp 0</div>
                </div>
            </div>
        </section>
    </main>
</div>

<style>
    .field {
        width: 100%;
        min-width: 110px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 9px 10px;
        outline: none;
    }
    .field:focus {
        border-color: #0f766e;
        box-shadow: 0 0 0 3px rgba(15,118,110,.12);
    }
</style>

<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    function localRupiah(number) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(number || 0);
    }

    function collectItems() {
        return Array.from(document.querySelectorAll('#rabTable tbody tr')).map((row, index) => {
            row.querySelector('.row-no').textContent = index + 1;
            return {
                category: row.querySelector('.category').value,
                name: row.querySelector('.name').value,
                spec: row.querySelector('.spec').value,
                qty: parseFloat(row.querySelector('.qty').value || 0),
                unit: row.querySelector('.unit').value,
                price: parseFloat(row.querySelector('.price').value || 0),
            };
        });
    }

    async function calculateRab() {
        const items = collectItems();

        items.forEach((item, index) => {
            const amount = item.qty * item.price;
            document.querySelectorAll('.amount')[index].textContent = localRupiah(amount);
        });

        const response = await fetch("{{ route('rab.calculate') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                items: items,
                tax_rate: parseFloat(document.getElementById('taxRate').value || 0),
                reserve_rate: parseFloat(document.getElementById('reserveRate').value || 0),
            })
        });

        if (!response.ok) {
            alert('Gagal menghitung RAB. Periksa input volume dan harga.');
            return;
        }

        const result = await response.json();

        document.getElementById('subtotalMetric').textContent = result.formatted.subtotal;
        document.getElementById('taxMetric').textContent = result.formatted.tax;
        document.getElementById('reserveMetric').textContent = result.formatted.reserve;
        document.getElementById('grandMetric').textContent = result.formatted.grand_total;

        document.getElementById('subtotalCell').textContent = result.formatted.subtotal;
        document.getElementById('taxCell').textContent = result.formatted.tax;
        document.getElementById('reserveCell').textContent = result.formatted.reserve;
        document.getElementById('grandCell').textContent = result.formatted.grand_total;
        document.getElementById('invoiceTotal').textContent = result.formatted.grand_total;
    }

    function addRow() {
        const tbody = document.querySelector('#rabTable tbody');
        const tr = document.createElement('tr');
        tr.className = 'border-t border-slate-100';
        tr.innerHTML = `
            <td class="p-2 row-no"></td>
            <td class="p-2"><input class="field category" value="Material"></td>
            <td class="p-2"><input class="field name" value="Item baru"></td>
            <td class="p-2"><input class="field spec" value="Spesifikasi"></td>
            <td class="p-2"><input type="number" class="field qty" value="1"></td>
            <td class="p-2"><input class="field unit" value="Unit"></td>
            <td class="p-2"><input type="number" class="field price" value="0"></td>
            <td class="p-2 amount text-right font-bold">Rp 0</td>
        `;
        tbody.appendChild(tr);
        tr.querySelectorAll('input').forEach(input => input.addEventListener('input', calculateRab));
        calculateRab();
    }

    document.querySelectorAll('input').forEach(input => input.addEventListener('input', calculateRab));
    calculateRab();
</script>
@endsection
