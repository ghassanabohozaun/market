document.addEventListener("DOMContentLoaded", function () {
    const searchForm = document.querySelector(".weather-search-form");
    const submitBtn = document.querySelector(".btn-weather-search");

    if (searchForm) {
        searchForm.addEventListener("submit", function () {
            submitBtn.innerHTML =
                '<i class="mdi mdi-loading mdi-spin"></i> ' +
                (window.Translations && window.Translations.weather_searching
                    ? window.Translations.weather_searching
                    : "جاري البحث...");
            submitBtn.style.opacity = "0.8";
            submitBtn.disabled = true;
        });
    }
});
