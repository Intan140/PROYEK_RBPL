<?php
include '../sim_logistik/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nomor_resi'])) {
    $id_manifest = mysqli_real_escape_string($koneksi, $_POST['id_manifest']);
    $nomor_resi = mysqli_real_escape_string($koneksi, $_POST['nomor_resi']);
    $tujuan = mysqli_real_escape_string($koneksi, $_POST['tujuan']);
    $catatan = mysqli_real_escape_string($koneksi, $_POST['catatan']);

    $query = "UPDATE pesanan SET status = 'In Transit (Middle Mile)', alamat = '$tujuan' WHERE resi = '$nomor_resi'";

    if (mysqli_query($koneksi, $query)) {
        if (mysqli_affected_rows($koneksi) > 0) {
            echo "<script>alert('Berhasil! Status paket diupdate ke In Transit.'); window.location.href='trackingstatus.php';</script>";
        } else {
            echo "<script>alert('Gagal: Nomor Resi tidak ditemukan di database!');</script>";
        }
    } else {
        echo "<script>alert('Error database: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Catat Data - Admin Middle Mile</title>
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
            overflow: hidden;
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

        .header-fixed {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 50;
        }

        .input-card {
            background: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .custom-input {
            width: 100%;
            height: 48px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 0 16px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            color: #1e293b;
            margin-top: 10px;
            transition: all 0.2s;
        }

        .custom-input:focus {
            outline: none;
            border-color: var(--shopee-orange);
            background: white;
            box-shadow: 0 0 0 4px rgba(246, 99, 65, 0.1);
        }

        .label-style {
            color: #0f172a;
            font-size: 15px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .scroll-content {
            flex: 1;
            overflow-y: auto;
            padding-top: 130px;
            padding-bottom: 100px;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 4px;
            color: #94a3b8;
            transition: all 0.3s;
            flex: 1;
            text-decoration: none;
        }

        .nav-item.active {
            color: var(--shopee-orange);
        }

        .nav-item span {
            font-size: 11px;
            font-weight: 600;
        }
    </style>
</head>

<body class="flex justify-center items-start min-h-screen">

    <div class="w-full max-w-[400px] bg-[#fdfdfd] h-screen relative shadow-2xl overflow-hidden flex flex-col border-x border-gray-100">

        <div class="header-fixed">
            <div class="shopee-bg w-full h-[120px] absolute top-0 left-0 z-0 shadow-lg"></div>
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
                <a href="obadmin.php" class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-white/10 active:scale-90 transition-transform">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                </a>
                <h1 class="text-white text-[22px] font-bold font-jakarta tracking-tight">Catat Data Admin</h1>
            </div>
        </div>


        <form id="formAdmin" action="" method="POST" class="scroll-content no-scrollbar px-6">
            <p class="text-gray-400 text-[12px] font-bold uppercase tracking-widest mb-4 ml-1">Input Middle Mile</p>

            <div class="input-card">
                <label class="label-style">ID Manifest / Batch</label>
                <input type="text" name="id_manifest" class="custom-input" placeholder="Masukkan ID Manifest..." required>
            </div>

            <div class="input-card">
                <label class="label-style">Resi Paket</label>
                <div class="relative">
                    <input type="text" name="nomor_resi" class="custom-input" placeholder="Scan atau ketik nomor resi..." required>
                    <button type="button" class="absolute right-3 top-[21px] text-orange-500 active:scale-90">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7V5a2 2 0 012-2h2M17 3h2a2 2 0 012 2v2M21 17v2a2 2 0 01-2 2h-2M7 21H5a2 2 0 01-2-2v-2" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="input-card">
                <label class="label-style">Tujuan Hub / Sort Center</label>
                <select name="tujuan" class="custom-input appearance-none bg-white" required>
                    <option value="">Pilih Lokasi Tujuan...</option>
                    <option value="Jakarta DC">Jakarta DC (Cengkareng)</option>
                    <option value="Bandung SC">Bandung SC (Cileunyi)</option>
                    <option value="Surabaya Hub">Surabaya Hub (Sidoarjo)</option>
                    <option value="Semarang DC">Semarang DC</option>
                </select>
            </div>

            <div class="input-card">
                <label class="label-style">Catatan Tambahan</label>
                <textarea name="catatan" class="custom-input h-24 pt-3 resize-none" placeholder="Opsional..."></textarea>
            </div>

            <div class="mt-2 pb-10">
                <button type="submit" class="w-full h-[54px] shopee-bg text-white font-jakarta font-bold text-[16px] rounded-2xl shadow-xl shadow-orange-200 active:scale-[0.98] transition-all">
                    SIMPAN DATA ADMIN
                </button>
            </div>
        </form>
        <div class="bg-white border-t border-gray-100 w-full h-[75px] flex justify-around items-center px-2 z-20 pb-2 absolute bottom-0">
            <a href="trackingstatus.php" class="nav-item">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 10H3M21 6H3M21 14H3M21 18H3"></path>
                </svg>
                <span>Tracking</span>
            </a>
            <a href="detail.php" class="nav-item">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <span>Statistik</span>
            </a>
            <a href="input.php" class="nav-item active">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="12" y1="8" x2="12" y2="16"></line>
                    <line x1="8" y1="12" x2="16" y2="12"></line>
                </svg>
                <span>Input</span>
            </a>
        </div>
    </div>
</body>

</html>