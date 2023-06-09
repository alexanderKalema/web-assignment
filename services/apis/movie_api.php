<?php


function get_movies($category)
{

    $genre_url = 'https://api.themoviedb.org/3/genre/movie/list';
    $genre_params = array(
        'api_key' => '04a11c37bed080ebfdae72a810bd376e',
        'language' => 'en-US'
    );
    $genre_url .= '?' . http_build_query($genre_params);
    $genre_curl = curl_init($genre_url);
    curl_setopt($genre_curl, CURLOPT_RETURNTRANSFER, true);
    $genre_response = curl_exec($genre_curl);
    curl_close($genre_curl);
    $genre_data = json_decode($genre_response, true);

// Create a mapping of genre IDs to genre names
    $genre_map = array();

    foreach ($genre_data['genres'] as $genre) {
        $genre_map[$genre['id']] = $genre['name'];
    }


    $url = "https://api.themoviedb.org/3/movie/$category";

    $params = array(
        'api_key' => '04a11c37bed080ebfdae72a810bd376e',
        'id' => 766507,
        'language' => 'en-US',
        'page' => 1,

    );

    $url .= '?' . http_build_query($params);

    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);

    if (curl_error($curl)) {
        $error_msg = curl_error($curl);
        // Handle the error
    }

    curl_close($curl);


    $data = json_decode($response, true);


    foreach ($data['results'] as &$movie) {
        $genre_names = array();
        foreach ($movie['genre_ids'] as $genre_id) {
            if ($genre_map[$genre_id]) {
                $genre_names[] = $genre_map[$genre_id];
            }
        }


        $movie['genre_names'] = $genre_names;
    }


    return $data;
}
?>
