<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles_main.css" rel="stylesheet">
    <title>Notes par Matière</title>
    <style>
        
    </style>
</head>
<body>

    <div class="container">
        <nav>
            <a href="../page_accueil.php", style="text-align: center">Retour</span></a>
        </nav>
        <h1>Mes Notes par Matière</h1>

        <div id="list-notes">
            <!-- Les matières et les notes seront affichées ici -->
        </div>
    </div>

    <script>
        // Exemple de données : matières et notes ajoutées
        let matieres = [
            {
                nom: "Sciences Économiques et Sociales",
                moyenne: 13.59,
                notes: [
                    { date: "le 8 novembre", note: 9.50 },
                    { date: "le 13 octobre", note: 17.00 },
                    { date: "le 15 septembre", note: 17.00 }
                ]
            },
            {
                nom: "Éducation Physique et Sportive",
                moyenne: 15.11,
                notes: [
                    { date: "le 21 novembre", note: 16.00 },
                    { date: "le 17 octobre", note: 13.00 },
                    { date: "le 19 septembre", note: 4.10 }
                ]
            },
            {
                nom: "Enseignement Moral et Civique",
                moyenne: 18.00,
                notes: [
                    { date: "le 10 novembre", note: 9.00 },
                    { date: "le 13 octobre", note: 9.00 }
                ]
            }
        ];

        // Fonction pour afficher les matières et leurs notes
        function afficherNotes() {
            const listNotes = document.getElementById('list-notes');
            listNotes.innerHTML = ''; // Vider les notes précédentes

            matieres.forEach(matiere => {
                const matiereDiv = document.createElement('div');
                matiereDiv.classList.add('matiere');

                // Ajouter les informations de la matière
                const matiereDetails = `
                    <div>
                        <p class="matiere">${matiere.nom}</p>
                        <p class="moyenne">${matiere.moyenne} / 20</p>
                    </div>
                    <div class="details">
                        <p>Moyenne de la classe : ${matiere.moyenne}</p>
                    </div>
                `;
                matiereDiv.innerHTML = matiereDetails;

                // Affichage des notes
                const noteDetails = document.createElement('div');
                noteDetails.classList.add('note-details');
                matiere.notes.forEach(note => {
                    noteDetails.innerHTML += `<span>${note.date} : ${note.note} / 20</span><br>`;
                });

                matiereDiv.appendChild(noteDetails);
                listNotes.appendChild(matiereDiv);
            });
        }

        // Appeler la fonction pour afficher les notes lors du chargement de la page
        window.onload = afficherNotes;
    </script>

</body>
</html>
