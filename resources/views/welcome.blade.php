<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil | ProfilPsy</title>
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- AOS Animation Library CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-12">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-4" data-aos="fade-down" data-aos-delay="100">Bienvenue sur ProfilPsy</h1>
            <p class="text-lg mb-4" data-aos="fade-up" data-aos-delay="200">Explorez les profondeurs de votre personnalité dans un monde en constante évolution. ProfilPsy vous offre une fenêtre interactive sur votre être, à travers les Big Five - les dimensions fondamentales de la personnalité humaine.</p>
            <ul class="text-lg mb-4 list-disc list-inside" data-aos="fade-up" data-aos-delay="200">
                <li><strong>Ouverture</strong>: Votre degré d'ouverture à de nouvelles expériences.</li>
                <li><strong>Conscienciosité</strong>: Votre niveau de fiabilité et de discipline.</li>
                <li><strong>Extraversion</strong>: Votre tendance à chercher la compagnie des autres.</li>
                <li><strong>Agréabilité</strong>: Votre aptitude à être coopératif et social.</li>
                <li><strong>Neuroticisme</strong>: Votre tendance à éprouver des émotions négatives.</li>
            </ul>
            <p class="text-lg mb-4" data-aos="fade-up" data-aos-delay="300">Notre questionnaire intuitif et approfondi révèle les nuances de votre caractère. En alliant l'intelligence artificielle d'OpenAI, nous offrons des analyses et des conseils personnalisés pour enrichir votre voyage d'auto-découverte.</p>
            <p class="text-lg mb-8" data-aos="fade-up" data-aos-delay="400">Chez ProfilPsy, la sécurité de vos données et la confidentialité sont primordiales. Embarquez vers une meilleure connaissance de soi, guidé par la technologie et l'empathie.</p>
            <a href="{{ url('/big-five') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" data-aos="zoom-in" data-aos-delay="500">Commencez le Test de Personnalité</a>
        </div>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1200,
        });
    </script>
</body>

</html>
