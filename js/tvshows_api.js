async function getTvShows(category) {
    const apiKey = "04a11c37bed080ebfdae72a810bd376e";
    const baseUrl = "https://api.themoviedb.org/3";
    let url;
  
    if (category === "Trending") {
      url = `${baseUrl}/trending/tv/week?api_key=${apiKey}`;
    } else if (category === "Top Rated") {
      url = `${baseUrl}/tv/top_rated?api_key=${apiKey}&language=en-US&page=1`;
    } else if (category === "Most Popular") {
      url = `${baseUrl}/tv/popular?api_key=${apiKey}&language=en-US&page=1`;
    } else {
      return "Invalid category";
    }
  
    try {
      const response = await fetch(url);
      const data = await response.json();
      return data;
    } catch (error) {
      console.error("Error fetching data:", error);
      return null;
    }
  }

  async function getGenres() {
    const apiKey = "04a11c37bed080ebfdae72a810bd376e";
    const url = `https://api.themoviedb.org/3/genre/tv/list?api_key=${apiKey}&language=en-US`;
  
    try {
      const response = await fetch(url);
      const data = await response.json();
      return data.genres;
    } catch (error) {
      console.error("Error fetching genres:", error);
      return null;
    }
  }
  function getGenreNames(genreIds, genres) {
    return genreIds.map(id => genres.find(genre => genre.id === id).name).join(', ');
  } 