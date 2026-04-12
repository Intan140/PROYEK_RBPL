<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - SIM Logistik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            -webkit-tap-highlight-color: transparent;
        }

        .shopee-bg {
            background-color: #F66341;
        }

        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }

        .img-hero-container {
            width: 100%;
            height: 340px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(to bottom, #F66341 0%, #F66341 45%, #ffffff 100%);
        }
    </style>
</head>

<body class="flex justify-center items-start min-h-screen">
    <div class="w-full max-w-[400px] bg-white min-h-screen relative shadow-2xl overflow-hidden flex flex-col border-x border-gray-100">

        <div class="shopee-bg text-white px-5 pt-2 flex justify-between items-center text-[12px] font-medium z-10 relative">
            <span>9:41</span>
            <div class="flex items-center gap-1.5">
                <div class="w-5 h-2.5 border border-white/60 rounded-sm relative">
                    <div class="absolute inset-0.5 bg-white w-3/4 rounded-px"></div>
                </div>
            </div>
        </div>


        <div class="img-hero-container relative">

            <div class="absolute top-10 right-10 w-20 h-20 bg-white/10 rounded-full blur-xl"></div>
            <div class="absolute bottom-10 left-10 w-24 h-24 bg-orange-500/20 rounded-full blur-2xl"></div>

            <div class="p-6 z-10">

                <img src="pelanggan.png" class="h-52 w-52 object-contain filter drop-shadow-xl" alt="Ilustrasi Tracking Paket" onerror="this.src='https://cdn-icons-png.flaticon.com/512/2838/2838895.png'">
            </div>
        </div>


        <div class="px-8 py-6 flex-1 flex flex-col justify-center text-center">
            <h1 class="text-[26px] font-extrabold text-gray-800 tracking-tight font-poppins leading-tight">Lacak Paket Jadi <br>Lebih Mudah</h1>
            <p class="text-gray-500 text-[14px] mt-3 leading-relaxed">
                Pantau pergerakan paket Anda secara real-time dari genggaman tangan. Cepat, aman, dan terpercaya.
            </p>
        </div>


        <div class="p-8 pb-8 flex gap-3">
            <button onclick="window.location.href='../sim_logistik/onboarding.php'" class="flex-1 bg-white border-2 border-[#F66341] text-[#F66341] py-4 rounded-2xl font-bold text-[15px] active:scale-95 transition-all text-center">
                Kembali
            </button>
            <button onclick="window.location.href='portalpelanggan.php'" class="flex-1 shopee-bg text-white py-4 rounded-2xl font-bold text-[15px] shadow-[0_10px_20px_-10px_rgba(246,99,65,0.6)] active:scale-95 transition-all text-center">
                Mulai
            </button>
        </div>

    </div>
</body>

</html>