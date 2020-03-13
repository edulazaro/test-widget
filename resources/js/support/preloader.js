/**
 * Shows a preloading image
 * 
 * @param {string} preloader The preloader id
 * @param {*} callback The preloader callback method
 * @return {void}
 */
export const showPreloader = function (preloader, callback)  
{
    document.getElementById(preloader).style.display='inline';
    if (typeof callback !== 'undefined') {
        callback(); 
    }
}

/**
 * Hides a preloading image
 * 
 * @param {string} preloader The preloader id
 * @param {*} callback The preloader callback method
 * @return {void}
 */
export const hidePreloader = function (preloader, callback)
{
    document.getElementById(preloader).style.display='none';
    if (typeof callback !== 'undefined') {
        callback();
    }
}