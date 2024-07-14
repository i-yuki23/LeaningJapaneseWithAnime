<?php

namespace App\Services;

use Google_Client;
use Google_Service_YouTube;

/**
 * Service for searching YouTube videos with caption-based filtering.
 * 
 * This service uses the YouTube Data API to search for videos and then
 * filters the results based on the presence of a keyword in the captions.
 */
class VideoSearchService
{
    protected $client;
    protected $youtube;

    /**
     * Initialize the Google client and YouTube service.
     *
     */
    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setDeveloperKey(env('GOOGLE_API_KEY')); // Use your API key
        $this->youtube = new Google_Service_YouTube($this->client);
    }

    /**
     * Search for videos containing the specified keyword in their captions.
     *
     * @param string $query The search keyword
     * @param string $language The language code for captions (default: 'ja')
     * @param int $maxResults Maximum number of results to return (default: 1)
     * @return array Array of video data containing the keyword in captions
     */
    public function search($query, $language = 'ja', $maxResults = 1)
    {
        $searchResponse = $this->youtube->search->listSearch('id,snippet', [
            'q' => $query,
            'type' => 'video',
            // 'videoCaption' => 'closedCaption',
            'relevanceLanguage' => $language,
            'maxResults' => $maxResults,
            'videoEmbeddable' => true,
            // 'videoLicense' => 'creativeCommon',
        ]);

        return $searchResponse['items'];
    }

}
