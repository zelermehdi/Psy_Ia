<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Psy Virtuel Chat</title>
    <!-- Lien vers le CDN de Tailwind CSS pour le design -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10 max-w-4xl bg-white rounded-lg shadow-lg">
        <header class="bg-blue-500 text-white text-lg font-semibold px-6 py-4 rounded-t-lg">
            Chat avec votre Psy Virtuel
        </header>
        <main class="p-6 space-y-4 overflow-y-auto h-96" id="chat-messages">
            <!-- Exemple de message du bot -->
            <div class="text-right">
                <span class="inline-block bg-blue-500 text-white p-3 rounded-lg">Bonjour, comment ça va ?</span>
            </div>

            <!-- Dynamique des messages -->
            @foreach (session('chatHistory', []) as $chat)
                @if (isset($chat['user']))
                    <div class="text-right">
                        <span class="inline-block bg-red-500 text-white p-3 rounded-lg">{{ $chat['user'] }}</span>
                    </div>
                @elseif (isset($chat['bot']))
                    <div class="text-left">
                        <span class="inline-block bg-gray-200 p-3 rounded-lg">{{ $chat['bot'] }}</span>
                    </div>
                @endif
            @endforeach

            @if (session('reply'))
                <div class="text-left">
                    <span class="inline-block bg-gray-200 p-3 rounded-lg">{{ session('reply') }}</span>
                </div>
            @endif
        </main>
        <footer class="px-6 py-4 border-t border-gray-200">
            <form action="{{ route('chat') }}" method="POST">
                @csrf
                <div class="flex space-x-3">
                    <input type="text" class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" id="message" name="message" placeholder="Écrivez votre message ici..." required aria-label="Votre message">
                    <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-lg">Envoyer</button>
                </div>
            </form>
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#chat-messages').scrollTop($('#chat-messages')[0].scrollHeight);
        });
    </script>
</body>
</html>






























{{-- <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Chat avec OpenAI</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Parler avec ChatGPT</h2>
        <form action="{{ route('chat') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="message" class="form-label">Votre message :</label>
                <input type="text" class="form-control" id="message" name="message" required>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
        @if (session('reply'))
    <div class="alert alert-success" role="alert">
        Réponse de ton PSY_IA: {{ session('reply') }}
    </div>
@endif
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html> --}}
