<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BigFiveController extends Controller
{
    public function index()

    {

        $path = public_path();
        $questions = json_decode(file_get_contents($path . "/questionnaire.json"), true);
        $choices = json_decode(file_get_contents($path . "/reponse.json"), true);
    
        return view('bigfive.index', compact('questions', 'choices'));
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
    
      
        return view('bigfive.results', compact('scores'));
    }
}
