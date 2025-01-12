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
            },
            boxShadow:{
                'equalTo':'5px 3px 5px rgba(0, 0, 0, 0.3),-5px -3px 5px rgba(0, 0, 0, 0.3)',
                'inset_white':'1px 1px 10px rgba(255,255,255,.2) , inset -2px -2px 3px rgba(255,255,255,.3),inset 2px 2px  rgba(255,255,255,.2) , inset -2px -2px 3px rgba(255,255,255,.3)',

            },
            borderRadius:{
                '50%':'50%'
            }
        },
    },
    plugins: [],
}

