

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
        altField: '#startDate'
    });
    $('.endDate').persianDatepicker({
        observer: true,
        format: 'YYYY/MM/DD',
        altField: '#endDate'
    });
            $(document).ready(function(){
                $(".submit_date").click(function (){
                    $(".submit_date").removeClass('border')
                    $(this).addClass('border')
                    $('#input_date').val($(this).data('date'))
                    $('#startDate').val('');
                    $('#endDate').val('');
                    permissionRequest();
                    $('#form').submit()

                });

                $(".search").click(function (){
                    $('#startDate').val('');
                    $('#endDate').val('');
                    permissionRequest();
                    $('#form').submit();
                })

                function permissionRequest()
                {
                    if ($('#input_search').val()==='')
                        $("#input_search").removeAttr('name')

                    if ($('#input_date').val()==='')
                        $("#input_date").removeAttr('name')

                    if ($('#startDate').val()==='')
                        $("#startDate").removeAttr('name')

                    if ($('#endDate').val()==='')
                        $("#endDate").removeAttr('name')
                }

                $('.submit-date').click(function(){
                    permissionRequest();
                    $('#form').submit();
                })

                    $(".searchInput").on('keydown',function (event){
                        if(event.key=='Enter')
                        {
                            event.preventDefault();
                        }

                })

                        $(".profile").click(function (){
                         $(".profileBox").toggleClass('active')
                    })
            })



</script>
