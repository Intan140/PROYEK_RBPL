<?php
include '../koneksi.php';

$id_pengirim = 1;

$query = mysqli_query($koneksi, "
    SELECT pesanan.*, pelanggan.nama AS nama_penerima 
    FROM pesanan 
    JOIN pelanggan ON pesanan.id_penerima = pelanggan.id_pelanggan 
    WHERE pesanan.id_pengirim = '$id_pengirim'
    ORDER BY pesanan.id_pesanan DESC
");

$jumlah_pesanan = mysqli_num_rows($query);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Toko Saya - Daftar Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            -webkit-tap-highlight-color: transparent;
        }

        .shopee-bg {
            background-color: #ee4d2d;
        }

        .shopee-text {
            color: #ee4d2d;
        }

        .status-card {
            box-shadow: 0 1px 6px rgba(0, 0, 0, 0.08);
        }

        .nav-shadow {
            box-shadow: 0px -2px 10px rgba(0, 0, 0, 0.05);
        }

        .poppins {
            font-family: 'Poppins', sans-serif;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body class="flex justify-center items-start min-h-screen">

    <div class="w-full max-w-[400px] bg-[#f5f5f5] min-h-screen relative shadow-2xl overflow-hidden flex flex-col">

        <div class="shopee-bg text-white px-5 pt-2 flex justify-between items-center text-[12px] font-medium shrink-0">
            <span class="font-semibold">9:41</span>
            <div class="flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 2a1 1 0 011-1h2a1 1 0 011 1v14a1 1 0 01-1 1h-2a1 1 0 01-1-1V2z" />
                </svg>
                <div class="w-5 h-2.5 border border-white/60 rounded-sm relative">
                    <div class="absolute inset-0.5 bg-white w-3/4 rounded-px"></div>
                </div>
            </div>
        </div>

        <div class="shopee-bg text-white px-4 pt-4 pb-4 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-3">
                <a href="dashboard.php" class="active:scale-90 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <h1 class="text-lg font-medium poppins">Toko Saya</h1>
            </div>
            <div class="flex gap-4 items-center">
                <a href="formdetailproduk.php" class="bg-white/20 px-2 py-1 rounded text-sm font-bold flex items-center gap-1 active:bg-white/30">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Buat
                </a>
            </div>
        </div>

        <div class="bg-white flex justify-around text-[13px] border-b border-gray-100 shrink-0">
            <div class="py-3 shopee-text border-b-2 border-[#ee4d2d] font-medium">Semua (<?= $jumlah_pesanan ?>)</div>
            <div class="py-3 text-gray-500">Perlu Dikirim</div>
            <div class="py-3 text-gray-500">Selesai</div>
        </div>

        <div class="p-3 space-y-3 flex-1 overflow-y-auto pb-24 no-scrollbar">

            <?php if ($jumlah_pesanan > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($query)):
                    $status = $row['status'];
                    $color_class = "text-[#ee4d2d]";

                    if ($status == 'Selesai') {
                        $color_class = "text-green-600";
                    } elseif ($status == 'Picked Up' || $status == 'Out for Delivery') {
                        $color_class = "text-blue-500";
                    }
                ?>

                    <div class="bg-white rounded-sm p-4 status-card">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex items-center gap-2">
                                <div class="w-5 h-5 bg-orange-100 rounded-full flex items-center justify-center shrink-0">
                                    <svg class="w-3 h-3 shopee-text" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 11H9v-2h2v2zm0-4H9V5h2v4z" />
                                    </svg>
                                </div>
                                <span class="text-[14px] font-bold text-gray-800 truncate"><?= htmlspecialchars($row['nama_penerima']) ?></span>
                            </div>
                            <span class="text-[11px] font-bold <?= $color_class ?> shrink-0 ml-2"><?= htmlspecialchars($status) ?></span>
                        </div>

                        <div class="flex gap-3 border-t border-gray-50 pt-3">
                            <div class="w-16 h-16 bg-gray-50 border border-gray-100 rounded flex-shrink-0 flex items-center justify-center text-2xl">
                                📦
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-[14px] text-gray-800 font-medium truncate"><?= htmlspecialchars($row['nama_produk']) ?></h3>
                                <p class="text-[11px] text-gray-400 font-bold mt-1 tracking-wider uppercase"><?= htmlspecialchars($row['resi']) ?></p>
                                <p class="text-[12px] text-gray-500 mt-1 leading-tight line-clamp-2"><?= htmlspecialchars($row['alamat']) ?></p>
                            </div>
                        </div>

                        <div class="mt-4 flex justify-end gap-2 border-t border-gray-50 pt-3">
                            <span class="text-[11px] text-gray-400 font-medium mr-auto mt-2">Qty: <?= htmlspecialchars($row['jumlah']) ?></span>

                            <?php if ($status == 'Menunggu Pickup'): ?>
                                <a href="edit_pesanan.php?id=<?= $row['id_pesanan'] ?>" class="border border-orange-500 text-[#ee4d2d] px-4 py-1.5 rounded-sm text-[13px] font-bold active:bg-orange-50 transition-colors">
                                    Ubah
                                </a>
                            <?php endif; ?>

                            <a href="formdetailproduk.php?id=<?= $row['id_pesanan'] ?>" class="border border-gray-300 text-gray-600 px-4 py-1.5 rounded-sm text-[13px] font-medium active:bg-gray-50">
                                Detail
                            </a>
                            <button class="shopee-bg text-white px-4 py-1.5 rounded-sm text-[13px] font-medium active:opacity-80 shadow-sm">
                                Lacak
                            </button>
                        </div>
                    </div>

                <?php endwhile; ?>
            <?php else: ?>
                <div class="text-center py-16">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-4xl opacity-50">📝</span>
                    </div>
                    <p class="text-gray-800 font-bold text-[15px]">Belum Ada Pesanan</p>
                    <p class="text-gray-500 text-[13px] mt-1">Pesanan yang Anda buat akan muncul di sini.</p>
                    <a href="formdetailproduk.php" class="inline-block mt-4 shopee-bg text-white px-6 py-2 rounded-sm font-bold text-[13px]">Buat Pesanan Baru</a>
                </div>
            <?php endif; ?>

        </div>

        <div class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-[400px] bg-white border-t border-gray-100 h-[60px] flex justify-around items-center px-2 z-[100] nav-shadow">
            <div class="flex flex-col items-center gap-1 text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-[10px] font-medium">Beranda</span>
            </div>
            <div class="flex flex-col items-center gap-1 shopee-text">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                </svg>
                <span class="text-[10px] font-medium">Toko Saya</span>
            </div>
            <div class="flex flex-col items-center gap-1 text-gray-400 relative">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <span class="text-[10px] font-medium">Notifikasi</span>
            </div>
            <div class="flex flex-col items-center gap-1 text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="text-[10px] font-medium">Saya</span>
            </div>
        </div>

    </div>

</body>

</html>
