<html>
    <head>
        <style>
            body{
                font-family: 'arial';
                margin: 0;
                overflow-x: hidden;
                padding: 0;

            }

            .animation-wrapper{
                background: #ace5ee;
                bottom: 0;
                left: 0;
                position: absolute;
                right: 0;
                top: 0;
            }

            .water{
                bottom: 0;
                left: 0;
                position: absolute;
                width: 100%;
            }

            .water ul.waves{
                list-style: none;
                margin: 0;
                padding: 0;
            }

            .water ul.waves li{
                background-repeat: repeat-x;
            }

            .water ul.waves li.wave-one{
                animation: wave 8.7s linear infinite;
                -webkit-animation-fill-mode: forwards;
                -o-animation-fill-mode: forwards;
                animation-fill-mode: forwards;
                bottom: 0px;
                height: 50px;
                left: 0;
                position: absolute;
                right: 0;
                z-index: 10;
            }

            .water ul.waves li.wave-two{
                -webkit-animation-fill-mode: forwards;
                -o-animation-fill-mode: forwards;
                animation-fill-mode: forwards;
                animation: wave 10s linear infinite;
                bottom: 0px;
                height: 84px;
                left: 0;
                position: absolute;
                right: 0;
                z-index: 9;
            }

            .water ul.waves li.wave-three{
                -webkit-animation-fill-mode: forwards;
                -o-animation-fill-mode: forwards;
                animation-fill-mode: forwards;
                animation: wave 25s linear infinite;
                bottom: 0;
                height: 190px;
                left: 0;
                position: absolute;
                right: 0;
                z-index: 8;
            }

            .water ul.waves li.wave-four{
                -webkit-animation-fill-mode: forwards;
                -o-animation-fill-mode: forwards;
                animation-fill-mode: forwards;
                animation: wave 25s linear infinite;
                bottom: 0;
                height: 205px;
                left: 0;
                position: absolute;
                right: 0;
            }

            .boat{
                animation: boat 3s linear infinite;
                background-repeat: no-repeat;
                bottom: 160px;
                height: 145px;
                left: 40%;
                position: absolute;
                width: 480px;
            }

            .cloud{
                animation: cloud 30s linear infinite;
                background-repeat: no-repeat;
                height: 165px;
                left: 0;
                position: absolute;
                width: 297px
            }

            .cloud2{
                animation: cloud 25s linear infinite;
                background-repeat: no-repeat;
                bottom: 320px;
                height: 165px;
                left: 140px;
                position: absolute;
                width: 297px;
            }

            .dolphin{
                animation: fish 15s linear infinite;
                background-repeat: no-repeat;
                bottom: 45px;
                height: 80px;
                left: 20%;
                position: absolute;
                width: 124px;
                z-index: 9;
            }





            /*Animation Keyframe Section*/

            @keyframes  wave{
                0% {
                    background-position: 0 0;
                }

                100% {
                    background-position: 1920px 0;
                }
            }

            @keyframes  boat{
                0%{
                    transform: rotate(0);
                }

                50%{
                    transform: rotate(-3deg);
                }

                100%{
                    transform: rotate(0);
                }
            }

            @keyframes  cloud{
                0%{
                    left: -30%;
                }

                100%{
                    left: 100%;
                }
            }

        </style>
    </head>
    <body>
    <div class="animation-wrapper">
        <div class="water">
            <ul class="waves">
                <li class="wave-one" style="background-image: url(<?php echo e(asset('assets/images/wave1.png')); ?>);"></li>
                <li class="wave-two" style="background-image: url(<?php echo e(asset('assets/images/wave2.png')); ?>);"></li>
                <li class="wave-three" style="background-image: url(<?php echo e(asset('assets/images/wave3.png')); ?>);"></li>
                <li class="wave-four" style="background-image: url(<?php echo e(asset('assets/images/wave4.png')); ?>);"></li>
            </ul>
        </div>
        <div class="boat" style="background-image: url(<?php echo e(asset('assets/images/ship.png')); ?>);"></div>
        <div class="cloud" style="background-image: url(<?php echo e(asset('assets/images/cloud-md.png')); ?>);"></div>
        <div class="cloud2" style="background-image: url(<?php echo e(asset('assets/images/cloud-md.png')); ?>);"></div>
    </div>
    </body>
</html><?php /**PATH C:\xampp\htdocs\mail\resources\views/animation.blade.php ENDPATH**/ ?>