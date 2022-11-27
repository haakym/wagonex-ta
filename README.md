# WagonEx Tech Assessment

## Get started

1. Run `composer install`.
2. Check if `.env`file exists. If not, run `cp .env.example .env`.
3. Update `.env`, add the api-key value to `OPEN_WEATHER_API_APP_ID=`.
4. Run `touch database/database.sqlite`.
5. Run `./vendor/bin/sail up`; docker must be installed and running for this to work.
6. Run `./vendor/bin/sail artisan migrate` to create the database tables.
7. Access on `http://localhost` with postman or use front-end solution.

## Useful tips to review solution

- View `routes/api.php` to see available routes.
- Run `./vendor/bin/sail artisan db:seed` once app is running to seed a few cities.
- To run tests: `./vendor/bin/phpunit`.

## Significant files for review
  - specifications.json
  - routes/api.php
  - app/Http/Controllers/CityController.php
  - app/Http/Controllers/WeatherController.php
  - app/Weather/Repositories/OpenWeatherApiRepository.php
  - app/Weather/Services/ForecastService.php
  - app/Providers/AppServiceProvider.php
  - tests/Feature/AddCityTest.php
  - tests/Feature/GetFiveDayForecastTest.php

## Notes on solution

- On the front-end solution, viewing weather for all cities works, however, the single weather page does not work, this would be fixed with more time.
- On the backend, I initially attempted to use `api.openweathermap.org/data/2.5/forecast/daily` and limit the count to 5 to accomplish the five day summary, however, it would return a 401 due to the api-key settings. So I opted to use the 5 day 3 hour endpoint via `api.openweathermap.org/data/2.5/forecast` and limit the data returned.

### Additional Functionality and improvements

- Feature tests have been added, with more time I would have added Unit tests. I typically use an outside-in (ish) TDD approach, writing Feature tests first, e.g. "Can add a city", then follow up with any related Unit tests.
- For Service and Repository classes, I would have written proper interfaces and binded the interfaces to the full implementation in Laravel's container (e.g. in AppServiceProvider). Doing this makes mocking easier to test the expected behaviour of the aforementioned classes.
- Before writing any code, I wrote a `specifications.json` file using Open API Specifications. This helps me plan out the input and output of the API and plan what data structures should look like. With more time I would go back and update some of this as I'm not sure it lines up exactly with my final refactor.
- Added more "value" objects, eg. 
  - Data object/class representing a forecast
  - An APIKey object/class, instead of relying on a string.
- Add proper exception and error handling.
