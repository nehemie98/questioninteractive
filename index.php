<?php
// Lire les questions à partir du fichier JSON
$questions = json_decode(file_get_contents('questions.json'), true);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz interactif</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="quiz-container">
        <h1>Quiz Interactif</h1>
        <form id="quizForm">
            <?php foreach ($questions as $index => $question): ?>
                <div class="question">
                    <h2><?php echo $question['question']; ?></h2>
                    <?php if (isset($question['options'])): ?>
                        <?php foreach ($question['options'] as $choice): ?>
                            <label>
                                <input type="radio" name="question_<?php echo $index; ?>" value="<?php echo $choice; ?>" data-correct="<?php echo $question['answer']; ?>">
                                <?php echo $choice; ?>
                            </label>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            <button type="submit" id="submitBtn">Soumettre</button>
        </form>
        <div id="result"></div>
    </div>

    <script src="script.js"></script>
    <script>
        document.getElementById('quizForm').addEventListener('submit', function(event) {
            event.preventDefault();
            let score = 0;
            let totalQuestions = <?php echo count($questions); ?>;
            let formData = new FormData(this);

            formData.forEach((value, key) => {
                let correctAnswer = document.querySelector(`input[name="${key}"][value="${value}"]`).getAttribute('data-correct');
                if (value === correctAnswer) {
                    score++;
                }
            });

            document.getElementById('result').innerText = `Votre cote est de ${score} sur ${totalQuestions}`;
        });
    </script>
</body>
</html>
