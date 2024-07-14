<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

/**
 * Service for generating explanations for video content using OpenAI.
 *
 * This service interacts with the OpenAI API to generate creative and concise explanations
 * based on the title and description of a video.
 */
class OpenAIService
{
    protected $openai_api_key;

    /**
     * Initialize the OpenAIService with the API key from environment variables.
     */
    public function __construct()
    {
        $this->openai_api_key = env('OPENAI_API_KEY');
    }

    /**
     * Generate an explanation for a given video based on its title and description.
     *
     * @param string $title The title of the video
     * @param string $description The description of the video
     * @return string The generated explanation
     */
    public function generateExplanation($title, $description)
    {
        // Make a POST request to the OpenAI API to generate the explanation
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->openai_api_key,
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are an assistant that explains video content creatively. Provide only the explanation without any introductory phrases or unnecessary words.'
                ],
                [
                    'role' => 'user',
                    'content' => "Explain the following video concisely:\n\nTitle: $title\n\nDescription: $description"
                ]
            ],
        ]);
    
        // Decode the JSON response from the API
        $data = $response->json();

        // Return the explanation from the response, or a default message if not available
        return $data['choices'][0]['message']['content'] ?? 'No explanation available.';
    }
}
