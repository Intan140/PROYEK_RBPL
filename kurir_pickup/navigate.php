<?php
include '../koneksi.php';

$resi = isset($_GET['resi']) ? mysqli_real_escape_string($koneksi, $_GET['resi']) : '';

if (empty($resi)) {
    echo "<script>alert('Resi tidak valid!'); window.location.href='listpengantaran.php';</script>";
    exit;
}

$query = mysqli_query($koneksi, "
    SELECT pesanan.*, pelanggan.nama AS nama_pengirim 
    FROM pesanan 
    JOIN pelanggan ON pesanan.id_pengirim = pelanggan.id_pelanggan 
    WHERE pesanan.resi = '$resi'
");

$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>alert('Data pesanan tidak ditemukan!'); window.location.href='listpengantaran.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Navigate Pickup - Logistik Kurir</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --shopee-orange: #F66341;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            -webkit-tap-highlight-color: transparent;
        }

        .font-jakarta {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .font-status {
            font-family: -apple-system, BlinkMacSystemFont, sans-serif;
        }

        .shopee-bg {
            background-color: var(--shopee-orange);
        }

        .shopee-text {
            color: var(--shopee-orange);
        }

        .glass-card {
            background: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.04), 0 8px 10px -6px rgba(0, 0, 0, 0.04);
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body class="flex justify-center items-start min-h-screen">

    <div class="w-full max-w-[400px] bg-[#fdfdfd] min-h-screen relative shadow-2xl overflow-hidden flex flex-col no-scrollbar border-x border-gray-100">
        <div class="shopee-bg w-full h-[120px] absolute top-0 left-0 z-0"></div>

        <div class="relative z-10 w-full h-[40px] px-6 flex justify-between items-center mt-1">
            <span class="font-status text-white text-[15px] font-bold">9:41</span>
            <div class="flex items-center gap-2">
                <svg width="17" height="11" viewBox="0 0 17 11" fill="none">
                    <path d="M1 5C3.5 2 7.5 2 10 5M1 8C2.5 6.5 4.5 6.5 6 8" stroke="white" stroke-width="2" stroke-linecap="round" />
                </svg>
                <div class="w-6 h-3 border-2 border-white/40 rounded-[3px] relative">
                    <div class="absolute inset-[1px] bg-white w-[70%] rounded-[1px]"></div>
                </div>
            </div>
        </div>

        <div class="relative z-10 px-6 mt-4 flex items-center gap-4">
            <button onclick="window.history.back()" class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-white/10 active:scale-90 transition-transform -ml-1">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 18l-6-6 6-6" />
                </svg>
            </button>
            <h1 class="text-white text-[22px] font-bold font-jakarta tracking-tight">
                Navigasi
            </h1>
        </div>

        <div class="relative z-10 px-6 mt-6">
            <div class="glass-card rounded-[24px] p-5 flex items-center gap-4">
                <div class="relative shrink-0">
                    <div class="w-[72px] h-[72px] rounded-2xl overflow-hidden ring-4 ring-gray-50 bg-orange-50 flex items-center justify-center shadow-inner">
                        <span class="text-3xl">🏪</span>
                    </div>
                    <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 border-2 border-white rounded-full"></div>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex flex-col">
                        <h2 class="text-[18px] font-bold text-gray-900 font-jakarta leading-none tracking-tight truncate"><?= htmlspecialchars($data['nama_pengirim']) ?></h2>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="px-2 py-0.5 bg-orange-50 text-orange-600 text-[10px] font-bold rounded-md font-jakarta tracking-widest uppercase">PICKUP</span>
                            <span class="text-[11px] font-semibold text-gray-400 font-jakarta tracking-tight"><?= htmlspecialchars($data['resi']) ?></span>
                        </div>
                        <div class="flex items-start gap-1.5 mt-2">
                            <svg class="w-4 h-4 text-[#F66341] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-[12px] text-gray-500 font-medium font-jakarta leading-snug"><?= htmlspecialchars($data['alamat']) ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative z-10 px-6 mt-5">
            <div class="glass-card rounded-[24px] overflow-hidden relative border border-gray-100 h-[220px]">
                <img src="https://placehold.co/400x300/e2e8f0/64748b?text=Live+Map+Navigation" class="w-full h-full object-cover" alt="Peta" />

                <div class="absolute top-4 right-4 w-10 h-10 bg-white shadow-xl flex items-center justify-center rounded-xl active:scale-95 transition-transform">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#F66341" stroke-width="2.5">
                        <circle cx="12" cy="12" r="3"></circle>
                        <path d="M12 2v3m0 14v3m10-10h-3M5 12H2"></path>
                    </svg>
                </div>

                <div class="absolute bottom-0 right-0 px-5 py-3 shopee-bg flex flex-col items-center justify-center shadow-[-5px_-5px_20px_rgba(246,99,65,0.2)] rounded-tl-[24px]">
                    <span class="text-white text-[24px] font-bold font-jakarta leading-none">15</span>
                    <span class="text-white text-[10px] font-bold uppercase tracking-[0.1em] mt-1">Menit</span>
                </div>
            </div>
        </div>

        <div class="relative z-10 px-6 mt-8 mb-4 flex justify-between items-end">
            <h2 class="text-gray-900 text-[18px] font-bold font-jakarta tracking-tight">Status Penjemputan</h2>
            <span class="text-[#F66341] bg-orange-50 px-2 py-1 rounded-md text-[9px] font-bold uppercase tracking-widest flex items-center gap-1">
                <span class="w-1.5 h-1.5 bg-[#F66341] rounded-full animate-pulse"></span> LIVE
            </span>
        </div>

        <div class="relative z-10 px-6 flex-1 overflow-y-auto no-scrollbar pb-32">
            <div class="absolute left-[42px] top-4 bottom-10 w-0.5 bg-gray-100 z-0"></div>

            <div class="flex items-start gap-4 mb-8 relative">
                <div class="w-9 h-9 bg-green-500 flex items-center justify-center shrink-0 rounded-full shadow-md z-10">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 6L9 17l-5-5" />
                    </svg>
                </div>
                <div class="flex-1 pt-1.5">
                    <p class="text-gray-900 text-[15px] font-bold font-jakarta leading-none">Menuju Lokasi Pengirim</p>
                    <p class="text-gray-400 text-[12px] mt-1.5 font-medium">Kurir sedang dalam perjalanan ke lokasi toko.</p>
                </div>
            </div>

            <div class="flex items-start gap-4 mb-8 relative">
                <div class="w-9 h-9 shopee-bg flex items-center justify-center shrink-0 rounded-full shadow-lg shadow-orange-200 z-10 ring-4 ring-white">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </div>
                <div class="flex-1 pt-1.5">
                    <p class="shopee-text text-[15px] font-bold font-jakarta leading-none">Proses Penjemputan</p>
                    <p class="text-gray-600 text-[12px] mt-1.5 font-medium leading-relaxed">Tiba di lokasi dan memindai paket penjual.</p>
                </div>
            </div>

            <div class="flex items-start gap-4 relative">
                <div class="w-9 h-9 bg-white border-2 border-gray-200 flex items-center justify-center shrink-0 rounded-full z-10">
                    <span class="w-2.5 h-2.5 bg-gray-200 rounded-full"></span>
                </div>
                <div class="flex-1 pt-1.5 opacity-40">
                    <p class="text-gray-900 text-[15px] font-bold font-jakarta leading-none">Dibawa ke Hub (Sortation)</p>
                    <p class="text-gray-500 text-[12px] mt-1.5 font-medium">Paket berhasil di-pickup dan diantar ke operator Hub.</p>
                </div>
            </div>
        </div>

        <div class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-[400px] bg-white p-5 border-t border-gray-100 z-50">
            <button onclick="window.location.href='scan.php'" class="w-full h-[54px] shopee-bg text-white rounded-2xl font-bold font-jakarta text-[15px] shadow-lg shadow-orange-200 active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 7V5a2 2 0 012-2h2M17 3h2a2 2 0 012 2v2M21 17v2a2 2 0 01-2 2h-2M7 21H5a2 2 0 01-2-2v-2" />
                    <rect x="7" y="7" width="10" height="10" rx="1" />
                </svg>
                Selesaikan Penjemputan
            </button>
        </div>

    </div>

</body>

</html>
