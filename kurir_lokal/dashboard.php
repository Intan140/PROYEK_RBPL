<?php
include '../sim_logistik/koneksi.php';

$query = "SELECT * FROM pesanan WHERE status = 'Out for Delivery' ORDER BY alamat ASC";
$result = mysqli_query($koneksi, $query);
$total_tugas = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Tugas Kurir - Last Mile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            overflow: hidden;
            -webkit-tap-highlight-color: transparent;
        }

        .shopee-bg {
            background-color: #F66341;
        }

        .sf-pro {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        .glass-card {
            background: white;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.04);
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.04);
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body class="flex justify-center items-start min-h-screen">
    <div class="w-full max-w-[400px] bg-[#f8fafc] h-screen relative shadow-2xl overflow-hidden flex flex-col border-x border-gray-100">

        <div class="shopee-bg w-full shrink-0 relative z-10 text-white shadow-md">

            <div class="w-full h-[40px] px-6 flex justify-between items-center">
                <span class="sf-pro font-semibold text-[15px]">9:41</span>
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="white" viewBox="0 0 20 20">
                        <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 2a1 1 0 011-1h2a1 1 0 011 1v14a1 1 0 01-1 1h-2a1 1 0 01-1-1V2z" />
                    </svg>
                    <div class="w-6 h-3 border border-white/60 rounded-sm relative">
                        <div class="absolute inset-0.5 bg-white w-3/4 rounded-px"></div>
                    </div>
                </div>
            </div>

            <div class="px-6 py-5 flex items-center justify-between">
                <div class="flex items-center gap-3">

                    <a href="obkurir.php" class="bg-white/20 hover:bg-white/30 p-1.5 rounded-full backdrop-blur-md transition-all border border-white/10 group">
                        <svg class="w-5 h-5 text-white group-active:scale-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                    <div>
                        <p class="text-white/90 text-[11px] font-bold uppercase tracking-widest mb-0.5">Kurir Last Mile</p>
                        <h1 class="text-[20px] font-bold tracking-tight">Daftar Antaran</h1>
                    </div>
                </div>
                <div class="w-10 h-10 bg-white text-[#F66341] rounded-full flex items-center justify-center font-bold text-lg shadow-sm">
                    <?= $total_tugas ?>
                </div>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto no-scrollbar px-6 pt-5 pb-24">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-gray-900 text-[16px] font-bold">Rute Hari Ini</h2>
                <span class="text-[12px] text-gray-400 font-medium">Prioritas Alamat</span>
            </div>

            <div class="space-y-4">
                <?php
                if ($total_tugas > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="glass-card p-4 relative overflow-hidden">
                            <div class="absolute top-0 right-0 bg-blue-50 text-blue-600 px-3 py-1 rounded-bl-lg text-[10px] font-bold uppercase">Sedang Dikirim</div>

                            <p class="text-gray-400 text-[10px] font-bold uppercase tracking-wider mb-0.5 mt-2">Nomor Resi</p>
                            <h3 class="text-gray-900 font-bold text-[15px] mb-2"><?= htmlspecialchars($row['resi']) ?></h3>

                            <div class="flex items-start gap-2 mb-4 bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <svg class="w-4 h-4 text-[#F66341] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <p class="text-gray-700 text-[13px] font-medium leading-snug"><?= htmlspecialchars($row['alamat']) ?></p>
                            </div>

                            <a href="konfirmasi.php?id=<?= $row['id_pesanan'] ?>" class="w-full bg-[#F66341] text-white h-[42px] rounded-xl flex items-center justify-center font-bold text-[13px] active:scale-95 transition-all shadow-md shadow-orange-200">
                                SELESAIKAN PENGIRIMAN
                            </a>
                        </div>
                <?php
                    }
                } else {
                    echo "<div class='text-center py-10'><span class='text-4xl'>🎉</span><p class='text-gray-500 font-medium text-sm mt-3'>Hebat! Semua paket hari ini sudah terkirim.</p></div>";
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>