<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test du Big Five</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        body {
            background-color: #EDF2F7; /* Utilisation d'une couleur de fond douce */
            color: #333; /* Couleur de texte générale */
        }
        .question-card {
            transition: transform 0.5s ease-in-out;
            background-color: #ffffff; /* Fond blanc pour les cartes de question */
            padding: 1.5rem; /* Espacement interne */
            border-radius: 0.5rem; /* Bordures arrondies */
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); /* Ombre douce */
            margin-bottom: 1rem; /* Espacement entre les cartes */
        }
        button {
            background-color: #4F46E5; /* Couleur de fond pour les boutons */
            color: #ffffff; /* Texte blanc pour les boutons */
            padding: 0.5rem 1rem; /* Espacement interne pour les boutons */
            border-radius: 0.25rem; /* Bordures arrondies pour les boutons */
            cursor: pointer; /* Curseur pointeur */
            border: none; /* Aucune bordure pour les boutons */
            transition: background-color 0.3s; /* Transition fluide pour le survol */
        }
        button:hover {
            background-color: #3730A3; /* Changement de couleur au survol */
        }
    </style>
</head>
<body class="p-5">
    <h2 class="text-2xl font-bold text-center my-8">Test Big Five </h2>

    <div x-data="questionnaire()" x-init="init()">
        <form action="/big-five/results" method="POST">
            @csrf <!-- Inclusion du token CSRF -->
            <template x-for="(question, index) in questions" :key="index">
                <div class="question-card">
                    <label x-text="question.text" class="block text-lg mb-4"></label>
                    <template x-for="choice in question.choices" :key="choice.score">
                        <div>
                            <input type="radio" :name="`responses[${question.id}]`" :value="choice.score"> <span x-text="choice.text"></span>
                        </div>
                    </template>
                </div>
            </template>
            <button type="submit" class="mt-5">Soumettre</button>
        </form>
        <div class="mt-5">Total de Questions: <span x-text="questions.length"></span></div>
    </div>
    

    <script>
        function questionnaire() {
            return {
                questions: @json($questions).map(question => ({
                    ...question,
                    choices: @json($choices)[question.keyed]
                })),
                currentIndex: 0,
                init() {
                   
                },
                selectChoice(index) {
                    
                },
                nextQuestion() {
                    if (this.currentIndex < this.questions.length - 1) {
                        this.currentIndex++;
                    }
                }
            }
        }
    </script>
</body>
</html>




<script>
    document.addEventListener("DOMContentLoaded", function() {
        const allResponses = document.querySelectorAll('input[type="radio"]');
    
        let questionsAnswered = {};
    
        allResponses.forEach(radio => {
            const name = radio.name;
    
            if (!questionsAnswered[name]) {
                radio.checked = true; 
                questionsAnswered[name] = true;
            }
        });
    });
    </script>