module.exports = (function($) {

    var cache = {};


    var temp = (function() {
        var cache = {};

        cache = {};

        function temp(str, data){
            // Figure out if we're getting a template, or if we need to
            // load the template - and be sure to cache the result.

            var fn = !/\W/.test(str) ?
                cache[str] = cache[str] ||
                    temp(document.getElementById(str).innerHTML) :

                // Generate a reusable function that will serve as a template
                // generator (and which will be cached).
                new Function("obj",
                    "var p=[],\n\tprint=function(){p.push.apply(p,arguments);};\n" +

                        // Introduce the data as local variables using with(){}
                        "\nwith(obj){\np.push('" +

                        // Convert the template into pure JavaScript
                        str
                            .replace(/[\r\t\n]/g, " ")
                            .split("<%").join("\t")
                            .replace(/((^|%>)[^\t]*)'/g, "$1\r")
                            .replace(/\t=(.*?)%>/g, "',\n$1,\n'")
                            .split("\t").join("');\n")
                            .split("%>").join("\np.push('")
                            .split("\r").join("\\'") +
                        "');\n}\nreturn p.join('');");

            // Provide some basic currying to the user
            return data ? fn(data) : fn;
        }

        return {
            temp: temp
        };
    })();

    $.temp = temp.temp;

    return $.temp;
})(jQuery);