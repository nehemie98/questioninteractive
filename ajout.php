<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Question</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Ajouter une Question</h1>
    <form id="questionForm">
        <label for="question">Question:</label>
        <input type="text" id="question" name="question" required><br><br>

        <label for="option1">Option 1:</label>
        <input type="text" id="option1" name="option1" required><br><br>

        <label for="option2">Option 2:</label>
        <input type="text" id="option2" name="option2" required><br><br>

        <label for="option3">Option 3:</label>
        <input type="text" id="option3" name="option3" required><br><br>

        <label for="option4">Option 4:</label>
        <input type="text" id="option4" name="option4" required><br><br>

        <label for="answer">Réponse:</label>
        <input type="text" id="answer" name="answer" required><br><br>

        <button type="submit">Ajouter</button>
    </form>

    <script>
        // Ajoute un écouteur d'événement pour le formulaire de soumission
        document.getElementById('questionForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Empêche le comportement par défaut du formulaire

            // Récupère les valeurs des champs du formulaire
            const question = document.getElementById('question').value;
            const options = [
                document.getElementById('option1').value,
                document.getElementById('option2').value,
                document.getElementById('option3').value,
                document.getElementById('option4').value
            ];
            const answer = document.getElementById('answer').value;

            // Crée un nouvel objet question
            const newQuestion = {
                question: question,
                options: options,
                answer: answer
            };

            // Récupère les questions existantes à partir du fichier JSON
            fetch('questions.json')
                .then(response => response.json())
                .then(data => {
                    data.push(newQuestion); // Ajoute la nouvelle question aux données existantes
                    return fetch('questions.json', {
                        method: 'POST', // Utilise la méthode POST pour envoyer les données
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data) // Convertit les données en JSON
                    });
                })
                .then(response => {
                    if (response.ok) {
                        alert('Question ajoutée avec succès!'); // Affiche un message de succès
                        window.location.href = 'index.php'; // Redirige vers la page d'accueil
                    } else {
                        alert('Erreur lors de l\'ajout de la question.'); // Affiche un message d'erreur
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error); // Affiche l'erreur dans la console
                });
        });
    </script>
</body>
</html>