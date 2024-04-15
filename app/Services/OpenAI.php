<?php
namespace App\Services;

use Illuminate\Support\Facades\Facade;

class OpenAI extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'OpenAIClient'; 
    }

    public static function ask($userMessage)
    {
        try {
            $client = static::getFacadeRoot();
            $response = $client->post('chat/completions', [
                'json' => [
                    'model' => 'gpt-3.5-turbo', 
                    'messages' => [
                        ["role" => "system", "content" => "Vous êtes un assistant utile."],
                        ["role" => "user", "content" => $userMessage], 
                    ],
                    'temperature' => 0.7,
                    'max_tokens' => 900,
                ],
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            if ($statusCode == 429) {
                return ['error' => 'Vous avez dépassé votre quota de requêtes. Veuillez réessayer plus tard.'];
            }
            else if ($statusCode == 400) {
                return ['error' => 'Requête mal formée. Vérifiez les données envoyées.'];
            }
            else {
                return ['error' => 'Une erreur inattendue est survenue.'];
            }
        }
    }


//commentaire

    
}
