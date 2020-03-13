require('./bootstrap');
require('./component');
require('./support/functions');
require('./support/countries');

import WeatherWidget from './widgets/WeatherWidget';

global.widgets = {};
global.widgets.weatherWidget = WeatherWidget;
