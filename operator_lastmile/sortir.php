<?php
include '../sim_logistik/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['assign_kurir'])) {
    if (!empty($_POST['paket_terpilih']) && !empty($_POST['id_kurir'])) {
        $id_kurir = mysqli_real_escape_string($koneksi, $_POST['id_kurir']);
        $paket_list = $_POST['paket_terpilih'];

        $sukses = 0;
        foreach ($paket_list as $id_pesanan) {
            $id_pesanan = mysqli_real_escape_string($koneksi, $id_pesanan);

            $query_update = "UPDATE pesanan SET status = 'Out for Delivery' WHERE id_pesanan = '$id_pesanan'";
            if (mysqli_query($koneksi, $query_update)) {
                $sukses++;
            }
        }
        echo "<script>alert('Berhasil menugaskan $sukses paket ke Kurir Lokal!'); window.location.href='dashboard.php';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal: Pilih minimal 1 paket dan pilih 1 Kurir!');</script>";
    }
}


$q_paket = "SELECT * FROM pesanan WHERE status = 'Tiba di Hub Tujuan' ORDER BY alamat ASC";
$res_paket = mysqli_query($koneksi, $q_paket);
$jumlah_paket = mysqli_num_rows($res_paket);

$q_kurir = "SELECT * FROM kurir WHERE status = 'Aktif'";
$res_kurir = mysqli_query($koneksi, $q_kurir);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Sortir & Assign Rute - Last Mile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            overflow: hidden;
            -webkit-tap-highlight-color: transparent;
        }

        .shopee-bg {
            background-color: #F66341;
        }

        .shopee-text {
            color: #F66341;
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

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            color: #94a3b8;
            text-decoration: none;
            font-weight: 500;
        }

        .nav-item.active {
            color: #F66341;
        }

        .custom-checkbox {
            width: 24px;
            height: 24px;
            border-radius: 6px;
            border: 2px solid #cbd5e1;
            appearance: none;
            cursor: pointer;
            outline: none;
            transition: all 0.2s;
            position: relative;
            background: white;
        }

        .custom-checkbox:checked {
            background-color: #F66341;
            border-color: #F66341;
        }

        .custom-checkbox:checked::after {
            content: '';
            position: absolute;
            left: 7px;
            top: 3px;
            width: 6px;
            height: 12px;
            border: solid white;
            border-width: 0 2.5px 2.5px 0;
            transform: rotate(45deg);
        }

        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%239CA3AF' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1.2em;
        }
    </style>
</head>

<body class="flex justify-center items-start min-h-screen">
    <div class="w-full max-w-[400px] bg-[#f8fafc] h-screen relative shadow-2xl overflow-hidden flex flex-col border-x border-gray-100">

        <div class="shopee-bg w-full shrink-0 relative z-10 text-white">
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

            <div class="px-5 py-4 flex items-center gap-3">
                <button onclick="window.location.href='dashboard.php'" class="p-1 active:opacity-50 transition-opacity">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 18l-6-6 6-6" />
                    </svg>
                </button>
                <h1 class="text-[20px] font-bold tracking-wide">Sortir & Assign Rute</h1>
            </div>
        </div>

        <form method="POST" action="" class="flex-1 overflow-y-auto no-scrollbar pb-48 flex flex-col relative pt-4">

            <div class="px-6 flex-1">
                <div class="flex justify-between items-end mb-4">
                    <div>
                        <h2 class="text-gray-900 text-[18px] font-bold leading-tight">Pilih Paket</h2>
                        <span class="text-[12px] text-gray-400 font-medium">Berdasarkan area/kecamatan tujuan</span>
                    </div>
                    <span class="bg-orange-100 text-[#F66341] px-3 py-1 rounded-full text-[12px] font-bold"><?= $jumlah_paket ?> Paket</span>
                </div>

                <div class="space-y-3">
                    <?php
                    if ($jumlah_paket > 0) {
                        while ($row = mysqli_fetch_assoc($res_paket)) {
                    ?>
                            <label class="glass-card p-4 flex items-center gap-4 cursor-pointer hover:bg-orange-50/30 transition-colors">
                                <input type="checkbox" name="paket_terpilih[]" value="<?= $row['id_pesanan'] ?>" class="custom-checkbox shrink-0">
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-gray-900 font-bold text-[15px] truncate">Resi: <?= htmlspecialchars($row['resi']) ?></h4>
                                    <div class="flex items-center gap-1.5 mt-1">
                                        <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <p class="text-gray-500 text-[13px] font-medium truncate"><?= htmlspecialchars($row['alamat']) ?></p>
                                    </div>
                                </div>
                            </label>
                    <?php
                        }
                    } else {
                        echo "<div class='text-center py-10'><p class='text-gray-400 font-medium text-sm'>Tidak ada paket yang menunggu disortir.</p></div>";
                    }
                    ?>
                </div>
            </div>

            <div class="fixed bottom-[65px] left-1/2 -translate-x-1/2 w-full max-w-[400px] bg-white p-5 z-40 rounded-t-3xl shadow-[0_-8px_30px_rgba(0,0,0,0.06)] border border-gray-100">
                <label class="block text-gray-700 text-[11px] font-bold uppercase tracking-widest mb-2 ml-1">Pilih Kurir Penjemput</label>
                <div class="mb-4">

                    <select name="id_kurir" required class="w-full bg-white border-2 border-[#F66341] rounded-xl px-4 py-3.5 outline-none font-bold text-gray-800 appearance-none text-[14px]">
                        <option value="" disabled selected>-- Pilih Kurir Lokal --</option>
                        <?php
                        if ($res_kurir && mysqli_num_rows($res_kurir) > 0) {
                            while ($kurir = mysqli_fetch_assoc($res_kurir)):
                        ?>
                                <option value="<?= $kurir['id_kurir'] ?>"><?= htmlspecialchars($kurir['nama_kurir']) ?></option>
                        <?php
                            endwhile;
                        } else {
                            echo "<option value=''>Data Kurir Kosong</option>";
                        }
                        ?>
                    </select>
                </div>

                <button type="submit" name="assign_kurir" class="w-full shopee-bg text-white h-[52px] rounded-xl font-bold text-[14px] shadow-lg shadow-orange-200 active:scale-[0.98] transition-all tracking-wide">
                    ASSIGN RUTE & BERANGKATKAN
                </button>
            </div>
        </form>

        <nav class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-[400px] bg-white border-t border-gray-100 h-[65px] flex justify-around items-center px-2 z-[100]">
            <a href="dashboard.php" class="nav-item">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-[10px]">Home</span>
            </a>
            <a href="scan_paket.php" class="nav-item">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                </svg>
                <span class="text-[10px]">Scan</span>
            </a>
            <a href="sortir.php" class="nav-item active">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <span class="text-[10px]">Sortir</span>
            </a>
        </nav>
    </div>
</body>

</html>