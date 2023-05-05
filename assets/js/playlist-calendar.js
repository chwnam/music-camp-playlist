/* global mpclCalendar */
(function ($) {
    const cal = $('#calendar')

    $(document).ready(function () {
        cal.calendar({
            ...mcplCalendar.calendar,
            highlightSelectedWeek: false,
            highlightSelectedWeekday: false,
            showYearDropdown: true,
            startOnMonday: false,
            monthYearOrder: 'ym',
            onClickDate: function (date) {
                if (!moment(cal.getSelectedDate()).isSame(date)) {
                    location.href = '?date=' + (moment(date).format('YYYY-MM-DD'))
                }
            }
        })

        $('#check-playlist').on('click', (e) => {
            e.preventDefault();
            open(e.currentTarget.href, 'playlist', 'popup,width=640,height=520');
        })

        $('#refetch-playlist').on('click', (e) => {
            e.preventDefault();
            if (!confirm('이 날짜의 플레이리스트를 다시 수집할까요?')) {
                return
            }

            $.ajax(mcplCalendar.ajax.url, {
                method: 'post',
                data: {
                    action: 'refetch_playlist',
                    nonce: mcplCalendar.ajax.refetchNonce,
                    date: mcplCalendar.calendar.date,
                },
                success: function (r) {
                    if (r.success) {
                        location.reload()
                    }
                },
            })
        })
    })
})(jQuery)
