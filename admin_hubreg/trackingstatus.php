<?php
include '../sim_logistik/koneksi.php';

$query = "SELECT * FROM pesanan ORDER BY id_pesanan DESC LIMIT 20";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Tracking - Admin Middle Mile</title>
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

        .shopee-bg {
            background-color: var(--shopee-orange);
        }

        .shopee-text {
            color: var(--shopee-orange);
        }

        .glass-card {
            background: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
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

        .btn-view {
            background-color: var(--shopee-orange);
            color: white;
            font-size: 12px;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 4px;
            color: #64748b;
            font-size: 11px;
            font-weight: 500;
            transition: color 0.2s;
            background: none;
            border: none;
            text-decoration: none;
        }

        .nav-item.active {
            color: var(--shopee-orange);
        }
    </style>
</head>

<body class="flex justify-center items-start min-h-screen">

    <div class="w-full max-w-[400px] bg-[#fdfdfd] h-screen relative shadow-2xl overflow-hidden flex flex-col border-x border-gray-100">

        <div class="shopee-bg w-full h-[107px] absolute top-0 left-0 z-0"></div>

        <div class="relative z-10 w-full h-[40px] px-6 flex justify-between items-center mt-1">
            <span class="text-white text-[16px] font-semibold font-poppins">9:41</span>
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
            <a href="obadmin.php" class="flex items-center justify-center active:scale-90 transition w-8 h-8">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
            </a>
            <h1 id="page-title" class="text-white text-[20px] font-medium font-poppins tracking-tight">Tracking Paket</h1>
        </div>

        <div id="tracking-page" class="relative z-10 px-6 mt-10 flex-1 overflow-y-auto no-scrollbar pb-24">
            <div class="space-y-4">

                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                        $status_str = strtolower($row['status']);
                        $dot_color = "bg-yellow-500";

                        if (strpos($status_str, 'transit') !== false || strpos($status_str, 'menuju') !== false) {
                            $dot_color = "bg-blue-500";
                        } elseif (strpos($status_str, 'delivered') !== false || strpos($status_str, 'sampai') !== false || strpos($status_str, 'selesai') !== false) {
                            $dot_color = "bg-green-500";
                        }
                ?>
                        <div class="glass-card p-4 flex justify-between items-center rounded-lg">
                            <div class="flex flex-col max-w-[65%]">
                                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Nomor Resi</span>
                                <h3 class="text-[#030303] text-[15px] font-semibold font-montserrat truncate"><?= htmlspecialchars($row['resi']) ?></h3>
                                <div class="flex items-center gap-2 mt-1">
                                    <div class="w-2 h-2 <?= $dot_color ?> rounded-full shrink-0"></div>
                                    <p class="text-[#030303] text-[12px] font-montserrat truncate"><?= htmlspecialchars($row['status'] ? $row['status'] : 'Pending') ?></p>
                                </div>
                            </div>
                            <a href="detail.php" class="btn-view uppercase font-jakarta">Details</a>
                        </div>
                <?php
                    }
                } else {
                    echo "<p class='text-center text-gray-500 mt-10 text-sm'>Belum ada data paket.</p>";
                }
                ?>

            </div>
        </div>

        <div class="bg-white border-t border-gray-100 w-full h-[75px] flex justify-around items-center px-4 z-20 absolute bottom-0">
            <a href="trackingstatus.php" class="nav-item active">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 10H3M21 6H3M21 14H3M21 18H3"></path>
                </svg>
                <span>Tracking</span>
            </a>
            <a href="detail.php" class="nav-item">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <span>Statistik</span>
            </a>
            <a href="input.php" class="nav-item">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <span>Input</span>
            </a>
        </div>

    </div>
</body>

</html>