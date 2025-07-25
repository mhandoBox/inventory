$(document).ready(function() {
    // Data for the vector map
    var visitorsData = {
        "US": 398, //USA
        "SA": 400, //Saudi Arabia
        "CA": 1000, //Canada
        "DE": 500, //Germany
        "FR": 760, //France
        "CN": 300, //China
        "AU": 700, //Australia
        "BR": 600, //Brazil
        "IN": 800, //India
        "GB": 320, //Great Britain
        "RU": 3000 //Russia
    };

    // Function to initialize the vector map
    function initVectorMap() {
        if ($('#world-map').length) {
            try {
                $('#world-map').vectorMap({
                    map: 'world_mill',
                    backgroundColor: "transparent",
                    regionStyle: {
                        initial: {
                            fill: '#e4e4e4',
                            "fill-opacity": 1,
                            stroke: 'none',
                            "stroke-width": 0,
                            "stroke-opacity": 1
                        }
                    },
                    series: {
                        regions: [{
                            values: visitorsData,
                            scale: ["#92c1dc", "#ebf4f9"],
                            normalizeFunction: 'polynomial'
                        }]
                    },
                    onRegionLabelShow: function (e, el, code) {
                        if (typeof visitorsData[code] != "undefined") {
                            el.html(el.html() + ': ' + visitorsData[code] + ' new visitors');
                        }
                    }
                });
            } catch (e) {
                console.warn('JVectorMap initialization error:', e);
            }
        }
    }

    // Check if vector map script is loaded
    var maxAttempts = 10;
    var attempts = 0;
    var checkVectorMap = setInterval(function() {
        if (typeof $.fn.vectorMap !== 'undefined') {
            clearInterval(checkVectorMap);
            initVectorMap();
        } else if (attempts >= maxAttempts) {
            clearInterval(checkVectorMap);
            console.warn('JVectorMap failed to load after ' + maxAttempts + ' attempts');
        }
        attempts++;
    }, 500);
});
