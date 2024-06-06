<?php

namespace App\Http\Controllers;

use App\Services\OpenAI;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        $userMessage = $request->input('message');
        $chatHistory = session('chatHistory', []);
    
        // Ajouter le message de l'utilisateur à l'historique
        $chatHistory[] = ['user' => $userMessage];
    
        if (session()->has('bigFiveScores') && session()->has('bigFiveAnalysis')) {
            $scores = session('bigFiveScores');
            $analysis = session('bigFiveAnalysis');
    
            $messageToChatGPT = "L'utilisateur a posé la question suivante : \"$userMessage\" "
                . "Voici les scores du Big Five de l'utilisateur : " . json_encode($scores) . ". "
                . "Et voici l'analyse des résultats : $analysis. "
                . "Peux-tu fournir une réponse basée sur ces informations ?";
    
            $response = $this->askOpenAI($messageToChatGPT);
        } else {
            $response = $this->askOpenAI($userMessage);
        }
    
        // Ajouter la réponse à l'historique
        $chatHistory[] = ['bot' => $response];
    
        // Sauvegarder l'historique dans la session
        session(['chatHistory' => $chatHistory]);
    
        return back();
    }
    

    public function results(Request $request)
    {
        $responses = $request->input('responses', []);
        
        $scores = [
            'N' => 0, // Neuroticisme
            'E' => 0, // Extraversion
            'O' => 0, // Ouverture
            'A' => 0, // Agréabilité
            'C' => 0, // Conscience
        ];
    
        $questions = json_decode(file_get_contents(public_path() . "/questionnaire.json"), true);

        foreach ($responses as $questionId => $responseScore) {
            foreach ($questions as $question) {
                if ($question['id'] === $questionId) {
                    $domain = $question['domain'];
                    $scores[$domain] += ($question['keyed'] === 'plus') ? $responseScore : 6 - $responseScore;
                    break;
                }
            }
        }
    
        $totalQuestionsPerDomain = count($responses) / count($scores);
        $maxScorePerDomain = $totalQuestionsPerDomain * 5;
        foreach ($scores as $domain => $score) {
            $scores[$domain] = ($score / $maxScorePerDomain) * 100;
        }
    
        $message = " Neuroticism: {$scores['N']}%, Extraversion: {$scores['E']}%, Openness: {$scores['O']}%, Agreeableness: {$scores['A']}%, Conscientiousness: {$scores['C']}%. Could you analyze these results and provide a detailed summary?";
    
        $response = $this->askOpenAI($message);
        $analysis = $response;
        session(['bigFiveScores' => $scores, 'bigFiveAnalysis' => $analysis]);

        return view('bigfive.results', compact('analysis', 'scores'));
    }
    

    protected function askOpenAI($message)
    {
        $response = OpenAI::ask($message);

        if (isset($response['choices'][0]['message']['content'])) {
            return $response['choices'][0]['message']['content'];
        } else {
            return "Désolé, je n'ai pas pu traiter votre demande.";
        }
    }

    public function getAnalysisFromSession()
    {
        if (session()->has('bigFiveScores') && session()->has('bigFiveAnalysis')) {
            $scores = session('bigFiveScores');
            $analysis = session('bigFiveAnalysis');
   
            
            return $analysis; 
        } else {
            return "Il semble que nous n'ayons pas vos résultats. Veuillez effectuer le test pour obtenir une analyse.";
        }
    }
    


    
}
