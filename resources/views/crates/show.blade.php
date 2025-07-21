@extends('base.base')
@section('noheader')
@endsection

@section('nofooter')
@endsection

@section('content')
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Gacha</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      background: linear-gradient(to bottom, #0d0c1d, #1d1d35);
      color: white;
      font-family: sans-serif;
      text-align: center;
      overflow-x: hidden;
    }
    h1 {
      color: gold;
      font-size: 2.5rem;
      margin: 20px 0;
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 12px;
    }
    h1::before {
      content: "\2728";
      font-size: 1.5rem;
    }
    .crate-container {
      width: 100%;
      max-width: 100vw;
      margin: auto;
      position: relative;
      padding: 0 10px;
    }
    .crate {
      position: relative;
      width: 100%;
      max-width: 1400px;
      aspect-ratio: 14 / 3;
      border: 0.7vw solid gold;
      overflow: hidden;
      background-color: #1e1e2e;
      border-radius: 10px;
      margin: auto;
    }
    .item-strip {
      display: flex;
      gap: 0.7vw;
      position: absolute;
      top: 5%;
      transform: translateY(-50%);
      will-change: transform;
      left: 0;
    }
    .item {
      width: clamp(75px, 20vw, 155vw);
      height: clamp(120px, 20vw, 250px);
      background-color: #fff;
      color: black;
      border-radius: 8px;
      display: flex;
      justify-content: center;
      align-items: center;
      font-weight: bold;
      font-size: 1.1rem;
      user-select: none;
    }
    .center-line {
      position: absolute;
      top: 0;
      bottom: 0;
      width: 4px;
      background: red;
      left: 50%;
      transform: translateX(-50%);
      z-index: 10;
    }
   .open {
      margin-top: 30px;
      padding: 14px 36px;
      font-size: 18px;
      background: linear-gradient(45deg, gold, #ffcc00);
      border: 2px solid #fff;
      border-radius: 12px;
      color: #000;
      font-weight: bold;
      box-shadow: 0 0 18px 6px rgba(255, 215, 0, 0.7), 0 0 40px 8px rgba(255, 255, 255, 0.2) inset;
      cursor: pointer;
      animation: pulseGlow 1.2s infinite ease-in-out;
      transition: transform 0.2s ease, background 0.3s ease;
    }

    .open:hover {
      transform: scale(1.08);
      background: linear-gradient(45deg, #fff566, #ffd700);
      box-shadow: 0 0 24px 10px rgba(255, 255, 0, 0.9);
    }

    .result {
      margin-top: 20px;
      font-size: 20px;
    }
    .crate-glow-1 { border: 0.7vw solid #555; }
    .crate-glow-2 { border: 0.7vw solid #2d5d9f; box-shadow: 0 0 10px 3px rgba(45, 93, 159, 0.5); }
    .crate-glow-3 { border: 0.7vw solid #8932a8; animation: glow-purple 1s infinite alternate; }
    .crate-glow-4 { border: 0.7vw solid #ff9933; animation: glow-orange 1s infinite alternate; }
    .crate-glow-5 { border: 0.7vw solid gold; animation: glow-gold 1s infinite alternate; }
    @keyframes glow-purple {
      from { box-shadow: 0 0 12px 4px rgba(137, 50, 168, 0.6); }
      to   { box-shadow: 0 0 24px 10px rgba(137, 50, 168, 0.9); }
    }
    @keyframes glow-orange {
      from { box-shadow: 0 0 15px 5px rgba(255, 153, 51, 0.5); }
      to   { box-shadow: 0 0 30px 12px rgba(255, 153, 51, 0.8); }
    }
    @keyframes glow-gold {
      from { box-shadow: 0 0 20px 8px rgba(255, 215, 0, 0.6); }
      to   { box-shadow: 0 0 40px 15px rgba(255, 215, 0, 0.9); }
    }
    .item-content {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100%;
      width: 100%;
      text-align: center;
      padding: 6px;
    }
    .item-img {
      width: clamp(50px, 20vw, 11vw);
      height: clamp(50px, 20vw, 11vw);
      object-fit: contain;
      margin-top:10px;
      margin-bottom: 4px;
    }
    .item-label {
      font-size: clamp(0.6rem, 1.2vw, 2rem); /* fleksibel sesuai ukuran layar */
      text-align: center;
      color: #000;
      font-weight: bold;
      margin-top: 4px;
      line-height: 1.2;
      word-break: break-word;
    }
    @media (max-width: 768px) {
      h1 {
        font-size: 1.5rem;
      }

      .item {
        font-size: 0.85rem;
      }

      .crate {
        aspect-ratio: 14 / 5; /* dari 14 / 3 → menjadi lebih tinggi */
      }

      button {
        font-size: 13px;
        padding: 10px 20px;
      }
    }
    #backButton {
      position: absolute;
      top: 10px; /* cukup jauh dari header */
      left: 20px;
      font-weight: bold;
      padding: 10px 18px;
      font-size: 16px;
      background-color: #ffc107;
      color: #000;
      border: none;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
      text-decoration: none;
      z-index: 999;
      transition: transform 0.2s ease, background-color 0.3s ease;
    }

    #backButton:hover {
      transform: scale(1.05);
      background-color: #ffdd33;
    }

    @media (max-width: 768px) {
      #backButton {
        top: 70px;
        left: 12px;
        font-size: 13px;
        padding: 6px 14px;
      }
    }



  </style>
</head>

<body>
  <a href="{{ url('/crates') }}" id="backButton">← Back</a>
  <h1>{{ $crate->name }}</h1>
  <div class="crate-container">
    <div class="crate" id="crate">
      <div class="item-strip" id="itemStrip"></div>
      <div class="center-line"></div>
    </div>
  </div>
  <button id="startButton" class="open" onclick="attemptOpenCrate({{ $crate->id }})">Open Crate</button>

  <div class="result" id="result"></div>
  <div id="gachaResult"></div> <!-- Tambahan untuk efek reward -->

  <!-- Popup fullscreen hasil gacha -->
  <!-- Popup fullscreen hasil gacha -->
<div id="gachaPopup" style="
  position: fixed;
  top:0; left:0; right:0; bottom:0;
  background: rgba(0,0,0,0.9);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
  visibility: hidden;
  opacity: 0;
  transition: opacity 0.3s ease;
">
  <div style="
    background:#222;
    padding: 20px;
    border-radius: 12px;
    text-align: center;
    max-width: 90vw;
    max-height: 90vh;
    box-shadow: 0 0 40px gold;
    animation: zoomIn 0.4s ease forwards;
  ">
    <img id="popupImage" src="" alt="Hadiah" style="
      max-width: 100%;
      max-height: 60vh;
      object-fit: contain;
      border-radius: 10px;
      margin-bottom: 15px;
    ">
    <h2 id="popupTitle" style="
      color: gold;
      font-family: 'Press Start 2P', monospace;
      margin-bottom: 8px;
    ">Hadiah</h2>
    <p id="popupDesc" style="color: #fff; font-weight: bold; margin-bottom: 15px;">Deskripsi hadiah</p>
    
    <div style="display: flex; justify-content: center; gap: 10px;">
      <button onclick="closePopup()" style="
        padding: 10px 24px;
        background: gold;
        color: black;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        font-family: monospace;
        box-shadow: 0 0 12px gold;
        transition: background-color 0.2s ease;
      " onmouseover="this.style.background='#d4af37'" onmouseout="this.style.background='gold'">Close</button>

      <a href="/gacha-history" id="historyButton" style="
        display: none;
        padding: 10px 24px;
        background: #00f0ff;
        color: black;
        border-radius: 8px;
        font-weight: bold;
        text-decoration: none;
        font-family: monospace;
        box-shadow: 0 0 12px #00f0ff;
        transition: background-color 0.2s ease;
      " onmouseover="this.style.background='#00c6cc'" onmouseout="this.style.background='#00f0ff'">Cek History</a>
    </div>
  </div>
</div>


  <style>
    @keyframes zoomIn {
      from {
        transform: scale(0.7);
        opacity: 0;
      }
      to {
        transform: scale(1);
        opacity: 1;
      }
    }
  </style>

{{--############################################################################################################################################## --}}
  <script>

    const crate = {
        name: @json($crate->name),
        item1_name: @json($crate->item1_name),
        item2_name: @json($crate->item2_name),
        item3_name: @json($crate->item3_name),
        item4_name: @json($crate->item4_name),
        item5_name: @json($crate->item5_name),

        item1_image: @json($crate->item1_image),
        item2_image: @json($crate->item2_image),
        item3_image: @json($crate->item3_image),
        item4_image: @json($crate->item4_image),
        item5_image: @json($crate->item5_image),

        item1_rate: @json($crate->item1_rate),
        item2_rate: @json($crate->item2_rate),
        item3_rate: @json($crate->item3_rate),
        item4_rate: @json($crate->item4_rate),
        item5_rate: @json($crate->item5_rate),
    };
    function goBack() {
      window.location.href = "/crates";
    }
    let barang1=crate.item1_name;
    let barang2=crate.item2_name;
    let barang3=crate.item3_name;
    let barang4=crate.item4_name;
    let barang5=crate.item5_name;
    let gambar_barang1 = crate.item1_image;
    let gambar_barang2 = crate.item2_image;
    let gambar_barang3 = crate.item3_image;
    let gambar_barang4 = crate.item4_image;
    let gambar_barang5 = crate.item5_image;
    let item1= `
    <div class="item-content">
      <img src="/Images/${gambar_barang1}" class="item-img">
      <div class="item-label">${barang1}</div>
    </div>`;
    let item2= `
    <div class="item-content">
      <img src="/Images/${gambar_barang2}" class="item-img">
      <div class="item-label">${barang2}</div>
    </div>`;
    let item3= `
    <div class="item-content">
      <img src="/Images/${gambar_barang3}" class="item-img">
      <div class="item-label">${barang3}</div>
    </div>`;
    let item4= `
    <div class="item-content">
      <img src="/Images/${gambar_barang4}" class="item-img">
      <div class="item-label">${barang4}</div>
    </div>`;
    let item5= `
    <div class="item-content">
      <img src="/Images/${gambar_barang5}" class="item-img">
      <div class="item-label">${barang5}</div>
    </div>`;
    const items = [item1, item2, item3, item4, item5];
    const itemStrip = document.getElementById('itemStrip');
    const resultBox = document.getElementById('result');
    let allItems = [];

    function setupStrip() {
      allItems = [];
      for (let i = 0; i < 30; i++) {
        allItems = allItems.concat(items);
      }
      let html = '';
      allItems.forEach(item => {
        html += `<div class="item">${item}</div>`;
      });
      itemStrip.innerHTML = html;
    }

    function gacha(level) {
      const crate = document.getElementById("crate");
      const rewardBox = document.getElementById("gachaResult");

      // Reset efek
      crate.className = "crate"; // reset semua class sebelumnya

      // Tambahkan class efek glow sesuai level
      crate.classList.add(`crate-glow-${level}`, 'fade-in');
    }

    function resetCrateGlow() {
      const crate = document.getElementById("crate");

      // Reset semua class, tapi tetap pertahankan class "crate"
      crate.className = "crate";
    }

    // --- Popup fullscreen result ---
    const gachaPopup = document.getElementById('gachaPopup');
    const popupImage = document.getElementById('popupImage');
    const popupTitle = document.getElementById('popupTitle');
    const popupDesc = document.getElementById('popupDesc');
    const startButton = document.getElementById('startButton');
    const backButton = document.getElementById('backButton');

    function openPopup(item) {
      popupImage.src = `/Images/${item.gambar}`;
      popupTitle.textContent = item.label;
      popupDesc.textContent = item.description;
      gachaPopup.style.visibility = 'visible';
      gachaPopup.style.opacity = '1';

      // Tampilkan tombol history
      document.getElementById("historyButton").style.display = "inline-block";

      // Disable tombol agar tidak klik saat popup
      startButton.disabled = true;
      backButton.disabled = true;
      startButton.style.opacity = "0.5";
      backButton.style.opacity = "0.5";
      startButton.style.cursor = "not-allowed";
      backButton.style.cursor = "not-allowed";
    }


    function closePopup() {
      gachaPopup.style.opacity = '0';
      setTimeout(() => {
        gachaPopup.style.visibility = 'hidden';

        // Sembunyikan tombol history kembali
        document.getElementById("historyButton").style.display = "none";

        // Enable tombol kembali
        startButton.disabled = false;
        backButton.disabled = false;
        startButton.style.opacity = "1";
        backButton.style.opacity = "1";
        startButton.style.cursor = "pointer";
        backButton.style.cursor = "pointer";
      }, 300);
    }


    // Data detail hadiah untuk popup
    const itemsData = [
      { label: barang1, gambar: gambar_barang1 },
      { label: barang2, gambar: gambar_barang2 },
      { label: barang3, gambar: gambar_barang3 },
      { label: barang4, gambar: gambar_barang4 },
      { label: barang5, gambar: gambar_barang5 },
    ];
    function attemptOpenCrate(crateId) {
      fetch(`/crate/unlock/${crateId}`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          startGacha(); // <== ini WAJIB ADA agar animasi jalan & history terkirim
        } else {
          if (data.message.includes("key")) {
            if (confirm("❌ Kamu tidak memiliki key untuk membuka crate ini.\n\nIngin membeli key sekarang?")) {
              window.location.href = "/store";
            }
          } else {
            alert(data.message);
          }
        }
      })

      .catch(error => {
        alert("Terjadi kesalahan. Silakan coba lagi.");
        console.error(error);
      });
    }

    // Override startGacha agar panggil openPopup sesuai hadiah
    function startGacha() {
      stopPreviewLoop();
      const button = document.getElementById("startButton");
      const back = document.getElementById("backButton");
      back.disabled = true;
      back.style.opacity = "0.5";
      back.style.cursor = "not-allowed";
      button.disabled = true;
      button.style.opacity = "0.5";
      button.style.cursor = "not-allowed";
      resetCrateGlow();

      let hadiah1 = Number(crate.item1_rate);
      let hadiah2 = Number(crate.item2_rate);
      let hadiah3 = Number(crate.item3_rate);
      let hadiah4 = Number(crate.item4_rate);
      let hadiah5 = Number(crate.item5_rate);


      hadiah2 = hadiah1 + hadiah2;
      hadiah3 = hadiah2 + hadiah3;
      hadiah4 = hadiah3 + hadiah4;
      hadiah5 = hadiah4 + hadiah5;

      setupStrip();
      resultBox.innerText = '';
      document.getElementById("gachaResult").innerHTML = ''; // reset efek sebelumnya

      let rate = Math.floor(Math.random() * 100) + 1;
      let pos = 0;
      let hadiah = 0;
      let nama_hadiah = '';
      let chosenIndex = 0;

      if (rate >= 1 && rate <= hadiah1) {
        pos = 1;
        nama_hadiah = itemsData[0].label;
        hadiah = 1;
        chosenIndex = 0;
      } else if (rate > hadiah1 && rate <= hadiah2) {
        pos = 800;
        nama_hadiah = itemsData[1].label;
        hadiah = 2;
        chosenIndex = 1;
      } else if (rate > hadiah2 && rate <= hadiah3) {
        pos = 1650;
        nama_hadiah = itemsData[2].label;
        hadiah = 3;
        chosenIndex = 2;
      } else if (rate > hadiah3 && rate <= hadiah4) {
        pos = 350;
        nama_hadiah = itemsData[3].label;
        hadiah = 4;
        chosenIndex = 3;
      } else if (rate > hadiah4 && rate <= hadiah5) {
        pos = 150;
        nama_hadiah = itemsData[4].label;
        hadiah = 5;
        chosenIndex = 4;
      }

      let speed = 40;
      let phase = 1;
      

      function animate() {
        pos -= speed;
        itemStrip.style.transform = `translateX(${pos / 10}vw)`;

        if (phase === 1 && speed <= 20) phase = 2;
        else if (phase === 2 && speed <= 7) phase = 3;

        if (phase === 1) speed -= 0.25;
        else if (phase === 2) speed -= 0.08;
        else if (phase === 3) speed -= 0.02;
        if (speed < 10) {
          gacha(hadiah);
        }
        if (speed > 0.3) {
          requestAnimationFrame(animate);
        } else {
          openPopup(itemsData[chosenIndex]);
          console.log({
            crate_id: {{ $crate->id }},
            item_name: itemsData[chosenIndex].label,
            item_image: itemsData[chosenIndex].gambar,
            rate: Number(crate[`item${hadiah}_rate`])
          });
          console.log("DATA YANG DIKIRIM:", {
            crate_id: {{ $crate->id }},
            item_name: itemsData[chosenIndex].label,
            item_image: itemsData[chosenIndex].gambar,
            rate: Number(crate[`item${hadiah}_rate`])
          });

          fetch('/crate/store-history', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
              crate_id: {{ $crate->id }},
              item_name: itemsData[chosenIndex].label,
              item_image: itemsData[chosenIndex].gambar,
              rate: Number(crate[`item${hadiah}_rate`])
            })
          })
          .then(response => response.json())
          .then(data => {
            if (!data.success) {
              console.error('Gagal simpan history:', data.message);
              return;
            }

            if (data.crate_inactive) {
              alert("Crate sudah habis dan Terimakasih sudah bermain :)");
              window.location.href = "/crates";
              return;
            }

            button.disabled = false;
            button.style.opacity = "1";
            button.style.cursor = "pointer";
            back.disabled = false;
            back.style.opacity = "1";
            back.style.cursor = "pointer";
          })

        }
      }
      animate();
    }
    // === Preview Loop Sebelum Tombol Ditekan ===
    let previewRunning = true;
    let previewOffset = 0;

    function startPreviewLoop() {
      const loopSpeed = 0.4;
      function loop() {
        if (previewRunning) {
          previewOffset -= loopSpeed;
          itemStrip.style.transform = `translateX(${previewOffset / 10}vw)`;
          requestAnimationFrame(loop);
        }
      }
      setupStrip(); // tampilkan item
      loop();
    }

    function stopPreviewLoop() {
      previewRunning = false;
    }
    window.addEventListener('DOMContentLoaded', () => {
      startPreviewLoop();
    });

  </script>
</body>
</html>
@endsection