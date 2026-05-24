<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RabController extends Controller
{
    public function landing()
    {
        $features = [
            [
                'title' => 'RAB Otomatis',
                'desc' => 'Hitung subtotal, PPN, biaya cadangan, dan total akhir secara cepat.',
                'icon' => '📊',
            ],
            [
                'title' => 'Invoice Proyek',
                'desc' => 'Buat invoice dari data RAB tanpa input ulang.',
                'icon' => '🧾',
            ],
            [
                'title' => 'Dashboard Modern',
                'desc' => 'Pantau estimasi biaya, progress pekerjaan, dan jadwal proyek.',
                'icon' => '⚡',
            ],
            [
                'title' => 'Siap Cetak PDF',
                'desc' => 'Gunakan fitur print browser untuk cetak atau simpan sebagai PDF.',
                'icon' => '🖨️',
            ],
        ];

        return view('pages.landing', compact('features'));
    }

    public function dashboard()
    {
        $project = [
            'name' => 'Pemasangan CCTV Kantor',
            'client' => 'Nama Klien / Instansi',
            'vendor' => 'DEPONSEL NET',
            'location' => 'Teluk Bintuni, Papua Barat',
            'document_no' => 'RAB/001/V/2026',
            'duration' => '14 hari kerja',
            'status' => 'Draft',
        ];

        $items = [
            [
                'category' => 'Persiapan',
                'name' => 'Survey lokasi',
                'spec' => 'Survey dan analisa kebutuhan',
                'qty' => 1,
                'unit' => 'Paket',
                'price' => 500000,
            ],
            [
                'category' => 'Material',
                'name' => 'Kamera CCTV',
                'spec' => 'IP Camera 2MP Outdoor',
                'qty' => 4,
                'unit' => 'Unit',
                'price' => 650000,
            ],
            [
                'category' => 'Jasa',
                'name' => 'Jasa instalasi',
                'spec' => 'Pemasangan, konfigurasi, dan testing',
                'qty' => 1,
                'unit' => 'Paket',
                'price' => 1500000,
            ],
        ];

        return view('pages.dashboard', compact('project', 'items'));
    }

    public function calculate(Request $request)
    {
        $validated = $request->validate([
            'items' => ['required', 'array'],
            'items.*.qty' => ['required', 'numeric', 'min:0'],
            'items.*.price' => ['required', 'numeric', 'min:0'],
            'tax_rate' => ['nullable', 'numeric', 'min:0'],
            'reserve_rate' => ['nullable', 'numeric', 'min:0'],
        ]);

        $subtotal = collect($validated['items'])->sum(function ($item) {
            return (float) $item['qty'] * (float) $item['price'];
        });

        $taxRate = (float) ($validated['tax_rate'] ?? 11);
        $reserveRate = (float) ($validated['reserve_rate'] ?? 5);

        $tax = $subtotal * $taxRate / 100;
        $reserve = $subtotal * $reserveRate / 100;
        $grandTotal = $subtotal + $tax + $reserve;

        return response()->json([
            'subtotal' => $subtotal,
            'tax' => $tax,
            'reserve' => $reserve,
            'grand_total' => $grandTotal,
            'formatted' => [
                'subtotal' => 'Rp ' . number_format($subtotal, 0, ',', '.'),
                'tax' => 'Rp ' . number_format($tax, 0, ',', '.'),
                'reserve' => 'Rp ' . number_format($reserve, 0, ',', '.'),
                'grand_total' => 'Rp ' . number_format($grandTotal, 0, ',', '.'),
            ],
        ]);
    }
}
