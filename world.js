document.addEventListener("DOMContentLoaded", function () {
  const countryLookup = document.getElementById("lookup");
  const result = document.getElementById("result");

  function fetchData(url, params) {
    return fetch(url + params)
      .then((response) => response.json())
      .catch((error) => {
        console.error(error);
      });
  }

  function handleLookup() {
    const country = encodeURIComponent(
      document.getElementById("country").value.trim()
    );

    let params = `?country=${country}`;
    fetchData("world.php", params).then((response) => {
      result.innerHTML = response;
    });
  }

  // country
  countryLookup.addEventListener("click", function () {
    handleLookup();
  });
});
