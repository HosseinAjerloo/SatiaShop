

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

</script>
