document.addEventListener("DOMContentLoaded", function () {
  const countryLookup = document.getElementById("lookup");
  const cityLookup = document.getElementById("city-btn");
  const result = document.getElementById("result");

  function fetchData(url, params) {
    return fetch(url + params)
      .then((response) => response.json())
      .catch((error) => {
        console.error(error);
      });
  }

  function handleLookup(lookupType) {
    const country = encodeURIComponent(
      document.getElementById("country").value.trim()
    );

    let params = `?country=${country}`;
    if (lookupType === "cities") {
      params += "&lookup=cities";
    }

    fetchData("world.php", params).then((response) => {
      result.innerHTML = response;
    });
  }

  // country
  countryLookup.addEventListener("click", function () {
    handleLookup();
  });

  // cities
  cityLookup.addEventListener("click", function () {
    handleLookup("cities");
  });
});
