function loadQuestion() {
    if (currentQuestion < questions.length) {
        const question = questions[currentQuestion];
        const questionContainer = document.getElementById('quiz');
        questionContainer.innerHTML = `
            <h2>${question.question}</h2>
            <div class="options">
                ${question.options.map((option, index) => `
                    <label>
                        <input type="radio" name="question${currentQuestion}" value="${options}">
                        ${options}
                    </label><br>
                `).join('')}
            </div>
        `;
    } else {
        // Si toutes les questions ont été posées, affichez le résultat
        document.getElementById('quiz').innerHTML = `
            <h2>Le quiz est terminé !</h2>
            <p>Votre score final est : ${score} / ${questions.length}</p>
        `;
        document.getElementById('submitBtn').style.display = 'none';
    }
}

function checkAnswers() {
    const selectedOption = document.querySelector(`input[name="question${currentQuestion}"]:checked`);
    if (selectedOption) {
        if (selectedOption.value === questions[currentQuestion].answer) {
            score++;
        }
    }
    currentQuestion++;
    loadQuestion();
}

// Initialiser le quiz
loadQuestion();

// Ajouter l'événement au bouton "Soumettre"
document.getElementById('submitBtn').addEventListener('click', checkAnswers);
