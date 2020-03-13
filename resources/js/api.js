export const api = {

    /**
     * Api call to get the weather
     * 
     * @param {string} country Country request parameter
     * @param {city} city City request parameter
     * @return {string}
     */
    getWeatherForecast: (country, city) => fetch(`api/v1/weather/${country}/${city}`, {
        method: 'GET',
            headers:{
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            }
        }
    ).then((response) => { return response.json(); } ),

}