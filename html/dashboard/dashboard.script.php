  <script src="assets/weather-widget.js"></script>
  
  <!-- Inicialización con IIFE para evitar conflictos -->
  <script>
    (function() {
      const widget = new WeatherWidget('#weather-widget', {
        provincia: '29',
        municipio: '29094'
      });
      widget.load();
    })();
  </script>
