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

    const calendarCells = document.querySelectorAll("#calendar td");
    const eventDetails = document.getElementById("event-details");

    for (let i = 0; i < calendarCells.length; i++) {
        const cell = calendarCells[i];

        cell.addEventListener("click", function() {
            // Gère le clic sur une cellule du calendrier ici.
            const day = parseInt(cell.innerText);

            if (!isNaN(day)) {
                // Vérifie si le contenu de la cellule est un nombre (un jour).
                // Si c'est le cas, affiche les détails de l'événement dans #event-details.
                eventDetails.innerHTML = `Événement du ${day}/${month}/${year}`;
            }
        });
    }
}

function saveEvent(date, titre, description) {
    const data = new URLSearchParams();
    data.append('date', date);
    data.append('titre', titre);
    data.append('description', description);

    fetch('../mod/mod_saveEvent.php', {
        method: 'POST',
        body: data
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        // Afficher un message de confirmation ou actualiser le calendrier après l'enregistrement.
    })
    .catch(error => {
        console.error('Erreur lors de la requête :', error);
    });
}

const date = '2023-10-20';
const titre = 'Mon événement';
const description = 'Description de l\'événement';

saveEvent(date, titre, description);



generateCalendar(2023, 10); // Met la date de ton choix ici
