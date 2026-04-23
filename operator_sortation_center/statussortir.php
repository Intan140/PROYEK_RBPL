<?php
include '../koneksi.php';

$query = "SELECT * FROM pesanan ORDER BY id_pesanan DESC";
$result = mysqli_query($koneksi, $query);
$total_paket = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Sortation Center - Logistik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Montserrat:wght@400;500;600&family=Plus+Jakarta+Sans:wght@700&display=swap" rel="stylesheet">
    <style>
        :root {
            --shopee-orange: #F66341;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            overflow: hidden;
            -webkit-tap-highlight-color: transparent;
        }

        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }

        .font-montserrat {
            font-family: 'Montserrat', sans-serif;
        }

        .font-jakarta {
            font-family: 'Plus Jakarta Sans', sans-serif;
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
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.04);
            transition: transform 0.2s ease;
        }

        .glass-card:active {
            transform: scale(0.98);
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
    </style>
</head>

<body class="flex justify-center items-start min-h-screen">
    <div class="w-full max-w-[400px] bg-[#fdfdfd] h-screen relative shadow-2xl overflow-hidden flex flex-col border-x border-gray-100">

        <div class="shopee-bg w-full h-[120px] absolute top-0 left-0 z-0"></div>

        <div class="relative z-10 w-full h-[40px] px-6 flex justify-between items-center mt-1">
            <span class="text-white text-[16px] font-semibold">9:41</span>
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
            <a href="sortir.php" class="flex items-center justify-center">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                    <path d="M19 12H5M12 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-white text-[20px] font-medium font-poppins">Daftar Sortir</h1>
        </div>

        <div class="relative z-10 px-6 mt-12 flex-1 overflow-y-auto no-scrollbar pb-32">

            <div class="flex items-center justify-between mb-4">
                <h2 class="text-gray-800 text-[18px] font-semibold font-montserrat">Daftar Paket</h2>
                <span class="text-xs text-orange-500 font-bold bg-orange-50 px-2 py-1 rounded-md"><?= $total_paket ?> Total</span>
            </div>

            <div class="space-y-4">
                <?php
                if ($total_paket > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                        $status_str = strtolower($row['status']);
                        $status_class = "bg-blue-50 text-blue-600";
                        $border_class = "";

                        if (strpos($status_str, 'menuju') !== false || strpos($status_str, 'sorted') !== false) {
                            $status_class = "bg-green-50 text-green-600";
                        } elseif (strpos($status_str, 'error') !== false || strpos($status_str, 'gagal') !== false) {
                            $status_class = "bg-red-50 text-red-600";
                            $border_class = "border-l-4 border-l-red-500";
                        }
                ?>
                        <a href="detailstatus.php?id=<?= $row['id_pesanan'] ?>" class="block">
                            <div class="glass-card rounded-[16px] p-5 <?= $border_class ?>">
                                <div class="flex justify-between items-start mb-3">
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-400 font-bold uppercase tracking-widest mb-1">RESI</span>
                                        <span class="text-gray-900 font-bold font-poppins text-lg"><?= htmlspecialchars($row['resi']) ?></span>
                                    </div>
                                    <span class="status-badge <?= $status_class ?>"><?= htmlspecialchars($row['status'] ? $row['status'] : 'Pending') ?></span>
                                </div>
                                <div class="flex items-center gap-2 text-gray-500">
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <p class="text-[13px] font-medium truncate w-full"><?= htmlspecialchars($row['alamat']) ?></p>
                                </div>
                            </div>
                        </a>
                <?php
                    }
                } else {
                    echo "<p class='text-center text-gray-400 mt-10 text-sm'>Belum ada data paket.</p>";
                }
                ?>
            </div>
        </div>

        <div class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-[400px] h-[85px] bg-white shadow-[0_-10px_40px_rgba(0,0,0,0.06)] rounded-t-[32px] flex justify-around items-center z-50 border-t border-gray-50">
            <a href="sortir.php" class="flex flex-col items-center gap-1.5 px-4 opacity-25 transition-all active:scale-95 no-underline">
                <svg class="w-6 h-6 text-gray-800" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 00.707-1.707l-9-9a.999.999 0 00-1.414 0l-9 9A1 1 0 003 13zm7 7v-5h4v5h-4z" />
                </svg>
                <span class="text-[10px] font-bold text-gray-800 font-jakarta tracking-wider uppercase text-center">Beranda</span>
            </a>
            <div class="relative">
                <button class="shopee-bg w-[58px] h-[54px] -mt-12 rounded-[20px] flex items-center justify-center shadow-2xl shadow-orange-300 border-[4px] border-white active:scale-90 transition-all">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                </button>
            </div>
            <button class="flex flex-col items-center gap-1.5 px-4 transition-all active:scale-95">
                <svg class="w-6 h-6 shopee-text" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
                <span class="text-[10px] font-bold shopee-text font-jakarta tracking-wider uppercase">Daftar Sortir</span>
            </button>
        </div>
    </div>
</body>

</html>
