const API_KEY = "644ea286e838fdfb986ce25571b81c95";

// 🇮🇩 WEATHER TRANSLATIONS LENGKAP
const weatherTranslations = {
    'cerah': 'Cerah',
    'sedikit berawan': 'Sedikit Berawan',
    'berawan': 'Berawan',
    'berawan tebal': 'Awan Mendung',
    'hujan ringan': 'Hujan Ringan',
    'hujan gerimis': 'Gerimis',
    'hujan': 'Hujan',
    'hujan sedang': 'Hujan Sedang',
    'hujan lebat': 'Hujan Lebat',
    'hujan badai': 'Hujan Badai',
    'hujan badai petir': 'Badai Petir',
    'hujan badai salju': 'Badai Salju',
    'hujan salju': 'Hujan Salju',
    'salju': 'Salju',
    'hujan es': 'Hujan Es',
    'kabut': 'Kabut',
    'berembun': 'Berembun',
    'asap': 'Asap',
    'kabut tebal': 'Kabut Tebal',
    'pasir': 'Pasir',
    'debu': 'Debu',
    'awan bergerak': 'Awan Bergerak',
    'awan pecah': 'Berawan Pecah'
};

// Label Stats Indonesia
const statLabels = {
    humidity: 'Kelembaban',
    wind: 'Angin',
    pressure: 'Tekanan'
};

async function u() {
  try {
    const r = await fetch(
        `https://api.openweathermap.org/data/2.5/weather?q=Bandung&appid=${API_KEY}&units=metric&lang=id`
      ),
      d = await r.json();
    
    // Terjemahkan deskripsi cuaca
    const rawDesc = d.weather[0].description.toLowerCase();
    let weatherDesc = weatherTranslations[rawDesc] || 
                      rawDesc.charAt(0).toUpperCase() + rawDesc.slice(1);
    
    document.getElementById("w").innerHTML = `
      <div class="icon">${g(d.weather[0].main)}</div>
      <div class="city">
        <i class="fa-solid fa-location-dot city-icon"></i>
        ${d.name}
      </div>
      <div class="temp">${Math.round(d.main.temp)}°C</div>
      <div class="cond">${weatherDesc}</div>
      <div class="stats">
        <div class="stat">
          ${d.main.humidity}%<br>
          <small>${statLabels.humidity}</small>
        </div>
        <div class="stat">
          ${Math.round(d.wind.speed * 3.6)}km/j<br>
          <small>${statLabels.wind}</small>
        </div>
        <div class="stat">
          ${d.main.pressure}hPa<br>
          <small>${statLabels.pressure}</small>
        </div>
      </div>
    `;
  } catch (error) {
    console.error("Error fetching weather data:", error);
    document.getElementById("w").innerHTML = 
      '<div class="error">❌ Gagal memuat cuaca</div>';
  }
}

function g(c) {
  return {
    Clear: "☀️",
    Clouds: "☁️",
    Rain: "🌧️",
    Snow: "❄️",
    Thunderstorm: "⛈️",
    Drizzle: "🌦️",
    Atmosphere: "🌫️"
  }[c] || "🌤️";
}

// Start & Auto refresh
u();
setInterval(u, 15 * 60 * 1000); // 15 menit