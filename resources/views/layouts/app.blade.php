<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'RAB Proyek - DEPONSEL NET' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0f766e',
                        dark: '#0f172a',
                        gold: '#f59e0b',
                    },
                    boxShadow: {
                        soft: '0 20px 60px rgba(15,23,42,.10)'
                    }
                }
            }
        }
    </script>
    <style>
        @media print {
            .no-print { display: none !important; }
            .print-card { box-shadow: none !important; border: 1px solid #e5e7eb !important; }
            body { background: white !important; }
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800">
    @yield('content')
</body>
</html>
