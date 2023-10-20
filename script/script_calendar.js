function generateCalendar(year, month) {
    const calendar = document.getElementById("calendar");
    const date = new Date(year, month - 1, 1);
    const daysInMonth = new Date(year, month, 0).getDate();
    const firstDay = date.getDay();
  
    let html = "<h2>" + new Intl.DateTimeFormat('fr-FR', { month: 'long', year: 'numeric' }).format(date) + "</h2>";
    html += "<table><tr><th>Lun</th><th>Mar</th><th>Mer</th><th>Jeu</th><th>Ven</th><th>Sam</th><th>Dim</th></tr><tr>";
  
    let dayCount = 1;
    for (let i = 0; i < 42; i++) {
      if (i >= firstDay && dayCount <= daysInMonth) {
        html += "<td>" + dayCount + "</td>";
        dayCount++;
      } else {
        html += "<td></td>";
      }
  
      if (i % 7 === 6) {
        html += "</tr><tr>";
      }
    }
  
    html += "</tr></table>";
    calendar.innerHTML = html;
  }
  
  generateCalendar(2023, 10); // Met la date de ton choix ici
  
  