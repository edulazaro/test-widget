/**
 * Main component class
 */
export default class Component {

    /**
     * Constructor
     * 
     * @return {void}
     */
    constructor ()
    {
        this.ready();
    }

    /**
     * Trigger jQuery document ready
     * 
     * @return {void}
     */
    ready ()
    {
        const instance = this;
        $(document).ready( function () {
            if (typeof instance.mount !== "undefined") {
                instance.mount();
            }
        });
    }
}
