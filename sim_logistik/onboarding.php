<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SILOG - Pilih Peran</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: #f5f5f5;
            -webkit-tap-highlight-color: transparent;
        }


        .main-color {
            background: linear-gradient(135deg, #ee4d2d 0%, #ff6347 100%);
        }

        .main-text {
            color: #ee4d2d;
        }

        .role-card {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.02);
        }

        .poppins {
            font-family: 'Poppins', sans-serif;
        }
    </style>

</head>


<body class="flex justify-center items-start min-h-screen">

    <div class="w-full max-w-[400px] min-h-screen bg-[#f5f5f5] shadow-2xl overflow-hidden">

        <div class="main-color text-white px-6 pt-8 pb-8 shadow-lg relative">

            <div class="absolute top-0 right-0 w-24 h-24 bg-white/5 rounded-full -mr-10 -mt-10 blur-2xl"></div>

            <h1 class="text-[17px] font-bold poppins text-center tracking-tight leading-tight whitespace-nowrap">
                Sistem Informasi Manajemen Logistik
            </h1>

            <p class="text-[12px] text-center opacity-90 mt-2 font-medium">
                Pilih peran pengguna untuk masuk
            </p>

        </div>

        <div class="p-3 grid grid-cols-2 gap-3 mt-1">

            <a href="../penjual/obpenjual.php" class="bg-white p-5 rounded-xl role-card flex flex-col items-center group transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_8px_20px_rgba(238,77,45,0.12)] active:scale-95 cursor-pointer">

                <div class="w-12 h-12 bg-orange-50 rounded-full flex items-center justify-center mb-2 transition-colors group-hover:bg-orange-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 main-text transition-transform duration-300 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18l-1 13H4L3 3z" />
                    </svg>
                </div>

                <span class="text-[13px] font-semibold text-gray-700">Penjual</span>

            </a>

            <a href="../kurir_pickup/obkurirpu.php" class="bg-white p-5 rounded-xl role-card flex flex-col items-center group transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_8px_20px_rgba(238,77,45,0.12)] active:scale-95 cursor-pointer">

                <div class="w-12 h-12 bg-orange-50 rounded-full flex items-center justify-center mb-2 transition-colors group-hover:bg-orange-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 main-text transition-transform duration-300 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V5h6v12m-9 0h12" />
                    </svg>
                </div>

                <span class="text-[13px] font-semibold text-gray-700">Kurir Pickup</span>

            </a>

            <a href="../operator_sortation_center/obsortasi.php" class="bg-white p-5 rounded-xl role-card flex flex-col items-center group transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_8px_20px_rgba(238,77,45,0.12)] active:scale-95 cursor-pointer">

                <div class="w-12 h-12 bg-orange-50 rounded-full flex items-center justify-center mb-2 transition-colors group-hover:bg-orange-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 main-text transition-transform duration-300 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                    </svg>
                </div>

                <span class="text-[13px] font-semibold text-gray-700">Sortation</span>

            </a>

            <a href="../admin_hubreg/obadmin.php" class="bg-white p-5 rounded-xl role-card flex flex-col items-center group transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_8px_20px_rgba(238,77,45,0.12)] active:scale-95 cursor-pointer">

                <div class="w-12 h-12 bg-orange-50 rounded-full flex items-center justify-center mb-2 transition-colors group-hover:bg-orange-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 main-text transition-transform duration-300 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6h13v6" />
                    </svg>
                </div>

                <span class="text-[13px] font-semibold text-gray-700 text-center">Admin Regional</span>

            </a>

            <a href="../planner/obplanner.php" class="bg-white p-5 rounded-xl role-card flex flex-col items-center group transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_8px_20px_rgba(238,77,45,0.12)] active:scale-95 cursor-pointer">

                <div class="w-12 h-12 bg-orange-50 rounded-full flex items-center justify-center mb-2 transition-colors group-hover:bg-orange-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 main-text transition-transform duration-300 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10" />
                    </svg>
                </div>

                <span class="text-[13px] font-semibold text-gray-700">Planner</span>

            </a>

            <a href="../koordinator_hubreg/obkoor.php" class="bg-white p-5 rounded-xl role-card flex flex-col items-center group transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_8px_20px_rgba(238,77,45,0.12)] active:scale-95 cursor-pointer">

                <div class="w-12 h-12 bg-orange-50 rounded-full flex items-center justify-center mb-2 transition-colors group-hover:bg-orange-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 main-text transition-transform duration-300 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10l9-7 9 7v10H3z" />
                    </svg>
                </div>

                <span class="text-[13px] font-semibold text-gray-700 text-center">Koordinator Hub</span>

            </a>

            <a href="../driver_middlemile/obdriver.php" class="bg-white p-5 rounded-xl role-card flex flex-col items-center group transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_8px_20px_rgba(238,77,45,0.12)] active:scale-95 cursor-pointer">

                <div class="w-12 h-12 bg-orange-50 rounded-full flex items-center justify-center mb-2 transition-colors group-hover:bg-orange-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 main-text transition-transform duration-300 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13h13l3 3v5H3z" />
                    </svg>
                </div>

                <span class="text-[13px] font-semibold text-gray-700 text-center">Driver Middle Mile</span>

            </a>

            <a href="../operator_lastmile/oboperator.php" class="bg-white p-5 rounded-xl role-card flex flex-col items-center group transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_8px_20px_rgba(238,77,45,0.12)] active:scale-95 cursor-pointer">

                <div class="w-12 h-12 bg-orange-50 rounded-full flex items-center justify-center mb-2 transition-colors group-hover:bg-orange-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 main-text transition-transform duration-300 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                <span class="text-[13px] font-semibold text-gray-700">Operator</span>

            </a>

            <a href="../kurir_lokal/obkurir.php" class="bg-white p-5 rounded-xl role-card flex flex-col items-center group transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_8px_20px_rgba(238,77,45,0.12)] active:scale-95 cursor-pointer">

                <div class="w-12 h-12 bg-orange-50 rounded-full flex items-center justify-center mb-2 transition-colors group-hover:bg-orange-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 main-text transition-transform duration-300 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5-5m0 0l5-5m-5 5h12" />
                    </svg>
                </div>

                <span class="text-[13px] font-semibold text-gray-700 text-center">Kurir Last Mile</span>

            </a>

            <a href="../pelanggan/obpelanggan.php" class="bg-white p-5 rounded-xl role-card flex flex-col items-center group transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_8px_20px_rgba(238,77,45,0.12)] active:scale-95 cursor-pointer">

                <div class="w-12 h-12 bg-orange-50 rounded-full flex items-center justify-center mb-2 transition-colors group-hover:bg-orange-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 main-text transition-transform duration-300 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 1.656-1.344 3-3 3s-3-1.344-3-3 1.344-3 3-3 3 1.344 3 3z" />
                    </svg>
                </div>

                <span class="text-[13px] font-semibold text-gray-700 text-center">Pelanggan</span>

            </a>

        </div>

    </div>

</body>

</html>