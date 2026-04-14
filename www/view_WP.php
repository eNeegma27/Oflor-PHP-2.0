<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard Produkcji</title>
  <meta name="ROBOTS" content="none">

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

  <!-- NASZE STYLE -->
  <link rel="stylesheet" href="style/SumOfProd_WP.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="style/Clock.css?v=<?php echo time(); ?>">

</head>
<body>
  <!-- ZEGAR POZA MAINPANEL -->
  <div id="clock-container">
    <div id="clock">
      <div class="clock-line">
        <span id="date"></span>
        <span id="time"></span>
      </div>
    </div>
  </div>

  <!-- DASHBOARD -->
  <div id="app-container">
    <div id="mainpanel">Ładowanie...</div>
  </div>

  <script src="js/_common_WP.js?v=<?php echo time(); ?>"></script>

  <script>
    function updateClock() {
      const now = new Date();
      $('#date').text(now.toLocaleDateString('pl-PL', {
        weekday: 'long', day: 'numeric', month: 'long', year: 'numeric'
      }));
      $('#time').text(now.toLocaleTimeString('pl-PL', {
        hour: '2-digit', minute: '2-digit', second: '2-digit'
      }));
    }
    updateClock();
    setInterval(updateClock, 1000);

    $(document).ready(function() {
      setInterval(ReadConfig, 1000);
    });
  </script>
</body>