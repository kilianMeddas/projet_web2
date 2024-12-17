<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/styles_edt.css" rel="stylesheet">
    <link rel="icon" href="../assets/logo.png" type="png">


    <title>Emploi du Temps - Aujourd'hui</title>
</head>

<body>
    <div class="text-background">
        <h1>Emploi du Temps du <p id="datetime"></p></h1>
        <div id="emploi-du-temps" class="emploi-du-temps">
            <!-- L'emploi du temps sera généré ici -->
        </div>
        <nav>
            <a href="page_accueil.php", style="text-align: center">Retour</span></a>
        </nav>
    </div>

    <script>
        // Exemple d'emploi du temps de 9h à 18h
        const emploiDuTemps = [
            { heure: "09:00 10:00", titre: "Mathématiques ", type: "cours" },
            { heure: "10:15 12:30", titre: "Physique ", type: "cours" },
            { heure: "12:30 14:00", titre: "Déjeuner", type: "pause" },
            { heure: "14:00 16:00", titre: "Informatique", type: "cours" },
            { heure: "16:15 18:00", titre: "Chimie ", type: "cours" },
        ];

        // Fonction pour afficher l'emploi du temps
        function afficherEmploiDuTemps() {
            const emploiDuTempsDiv = document.getElementById('emploi-du-temps');
            emploiDuTempsDiv.innerHTML = ''; // Réinitialise le contenu

            emploiDuTemps.forEach((event) => {
                const eventElement = document.createElement('div');
                const heureElement = document.createElement('span');
                const titreElement = document.createElement('span');

                // Affichage de l'heure
                heureElement.textContent = event.heure;
                heureElement.classList.add('heure');

                // Affichage du titre et style selon le type d'événement
                titreElement.textContent = event.titre;
                titreElement.classList.add('activite');
                if (event.type === 'pause') {
                    titreElement.classList.add('pause');
                } else if (event.type === 'cours') {
                    titreElement.classList.add('cours');
                }

                // Ajouter l'heure et l'activité au div
                eventElement.appendChild(heureElement);
                eventElement.appendChild(titreElement);
                emploiDuTempsDiv.appendChild(eventElement);
            });
        }

        // Appel de la fonction pour afficher l'emploi du temps
        afficherEmploiDuTemps();
    </script>
    <script>
    // Get current date and time
    var nowDate = new Date(); 
    var date = nowDate.getDate()+'/'+(nowDate.getMonth()+1)+'/'+nowDate.getFullYear(); 
    var datetime = date.toLocaleString();

    // Insert date and time into HTML
    document.getElementById("datetime").innerHTML = datetime;
    </script>

</body>

</html>