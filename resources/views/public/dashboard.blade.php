<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cashier Dashboard with Chart</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.cdnfonts.com/css/sf-pro-display" rel="stylesheet" />

    <style>
      body {
        font-family: 'SF Pro Display', sans-serif;
        overflow: hidden; /* Prevent body scroll */
        height: 100vh;
      }
      /* Custom scrollbar styling */
      .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
      }
      .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1;
      }
      .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 3px;
      }
      .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #555;
      }
      /* Calendar scroll container */
      .calendar-container {
        max-height: 300px;
        overflow-y: auto;
      }
    </style>
  </head>
  <body class="bg-gray-100 flex h-screen">
    <x-navbar-pos-admin class="h-screen sticky top-0"></x-navbar-pos-admin>

    <section class="w-4/5 flex flex-col h-screen overflow-y-auto px-10 pb-10">
      <!-- Header section - fixed -->
      <header class="flex justify-between items-center p-10 bg-gray-100">
        <div>
          <h2 class="text-2xl font-bold">Hello, Bblar'a! 👋</h2>
          <p class="text-gray-600">Ini adalah apa yang terjadi pada penyimpanan mu saat ini</p>
        </div>
        <div>
          <button class="bg-blue-700 text-white px-4 py-2 rounded">Export To Excel</button>
        </div>
      </header>

      <!-- Scrollable content -->
      <div>
        <div class="flex gap-6">
          <div class="w-full grid grid-cols-2 gap-6">
            <div class="bg-yellow-400 text-white p-8 shadow rounded-tl-[35px] rounded-tr-[35px] rounded-bl-[35px]">
              <h3 class="text-lg font-semibold">Total pendapatan</h3>
              <p class="text-2xl font-bold">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
              <p class="text-sm">Total pendapatan saat ini</p>
            </div>
            <div class="bg-white p-8 shadow rounded-tl-[35px] rounded-tr-[35px] rounded-bl-[35px]">
              <h3 class="text-lg font-semibold">Total Transaksi</h3>
              <p class="text-2xl font-bold">{{ $totalTransaksi }}</p>
              <p class="text-sm text-gray-600">Total order saat ini</p>
            </div>
            <div class="bg-white p-8 shadow rounded-tl-[35px] rounded-tr-[35px] rounded-bl-[35px]">
              <h3 class="text-lg font-semibold">Total Modal</h3>
              <p class="text-2xl font-bold">Rp {{ number_format($totalModal, 0, ',', '.') }}</p>
              <p class="text-sm text-gray-600">Total modal saat ini</p>
            </div>
            <div class="bg-white p-8 shadow rounded-tl-[35px] rounded-tr-[35px] rounded-bl-[35px]">
              <h3 class="text-lg font-semibold">Total Keuntungan</h3>
              <p class="text-2xl font-bold">Rp {{ number_format($totalKeuntungan, 0, ',', '.') }}</p>
              <p class="text-sm text-gray-600">Total keuntungan saat ini</p>
            </div>          
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">
          <!-- Calendar Section -->
          <div class="bg-gray-100 flex items-start justify-center w-full">
            <div class="w-full bg-white shadow-lg rounded-lg overflow-hidden">
              <div class="flex items-center justify-between px-6 py-3 bg-gray-700 sticky top-0 z-10">
                <button id="prevMonth" class="text-white">Previous</button>
                <h2 id="currentMonth" class="text-white"></h2>
                <button id="nextMonth" class="text-white">Next</button>
              </div>
              <div class="calendar-container custom-scrollbar">
                <div class="grid grid-cols-7 gap-2 p-4" id="calendar"></div>
              </div>
            </div>
          </div>
        
          <!-- Bar Chart Section -->
          <div class="flex items-center justify-center w-full">
            <div class="w-full bg-white shadow-lg rounded-lg p-6">
              <h3 class="text-lg font-semibold mb-4">Statistik</h3>
              <div class="w-full h-[255px]">
                <canvas id="barChart"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script>
      function generateCalendar(year, month) {
        const calendarElement = document.getElementById('calendar');
        const currentMonthElement = document.getElementById('currentMonth');

        const firstDayOfMonth = new Date(year, month, 1);
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        calendarElement.innerHTML = '';

        const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        currentMonthElement.innerText = `${monthNames[month]} ${year}`;

        const firstDayOfWeek = firstDayOfMonth.getDay();

        const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        daysOfWeek.forEach(day => {
          const dayElement = document.createElement('div');
          dayElement.className = 'text-center font-semibold sticky top-0 bg-white';
          dayElement.innerText = day;
          calendarElement.appendChild(dayElement);
        });

        for (let i = 0; i < firstDayOfWeek; i++) {
          const emptyDayElement = document.createElement('div');
          calendarElement.appendChild(emptyDayElement);
        }

        for (let day = 1; day <= daysInMonth; day++) {
          const dayElement = document.createElement('div');
          dayElement.className = 'text-center py-2 border cursor-pointer hover:bg-gray-100';
          dayElement.innerText = day;

          const currentDate = new Date();
          if (year === currentDate.getFullYear() && month === currentDate.getMonth() && day === currentDate.getDate()) {
            dayElement.classList.add('bg-blue-500', 'text-white', 'hover:bg-blue-600');
          }

          calendarElement.appendChild(dayElement);
        }
      }

      const currentDate = new Date();
      let currentYear = currentDate.getFullYear();
      let currentMonth = currentDate.getMonth();
      generateCalendar(currentYear, currentMonth);

      document.getElementById('prevMonth').addEventListener('click', () => {
        currentMonth--;
        if (currentMonth < 0) {
          currentMonth = 11;
          currentYear--;
        }
        generateCalendar(currentYear, currentMonth);
      });

      document.getElementById('nextMonth').addEventListener('click', () => {
        currentMonth++;
        if (currentMonth > 11) {
          currentMonth = 0;
          currentYear++;
        }
        generateCalendar(currentYear, currentMonth);
      });

      // Bar Chart Data
      const ctx = document.getElementById('barChart').getContext('2d');
      const barChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: ['Pendapatan', 'Modal', 'Keuntungan'],
              datasets: [
                  {
                      label: 'Statistik',
                      data: [{{ $totalPemasukan }}, {{ $totalModal }}, {{ $totalKeuntungan }}],
                      backgroundColor: [
                          'rgba(255, 206, 86, 0.6)',
                          'rgba(75, 192, 192, 0.6)',
                          'rgba(255, 99, 132, 0.6)'
                      ],
                      borderColor: [
                          'rgba(255, 206, 86, 1)',
                          'rgba(75, 192, 192, 1)',
                          'rgba(255, 99, 132, 1)'
                      ],
                      borderWidth: 1
                  }
              ]
          },
          options: {
              responsive: true,
              maintainAspectRatio: false,
              scales: {
                  y: {
                      beginAtZero: true,
                      ticks: {
                          callback: function(value) {
                              return 'Rp ' + value.toLocaleString('id-ID');
                          }
                      }
                  }
              },
              plugins: {
                  tooltip: {
                      callbacks: {
                          label: function(context) {
                              return 'Rp ' + context.raw.toLocaleString('id-ID');
                          }
                      }
                  }
              }
          }
      });
    </script>
  </body>
</html>
