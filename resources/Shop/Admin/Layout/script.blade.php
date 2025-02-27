

<script>
    $(".date").click(function (){
        $(".picker").css(
            {
                'height':'auto',
                'transform':'scale(1)',
                'transition':'.5s',
                'transitionDelay':'1s',
                'position':'relative'
            });

    })
    $('.startDate').persianDatepicker({
        observer: true,
        format: 'YYYY/MM/DD',
        altField: '.observer-example-alt'
    });
    $('.endDate').persianDatepicker({
        observer: true,
        format: 'YYYY/MM/DD',
        altField: '.observer-example-alt'
    });
            $(document).ready(function(){
                $(".submit_date").click(function (){
                    $(".submit_date").removeClass('border')
                    $(this).addClass('border')
                    $('#input_date').val($(this).data('date'))
                    permissionRequest();
                    $('#form').submit()

                });

                $(".search").click(function (){
                    permissionRequest();
                    $('#form').submit();
                })

                function permissionRequest()
                {
                    if ($('#input_search').val()==='')
                        $("#input_search").removeAttr('name')

                    if ($('#input_date').val()==='')
                        $("#input_date").removeAttr('name')

                    if ($('#customDate').val()==='')
                        $("#customDate").removeAttr('name')
                }

            })

</script>
