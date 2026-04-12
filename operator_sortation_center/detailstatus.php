<?php
include '../sim_logistik/koneksi.php';


if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: statussortir.php");
    exit;
}

$id_pesanan = mysqli_real_escape_string($koneksi, $_GET['id']);

$query = "SELECT * FROM pesanan WHERE id_pesanan = '$id_pesanan'";
$result = mysqli_query($koneksi, $query);
$data_paket = mysqli_fetch_assoc($result);

if (!$data_paket) {
    die("Data paket tidak ditemukan.");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_alamat'])) {
    $alamat_baru = mysqli_real_escape_string($conn, $_POST['alamat_baru']);

    $update_query = "UPDATE pesanan SET alamat = '$alamat_baru' WHERE id_pesanan = '$id_pesanan'";
    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Destinasi berhasil diperbarui!'); window.location.href='suksessortir.php?id=$id_pesanan';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal memperbarui destinasi: " . mysqli_error($conn) . "');</script>";
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['teruskan_hub'])) {
    $update_status_query = "UPDATE pesanan SET status = 'Menuju Hub Regional' WHERE id_pesanan = '$id_pesanan'";
    if (mysqli_query($koneksi, $update_status_query)) {
        echo "<script>alert('Paket berhasil diteruskan ke Hub Regional!'); window.location.href='suksessortir.php?id=$id_pesanan';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal meneruskan paket: " . mysqli_error($conn) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Detail Paket - Logistik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Montserrat:wght@400;500;600&family=Plus+Jakarta+Sans:wght@700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
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

        .font-roboto {
            font-family: 'Roboto', sans-serif;
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

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .input-box {
            box-shadow: 0px 2px 8px rgba(64, 60, 67, 0.24);
        }
    </style>
</head>

<body class="flex justify-center items-start min-h-screen">
    <div class="w-full max-w-[400px] bg-[#fdfdfd] h-screen relative shadow-2xl overflow-hidden flex flex-col border-x border-gray-100">

        <div class="shopee-bg w-full h-[120px] absolute top-0 left-0 z-0"></div>

        <div class="relative z-10 w-full flex flex-col">
            <div class="w-full h-[40px] px-6 flex justify-between items-center mt-1">
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

            <div class="px-6 mt-4 flex items-center gap-4">
                <a href="statussortir.php" class="flex items-center justify-center active:scale-90 transition">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                </a>
                <h1 class="text-white text-[20px] font-medium font-poppins">Detail Paket</h1>
            </div>
        </div>

        <div class="relative z-10 px-6 mt-12 flex-1 overflow-y-auto no-scrollbar pb-32">

            <div class="glass-card rounded-[16px] p-5 mb-6">
                <div class="flex justify-between">
                    <h2 class="text-[#030303] text-[20px] font-roboto mb-3 font-semibold">Package Summary</h2>
                    <span class="text-xs bg-orange-100 text-orange-600 px-2 py-1 h-fit rounded font-bold uppercase"><?= htmlspecialchars($data_paket['status']) ?></span>
                </div>
                <div class="space-y-1.5">
                    <p class="text-[#030303] text-[16px] font-normal font-roboto">Resi: <span class="font-bold"><?= htmlspecialchars($data_paket['resi']) ?></span></p>
                    <p class="text-[#030303] text-[16px] font-normal font-roboto">Produk: <?= htmlspecialchars($data_paket['nama_produk']) ?> (<?= htmlspecialchars($data_paket['jumlah']) ?> pcs)</p>
                    <p class="text-[#030303] text-[16px] font-normal font-roboto">Weight: <?= htmlspecialchars($data_paket['berat']) ?> kg</p>
                    <p class="text-[#030303] text-[16px] font-normal font-roboto mt-2 text-sm text-gray-500">Current Destination:</p>
                    <p class="text-[#030303] text-[14px] font-normal font-roboto bg-gray-50 p-3 rounded-lg border border-gray-100"><?= nl2br(htmlspecialchars($data_paket['alamat'])) ?></p>
                </div>
            </div>

            <!-- Form Edit Destinasi & Action Buttons -->
            <form method="POST" action="">
                <div class="glass-card rounded-[16px] p-5 mb-6">
                    <h2 class="text-[#030303] text-[20px] font-roboto mb-4 font-semibold">Edit Destination</h2>
                    <div class="w-full bg-white px-4 py-3 rounded-lg border border-gray-200 mb-4 focus-within:border-[#F66341] focus-within:ring-1 focus-within:ring-[#F66341] transition-all">
                        <textarea name="alamat_baru" rows="3" placeholder="Enter new destination" required
                            class="w-full outline-none text-[14px] font-roboto text-gray-700 placeholder:text-[#94A3B8] resize-none"><?= htmlspecialchars($data_paket['alamat']) ?></textarea>
                    </div>

                    <div class="flex items-center justify-between mb-5">
                        <span class="text-[#030303] text-[14px] font-medium font-roboto text-gray-600">Konfirmasi Alamat Baru</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" required class="sr-only peer" checked>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#F66341]"></div>
                        </label>
                    </div>

                    <button type="submit" name="update_alamat" class="w-full h-[45px] bg-gray-50 border border-gray-200 hover:bg-gray-100 flex items-center justify-center rounded-lg active:scale-[0.98] transition-all">
                        <span class="text-[#52525B] text-[14px] font-semibold font-roboto">Update Destination</span>
                    </button>
                </div>

                <!-- Action Button Teruskan ke Hub -->
                <button type="submit" name="teruskan_hub" class="w-full shopee-bg text-white h-[56px] rounded-xl flex items-center justify-center gap-3 shadow-[0_8px_20px_-6px_rgba(246,99,65,0.4)] active:scale-95 transition-all mb-4">
                    <span class="text-[14px] font-bold font-jakarta tracking-wide uppercase">TERUSKAN KE HUB REGIONAL</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </button>
            </form>

        </div>
    </div>
</body>

</html>