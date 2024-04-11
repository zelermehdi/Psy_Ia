<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultats du Test Big Five</title>
    <!-- Remplacer Bootstrap par le CDN de Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">
<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold text-center my-10">Résultats du Test du Big Five</h1>
    <p class="mb-6">Voici vos résultats basés sur les réponses fournies au test. Chaque score varie entre 0 et le maximum possible pour chaque trait, reflétant vos tendances dans chacune des cinq grandes dimensions de la personnalité.</p>

    @php
        $traitNames = [
            'N' => 'Neuroticisme',
            'E' => 'Extraversion',
            'O' => 'Ouverture à l\'expérience',
            'A' => 'Agréabilité',
            'C' => 'Conscience',
        ];
        $maxScore = 100;
    @endphp

<div class="w-[5px] h-[5px]"> 
    <canvas id="bigFiveResultsChart" class="mb-4 w-full h-full"></canvas>
</div>
    <div class="my-8">
        <h2 class="text-2xl font-semibold mb-4">Analyse Détaillée</h2>
        <p>{{ $analysis }}</p>
    </div>

    <div class="flex justify-between">
        <a href="/big-five" class="inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 transition-colors duration-200">Reprendre le test</a>
        <a href="/chat" class="inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 transition-colors duration-200">Parler avec un psy IA</a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('bigFiveResultsChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: Object.values(@json($traitNames)),
                datasets: [{
                    label: 'Score',
                    backgroundColor: 'rgba(59, 130, 246, 0.5)', 
                    borderColor: 'rgb(37, 99, 235)', 
                    data: @json(array_values($scores)),
                }]
            },
            options: {

 
}
        });
    });
</script>
</body>
</html>
