<script>
    $(".date").click(function () {
        $(".picker").css(
            {
                'height': 'auto',
                'transform': 'scale(1)',
                'transition': '.5s',
                'transitionDelay': '1s',
                'position': 'relative'
            });

    })
    $('.startDate').persianDatepicker({
        observer: true,
        format: 'YYYY/MM/DD',
        altField: '#startDate'
    });
    $('.endDate').persianDatepicker({
        observer: true,
        format: 'YYYY/MM/DD',
        altField: '#endDate'
    });
    $(document).ready(function () {
        $(".submit_date").click(function () {
            $(".submit_date").removeClass('border')
            $(this).addClass('border')
            $('#input_date').val($(this).data('date'))
            $('#startDate').val('');
            $('#endDate').val('');
            permissionRequest();
            $('#form').submit()

        });

        $(".search").click(function () {
            $('#startDate').val('');
            $('#endDate').val('');
            permissionRequest();
            $('#form').submit();
        })

        function permissionRequest() {
            if ($('#input_search').val() === '')
                $("#input_search").removeAttr('name')

            if ($('#input_date').val() === '')
                $("#input_date").removeAttr('name')

            if ($('#startDate').val() === '')
                $("#startDate").removeAttr('name')

            if ($('#endDate').val() === '')
                $("#endDate").removeAttr('name')
        }

        $('.submit-date').click(function () {
            permissionRequest();
            $('#form').submit();
        })

        $(".searchInput").on('keydown', function (event) {
            if (event.key == 'Enter') {
                event.preventDefault();
            }

        })
        $(".profile").click(function () {
            $(".profileBox").toggleClass('active')
            if ($('.profileBox').hasClass('active')) {
                $(this).attr('src', "{{asset('capsule/images/2025-03-01_14-15-45.svg')}}")
            } else {
                $(this).attr('src', "{{asset('capsule/images/userIcon.svg')}}")
            }
        })
        $('.updatePro').click(function () {
            $(".editPro").toggleClass('editProActive')
            $(".profile").trigger('click')

        })
        $('.close-profile').click(function () {
            $(".editPro").toggleClass('editProActive')

        })
        $(".editPro").css({
            top: window.innerHeight / 2
        })

    })

</script>
<script>

    function select2Start() {
        $(".select2").select2({});
    }

    select2Start();
</script>
<script>
    function toast(message, status) {
        showToast(message);
        if (!status) {
            $(".progress-bar div").css({'background-color': 'red'})
        }

    }

</script>

<script>
    if ('input_search' in window)
    {
        window.input_search.addEventListener("keydown", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                let searchIcon=document.querySelector('.search');
                searchIcon.click();
            }
        });
    }

</script>
