<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\VideoSearchService;
use App\Services\OpenAIService;
use Illuminate\Http\Request;

/**
 * Controller for handling YouTube video search requests.
 * 
 * This controller interfaces with the VideoSearchService to search for
 * videos based on keywords present in their captions.
 */
class YoutubeController extends Controller
{
    protected $videoSearchService;
    protected $openAIService;
    
    /**
     * Initialize the controller with the VideoSearchService and OpenAIService.
     *
     * @param VideoSearchService $videoSearchService
     * @param OpenAIService $openAIService
     */
    public function __construct(VideoSearchService $videoSearchService, OpenAIService $openAIService)
    {
        $this->videoSearchService = $videoSearchService;
        $this->openAIService = $openAIService;  
    }

    /**
     * Display the YouTube search index page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('youtube.index');
    }

    /**
     * Redirect to the search route with the provided keyword.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToSearch(Request $request)
    {
        $keyword = $request->input('keyword');
        return redirect()->route('youtube.search', ['keyword' => urlencode($keyword)]);
    }

    /**
     * Search for YouTube videos containing the specified keyword in their subtitles.
     *
     * @param string $keyword The search keyword
     * @return \Illuminate\View\View
     */
    public function searchVideosByKeyword($keyword)
    {
        // Perform the search using the VideoSearchService
        $videos = $this->videoSearchService->search($keyword);

        foreach ($videos as &$video) {
            // Generate explanations for each video using OpenAIService
            $video['explanation'] = $this->openAIService->generateExplanation($video['snippet']['title'], $video['snippet']['description']);
        }

        // Return the view with search results
        return view('youtube.search')->with([
            'videos' => $videos,
            'keyword' => $keyword
        ]);
    }
}
