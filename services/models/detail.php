<?php


class MovieDetail
{
    public array $directors = [];
    public array $producers = [];
    public array $similarMovies = [];
    public array $actors = [];
    public $trailerKey;
    public array $imagePath = [];
    public array $watchProviders = [];

    public function __construct($id)
    {
        $apiKey = '5596f947d757674db65b85089477fca7';

        $creditsApiUrl = "https://api.themoviedb.org/3/movie/$id/credits?api_key={$apiKey}";
        $creditsData = $this->getApiData($creditsApiUrl);

        $similarMoviesApiUrl = "https://api.themoviedb.org/3/movie/$id/similar?api_key={$apiKey}";
        $similarMoviesData = $this->getApiData($similarMoviesApiUrl);

        $trailersApiUrl = "https://api.themoviedb.org/3/movie/$id/videos?api_key={$apiKey}";
        $trailersData = $this->getApiData($trailersApiUrl);

        $imagesApiUrl = "https://api.themoviedb.org/3/movie/$id/images?api_key={$apiKey}";
        $imagesData = $this->getApiData($imagesApiUrl);

        $watchProvidersApiUrl = "https://api.themoviedb.org/3/movie/$id/watch/providers?api_key={$apiKey}";
        $watchProvidersData = $this->getApiData($watchProvidersApiUrl);

        $this->directors = array_column(
            array_slice(

                array_filter($creditsData['crew'], function ($crewMember) {
                    return $crewMember['job'] === 'Director';
                }),0,5
            )

            , 'name');

        $this->producers = array_column(

            array_slice(
                array_filter($creditsData['crew'], function ($crewMember) {
                    return $crewMember['job'] === 'Producer';
                }),0,5
            )

            , 'name');

        foreach ($similarMoviesData['results'] as $member) {
            array_push($this->similarMovies, $member["id"]);
        }


        foreach ($creditsData['cast'] as $member) {
            array_push($this->actors, $member['name']);
        }

        foreach ($trailersData['results'] as $trailer) {
            if ($trailer['type'] === 'Trailer' && $trailer['site'] === 'YouTube') {
                $this->trailerKey = $trailer['key'];
                break;
            }
        }

        $backdrops = $imagesData['backdrops'];

        usort($backdrops, function ($a, $b) {
            return $b['aspect_ratio'] <=> $a['aspect_ratio'];
        });

        $top10Backdrops = array_slice($backdrops, 0, 10);

        $this->imagePath = array_map(function ($backdrop) {
            return $backdrop['file_path'];
        }, $top10Backdrops);



        if (isset($watchProvidersData['results']['US']['rent'])) {
            $count = 0;
            foreach ($watchProvidersData['results']['US']['rent'] as $provider) {
                $count++;
                array_push($this->watchProviders, $provider['provider_name']);
                if($count>=3){
                    break;
                }
            }
        }

    }

    private function getApiData($url)
    {
        $jsonData = file_get_contents($url);
        if ($jsonData === false) {
            throw new Exception("Failed to get data from URL: $url");
        }

        $data = json_decode($jsonData, true);
        if ($data === null) {
            throw new Exception("Failed to decode JSON data from URL: $url");
        }

        return $data;
    }

}