(function ($) {
    const cal = $('#calendar')

    $(document).ready(function () {
        cal.calendar({
            ...mcplCalendar,
            highlightSelectedWeek: false,
            highlightSelectedWeekday: false,
            showYearDropdown: true,
            startOnMonday: false,
            monthYearOrder: 'ym',
            onClickDate: function (date) {
                console.log(location.href)
                if (!moment(cal.getSelectedDate()).isSame(date)) {
                    location.href = '?date=' + (moment(date).format('YYYY-MM-DD'))
                }
            }
        })
    })
})(jQuery)
