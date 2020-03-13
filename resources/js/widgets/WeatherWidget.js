import { showPreloader, hidePreloader } from '../support/preloader';
import Component from '../component';
import { countries } from '../support/countries';
import { capitalizeFirstLetter } from '../support/functions';
import { api } from '../api';

/**
 * Weather Widget frontend class
 */
export default class WeatherWidget extends Component
{
    /**
     * Constructor
     * 
     * @return {void}
     */
    constructor(props)
    {
        super();

        this.id = props.id;

        this.city = '';
        this.country = '';
        this.weather = false;

        this.request = {
            weatherForecast: api.getWeatherForecast,
        }

        this.showPreloader = showPreloader;
        this.hidePreloader = hidePreloader;
    }
    
    /**
     * Executed when the document is ready
     * 
     * @return {void}
     */
    mount()
    {
        const instance = this;

        $(`#${this.id}-submit`).click(function () {
            instance.city = $(`#${instance.id}-city`).val();
            instance.country = $(`#${instance.id}-country`).val();
            instance.getWeatherAction();
        });
    }

    /**
     * Executed when the document is ready
     * 
     * @return {void}
     */
    async getWeatherAction()
    {
        this.showPreloader(`${this.id}-preloader`);

        try {
            let errors = [];
            if (!this.city.length) errors.push('The city name cannot be empty');
            if (!this.country.length) errors.push('The country name cannot be empty');
            if (errors.length) {
                this.hidePreloader(`${this.id}-preloader`);
                return this.renderError(errors);
            }
            const response = await this.request.weatherForecast(this.country, this.city)

            if (response.error !== undefined && response.error) {
                throw new Error(response.message);
            }

            if (!response.data) {
                throw new Error("There was a problem getting the Weather.");
            }

            this.weather = response.data;
            this.hidePreloader(`${this.id}-preloader`);
            this.renderWeather();
        } catch (error) {
            this.hidePreloader(`${this.id}-preloader`);
            this.renderError(error.message);
        }
    }

    /**
     * Render the error messages
     * 
     * @param {array|string} errors The error message or messages
     * @return {void}
     */
    renderError(errors)
    {
        let errorMessage = '';
        const container = `#${this.id}-results`;
        if (!Array.isArray(errors)) errors = [errors];
    
        for (const [key, value] of Object.entries(errors)) {
            errorMessage = '<p>' + capitalizeFirstLetter(value) + '<p/>';
        }

        let toRender = `
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>oops!</strong> ${errorMessage}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        `;

        $(container).empty();
        $(container).append(toRender);
    }

    /**
     * Render the weather results
     * 
     * @return {void}
     */
    renderWeather ()
    {
        const container = `#${this.id}-results`;

        const {list, city } = { ...this.weather };
        this.weather = false;
        let toRender = `
            <h3 class='pt-2'>${capitalizeFirstLetter(this.city)}, ${countries[this.country.toUpperCase()]}</h3>
            <span></span>
            <div style='display:block;'>
                <span>Latitude: ${city.latitude}</span>
                <span>Longitude: ${city.longitude}</span>
            </div>
            <div class="accordion" id='watherAccordion'>
        `;

        for (var i=0; i < list.length; i++) {

            const wTime = list[i];

            const weather = wTime.weather !== undefined ? capitalizeFirstLetter(wTime.weather) : ' - ';
            const description = wTime.description !== undefined ? capitalizeFirstLetter(wTime.description) : ' - ';
            const clouds = wTime.clouds !== undefined ? wTime.clouds : ' - ';
            const humidity = wTime.humidity !== undefined ? wTime.humidity : ' - ';
            const pressure = wTime.pressure !== undefined ? wTime.pressure : ' - ';
            const windSpeed = wTime.windSpeed !== undefined ? wTime.windSpeed : ' - ';
            const windDirection = wTime.windDirection !== undefined ? wTime.windDirection : ' - ';
            const temp = wTime.temp !== undefined ? wTime.temp : ' - ';
            const feelsLike = wTime.feelsLike !== undefined ? wTime.feelsLike : ' - ';
            const tempMin = wTime.tempMin !== undefined ? wTime.tempMin : ' - ';
            const tempMax = wTime.tempMax !== undefined ? wTime.tempMax : ' - ';

            var date = new Date(wTime.date);
            var date2 = new Date(wTime.date);
            date2.setHours( date2.getHours() + parseInt(wTime.hours) );
                  
            toRender  += `
            <div class="card">
                <div class="card-header" id="heading${i}"  data-toggle="collapse" data-target="#collapse${i}" aria-expanded="false" aria-controls="collapse${i}">
                    <h5 class="mb-0 p-2">
                        From: ${date.getDate()}/${date.getMonth()+1}/${date.getFullYear()} ${date.getHours()}h To: ${date2.getDate()}/${date2.getMonth()+1}/${date2.getFullYear()} ${date2.getHours()}h
                    </h5>
                </div>
                <div id="collapse${i}" class="collapse show" aria-labelledby="heading${i}" data-parent="#watherAccordion">
                    <div class="card-body">
                        <span><b>Weather</b>: ${weather}, ${description}<br/>`;
            toRender  += `<span><b>Temperature</b>: ${temp}º</span><br/>`;
            toRender  += `<span><b>Feels like</b>: ${feelsLike}º</span><br/>`; 
            toRender  += `<span><b>Min. Temperature</b>: ${tempMin}º</span><br/>`; 
            toRender  += `<span><b>Max. Temperature</b>: ${tempMax}º</span><br/>`; 
            toRender  += `<span><b>Win direction</b>: ${windDirection}º</span><br/>`;  
            toRender += `<span><b>Win speed</b>: ${windSpeed}km/h</span><br/>`;
            toRender += `<span><b>Pressure</b>: ${pressure} hPa</span><br/>`;
            toRender += `<span><b>Humidity</b>: ${humidity}%</span><br/>`;
            toRender += `<span><b>Clouds</b>: ${clouds}%</span>`;
            toRender += `</div></div></div>
                    </div>
                </div>
            </div>`;
        }

        toRender += `</div>`;
        $(container).html(toRender);
        $('.collapse').collapse();
    }
}
