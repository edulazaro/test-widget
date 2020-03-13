## Weather Widget

This widget displays weather forecast of the https://openweathermap.org/api webstie

## Requirements

PHP >= 7.2
Composer
Npm

## Installation

Unzip the files into any folder and run the next commandt to install all dependences:

```composer install```

Then install NPM prequired packages by executing:

```npm install```

You can now rename the ```.env.example``` file to ```.env``` and the application will be ready to use with the demo config.

## How to run the APP

Start the bundled development server using the next command:

```php artisan serve``` 

You can then access the URL http://localhost:8000/ in your local to view the index page of the project.

The index page displays three widget instances. Type any city in the field labeled as **_City_** and then select the **_country_** of the city. Click the **_Submit_** button to view the results.

You can find the ```preview.jpg``` image at the root of the project to check how it looks.

## Running the tests

This APP includes some unit and integration tests. You can run them by executing the command ```./vendor/bin/``` in your console.

## Considerations

* Crated data transfer classes to standarize API responses, so it's easier to add more weather providers or modify the current one.
* Used a PHP widget component which can be easily bundled into any page.
* Made a JS Widget class which is automatically instantiated when the Widget is created.
* Used bootstrap 4

## Possible improvements

* Add API auth and API keys to use it with more projects.
* Use a Vue/React component replacing the JS one and the widget template.
* Show the weather with a set of horizontally scrollable panels, each one corresponding to a range of three hours.
