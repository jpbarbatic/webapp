class WeatherWidget {
  constructor(containerSelector, options = {}) {
    this.container = document.querySelector(containerSelector);
    
    if (!this.container) {
      console.error('❌ No se encontró el contenedor:', containerSelector);
      return;
    }
    
    this.provincia = options.provincia || '29';
    this.municipio = options.municipio || '29094';
    this.data = null;
    
    this.weatherIcons = {
      '11': 'wi-day-sunny',
      '11n': 'wi-night-clear',
      '12': 'wi-day-sunny-overcast',
      '12n': 'wi-night-alt-partly-cloudy',
      '13': 'wi-day-sunny-overcast',
      '14': 'wi-cloudy',
      '15': 'wi-cloudy',
      '15n': 'wi-night-alt-cloudy',
      '16': 'wi-cloudy',
      '16n': 'wi-night-alt-cloudy',
      '17': 'wi-day-cloudy-high',
      '21': 'wi-fog',
      '22': 'wi-fog',
      '23': 'wi-dust',
      '24': 'wi-day-cloudy',
      '25': 'wi-day-cloudy',
      '26': 'wi-rain',
      '27': 'wi-rain',
      '31': 'wi-day-rain',
      '32': 'wi-day-rain',
      '33': 'wi-rain',
      '34': 'wi-rain',
      '35': 'wi-thunderstorm',
      '36': 'wi-thunderstorm',
      '41': 'wi-day-rain',
      '42': 'wi-day-rain',
      '43': 'wi-day-rain-mix',
      '44': 'wi-rain-mix',
      '45': 'wi-rain-mix',
      '46': 'wi-rain-mix',
      '51': 'wi-day-snow',
      '52': 'wi-day-snow',
      '53': 'wi-snow',
      '54': 'wi-snow',
      '61': 'wi-day-thunderstorm',
      '62': 'wi-thunderstorm',
      '63': 'wi-thunderstorm',
      '64': 'wi-thunderstorm',
      '71': 'wi-day-snow',
      '72': 'wi-snow',
      '73': 'wi-snow',
      '74': 'wi-snow',
      '81': 'wi-day-fog',
      '82': 'wi-day-fog',
      '83': 'wi-fog'
    };
  }

  getWeatherIcon(code) {
    if (!code) return 'wi-thermometer';
    return this.weatherIcons[String(code)] || 'wi-thermometer';
  }

  getSkyDescription(codigo) {
    const descriptions = {
      '11': 'Despejado', '12': 'Poco nuboso', '13': 'Poco nuboso',
      '14': 'Nuboso', '15': 'Muy nuboso', '16': 'Cubierto',
      '17': 'Nubes altas', '21': 'Niebla', '22': 'Bruma',
      '23': 'Calima', '24': 'Intervalos nubosos', '25': 'Intervalos nubosos',
      '26': 'Cubierto con lluvia', '27': 'Cubierto con lluvia',
      '31': 'Intervalos nubosos con lluvia', '32': 'Intervalos nubosos con lluvia',
      '33': 'Nuboso con lluvia', '34': 'Cubierto con lluvia',
      '35': 'Cubierto con tormenta', '36': 'Cubierto con tormenta',
      '41': 'Intervalos nubosos con lluvia', '42': 'Intervalos nubosos con lluvia',
      '43': 'Lluvia escasa', '44': 'Lluvia escasa',
      '45': 'Lluvia escasa', '46': 'Lluvia escasa',
      '51': 'Nieve débil', '52': 'Nieve', '53': 'Nieve',
      '54': 'Nieve abundante', '61': 'Tormenta débil',
      '62': 'Tormenta', '63': 'Tormenta fuerte',
      '64': 'Tormenta con lluvia', '71': 'Nieve débil',
      '72': 'Nieve', '73': 'Nieve abundante', '74': 'Nieve abundante',
      '81': 'Niebla', '82': 'Niebla', '83': 'Niebla'
    };
    return descriptions[String(codigo)] || 'Desconocido';
  }

  formatDate(dateStr) {
    const date = new Date(dateStr);
    const options = { weekday: 'short', day: 'numeric', month: 'short' };
    return date.toLocaleDateString('es-ES', options);
  }

  getFirstValue(value) {
    if (Array.isArray(value)) return value[0];
    return value;
  }

  renderLoading() {
    this.container.innerHTML = `
      <div class="card shadow-lg border-0">
        <div class="card-body text-center py-5">
          <div class="spinner-border text-primary mb-3" role="status">
            <span class="visually-hidden">Cargando...</span>
          </div>
          <p class="mb-0">Cargando datos meteorológicos...</p>
        </div>
      </div>
    `;
  }

  renderError(msg) {
    this.container.innerHTML = `
      <div class="alert alert-danger shadow-lg" role="alert">
        <strong>Error:</strong> ${msg}
      </div>
    `;
  }

  renderHourlyForecast() {
    const hoy = this.data.pronostico?.hoy;
    if (!hoy) return '';
    
    const horaActual = new Date().getHours();
    let horasHTML = '';
    
    for (let i = horaActual; i < 24 && i < (hoy.temperatura?.length || 0); i++) {
      const estadoCielo = hoy.estado_cielo?.[i] || '11';
      const temperatura = hoy.temperatura?.[i] ?? '--';
      const probLluvia = hoy.prob_precipitacion?.[i] ?? 0;
      
      horasHTML += `
        <div class="hour-card text-center p-2 rounded-3 flex-shrink-0" style="min-width: 90px;">
          <div class="fw-bold">${i.toString().padStart(2, '0')}:00</div>
          <i class="wi ${this.getWeatherIcon(estadoCielo)} display-6 my-2"></i>
          <div class="fw-bold fs-5">${temperatura}°</div>
          ${probLluvia > 0 ? `
            <div class="small text-info">
              <i class="wi wi-raindrop"></i> ${probLluvia}%
            </div>
          ` : ''}
        </div>
      `;
    }
    
    return `
      <div class="mb-4">
        <h4 class="mb-3">
          <i class="wi wi-time-1 me-2"></i>
          Pronóstico por horas - Hoy
        </h4>
        <div class="d-flex gap-2 overflow-auto pb-2">
          ${horasHTML}
        </div>
      </div>
    `;
  }

  renderDailyForecast() {
    const proximos = this.data.proximos_dias;
    if (!proximos || !Array.isArray(proximos)) return '';
    
    const diasHTML = proximos.map(dia => {
      const fecha = dia['@attributes']?.fecha || '';
      const estadoCielo = this.getFirstValue(dia.estado_cielo) || '11';
      const descripcion = this.getFirstValue(dia.estado_cielo_descripcion) || this.getSkyDescription(estadoCielo);
      const tempMax = dia.temperatura?.maxima ?? '--';
      const tempMin = dia.temperatura?.minima ?? '--';
      const probLluvia = this.getFirstValue(dia.prob_precipitacion) ?? 0;
      
      return `
        <div class="col-6 col-md-4 col-lg-2">
          <div class="day-card p-3 rounded-3 text-center h-100">
            <div class="fw-bold mb-2">${this.formatDate(fecha)}</div>
            <i class="wi ${this.getWeatherIcon(estadoCielo)} display-5 my-2"></i>
            <div class="small mb-2">${descripcion}</div>
            <div class="d-flex justify-content-center gap-2 mb-2">
              <span class="fw-bold">${tempMax}°</span>
              <span class="text-muted">${tempMin}°</span>
            </div>
            <div class="small text-info">
              <i class="wi wi-raindrop"></i> ${probLluvia}%
            </div>
          </div>
        </div>
      `;
    }).join('');
    
    return `
      <div>
        <h4 class="mb-3">
          <i class="wi wi-day-sunny me-2"></i>
          Próximos días
        </h4>
        <div class="row g-3">
          ${diasHTML}
        </div>
      </div>
    `;
  }

  render() {
    try {
      const d = this.data;
      
      const nombre = d.municipio?.NOMBRE || 'Ubicación';
      const provincia = d.municipio?.NOMBRE_PROVINCIA || '';
      const tempActual = d.temperatura_actual ?? '--';
      
      let skyCode = '11';
      let skyDesc = 'Despejado';
      
      if (d.stateSky?.id) {
        skyCode = d.stateSky.id;
        skyDesc = d.stateSky.description || this.getSkyDescription(skyCode);
      } else if (d.estado_cielo) {
        skyCode = this.getFirstValue(d.estado_cielo);
        skyDesc = this.getSkyDescription(skyCode);
      }
      
      const tempMax = d.temperaturas?.max ?? d.temperatura?.maxima ?? '--';
      const tempMin = d.temperaturas?.min ?? d.temperatura?.minima ?? '--';
      const humedad = d.humedad ?? d.humedad_relativa ?? '--';
      const viento = d.viento ?? '--';
      const precipitacion = d.precipitacion ?? '--';
      const productor = d.origin?.productor || d.productor || 'AEMET';

      this.container.innerHTML = `
        <div class="card weather-card shadow-lg border-0">
          <div class="card-header bg-primary text-white">
            <div class="row align-items-center">
              <div class="col-md-6">
                <h2 class="mb-1">${nombre}</h2>
                <p class="mb-0 opacity-75">${provincia}</p>
              </div>
              <div class="col-md-6 text-md-end">
                <div class="d-flex align-items-center justify-content-md-end">
                  <i class="wi ${this.getWeatherIcon(skyCode)} display-1 me-3"></i>
                  <div>
                    <div class="display-3 fw-bold">${tempActual}°C</div>
                    <div class="fs-5">${skyDesc}</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row g-3 mb-4">
              <div class="col-6 col-md-3">
                <div class="metric-card p-3 rounded-3 text-center">
                  <i class="wi wi-thermometer display-6 text-danger"></i>
                  <div class="mt-2">
                    <div class="small text-muted">Máx / Mín</div>
                    <div class="fw-bold">${tempMax}° / ${tempMin}°</div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-md-3">
                <div class="metric-card p-3 rounded-3 text-center">
                  <i class="wi wi-humidity display-6 text-info"></i>
                  <div class="mt-2">
                    <div class="small text-muted">Humedad</div>
                    <div class="fw-bold">${humedad}%</div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-md-3">
                <div class="metric-card p-3 rounded-3 text-center">
                  <i class="wi wi-strong-wind display-6 text-primary"></i>
                  <div class="mt-2">
                    <div class="small text-muted">Viento</div>
                    <div class="fw-bold">${viento} km/h</div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-md-3">
                <div class="metric-card p-3 rounded-3 text-center">
                  <i class="wi wi-rain display-6 text-secondary"></i>
                  <div class="mt-2">
                    <div class="small text-muted">Precipitación</div>
                    <div class="fw-bold">${precipitacion} mm</div>
                  </div>
                </div>
              </div>
            </div>

            ${this.renderHourlyForecast()}
            ${this.renderDailyForecast()}
          </div>

          <div class="card-footer text-center text-muted">
            <small>Datos: ${productor}</small>
          </div>
        </div>
      `;
    } catch (err) {
      console.error('Error al renderizar:', err);
      this.renderError('Error al mostrar los datos. Revisa la consola.');
    }
  }

  async load() {
    try {
      this.renderLoading();
      
      const url = `https://api.el-tiempo.net/json/v3/provincias/${this.provincia}/municipios/${this.municipio}`;
      const response = await fetch(url);
      
      if (!response.ok) {
        throw new Error(`Error HTTP: ${response.status}`);
      }
      
      this.data = await response.json();
      console.log('✅ Datos cargados correctamente');
      console.log('📊 Estructura:', this.data);
      this.render();
    } catch (err) {
      console.error('❌ Error:', err);
      this.renderError(err.message);
    }
  }
}
