<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Saya - Shopee Seller</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
        }

        .shopee-bg {
            background-color: #ee4d2d;
        }

        .shopee-text {
            color: #ee4d2d;
        }

        .shopee-border {
            border-color: #ee4d2d;
        }

        .status-card {
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .05);
        }

        .section-divider {
            height: 10px;
            background-color: #f5f5f5;
        }
    </style>
</head>

<body class="flex justify-center items-start min-h-screen">

    <div class="w-full max-w-[400px] bg-white min-h-screen relative shadow-2xl overflow-hidden pb-24">

        <div class="shopee-bg text-white px-5 pt-2 flex justify-between items-center text-[12px] font-medium">
            <span>9:41</span>
            <div class="flex items-center gap-1.5">

                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21l1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.18L12 21z" style="display:none;" />
                </svg>

                <div class="w-5 h-2.5 border border-white/60 rounded-sm relative">
                    <div class="absolute inset-0.5 bg-white w-3/4 rounded-px"></div>
                </div>
            </div>
        </div>

        <div class="shopee-bg text-white px-4 pt-4 pb-14">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <a href="obpenjual.php">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>

                    <h1 class="text-lg font-medium poppins">Toko Saya</h1>
                </div>
                <div class="flex gap-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    </svg>
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                        <span class="absolute -top-1 -right-1 bg-white text-orange-600 text-[8px] font-bold px-1 rounded-full border border-orange-600">99+</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="px-3 -mt-8">
            <div class="bg-white rounded-md p-4 flex items-center justify-between status-card">
                <div class="flex items-center gap-3">
                    <div class="w-14 h-14 bg-gray-100 rounded-full overflow-hidden border-2 border-white shadow-sm">
                        <img src="https://api.dicebear.com/7.x/adventurer/svg?seed=ShopKeeper" alt="Logo Toko">
                    </div>
                    <div>
                        <h2 class="font-bold text-[15px] text-gray-800">Seller Operations</h2>
                        <div class="flex items-center gap-1 mt-0.5">
                            <span class="bg-orange-100 text-orange-600 text-[9px] font-bold px-1 rounded-sm">Star+</span>
                            <p class="text-[11px] text-gray-500">shopee.co.id/sellerops</p>
                        </div>
                    </div>
                </div>
                <button class="shopee-text border shopee-border px-3 py-1.5 rounded-sm text-[11px] font-medium bg-white active:bg-gray-50">
                    Kunjungi Toko
                </button>
            </div>
        </div>

        <div class="mt-4 px-3 mb-4">
            <div class="flex justify-between items-center mb-2.5 px-1">
                <h3 class="font-bold text-[13.5px] text-gray-800">Pengumuman Penjual</h3>
                <span class="text-[11px] text-gray-400">Lainnya ></span>
            </div>
            <div class="shopee-bg rounded-lg p-4 h-32 relative overflow-hidden flex items-center">
                <div class="z-10">
                    <p class="text-[#fdfd96] font-bold text-[12px] italic tracking-tight">JUALAN DI SHOPEE</p>
                    <p class="text-white font-bold text-[16px] leading-tight">JADI SEMAKIN HANDAL</p>
                    <div class="mt-3 inline-block bg-black/10 px-2.5 py-1 rounded text-[10px] text-white font-bold tracking-widest border border-white/20">KAMPUS SHOPEE</div>
                </div>
                <div class="absolute -right-2 -bottom-2 w-28 h-28 bg-white/10 rounded-full"></div>
                <div class="absolute right-6 top-6 opacity-20 transform rotate-12">
                    <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="section-divider"></div>

        <div class="bg-white py-4 px-3">
            <div class="flex justify-between items-center mb-5 px-1">
                <h3 class="font-bold text-[13.5px] text-gray-800">Status Pesanan</h3>
                <span class="text-[11px] text-gray-400">Riwayat Penjualan ></span>
            </div>
            <div id="status-container" class="grid grid-cols-4 gap-1">

            </div>
        </div>

        <div class="section-divider"></div>

        <div class="bg-white px-2 py-6 grid grid-cols-4 gap-y-10">
            <div class="flex flex-col items-center gap-2.5 active:opacity-60 transition-opacity">
                <div class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center text-white shadow-sm shadow-orange-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <span class="text-[11px] font-medium text-gray-700">Produk</span>
            </div>
            <div class="flex flex-col items-center gap-2.5 active:opacity-60">
                <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-white shadow-sm shadow-blue-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="text-[11px] font-medium text-gray-700">Keuangan</span>
            </div>
            <div class="flex flex-col items-center gap-2.5 active:opacity-60">
                <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center text-white shadow-sm shadow-green-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m0 0a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <span class="text-[11px] font-medium text-gray-700">Performa</span>
            </div>
            <div class="flex flex-col items-center gap-2.5 active:opacity-60">
                <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center text-white shadow-sm shadow-red-200 relative">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path d="M11 5.882V19.297A1.701 1.701 0 018.997 21a1.71 1.71 0 01-1.492-.78l-4.507-6a1.7 1.7 0 010-2.438l4.507-6c.396-.528.914-.782 1.492-.782a1.7 1.7 0 012.003 1.882z" />
                    </svg>
                    <div class="absolute -top-1 -right-1 w-3 h-3 bg-red-600 rounded-full border-2 border-white"></div>
                </div>
                <span class="text-[11px] font-medium text-gray-700">Promosi</span>
            </div>
        </div>

        <div class="bg-white px-4 py-6 flex justify-around items-center border-t border-gray-100 mb-10">
            <div class="text-[12px] font-bold text-gray-400 hover:text-orange-500 cursor-pointer">Promosi Toko</div>
            <div class="w-[1px] h-4 bg-gray-200"></div>
            <div class="text-[12px] font-bold text-gray-400 hover:text-orange-500 cursor-pointer">Program</div>
            <div class="w-[1px] h-4 bg-gray-200"></div>
            <div class="text-[12px] font-bold text-gray-400 hover:text-orange-500 cursor-pointer">Bantuan</div>
        </div>

        <div class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-[400px] bg-white border-t border-gray-100 h-16 flex justify-around items-center px-2 z-[100]">
            <div class="flex flex-col items-center gap-1 text-gray-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-[10px] font-medium">Beranda</span>
            </div>
            <div class="flex flex-col items-center gap-1 shopee-text">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                </svg>
                <span class="text-[10px] font-medium">Toko Saya</span>
            </div>
            <div class="flex flex-col items-center gap-1 text-gray-400 relative">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <span class="text-[10px] font-medium">Notifikasi</span>
                <span class="absolute top-0 right-1.5 w-2 h-2 bg-red-600 rounded-full border border-white"></span>
            </div>
            <div class="flex flex-col items-center gap-1 text-gray-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="text-[10px] font-medium">Saya</span>
            </div>
        </div>

    </div>

    <script>
        const statusData = [{
                val: 1,
                label: 'Perlu Dikirim'
            },
            {
                val: 0,
                label: 'Pembatalan'
            },
            {
                val: 0,
                label: 'Pengembalian'
            },
            {
                val: 2,
                label: 'Penilaian Dibalas'
            }
        ];

        const container = document.getElementById('status-container');

        statusData.forEach(s => {

            let element;

            if (s.label === "Perlu Dikirim") {
                element = `
        <a href="daftarpesanan.php" class="flex flex-col items-center cursor-pointer active:opacity-60">
            <span class="text-[17px] font-bold text-gray-800 mb-1.5">${s.val}</span>
            <span class="text-[10.5px] text-center text-gray-500 font-medium leading-[1.2]">${s.label}</span>
        </a>
        `;
            } else {
                element = `
        <div class="flex flex-col items-center">
            <span class="text-[17px] font-bold text-gray-800 mb-1.5">${s.val}</span>
            <span class="text-[10.5px] text-center text-gray-500 font-medium leading-[1.2]">${s.label}</span>
        </div>
        `;
            }

            container.innerHTML += element;
        });
    </script>
</body>

</html>