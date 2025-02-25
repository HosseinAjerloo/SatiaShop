

<script>
            $('.observer-example').persianDatepicker({
                observer: true,

                format: 'LLLL',
                altField: '.customDate',
                initialValue: false,
                autoClose: true,
                calendar:{
                    'persian': {
                        'locale': 'fa',
                        'showHint': false
                    },
                    'gregorian': {
                        'locale': 'en',
                        'showHint': false
                    }
                },
                onSelect: function (){
                    $("#input_search").removeAttr('name')
                    $("#input_date").removeAttr('name')
                    $('#form').submit();


                }

            })
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
