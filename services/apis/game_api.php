<?php

function get_games($category){
    $cat=$category;
    if($cat=="New Releases"){
        $url="https://api.rawg.io/api/games?dates=2022-06-08,2023-06-08&ordering=-released,-rating&page_size=20&page=1&platforms=1,187,18,186,14&languages=en&key=c8750653a2754ea49bb6b6ff57ff592a";
    } else if($cat=="Best of the year"){
        $url="https://api.rawg.io/api/games?dates=2023-01-01,2023-06-08&ordering=-rating&page_size=20&platforms=1,187,18,186,14&languages=en&key=c8750653a2754ea49bb6b6ff57ff592a";
    } else if($cat=="All time top"){
        $url="https://api.rawg.io/api/games?dates=2005-01-01,2023-06-08&ordering=-rating&page_size=20&key=c8750653a2754ea49bb6b6ff57ff592a&platforms=1,187,18,186,14&languages=en";
    } else{
        $url="https://api.rawg.io/api/games?page_size=20&key=c8750653a2754ea49bb6b6ff57ff592a&platforms=1,187,18,186,14&languages=en";
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





?>