const API_KEY = " ";
async function u() {
  try {
    const r = await fetch(
        `https://api.openweathermap.org/data/2.5/weather?q=Bandung&appid=${API_KEY}&units=metric&lang=id`
      ),
      d = await r.json();
    document.getElementById("w").innerHTML = `<div class="icon">${g(
      d.weather[0].main
    )}</div><div class="city"><i class="fa-solid fa-location-dot city-icon"></i>${
      d.name
    }</div><div class="temp">${Math.round(
      d.main.temp
    )}°C</div><div class="cond">${
      d.weather[0].description
    }</div><div class="stats"><div class="stat">${
      d.main.humidity
    }%<br><small>Humidity</small></div><div class="stat">${Math.round(
      d.wind.speed * 3.6
    )}km/h<br><small>Wind</small></div><div class="stat">${
      d.main.pressure
    }hPa<br><small>Pressure</small></div></div>`;
  } catch {}
}

function g(c) {
  return (
    {
      Clear: "☀️",
      Clouds: "☁️",
      Rain: "🌧️",
      Snow: "❄️",
      Thunderstorm: "⛈️",
      Drizzle: "🌦️",
      Atmosphere: "🌫️"
    }[c] || "🌤️"
  );
}
u();
setInterval(u, 15 * 60 * 1000);
