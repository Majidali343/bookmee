(function ($) {
    'use strict';
    $.fn.countdown = function (options) {
        return $.fn.countdown.begin(this, $.extend({
            year: 2019, // YYYY Format
            month: 1, // 1-12
            day: 1, // 1-31
            hour: 0, // 24 hour format 0-23
            minute: 0, // 0-59
            second: 0, // 0-59
            timezone: -6, // http://en.wikipedia.org/wiki/List_of_tz_database_time_zones
            labelText: {},
            labels: true, // If false days hours seconds and monutes labels will not be created
            onFinish: function () { }  // Executes client side when timer is zero
        }, options));
    };

    $.fn.countdown.begin = function (parent, settings) {

        // Define Variables
        var timespan, start, end;

        // Define Target Date/time
        end = new Date(settings.year, settings.month - 1, settings.day, settings.hour, settings.minute, settings.second);

        // Converts Local Timezone to Target Timezone
        start = $.fn.countdown.convertTimezone(settings.timezone);

        // Defines countdown data
        timespan = $.fn.countdown.getTimeRemaining(start, end, settings);

        // Check if the script has run before
        if (!settings.init) {

            // Create elements
            $.each(timespan, function (k, v) {
                // Define variables being used
                var container, wrapper, time, label,newlevel,oldlebel;

                // Create elemnt container
                container = $('<div/>').addClass('nx-singular-countdown-item').attr('id', k);

                // Create wrapper clement
                wrapper = $('<div/>').addClass('wrapper');

                // Create time clement
                time = $('<span/>').addClass('time').text(v < 10 ? '0' + v : v.toLocaleString());

                if (settings.labels) {

                    oldlebel = $.fn.countdown.singularize(k);
                    $.each(settings.labelText,function (index,value) {
                        if (k == index){
                            newlevel =  value;
                            return false;
                        }
                    })
                    label = $('<span/>').addClass('label').text((v === 1 ? oldlebel : newlevel));
                    // Add everything to container element
                    container.append(wrapper.append(time).append(label));
                } else {
                    container.append(wrapper.append(time));
                }

                // Add elements to parent element
                parent.append(container);
            });

            // Tell the script that it has already been run
            settings.init = true;
        } else {
            // Update each element
            $.each(timespan, function (k, v) {
                $('.time', '#' + k).text(v < 10 ? '0' + v : v.toLocaleString());
                var oldlebel,newlevel;
                oldlebel = $.fn.countdown.singularize(k);
                $.each(settings.labelText,function (index,value) {
                    if (k == index){
                        newlevel =  value;
                        return false;
                    }
                })
                $('.label', '#' + k).text((v === 1 ? oldlebel : newlevel));
            });
        }

        // Check if target date has beeen reached
        if (settings.target_reached) {

            // Executetes function once timer reaches zero
            settings.onFinish();

        } else {

            // Updates the time every second for the visitor
            setTimeout(function () {
                $.fn.countdown.begin(parent, settings);
            }, 1000);
        }
    };

    // Removes the S in days hours minutes seconds
    $.fn.countdown.singularize = function (str) {
        return str.substr(0, str.length - 1);
    };

    // Converts local timezone to target timezone
    $.fn.countdown.convertTimezone = function (timezone) {
        var now, local_time, local_offset, utc;
        now = new Date();
        local_time = now.getTime();
        local_offset = now.getTimezoneOffset() * 60000;
        utc = local_time + local_offset;
        return new Date(utc + (3600000 * timezone));
    };

    // Returns time remaining data for view
    $.fn.countdown.getTimeRemaining = function (start, end, settings) {
        var timeleft, remaining;
        remaining = {};
        timeleft = (end.getTime() - start.getTime());
        timeleft = (timeleft < 0 ? 0 : timeleft);

        // Check if target date has been reached
        if (timeleft === 0) {
            settings.target_reached = true;
        }

        // Built deturn object
        remaining.days = Math.floor(timeleft / (24 * 60 * 60 * 1000));
        remaining.hours = Math.floor((timeleft / (24 * 60 * 60 * 1000) - remaining.days) * 24);
        remaining.minutes = Math.floor(((timeleft / (24 * 60 * 60 * 1000) - remaining.days) * 24 - remaining.hours) * 60);
        remaining.seconds = Math.floor(timeleft / 1000 % 60);
        return remaining;
    };
}(jQuery));