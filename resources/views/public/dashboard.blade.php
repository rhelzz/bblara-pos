<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cashier Dashboard with FullCalendar</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FullCalendar CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css"
    />

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <!-- Fonts -->
    <link href="https://fonts.cdnfonts.com/css/sf-pro-display" rel="stylesheet" />

    <style>
      body {
        font-family: 'SF Pro Display', sans-serif;
      }
      /* Styling untuk kalender */
      #calendar {
        border: 1px solid #e5e7eb; /* Border abu-abu ringan */
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Bayangan */
      }
      .fc-toolbar-title {
        font-size: 1.25rem;
        font-weight: bold;
        color: #374151;
      }
      .fc-button {
        background-color: #3b82f6;
        color: white;
        border: none;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 0.875rem;
        font-weight: 600;
      }
      .fc-button:hover {
        background-color: #2563eb;
      }
      .fc-daygrid-day:hover {
        background-color: #facc15; /* Kuning */
        color: white;
        border-radius: 4px;
        cursor: pointer;
      }
      .fc-day-today {
        background-color: #e0f2fe !important; /* Biru muda */
      }
    </style>
  </head>
  <body class="bg-gray-100 flex">
    <x-navbar-pos></x-navbar-pos>

    <section class="w-4/5 px-10 py-10">
      <!-- Header -->
      <header class="flex justify-between items-center mb-6">
        <div>
          <h2 class="text-2xl font-bold">Hello, Bblar'a! 👋</h2>
          <p class="text-gray-600">Ini adalah apa yang terjadi pada penyimpanan mu saat ini</p>
        </div>
        <div>
          <button class="bg-blue-700 text-white px-4 py-2 rounded">Export To Excel</button>
        </div>
      </header>

      <!-- Main Content -->
      <div class="flex gap-6">
        <!-- Cards Section -->
        <div class="w-3/4 grid grid-cols-2 gap-6">
          <div class="bg-yellow-400 text-white p-6 rounded-lg">
            <h3 class="text-lg font-semibold">Total pendapatan</h3>
            <p class="text-2xl font-bold">Rp 4.936.500</p>
            <p class="text-sm">Total pendapatan saat ini</p>
          </div>
          <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold">Total Order</h3>
            <p class="text-2xl font-bold">104</p>
            <p class="text-sm text-gray-600">Total order saat ini</p>
          </div>
          <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold">Total Pengunjung</h3>
            <p class="text-2xl font-bold">4.536</p>
            <p class="text-sm text-gray-600">Total pengunjung saat ini</p>
          </div>
          <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold">Total keuntungan</h3>
            <p class="text-2xl font-bold">Rp 836.900</p>
            <p class="text-sm text-gray-600">Total keuntungan saat ini</p>
          </div>
        </div>

        <!-- Calendar Section -->
        <div class="w-1/4 bg-white p-6 rounded-lg shadow">
          <h3 class="text-lg font-semibold mb-4">Calendar</h3>
          <div id="calendar" class="mt-4"></div>
        </div>
      </div>
    </section>

    <script>
      // Inisialisasi FullCalendar
      document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');

        const calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth', // Tipe tampilan default
          headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay',
          },
          dateClick: function (info) {
            // Tampilkan tanggal yang diklik
            alert(`Tanggal yang diklik: ${info.dateStr}`);
          },
        });

        calendar.render();
      });
    </script>
  </body>
</html>
