<?php
include '../sim_logistik/koneksi.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: sortir.php");
    exit;
}

$id_pesanan = mysqli_real_escape_string($koneksi, $_GET['id']);

$query = "SELECT resi, status, alamat FROM pesanan WHERE id_pesanan = '$id_pesanan'";
$result = mysqli_query($koneksi, $query);
$data_paket = mysqli_fetch_assoc($result);

if (!$data_paket) {
    header("Location: sortir.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Sortir Berhasil - Logistik</title>
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
            overflow: hidden;
            -webkit-tap-highlight-color: transparent;
        }

        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }

        .shopee-text {
            color: var(--shopee-orange);
        }

        .shopee-bg {
            background-color: var(--shopee-orange);
        }

        .success-circle {
            animation: scaleIn 0.5s ease-out forwards;
        }

        .success-check {
            stroke-dasharray: 100;
            stroke-dashoffset: 100;
            animation: drawCheck 0.5s 0.3s ease-out forwards;
        }

        @keyframes scaleIn {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            80% {
                transform: scale(1.1);
                opacity: 1;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes drawCheck {
            100% {
                stroke-dashoffset: 0;
            }
        }
    </style>
</head>

<body class="flex justify-center items-start min-h-screen">
    <div class="w-full max-w-[400px] bg-white h-screen relative shadow-2xl overflow-hidden flex flex-col items-center border-x border-gray-100">

        <div class="w-full h-[40px] px-6 flex justify-between items-center mt-1 z-10 absolute top-0">
            <span class="text-gray-800 text-[16px] font-semibold">9:41</span>
            <div class="flex items-center gap-2">
                <svg width="17" height="11" viewBox="0 0 17 11" fill="none">
                    <path d="M1 5C3.5 2 7.5 2 10 5M1 8C2.5 6.5 4.5 6.5 6 8" stroke="#1F2937" stroke-width="2" stroke-linecap="round" />
                </svg>
                <div class="w-6 h-3 border-2 border-gray-800 rounded-[3px] relative">
                    <div class="absolute inset-[1px] bg-gray-800 w-[70%] rounded-[1px]"></div>
                </div>
            </div>
        </div>

        <div class="flex-1 flex flex-col items-center justify-center w-full px-8 mt-10">
            <div class="w-28 h-28 rounded-full bg-green-50 flex items-center justify-center mb-6 success-circle">
                <div class="w-20 h-20 rounded-full bg-green-500 flex items-center justify-center shadow-lg shadow-green-200">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <polyline class="success-check" points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>
            </div>

            <h1 class="font-poppins text-[24px] font-bold text-gray-800 mb-2 text-center">Sortir Berhasil!</h1>
            <p class="text-gray-500 text-[14px] text-center mb-8">Paket telah diklasifikasikan dan siap diberangkatkan ke Hub Regional.</p>

            <div class="w-full bg-gray-50 border border-gray-100 rounded-2xl p-5 mb-8">
                <div class="flex justify-between items-center border-b border-gray-200 pb-3 mb-3">
                    <span class="text-gray-400 text-[12px] font-bold uppercase tracking-wider">No. Resi</span>
                    <span class="font-poppins font-bold text-gray-800"><?= htmlspecialchars($data_paket['resi']) ?></span>
                </div>
                <div class="flex justify-between items-center mb-3">
                    <span class="text-gray-400 text-[12px] font-bold uppercase tracking-wider">Status Baru</span>
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-[12px] font-bold uppercase"><?= htmlspecialchars($data_paket['status']) ?></span>
                </div>
                <div class="flex flex-col gap-1">
                    <span class="text-gray-400 text-[12px] font-bold uppercase tracking-wider">Tujuan Hub</span>
                    <span class="text-gray-700 text-[13px] font-medium leading-relaxed truncate"><?= htmlspecialchars($data_paket['alamat']) ?></span>
                </div>
            </div>
        </div>

        <div class="w-full px-6 pb-10 gap-3 flex flex-col">
            <a href="sortir.php" class="w-full shopee-bg text-white h-[54px] rounded-xl flex items-center justify-center font-bold tracking-wide transition-all active:scale-95 shadow-lg shadow-orange-200">
                SCAN PAKET LAIN
            </a>
            <a href="statussortir.php" class="w-full bg-white border border-gray-200 text-gray-600 h-[54px] rounded-xl flex items-center justify-center font-bold tracking-wide transition-all active:scale-95 active:bg-gray-50">
                LIHAT DAFTAR SORTIR
            </a>
        </div>

    </div>
</body>

</html>