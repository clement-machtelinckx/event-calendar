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
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
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

// Ajoutez cette fonction pour ouvrir la fenêtre pop-up
function openPopup() {
    // Créez une fenêtre pop-up
    const popup = window.open('', 'popup', 'width=400,height=300');

    // Ajoutez un formulaire dans la fenêtre pop-up
    popup.document.write('<h3>Ajouter un événement</h3>');
    popup.document.write('<form id="eventForm">');
    popup.document.write('Date : <input type="date" id="popupDate"><br>');
    popup.document.write('Titre : <input type="text" id="popupTitre"><br>');
    popup.document.write('Description : <textarea id="popupDescription"></textarea><br>');
    popup.document.write('<input type="submit" value="Enregistrer">');
    popup.document.write('</form>');

    // Gérez la soumission du formulaire dans la fenêtre pop-up
    popup.document.getElementById('eventForm').onsubmit = function (event) {
        event.preventDefault();
        const popupDate = popup.document.getElementById('popupDate').value;
        const popupTitre = popup.document.getElementById('popupTitre').value;
        const popupDescription = popup.document.getElementById('popupDescription').value;
        saveEvent(popupDate, popupTitre, popupDescription);
        popup.close();
    };
}

function showEvent(){

    fetch('../mod/mod_showEvent.php')
    .then(response => response.json())
    .then(data => {
        // Utilisez les données JSON (data) comme vous le souhaitez ici
        console.log(data);
    })
    .catch(error => {
        console.error('Une erreur s\'est produite : ', error);
    });

}

// Vous pouvez maintenant appeler openPopup lorsque vous cliquez sur un bouton par exemple.
const openPopupButton = document.getElementById("openPopupButton");
openPopupButton.addEventListener("click", openPopup);


const date = '2023-10-26';
const titre = 'Mon événement';
const description = 'Description de l\'événement';

// saveEvent(date, titre, description);





generateCalendar(2023, 10); // Met la date de ton choix ici
