/* ------------------------------------------------------------------------------
 *
 *  # Fullcalendar basic options
 *
 *  Demo JS code for extra_fullcalendar_views.html and extra_fullcalendar_styling.html pages
 *
 * ---------------------------------------------------------------------------- */


// Setup module
// ------------------------------

var FullCalendarBasic = function () {


    //
    // Setup module components
    //

    // Basic calendar
    var _componentFullCalendarBasic = function (events) {
        if (!$().fullCalendar) {
            console.warn('Warning - fullcalendar.min.js is not loaded.');
            return;
        }

        // Initialization
        // ------------------------------

        // Basic view
        $('.fullcalendar-basic').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            editable: true,
            events: events,
            eventLimit: true,
            isRTL: $('html').attr('dir') == 'rtl' ? true : false
        });

        // Agenda view
        $('.fullcalendar-agenda').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultDate: '2014-11-12',
            defaultView: 'agendaWeek',
            editable: true,
            businessHours: true,
            events: events,
            isRTL: $('html').attr('dir') == 'rtl' ? true : false
        });

        // List view
        $('.fullcalendar-list').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'listDay,listWeek,listMonth'
            },
            views: {
                listDay: {
                    buttonText: 'Day'
                },
                listWeek: {
                    buttonText: 'Week'
                },
                listMonth: {
                    buttonText: 'Month'
                }
            },
            defaultView: 'listMonth',
            defaultDate: '2014-11-12',
            navLinks: true, // can click day/week names to navigate views
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: events,
            isRTL: $('html').attr('dir') == 'rtl' ? true : false
        });
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function () {

            $(document).ready(function () {
                events = [];
                $.ajax({
                    method: 'get',
                    url: url,
                    data: {
                        _token: token
                    }
                }).done(function (response) {
                    // console.log(response);
                    $.each(JSON.parse(response), function (index, value) {
                        // console.log(value.created_at);
                        events.push({
                            'title': value.action,
                            'start': value.created_at,
                            'url': base_url + '/' + value.affected_url
                        });
                    });

                    _componentFullCalendarBasic(events);
                    // console.log(response);

                }).fail(function (msg) {
                    console.log(msg);
                });
            });

        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function () {
    FullCalendarBasic.init();
});

