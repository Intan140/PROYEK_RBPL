<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Scan Barcode - SIM Logistik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            -webkit-tap-highlight-color: transparent;
        }

        .shopee-bg {
            background-color: #F66341;
        }

        .shopee-text {
            color: #F66341;
        }

        .glass-card {
            background: white;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.05);
            border-radius: 20px;
            border: 1px solid rgba(0, 0, 0, 0.03);
        }

        .scanner-container {
            position: relative;
            background: linear-gradient(45deg, #F66341, #ff8c6d);
            border-radius: 24px;
            overflow: hidden;
            border: 4px solid white;
            box-shadow: 0 10px 25px -5px rgba(246, 99, 65, 0.3);
        }

        .scanner-line {
            position: absolute;
            width: 100%;
            height: 4px;
            background: white;
            box-shadow: 0 0 20px 5px rgba(255, 255, 255, 0.8);
            top: 0;
            animation: scan 2.5s infinite ease-in-out;
        }

        @keyframes scan {

            0%,
            100% {
                top: 5%;
            }

            50% {
                top: 95%;
            }
        }

        .scanner-overlay {
            position: absolute;
            inset: 0;
            background: radial-gradient(circle, transparent 40%, rgba(0, 0, 0, 0.1) 100%);
            pointer-events: none;
        }
    </style>
</head>

<body class="flex justify-center items-start min-h-screen">
    <div class="w-full max-w-[400px] bg-[#f8fafc] min-h-screen relative shadow-2xl overflow-hidden flex flex-col border-x border-gray-100">

        <div class="shopee-bg w-full shrink-0 relative z-10 text-white shadow-md">
            <div class="w-full h-[40px] px-6 flex justify-between items-center opacity-80">
                <span class="text-[14px] font-semibold">9:41</span>
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="white" viewBox="0 0 20 20">
                        <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 2a1 1 0 011-1h2a1 1 0 011 1v14a1 1 0 01-1 1h-2a1 1 0 01-1-1V2z" />
                    </svg>
                    <div class="w-5 h-2.5 border border-white/60 rounded-sm relative">
                        <div class="absolute inset-0.5 bg-white w-3/4 rounded-px"></div>
                    </div>
                </div>
            </div>

            <div class="px-6 py-5 flex items-center gap-4">
                <button onclick="window.history.back()" class="w-10 h-10 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center active:scale-90 transition-all">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                        <path d="M15 18l-6-6 6-6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <h1 class="text-[20px] font-bold tracking-tight text-white">Scan Barcode</h1>
                <button onclick="simulasiInput()" class="ml-auto text-[10px] bg-white text-[#F66341] px-3 py-1.5 rounded-lg font-bold uppercase tracking-wider">Manual</button>
            </div>
        </div>

        <div class="flex-1 px-6 pt-6 pb-32 overflow-y-auto">
            <div class="scanner-container w-full h-[260px] flex items-center justify-center mb-8">
                <div class="scanner-overlay"></div>
                <div class="z-10 bg-white/20 p-5 rounded-3xl backdrop-blur-md border border-white/40">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                        <path d="M3 7V5a2 2 0 012-2h2M17 3h2a2 2 0 012 2v2M21 17v2a2 2 0 01-2 2h-2M7 21H5a2 2 0 01-2-2v-2" stroke-linecap="round" stroke-linejoin="round" />
                        <rect x="9" y="9" width="6" height="6" rx="1" fill="white" fill-opacity="0.2" />
                    </svg>
                </div>
                <div class="scanner-line"></div>
            </div>

            <div class="glass-card p-6 space-y-5">
                <div class="flex justify-between items-start border-b border-gray-50 pb-4">
                    <div>
                        <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-1">Nomor Resi</p>
                        <h3 id="id_paket" class="text-gray-900 font-extrabold text-[16px] shopee-text leading-none tracking-tight">Belum di-scan</h3>
                    </div>
                    <div id="status_badge" class="hidden bg-orange-100 text-[#F66341] px-3 py-1 rounded-full text-[10px] font-bold uppercase">Ready</div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-1">Penerima</p>
                        <p id="penerima" class="text-gray-800 font-semibold text-[14px]">-</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-1">Jumlah</p>
                        <p id="jumlah" class="text-gray-800 font-semibold text-[14px]">-</p>
                    </div>
                </div>

                <div>
                    <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-1">Detail Produk</p>
                    <p id="deskripsi" class="text-gray-800 font-semibold text-[14px] leading-snug">-</p>
                </div>

                <div class="bg-orange-50/50 p-4 rounded-2xl border border-orange-100/50">
                    <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-2">Alamat Tujuan</p>
                    <div class="flex gap-2">
                        <svg class="w-4 h-4 text-[#F66341] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        </svg>
                        <p id="alamat" class="text-gray-600 text-[12px] font-medium leading-relaxed">-</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-[400px] bg-white/80 backdrop-blur-lg p-6 flex gap-3 border-t border-gray-100 z-30">
            <button onclick="location.reload()" class="flex-1 h-[54px] bg-gray-50 text-gray-400 font-bold rounded-2xl active:scale-95 transition-all flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
            </button>
            <button id="btnSimpan" disabled class="flex-[3] h-[54px] shopee-bg text-white font-bold rounded-2xl shadow-lg shadow-orange-200 disabled:opacity-40 disabled:shadow-none active:scale-95 transition-all uppercase tracking-widest text-sm">
                Pick Up Paket
            </button>
        </div>
    </div>

    <script>
        let currentResi = "";

        function simulasiInput() {
            const resi = prompt("Masukkan Nomor Resi:");
            if (resi) ambilDataResi(resi);
        }

        function ambilDataResi(resi) {
            currentResi = resi;
            const btn = document.getElementById('btnSimpan');
            const badge = document.getElementById('status_badge');

            document.getElementById('id_paket').innerText = "Mencari...";

            fetch('ambildata.php?id_resi=' + resi)
                .then(res => {
                    if (!res.ok) throw new Error("HTTP Error: " + res.status);
                    return res.json();
                })
                .then(data => {
                    if (data && !data.error) {
                        document.getElementById('id_paket').innerText = data.resi;
                        document.getElementById('penerima').innerText = data.nama_penerima || '-';
                        document.getElementById('alamat').innerText = data.alamat || '-';
                        document.getElementById('deskripsi').innerText = data.nama_produk || '-';
                        document.getElementById('jumlah').innerText = data.jumlah ? data.jumlah + " pcs" : '-';
                        btn.disabled = false;
                        badge.classList.remove('hidden');
                    } else {
                        resetUI();
                        alert("Resi tidak ditemukan atau sudah diproses.");
                    }
                })
                .catch(err => {
                    resetUI();
                    console.error("Debug Info:", err);
                    alert("⚠Masalah Koneksi:\n" + err.message + "\n\nSolusi:\n1. Pastikan file 'ambil_data.php' ada di folder kurir_pickup.\n2. Nyalakan Apache di XAMPP.");
                });
        }

        function resetUI() {
            currentResi = "";
            document.getElementById('id_paket').innerText = "Belum di-scan";
            document.getElementById('penerima').innerText = "-";
            document.getElementById('alamat').innerText = "-";
            document.getElementById('deskripsi').innerText = "-";
            document.getElementById('jumlah').innerText = "-";
            document.getElementById('btnSimpan').disabled = true;
            document.getElementById('status_badge').classList.add('hidden');
        }

        document.getElementById('btnSimpan').addEventListener('click', function() {
            if (!currentResi) return;

            this.innerText = "MEMPROSES...";
            this.disabled = true;

            const formData = new URLSearchParams();
            formData.append('id_resi', currentResi);

            fetch('proses_pickup.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: formData
                })
                .then(res => {
                    if (!res.ok) throw new Error("HTTP Error: " + res.status);
                    return res.text();
                })
                .then(res => {
                    if (res.trim() === "berhasil") {
                        alert("Berhasil! Paket telah diterima kurir.");
                        window.location.href = 'listpengantaran.php';
                    } else {
                        alert("⚠Pesan Server: " + res);
                        this.innerText = "PICK UP PAKET";
                        this.disabled = false;
                    }
                })
                .catch(err => {
                    console.error("Save Error:", err);
                    alert("Gagal menyimpan data: " + err.message);
                    this.disabled = false;
                    this.innerText = "PICK UP PAKET";
                });
        });
    </script>
</body>

</html>
