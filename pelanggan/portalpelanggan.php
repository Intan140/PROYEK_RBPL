<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Lacak Paket - SIM Logistik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --shopee-orange: #F66341;
        }

        body {
            background-color: #f8fafc;
            font-family: 'Poppins', sans-serif;
            -webkit-tap-highlight-color: transparent;
            margin: 0;
            overflow: hidden;
        }

        .shopee-bg {
            background-color: var(--shopee-orange);
        }

        .shopee-text {
            color: var(--shopee-orange);
        }

        .sf-pro {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        .glass-card {
            background: white;
            box-shadow: 0 10px 30px -10px rgba(246, 99, 65, 0.15);
            border-radius: 24px;
            border: 1px solid rgba(246, 99, 65, 0.1);
        }

        .input-focus:focus-within {
            border-color: var(--shopee-orange);
            box-shadow: 0 0 0 3px rgba(246, 99, 65, 0.15);
        }
    </style>
</head>

<body class="flex justify-center items-start min-h-screen">
    <div class="w-full max-w-[400px] bg-[#f8fafc] h-screen relative shadow-2xl flex flex-col border-x border-gray-100 overflow-hidden">


        <div class="w-full h-[40px] px-6 flex justify-between items-center absolute top-0 z-20 text-white">
            <span class="sf-pro font-semibold text-[15px]">9:41</span>
            <div class="flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="white" viewBox="0 0 20 20">
                    <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 2a1 1 0 011-1h2a1 1 0 011 1v14a1 1 0 01-1 1h-2a1 1 0 01-1-1V2z" />
                </svg>
                <div class="w-6 h-3 border border-white/80 rounded-sm relative">
                    <div class="absolute inset-0.5 bg-white w-3/4 rounded-px"></div>
                </div>
            </div>
        </div>

        <a href="obpelanggan.php" class="absolute top-12 left-5 z-20 bg-white/20 hover:bg-white/30 p-2 rounded-full backdrop-blur-md transition-all border border-white/10 group">
            <svg class="w-6 h-6 text-white group-active:scale-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>

        <div class="shopee-bg w-full h-[320px] rounded-b-[40px] absolute top-0 left-0 z-0">

            <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
            <div class="absolute left-10 top-20 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
        </div>


        <div class="relative z-10 px-6 pt-24 flex flex-col items-center text-center">
            <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-xl shadow-orange-900/20 mb-5 p-4">
                <img src="https://illustrations.popsy.co/amber/shipped.svg" alt="Delivery Box" class="w-full h-full object-contain">
            </div>
            <h1 class="text-white text-[28px] font-extrabold tracking-tight leading-tight">Lacak Paketmu</h1>
            <p class="text-white/90 text-[13px] mt-2 font-medium px-4 leading-relaxed">Masukkan nomor resi untuk mengetahui posisi paket secara real-time.</p>
        </div>

        <div class="relative z-10 px-6 mt-8 w-full">
            <div class="glass-card p-6 w-full relative">
                <form action="hasil.php" method="GET">
                    <label class="block text-[#F66341] text-[11px] font-bold uppercase tracking-widest mb-3 ml-1">Nomor Resi Pengiriman</label>
                    <div class="relative mb-5 input-focus rounded-xl transition-all">
                        <input type="text" name="resi" required placeholder="Contoh: RESI2026..."
                            class="w-full h-[54px] bg-gray-50 border-2 border-gray-100 rounded-xl pl-12 pr-4 outline-none font-bold text-gray-800 uppercase tracking-widest text-[14px]">
                        <svg class="w-6 h-6 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <button type="submit" class="w-full shopee-bg text-white h-[54px] rounded-xl font-bold text-[15px] shadow-lg shadow-orange-200 active:scale-[0.98] transition-all tracking-wide">
                        LACAK SEKARANG
                    </button>
                </form>
            </div>
        </div>

        <div class="relative z-10 mt-auto pb-8 w-full px-6 flex justify-center opacity-60">
            <p class="text-gray-400 text-[11px] font-semibold text-center">© 2026 SIM Logistik by RBPL<br>Pengiriman Cepat & Aman</p>
        </div>

    </div>
</body>

</html>
