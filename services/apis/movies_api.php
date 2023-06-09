<?php

function get_movies($category) {
    $apiKey = "04a11c37bed080ebfdae72a810bd376e";
    $baseUrl = "https://api.themoviedb.org/3";

    if ($category == "Trending") {
        $url = "{$baseUrl}/trending/movie/week?api_key={$apiKey}";
    } else if ($category == "Top Rated") {
        $url = "{$baseUrl}/movie/top_rated?api_key={$apiKey}&language=en-US&page=1";
    } else if ($category == "Most Popular") {
        $url = "{$baseUrl}/movie/popular?api_key={$apiKey}&language=en-US&page=1";
    } else {
        return "Invalid category";
    }

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
 
    if (curl_error($curl)) {
        $error_msg = curl_error($curl);
    }

    curl_close($curl);
    $data = json_decode($response, true);
    return $data;
}

function get_genre_name($genre_id) {
    static $genres = null;
    $apiKey = "04a11c37bed080ebfdae72a810bd376e";
    $baseUrl = "https://api.themoviedb.org/3";

    if ($genres === null){        
        $url = "{$baseUrl}/genre/movie/list?api_key={$apiKey}&language=en-US";
        $response = json_decode(file_get_contents($url), true);
        $genres = $response['genres'];
    }

    foreach ($genres as $genre) {
        if ($genre['id'] == $genre_id) {
            return $genre['name'];
        }
    }

    return null;
}
?>
