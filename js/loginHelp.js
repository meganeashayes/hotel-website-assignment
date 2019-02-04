var Help = (function() {
    "use strict";

    var pub = {}; //The public interface

    /**
     * @desc Provide an alert to let the user know where they can
     * find login details
     * @returns {boolean}
     */
    function alertHelp() {
        alert("For login details, please refer to the report!");
        return false;
    }

    /**
     * @desc Do the necessary setup and invocation
     */
    pub.setup = function () {
        $("#loginHelp").click(alertHelp);
    };

    return pub; //expose the public interface
}());

$(document).ready(Help.setup);