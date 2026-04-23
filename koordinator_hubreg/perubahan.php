<?php
include '../koneksi.php';

//SPRINT 9 - MAINTENANCE TASK (PBI-043 & PBI-045)

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kirim_notif'])) {
    $pesan = mysqli_real_escape_string($koneksi, $_POST['pesan']);

    $query_insert = "INSERT INTO notifikasi (id_pelanggan, id_resi, pesan, waktu_kirim, status_baca) 
                     VALUES (NULL, NULL, '$pesan', NOW(), 'Belum')";

    try {
        if (mysqli_query($koneksi, $query_insert)) {
            echo "<script>alert('Pesan berhasil dikirim!'); window.location.href='perubahan.php';</script>";
            exit;
        }
    } catch (mysqli_sql_exception $e) {
        $error_msg = $e->getMessage();

        if (strpos($error_msg, 'cannot be null') !== false || strpos($error_msg, 'foreign key constraint') !== false) {
            echo "<script>
                alert('GAGAL MENGIRIM PESAN!\\n\\nSistem database masih menolak karena kolom [id_pelanggan] tidak boleh kosong.\\n\\nSOLUSI MAINTENANCE:\\n1. Buka phpMyAdmin -> Klik tabel [notifikasi]\\n2. Pilih tab [Structure/Struktur]\\n3. Klik tombol [Change/Ubah] pada baris id_pelanggan dan id_resi.\\n4. Centang kotak [Null] lalu Save.');
             </script>";
        } else {
            echo "<script>alert('Gagal mengirim pesan: " . addslashes($error_msg) . "');</script>";
        }
    }
}

$query_notif = "SELECT * FROM notifikasi ORDER BY waktu_kirim DESC LIMIT 10";
$result_notif = mysqli_query($koneksi, $query_notif);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Perubahan - Admin Middle Mile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Montserrat:wght@400;500;600&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --shopee-orange: #ee4d2d;
        }

        body {
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            overflow: hidden;
            font-family: 'Roboto', sans-serif;
            -webkit-tap-highlight-color: transparent;
        }

        .font-status-bar {
            font-size: 12px;
            font-weight: 600;
            color: white;
        }

        .font-app-bar {
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            font-size: 18px;
            color: white;
        }

        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }

        .font-montserrat {
            font-family: 'Montserrat', sans-serif;
        }

        .shopee-bg {
            background-color: var(--shopee-orange);
        }

        .card-shadow {
            background: white;
            box-shadow: 2px 0px 10px rgba(3, 3, 3, 0.10);
            border: 0.5px solid rgba(0, 0, 0, 0.10);
            border-radius: 8px;
        }

        .input-box {
            box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.08);
            outline: 0.67px #DFDFDF solid;
            border-radius: 4px;
        }

        .input-box:focus-within {
            outline: 1px solid var(--shopee-orange);
        }

        .nav-shadow {
            box-shadow: 0px -2px 10px rgba(0, 0, 0, 0.05);
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            color: #9ca3af;
            text-decoration: none;
        }

        .nav-item.active {
            color: var(--shopee-orange);
        }
    </style>
</head>

<body class="flex justify-center items-start min-h-screen">
    <div class="w-full max-w-[400px] bg-[#f5f5f5] h-screen relative shadow-2xl overflow-hidden flex flex-col border-x border-gray-100">

        <div class="shopee-bg w-full shrink-0">
            <div class="px-5 pt-2 flex justify-between items-center font-status-bar">
                <span>9:41</span>
                <div class="flex items-center gap-1.5">
                    <div class="w-5 h-2.5 border border-white/60 rounded-sm relative">
                        <div class="absolute inset-0.5 bg-white w-3/4 rounded-px"></div>
                    </div>
                </div>
            </div>
            <div class="px-4 pt-4 pb-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <a href="dashboard.php">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    <h1 class="font-app-bar">Perubahan & Info</h1>
                </div>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto no-scrollbar px-6 pt-6 pb-24">

            <h2 class="font-montserrat text-[#030303] text-[20px] font-bold mb-4">Kirim Notifikasi Baru</h2>

            <form method="POST" action="" class="space-y-4 mb-8">
                <div class="input-box bg-white h-[45px] flex items-center px-3">
                    <input type="text" name="pesan" required placeholder="Ketik pesan informasi di sini..." class="w-full bg-transparent outline-none font-montserrat text-[14px] placeholder-[#94A3B8]">
                </div>
                <button type="submit" name="kirim_notif" class="w-full shopee-bg text-white h-[40px] font-montserrat font-bold text-[14px] rounded-md shadow-md active:scale-95 transition-all">
                    KIRIM PESAN (BROADCAST)
                </button>
            </form>

            <h2 class="font-montserrat text-[#030303] text-[20px] font-bold mb-4">Riwayat Komunikasi</h2>

            <div class="space-y-3">
                <?php
                if ($result_notif && mysqli_num_rows($result_notif) > 0) {
                    while ($row = mysqli_fetch_assoc($result_notif)) {
                        $waktu = date('g:i A', strtotime($row['waktu_kirim']));
                        $tanggal = date('d M', strtotime($row['waktu_kirim']));
                ?>
                        <div class="card-shadow p-4 flex items-start gap-3">
                            <div class="mt-1 shrink-0">
                                <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                            </div>
                            <p class="font-poppins text-[13px] text-[#030303] leading-relaxed">
                                <span class="font-bold text-gray-700"><?= $waktu ?> (<?= $tanggal ?>)</span> - <?= htmlspecialchars($row['pesan']) ?>
                            </p>
                        </div>
                <?php
                    }
                } else {
                    echo "<p class='text-gray-500 text-sm text-center italic'>Belum ada riwayat notifikasi.</p>";
                }
                ?>
            </div>
        </div>

        <nav class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-[400px] bg-white border-t border-gray-100 h-16 flex justify-around items-center px-2 z-[100] nav-shadow">
            <a href="dashboard.php" class="nav-item">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-[10px]">Beranda</span>
            </a>
            <a href="tracking.php" class="nav-item">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                </svg>
                <span class="text-[10px]">Lacak</span>
            </a>
            <a href="perubahan.php" class="nav-item active">
                <svg class="w-6 h-6" fill="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <span class="text-[10px]">Notifikasi</span>
            </a>
            <a href="#" class="nav-item">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="text-[10px]">Saya</span>
            </a>
        </nav>
    </div>
</body>

</html>