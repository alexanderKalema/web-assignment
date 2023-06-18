<?php
// Replace YOUR_API_KEY with your actual TMDb API key
$apiKey = '5596f947d757674db65b85089477fca7';



if (isset($movieName)) {
    $encodedMovieName = urlencode($movieName);




    // Fetch movie details from TMDb API
    $apiUrl = "https://api.themoviedb.org/3/search/movie?api_key={$apiKey}&query={$encodedMovieName}";
    $response = file_get_contents($apiUrl);
    $data = json_decode($response, true);

    if (isset($data['results'][0])) {
        // Get the first movie result
        $movie = $data['results'][0];
       
        
        // Extract movie details
        $title = $movie['title'];
        $overview = $movie['overview'];
        $posterPath = $movie['poster_path'];
        $backdropPath = $movie['backdrop_path'];
        $releaseDate = $movie['release_date'];

         // Fetch movie credits
         $creditsApiUrl = "https://api.themoviedb.org/3/movie/{$movie['id']}/credits?api_key={$apiKey}";
         $creditsResponse = file_get_contents($creditsApiUrl);
         $creditsData = json_decode($creditsResponse, true);
 
         $directors = array_column(array_filter($creditsData['crew'], function($crewMember) {
             return $crewMember['job'] === 'Director';
         }), 'name');
 
         $writers = array_column(array_filter($creditsData['crew'], function($crewMember) {
             return $crewMember['job'] === 'Writer';
         }), 'name');
 

        $similarMoviesApiUrl = "https://api.themoviedb.org/3/movie/{$movie['id']}/similar?api_key={$apiKey}";
        $similarMoviesResponse = file_get_contents($similarMoviesApiUrl);
        $similarMoviesData = json_decode($similarMoviesResponse, true);

        if (isset($similarMoviesData['results'])) {
            $similarMovies = $similarMoviesData['results'];
            
            usort($similarMovies, function($a, $b) {
                return $b['popularity'] - $a['popularity'];
            });
            
        }
        

        $creditsApiUrl = "https://api.themoviedb.org/3/movie/{$movie['id']}/credits?api_key={$apiKey}";
        $creditsResponse = file_get_contents($creditsApiUrl);
        $creditsData = json_decode($creditsResponse, true);

        if (isset($creditsData['cast'])) {
            $cast = $creditsData['cast'];
            $actors = [];

            foreach ($cast as $member) {
                $actorName = $member['name'];
                $actors[] = $actorName;
            }
        } else {
            $actors = [];
        }
    

        // Fetch movie genres
        $genresApiUrl = "https://api.themoviedb.org/3/genre/movie/list?api_key={$apiKey}";
        $genresResponse = file_get_contents($genresApiUrl);
        $genresData = json_decode($genresResponse, true);
        $genres = $genresData['genres'];

        // Map genre IDs to genre names
        $genreNames = array_map(function ($genreId) use ($genres) {
            foreach ($genres as $genre) {
                if ($genre['id'] == $genreId) {
                    return $genre['name'];
                }
            }
        }, $genreIds);

        // Fetch movie trailer
        $movieId = $movie['id'];
        $trailersApiUrl = "https://api.themoviedb.org/3/movie/{$movieId}/videos?api_key={$apiKey}";
        $trailersResponse = file_get_contents($trailersApiUrl);
        $trailersData = json_decode($trailersResponse, true);

        $trailerKey = null;
        if (isset($trailersData['results'])) {
            foreach ($trailersData['results'] as $trailer) {
                if ($trailer['type'] === 'Trailer' && $trailer['site'] === 'YouTube') {
                    $trailerKey = $trailer['key'];
                    break;
                }
            }
        }
        
        

        // Fetch movie watch providers
$watchProvidersApiUrl = "https://api.themoviedb.org/3/movie/{$movie['id']}/watch/providers?api_key={$apiKey}";
$watchProvidersResponse = file_get_contents($watchProvidersApiUrl);
$watchProvidersData = json_decode($watchProvidersResponse, true);

$providers = [];
if (isset($watchProvidersData['results'])) {
    $results = $watchProvidersData['results'];
    $providers = [];

    foreach ($results as $country) {
        $countryName = $country['iso_3166_1'];
        $streamingProviders = $country['flatrate'];

        if (isset($streamingProviders)) {
            foreach ($streamingProviders as $provider) {
                $providerName = $provider['provider_name'];
                $providers[$countryName][] = $providerName;
            }
        }
    }
}


        // Fetch movie images
        $imagesApiUrl = "https://api.themoviedb.org/3/movie/{$movieId}/images?api_key={$apiKey}";
        $imagesResponse = file_get_contents($imagesApiUrl);
        $imagesData = json_decode($imagesResponse, true);
        $backdrops = $imagesData['backdrops'];

        // Get the first 10 images
        $backdropImages = array_slice($backdrops, 0, 10);

        // Extract the file paths of the images
        $imagePaths = array_map(function ($image) {
            return $image['file_path'];
        }, $backdropImages);
    } else {
        echo "No movie found with the given name.";
    }
} else {
    echo "Please provide a movie name.";
}
?>

