<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['simpan_jadwal'])) {
    $id_driver = mysqli_real_escape_string($koneksi, $_POST['id_driver']);
    $id_rute = mysqli_real_escape_string($koneksi, $_POST['id_rute']);
    $tanggal_berangkat = mysqli_real_escape_string($koneksi, $_POST['tanggal_berangkat']);


    $query = "INSERT INTO jadwal_armada (id_driver, id_rute, tanggal_berangkat, status_perjalanan) 
              VALUES ('$id_driver', '$id_rute', '$tanggal_berangkat', 'Terjadwal')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Jadwal rute berhasil disimpan!'); window.location.href='daftar_armada.php';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal menyimpan jadwal: " . mysqli_error($koneksi) . "');</script>";
    }
}


$query_driver = mysqli_query($koneksi, "SELECT * FROM driver");

$query_rute = mysqli_query($koneksi, "
    SELECT r.id_rute, h1.nama_hub AS asal, h2.nama_hub AS tujuan 
    FROM rute r
    JOIN hub h1 ON r.asal_hub = h1.id_hub
    JOIN hub h2 ON r.tujuan_hub = h2.id_hub
");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Perencanaan Rute - Logistik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --shopee-orange: #F66341;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            -webkit-tap-highlight-color: transparent;
        }

        .font-poppins {
            font-family: 'Poppins', sans-serif;
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
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .input-focus:focus-within {
            border-color: var(--shopee-orange);
            box-shadow: 0 0 0 2px rgba(246, 99, 65, 0.1);
        }

        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1em;
        }
    </style>
</head>

<body class="flex justify-center items-start min-h-screen">
    <div class="w-full max-w-[400px] bg-[#fdfdfd] min-h-screen relative shadow-2xl overflow-hidden flex flex-col no-scrollbar border-x border-gray-100">

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
            <a href="daftar_armada.php" class="flex items-center justify-center active:scale-90 transition">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                    <path d="M19 12H5M12 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-white text-[20px] font-medium font-poppins">Rencana Armada</h1>
        </div>

        <div class="relative z-10 px-6 mt-8 flex-1 overflow-y-auto no-scrollbar pb-32">
            <form method="POST" action="">

                <div class="glass-card rounded-[20px] p-5 mb-5 border-t-4 border-[#F66341]">
                    <h2 class="text-gray-800 text-[16px] font-semibold font-poppins mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 shopee-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Penugasan Armada
                    </h2>

                    <div class="space-y-4">
                        <div class="bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 input-focus transition-all">
                            <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Supir Armada</label>
                            <select name="id_driver" required class="w-full bg-transparent outline-none text-[14px] font-semibold text-gray-800 pr-8">
                                <option value="" disabled selected>Pilih Supir...</option>
                                <?php
                                while ($driver = mysqli_fetch_assoc($query_driver)) {

                                    $nama_driver = isset($driver['nama_driver']) ? $driver['nama_driver'] : (isset($driver['nama']) ? $driver['nama'] : 'Driver ' . $driver['id_driver']);
                                    echo "<option value='" . $driver['id_driver'] . "'>" . htmlspecialchars($nama_driver) . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 input-focus transition-all">
                            <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Rute Perjalanan</label>
                            <select name="id_rute" required class="w-full bg-transparent outline-none text-[14px] font-semibold text-gray-800 pr-8">
                                <option value="" disabled selected>Pilih Rute...</option>
                                <?php
                                while ($rute = mysqli_fetch_assoc($query_rute)) {

                                    echo "<option value='" . $rute['id_rute'] . "'>" . htmlspecialchars($rute['asal']) . " ➔ " . htmlspecialchars($rute['tujuan']) . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 input-focus transition-all">
                            <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Waktu Keberangkatan</label>
                            <input type="datetime-local" name="tanggal_berangkat" required class="w-full bg-transparent outline-none text-[14px] font-semibold text-gray-800">
                        </div>
                    </div>
                </div>

                <button type="submit" name="simpan_jadwal" class="w-full shopee-bg text-white h-[56px] rounded-xl flex items-center justify-center gap-3 shadow-[0_8px_20px_-6px_rgba(246,99,65,0.4)] active:scale-95 transition-all">
                    <span class="text-[14px] font-bold font-jakarta tracking-wide uppercase">SIMPAN JADWAL</span>
                </button>
            </form>
        </div>

        <div class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-[400px] h-[85px] bg-white shadow-[0_-10px_40px_rgba(0,0,0,0.06)] rounded-t-[32px] flex justify-around items-center z-50 border-t border-gray-50">
            <a href="daftar_armada.php" class="flex flex-col items-center gap-1.5 px-4 opacity-30 transition-all active:scale-95 no-underline">
                <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <span class="text-[10px] font-bold text-gray-800 font-jakarta tracking-wider uppercase">Daftar Armada</span>
            </a>
            <div class="relative">
                <button class="shopee-bg w-[58px] h-[54px] -mt-12 rounded-[20px] flex items-center justify-center shadow-2xl shadow-orange-300 border-[4px] border-white">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                </button>
            </div>
            <button class="flex flex-col items-center gap-1.5 px-4 transition-all active:scale-95 text-[#F66341]">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5 11h-4v4h-2v-4H7v-2h4V7h2v4h4v2z" />
                </svg>
                <span class="text-[10px] font-bold font-jakarta tracking-wider uppercase">Tambah</span>
            </button>
        </div>
    </div>
</body>

</html>
