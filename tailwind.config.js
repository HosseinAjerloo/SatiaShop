/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ['./resources/Shop/**/*.blade.php'],
    theme: {
        extend: {
            fontSize:{
                min:'0.750rem',
                min_sm:'0.650rem'
            },
            colors:{
                '2081F2':'#2081F2',
                'F2F2F2':'#F2F2F2',
                'FFC0C0':'#FFC0C0',
                'BBB7BC':'#BBB7BC',
                'E7EFF2':'#E7EFF2',
                'E9E9E9':'#E9E9E9',
                'A6A6A6':'#A6A6A6',
                'F1F1F1':'#F1F1F1'
            },
            borderWidth:{
                divideWidth: {

                    '1': '1px',

                }
            }


        },
    },
    plugins: [],
}

