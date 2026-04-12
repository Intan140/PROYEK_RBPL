<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Toko Saya - Detail Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            -webkit-tap-highlight-color: transparent;
        }

        .shopee-bg {
            background-color: #ee4d2d;
        }

        .shopee-text {
            color: #ee4d2d;
        }

        .poppins {
            font-family: 'Poppins', sans-serif;
        }

        .status-card {
            box-shadow: 0 1px 6px rgba(0, 0, 0, 0.08);
        }

        .nav-shadow {
            box-shadow: 0px -2px 10px rgba(0, 0, 0, 0.05);
        }

        #modal-overlay {
            transition: opacity 0.3s ease;
        }

        #modal-container {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            transform: translateY(100%);
        }

        #modal.active #modal-overlay {
            opacity: 1;
            pointer-events: auto;
        }

        #modal.active #modal-container {
            transform: translateY(0);
        }

        .hidden-modal {
            opacity: 0;
            pointer-events: none;
        }

        .label-text {
            color: #030303;
            font-size: 14px;
            font-weight: 700;
        }

        .value-text {
            color: #555555;
            font-size: 14px;
            font-weight: 500;
        }


        input:focus {
            outline: none;
            border-color: #ee4d2d;
            box-shadow: 0 0 0 1px #ee4d2d;
        }
    </style>
</head>

<body class="flex justify-center items-start min-h-screen">

    <div class="w-full max-w-[400px] bg-[#f5f5f5] min-h-screen relative shadow-2xl overflow-hidden flex flex-col">


        <div class="shopee-bg text-white px-5 pt-2 flex justify-between items-center text-[12px] font-medium sticky top-0 z-50">
            <span class="font-semibold">9:41</span>
            <div class="flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 2a1 1 0 011-1h2a1 1 0 011 1v14a1 1 0 01-1 1h-2a1 1 0 01-1-1V2z" />
                </svg>
                <div class="w-5 h-2.5 border border-white/60 rounded-sm relative">
                    <div class="absolute inset-0.5 bg-white w-3/4 rounded-px"></div>
                </div>
            </div>
        </div>


        <div class="shopee-bg text-white px-4 pt-4 pb-4 flex items-center gap-3 sticky top-[24px] z-50">
            <button onclick="window.history.back()" class="p-1 active:opacity-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <h1 class="text-lg font-medium poppins">Ringkasan Produk</h1>
        </div>

        <form action="proses_tambah.php" method="POST" class="flex-1 flex flex-col">
            <div class="flex-1 overflow-y-auto p-3 space-y-3 pb-32">


                <div class="bg-white rounded-lg p-4 status-card flex justify-between items-center gap-3">
                    <div class="flex-1 min-w-0">
                        <h2 class="label-text mb-1.5">Nama Produk</h2>
                        <input type="text" name="nama" id="nama" value="Wireless Headphones"
                            class="value-text w-full border border-gray-200 rounded px-2 py-1.5 bg-gray-50" required>
                    </div>
                    <button type="button" onclick="openModal('Nama Produk', 'nama')"
                        class="shopee-bg text-white px-4 py-2 rounded text-[12px] font-bold shrink-0 mt-6 active:scale-95 transition-transform">
                        Edit
                    </button>
                </div>


                <div class="bg-white rounded-lg p-4 status-card flex justify-between items-center gap-3">
                    <div class="flex-1 min-w-0">
                        <h2 class="label-text mb-1.5">Jumlah</h2>
                        <input type="number" id="jumlah" name="jumlah" value="2"
                            class="value-text w-full border border-gray-200 rounded px-2 py-1.5 bg-gray-50" required>
                    </div>
                    <button type="button" onclick="openModal('Jumlah', 'jumlah')"
                        class="shopee-bg text-white px-4 py-2 rounded text-[12px] font-bold shrink-0 mt-6 active:scale-95 transition-transform">
                        Edit
                    </button>
                </div>


                <div class="bg-white rounded-lg p-4 status-card flex justify-between items-center gap-3">
                    <div class="flex-1 min-w-0">
                        <h2 class="label-text mb-1.5">Berat (kg)</h2>
                        <input type="number" id="berat" name="berat" placeholder="Contoh: 1" step="0.01"
                            class="value-text w-full border border-gray-200 rounded px-2 py-1.5 bg-gray-50" required>
                    </div>
                    <button type="button" onclick="openModal('Berat (kg)', 'berat')"
                        class="shopee-bg text-white px-4 py-2 rounded text-[12px] font-bold shrink-0 mt-6 active:scale-95 transition-transform">
                        Edit
                    </button>
                </div>


                <div class="bg-white rounded-lg p-4 status-card">
                    <div class="flex justify-between items-center mb-3">
                        <h2 class="label-text">Alamat Pengiriman</h2>
                    </div>

                    <div class="border-t border-gray-100 pt-3 space-y-3">
                        <div>
                            <label class="text-[11px] text-gray-500 font-bold uppercase tracking-wider block mb-1">Nama Penerima</label>
                            <input type="text" id="nama_penerima" name="nama_penerima" placeholder="Masukkan nama penerima"
                                class="value-text w-full border border-gray-200 rounded px-2 py-1.5 bg-gray-50" required>
                        </div>

                        <div>
                            <label class="text-[11px] text-gray-500 font-bold uppercase tracking-wider block mb-1">Alamat Lengkap</label>
                            <input type="text" id="alamat" name="alamat" placeholder="Masukkan alamat lengkap"
                                class="value-text w-full border border-gray-200 rounded px-2 py-1.5 bg-gray-50" required>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg p-4 status-card flex justify-between items-center gap-3">
                    <div class="flex-1 min-w-0">
                        <h2 class="label-text mb-1.5">Tanggal Pesan</h2>
                        <input type="date" id="tanggal" name="tanggal"
                            class="value-text w-full border border-gray-200 rounded px-2 py-1.5 bg-gray-50" required>
                    </div>
                    <button type="button" onclick="openModal('Tanggal Pesan', 'tanggal')"
                        class="shopee-bg text-white px-4 py-2 rounded text-[12px] font-bold shrink-0 mt-6 active:scale-95 transition-transform">
                        Edit
                    </button>
                </div>

            </div>

            <div class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-[400px] bg-white border-t p-4 z-40">
                <button type="submit" class="w-full shopee-bg text-white p-3 rounded-lg font-bold shadow-lg shadow-orange-200 active:scale-[0.98] transition-transform">
                    Simpan Pesanan
                </button>
            </div>
        </form>


        <div id="modal" class="fixed inset-0 z-[100] hidden-modal">

            <div id="modal-overlay" class="absolute inset-0 bg-black/60 opacity-0" onclick="closeModal()"></div>

            <div id="modal-container" class="absolute bottom-0 left-0 right-0 bg-white rounded-t-2xl p-6 pb-10 shadow-[0_-5px_20px_rgba(0,0,0,0.15)] max-w-[400px] mx-auto">

                <div class="w-12 h-1.5 bg-gray-200 rounded-full mx-auto mb-6"></div>

                <h3 id="modal-title" class="text-xl font-bold poppins mb-6 text-gray-800">Ubah Data</h3>

                <div class="space-y-6">
                    <div class="relative">
                        <label id="input-label" class="block text-[11px] font-bold text-orange-600 uppercase mb-1 tracking-wider">Nama Produk</label>
                        <input id="modal-input" type="text" class="w-full border-b-2 border-gray-200 py-3 focus:border-orange-500 focus:outline-none text-[16px] text-gray-800 font-medium transition-colors" placeholder="Ketik di sini...">
                    </div>

                    <div class="flex gap-4 pt-4">
                        <button onclick="closeModal()" class="flex-1 py-3.5 text-gray-500 font-bold text-[15px] active:bg-gray-50 rounded-lg transition-colors border border-gray-200">
                            Batal
                        </button>
                        <button onclick="saveChanges()" class="flex-1 py-3.5 shopee-bg text-white font-bold text-[15px] rounded-lg shadow-lg shadow-orange-200 active:scale-95 transition-transform">
                            Terapkan
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        let currentTargetId = '';

        function openModal(title, targetId) {
            const modal = document.getElementById('modal');
            const modalInput = document.getElementById('modal-input');
            const inputLabel = document.getElementById('input-label');
            const modalTitle = document.getElementById('modal-title');

            currentTargetId = targetId;

            modalTitle.innerText = `Ubah ${title}`;
            inputLabel.innerText = title;


            const originalInput = document.getElementById(targetId);
            modalInput.type = originalInput.type;

            modalInput.value = originalInput.value;

            modal.classList.remove('hidden-modal');
            setTimeout(() => modal.classList.add('active'), 10);

            setTimeout(() => modalInput.focus(), 300);
        }

        function closeModal() {
            const modal = document.getElementById('modal');
            modal.classList.remove('active');
            setTimeout(() => modal.classList.add('hidden-modal'), 300);
        }

        function saveChanges() {
            const newValue = document.getElementById('modal-input').value;

            document.getElementById(currentTargetId).value = newValue;

            closeModal();
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeModal();
        });

        document.addEventListener("DOMContentLoaded", function() {
            if (!document.getElementById('tanggal').value) {
                document.getElementById('tanggal').valueAsDate = new Date();
            }
        });
    </script>
</body>

</html>