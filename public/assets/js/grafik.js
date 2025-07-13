// Grafik Pendapatan Perbulan

document.addEventListener('DOMContentLoaded', function() {
  const grafikData = window.grafikPendapatan || [];
  const chart = document.querySelector('.grafik-bar-chart');
  if (!chart) return;
  chart.innerHTML = '';
  if (!grafikData.length) {
    chart.innerHTML = '<div style="text-align:center;color:#888;">Tidak ada data pendapatan.</div>';
    return;
  }
  const maxVal = Math.max(...grafikData.map(d => d.total));
  grafikData.forEach(d => {
    const bar = document.createElement('div');
    bar.className = 'grafik-bar';
    bar.style.height = '0px';
    // Bar value
    const value = document.createElement('div');
    value.className = 'grafik-bar-value';
    value.textContent = 'Rp' + Number(d.total).toLocaleString('id-ID');
    bar.appendChild(value);
    // Bar label
    const label = document.createElement('div');
    label.className = 'grafik-bar-label';
    label.textContent = d.bulan;
    bar.appendChild(label);
    chart.appendChild(bar);
    // Animate
    setTimeout(() => {
      bar.style.height = (d.total / maxVal * 200 + 30) + 'px';
    }, 100);
  });
});
