<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Onboarding Koordinator Hub - SIM Logistik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            -webkit-tap-highlight-color: transparent;
        }

        .shopee-bg {
            background-color: #ee4d2d;
        }

        .img-hero-container {
            width: 100%;
            height: 340px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(to bottom, #ee4d2d 0%, #ee4d2d 50%, #ffffff 100%);
            position: relative;
        }
    </style>
</head>

<body class="flex justify-center items-start min-h-screen">
    <div class="w-full max-w-[400px] bg-white min-h-screen relative shadow-2xl overflow-hidden flex flex-col border-x border-gray-100">

        <div class="shopee-bg text-white px-5 pt-2 flex justify-between items-center text-[12px] font-medium z-10">
            <span>9:41</span>
            <div class="flex items-center gap-1.5">
                <div class="w-5 h-2.5 border border-white/60 rounded-sm relative">
                    <div class="absolute inset-0.5 bg-white w-3/4 rounded-px"></div>
                </div>
            </div>
        </div>


        <div class="img-hero-container">
            <div class="p-6">

                <img src="planner.png" class="h-52 w-52 object-contain" alt="Ilustrasi Perencanaan Rute" onerror="this.src='https://cdn-icons-png.flaticon.com/512/3082/3082383.png'">
            </div>
        </div>
        <div class="px-8 py-6 flex-1 flex flex-col justify-center text-center">
            <h1 class="text-2xl font-bold text-gray-800 tracking-tight leading-tight">Selamat Datang, <br>Planner!</h1>
            <p class="text-gray-500 text-[14px] mt-3 leading-relaxed">
                Rencanakan rute pengiriman dan jadwalkan armada antar hub dengan lebih terstruktur, efisien, dan tepat waktu.
            </p>
        </div>

        <div class="p-8 pb-10 flex gap-3">
            <button onclick="window.location.href='../sim_logistik/onboarding.php'" class="flex-1 bg-white border-2 border-[#ee4d2d] text-[#ee4d2d] py-4 rounded-xl font-bold text-lg active:scale-95 transition-all text-center">
                Kembali
            </button>
            <button onclick="window.location.href='daftar_armada.php'" class="flex-1 shopee-bg text-white py-4 rounded-xl font-bold text-lg shadow-[0_10px_20px_-10px_rgba(238,77,45,0.6)] active:scale-95 transition-all text-center">
                Mulai
            </button>
        </div>
    </div>
</body>

</html>