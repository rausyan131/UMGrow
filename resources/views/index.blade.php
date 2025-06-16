
<x-layouts.guest title="welcome">

  <x-partials.navbar-guest/>

    <main>
        <!-- home section -->
        <section class="relative w-full min-h-screen flex items-center justify-center px-4 sm:px-10" id="home">

            <div class="absolute w-96 h-96 bg-primary rounded-full top-[-100px] left-[-130px] blur-2xl -z-10 bg-gradient-to-b from-primary via-primary via-40% to-white/30 animate-float-glow"></div>

            <div class="absolute w-52 h-62 md:w-62 md:h-96 bg-primary rounded-full bottom-[-100px] right-[-130px] blur-2xl -z-10 bg-gradient-to-b from-primary via-primary via-40% to-white/30 animate-float-glow"></div>

            <div class="flex flex-col items-center justify-center gap-10 max-w-[1100px] text-center">

                <svg class="w-full max-w-[800px] h-auto" viewBox="0 0 1310 357" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g opacity="0.96" filter="url(#filter0_d_0_1)">
                        <path d="M157.5 281.4C142.1 281.4 129.3 280.5 119.1 278.7C108.9 276.7 100.8 273.6 94.8 269.4C88.8 265.2 84.3 259.5 81.3 252.3C78.3 244.9 76.3 235.8 75.3 225C74.5 214 74.1 201 74.1 186V72.6H126.3V197.1C126.3 206.7 126.5 214.5 126.9 220.5C127.5 226.3 128.7 230.7 130.5 233.7C132.5 236.7 135.6 238.7 139.8 239.7C144.2 240.5 150.1 240.9 157.5 240.9C164.9 240.9 170.7 240.5 174.9 239.7C179.1 238.7 182.1 236.7 183.9 233.7C185.9 230.7 187.1 226.3 187.5 220.5C188.1 214.5 188.4 206.7 188.4 197.1V72.6H240.6V186C240.6 201 240.1 214 239.1 225C238.3 235.8 236.4 244.9 233.4 252.3C230.6 259.5 226.2 265.2 220.2 269.4C214.2 273.6 206.1 276.7 195.9 278.7C185.7 280.5 172.9 281.4 157.5 281.4ZM282.429 279V72.6H354.129L395.229 195H397.329L438.429 72.6H509.829V279H459.729V144.9H457.629L412.929 279H377.829L333.429 144.9H331.029V279H282.429ZM639.846 281.4C624.446 281.4 611.446 280.4 600.846 278.4C590.246 276.4 581.446 273.1 574.446 268.5C567.446 263.7 561.946 257.3 557.946 249.3C554.146 241.1 551.446 231 549.846 219C548.446 207 547.746 192.6 547.746 175.8C547.746 159 548.446 144.6 549.846 132.6C551.446 120.6 554.246 110.6 558.246 102.6C562.246 94.4 567.746 88 574.746 83.4C581.746 78.6 590.546 75.2 601.146 73.2C611.746 71.2 624.646 70.2 639.846 70.2C646.646 70.2 654.246 70.5 662.646 71.1C671.046 71.7 679.346 72.5 687.546 73.5C695.946 74.5 703.746 75.7 710.946 77.1V114.6C704.146 113.6 697.346 112.9 690.546 112.5C683.946 111.9 677.846 111.4 672.246 111C666.646 110.6 662.046 110.4 658.446 110.4C647.646 110.4 638.746 110.6 631.746 111C624.746 111.4 619.046 112.7 614.646 114.9C610.246 116.9 606.946 120.2 604.746 124.8C602.546 129.4 601.046 135.9 600.246 144.3C599.646 152.5 599.346 163 599.346 175.8C599.346 187.2 599.546 196.8 599.946 204.6C600.546 212.4 601.646 218.8 603.246 223.8C605.046 228.8 607.446 232.7 610.446 235.5C613.646 238.1 617.746 239.9 622.746 240.9C627.946 241.9 634.246 242.4 641.646 242.4C644.046 242.4 646.646 242.4 649.446 242.4C652.246 242.2 654.946 242 657.546 241.8C660.146 241.6 662.346 241.5 664.146 241.5V196.8H634.746V159.3H711.846V274.8C704.646 276.2 696.746 277.4 688.146 278.4C679.546 279.2 671.046 279.9 662.646 280.5C654.246 281.1 646.646 281.4 639.846 281.4ZM749.944 279V126H795.544L796.744 152.1H799.444C802.244 144.7 805.744 138.9 809.944 134.7C814.344 130.5 819.644 127.6 825.844 126C832.044 124.4 839.244 123.6 847.444 123.6V167.7C834.844 167.7 824.944 169.3 817.744 172.5C810.544 175.7 805.444 181.2 802.444 189C799.444 196.6 797.944 207.3 797.944 221.1V279H749.944ZM938.726 281.4C925.126 281.4 913.826 280.6 904.826 279C895.826 277.4 888.726 274.8 883.526 271.2C878.326 267.6 874.526 262.8 872.126 256.8C869.726 250.8 868.126 243.3 867.326 234.3C866.726 225.3 866.426 214.6 866.426 202.2C866.426 189.8 866.726 179.2 867.326 170.4C868.126 161.4 869.726 153.9 872.126 147.9C874.526 141.9 878.326 137.1 883.526 133.5C888.726 129.9 895.826 127.4 904.826 126C913.826 124.4 925.126 123.6 938.726 123.6C952.526 123.6 963.926 124.4 972.926 126C981.926 127.4 989.026 129.9 994.226 133.5C999.426 137.1 1003.23 141.9 1005.63 147.9C1008.03 153.9 1009.53 161.4 1010.13 170.4C1010.93 179.2 1011.33 189.8 1011.33 202.2C1011.33 214.6 1010.93 225.3 1010.13 234.3C1009.53 243.3 1008.03 250.8 1005.63 256.8C1003.23 262.8 999.426 267.6 994.226 271.2C989.026 274.8 981.926 277.4 972.926 279C963.926 280.6 952.526 281.4 938.726 281.4ZM938.726 244.8C944.726 244.8 949.426 244.4 952.826 243.6C956.226 242.8 958.626 241 960.026 238.2C961.426 235.4 962.226 231.1 962.426 225.3C962.826 219.5 963.026 211.8 963.026 202.2C963.026 192.6 962.826 185 962.426 179.4C962.226 173.8 961.426 169.6 960.026 166.8C958.626 164 956.226 162.2 952.826 161.4C949.426 160.6 944.726 160.2 938.726 160.2C932.726 160.2 928.026 160.6 924.626 161.4C921.426 162.2 919.126 164 917.726 166.8C916.326 169.6 915.426 173.8 915.026 179.4C914.826 185 914.726 192.6 914.726 202.2C914.726 211.8 914.826 219.5 915.026 225.3C915.426 231.1 916.326 235.4 917.726 238.2C919.126 241 921.426 242.8 924.626 243.6C928.026 244.4 932.726 244.8 938.726 244.8ZM1066.37 279L1027.37 126H1075.37L1097.27 230.7H1099.97L1126.67 126H1171.07L1198.07 230.7H1201.07L1222.37 126H1269.17L1230.17 279H1171.07L1149.77 198.9H1146.77L1125.77 279H1066.37Z" fill="#FEF0BB" />
                    </g>
                    <path d="M35.75 100V64.25H0.5V35.5H35.75V-5.48363e-06H65V35.5H100.5V64.25H65V100H35.75Z" fill="#FEF0BB" />
                    <path d="M1244.75 357V321.25H1209.5V292.5H1244.75V257H1274V292.5H1309.5V321.25H1274V357H1244.75Z" fill="#FEF0BB" />

                    <defs>
                        <filter id="filter0_d_0_1" x="70.1" y="70.2" width="1203.07" height="219.2" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                            <feFlood flood-opacity="0" result="BackgroundImageFix" />
                            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                            <feOffset dy="4" />
                            <feGaussianBlur stdDeviation="2" />
                            <feComposite in2="hardAlpha" operator="out" />
                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                            <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_0_1" />
                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_0_1" result="shape" />
                        </filter>
                    </defs>
                </svg>

                <div class="relative w-full md:max-w-[900px]">
                    <div class="relative w-full md:max-w-[900px]">
                        <div
                            class="relative p-10 md:p-20 text-center font-roboto text-white text-[15px] md:text-[20px] ">
                            <p class="opacity-75 ">
                                Kamu tidak harus berkembang sendirian.<br />
                                <strong>UMGrow</strong> hadir untuk membantu UMKM menemukan partner, mentor, dan rekan usaha yang siap tumbuh bersama.<br />
                                Kolaborasi adalah kunci masa depan.
                            </p>
                            <p class="mt-10 opacity-75">Dan semuanya dimulai dari sini.</p>
                        </div>

                        <a href="#about">
                            <i class="fa-solid fa-caret-down absolute -bottom-10 left-1/2 transform -translate-x-1/2 text-[#FEF0BB] text-4xl animate-bounce"
                                aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
        </section>

        <div class="flex p-5 md:p-10 gap-5 md:gap-10 text-white items-center">
            <i class="fa-solid fa-plus text-2xl md:text-4xl"></i>
            <div class="w-full h-1 bg-white"></div>
            <i class="fa-solid fa-plus text-2xl md:text-4xl"></i>
        </div>

        <!-- About section -->
        <section class="relative w-full min-h-screen flex flex-col lg:flex-row items-center justify-center gap-8 p-4 bg-transparent" id="about">

            <div class="opacity-80 w-96 h-56 rotate-45 bg-primary rounded-full absolute top-1/2 bottom-1/2 blur-2xl -z-10 bg-gradient-to-b from-primary via-primary via-40% to-white/30 animate-float-glow"></div>

            <svg class="w-full max-w-[700px]: md:w-[700px]" " viewBox=" 0 0 854 234" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g opacity="0.96" filter="url(#filter0_d_22_12)">
                    <path d="M4.4 223L69.8 16.6H140.9L206.6 223H153.8L141.5 182.5H68L56 223H4.4ZM79.1 143.2H130.1L105.5 61.6H103.4L79.1 143.2ZM320.729 225.4C315.129 225.4 309.529 224.8 303.929 223.6C298.329 222.6 293.229 220.7 288.629 217.9C284.229 214.9 280.429 210.5 277.229 204.7H274.529L273.329 223H227.729V0.0999908H275.729V86.2H278.129C281.529 81 285.329 77.1 289.529 74.5C293.929 71.9 298.829 70.1 304.229 69.1C309.629 68.1 315.229 67.6 321.029 67.6C330.029 67.6 337.629 68.9 343.829 71.5C350.229 74.1 355.429 78.4 359.429 84.4C363.429 90.2 366.329 98.2 368.129 108.4C370.129 118.6 371.129 131.4 371.129 146.8C371.129 162.2 370.129 175 368.129 185.2C366.329 195.2 363.329 203.2 359.129 209.2C355.129 215 349.929 219.2 343.529 221.8C337.329 224.2 329.729 225.4 320.729 225.4ZM299.129 185.8C304.529 185.8 308.829 185.5 312.029 184.9C315.229 184.1 317.529 182.5 318.929 180.1C320.529 177.5 321.529 173.6 321.929 168.4C322.529 163 322.829 155.7 322.829 146.5C322.829 137.3 322.529 130.1 321.929 124.9C321.529 119.7 320.529 115.9 318.929 113.5C317.529 110.9 315.229 109.2 312.029 108.4C308.829 107.6 304.529 107.2 299.129 107.2C293.729 107.2 289.429 107.8 286.229 109C283.229 110 281.029 112.1 279.629 115.3C278.029 118.7 276.929 122.9 276.329 127.9C275.929 132.9 275.729 139.1 275.729 146.5C275.729 153.7 275.929 159.9 276.329 165.1C276.929 170.3 278.029 174.5 279.629 177.7C281.029 180.7 283.229 182.8 286.229 184C289.429 185.2 293.729 185.8 299.129 185.8ZM470.417 225.4C456.817 225.4 445.517 224.6 436.517 223C427.517 221.4 420.417 218.8 415.217 215.2C410.017 211.6 406.217 206.8 403.817 200.8C401.417 194.8 399.817 187.3 399.017 178.3C398.417 169.3 398.117 158.6 398.117 146.2C398.117 133.8 398.417 123.2 399.017 114.4C399.817 105.4 401.417 97.9 403.817 91.9C406.217 85.9 410.017 81.1 415.217 77.5C420.417 73.9 427.517 71.4 436.517 70C445.517 68.4 456.817 67.6 470.417 67.6C484.217 67.6 495.617 68.4 504.617 70C513.617 71.4 520.717 73.9 525.917 77.5C531.117 81.1 534.917 85.9 537.317 91.9C539.717 97.9 541.217 105.4 541.817 114.4C542.617 123.2 543.017 133.8 543.017 146.2C543.017 158.6 542.617 169.3 541.817 178.3C541.217 187.3 539.717 194.8 537.317 200.8C534.917 206.8 531.117 211.6 525.917 215.2C520.717 218.8 513.617 221.4 504.617 223C495.617 224.6 484.217 225.4 470.417 225.4ZM470.417 188.8C476.417 188.8 481.117 188.4 484.517 187.6C487.917 186.8 490.317 185 491.717 182.2C493.117 179.4 493.917 175.1 494.117 169.3C494.517 163.5 494.717 155.8 494.717 146.2C494.717 136.6 494.517 129 494.117 123.4C493.917 117.8 493.117 113.6 491.717 110.8C490.317 108 487.917 106.2 484.517 105.4C481.117 104.6 476.417 104.2 470.417 104.2C464.417 104.2 459.717 104.6 456.317 105.4C453.117 106.2 450.817 108 449.417 110.8C448.017 113.6 447.117 117.8 446.717 123.4C446.517 129 446.417 136.6 446.417 146.2C446.417 155.8 446.517 163.5 446.717 169.3C447.117 175.1 448.017 179.4 449.417 182.2C450.817 185 453.117 186.8 456.317 187.6C459.717 188.4 464.417 188.8 470.417 188.8ZM621.69 225.4C611.49 225.4 603.29 224.1 597.09 221.5C590.89 218.9 586.19 215.1 582.99 210.1C579.79 205.1 577.69 198.9 576.69 191.5C575.69 184.1 575.19 175.5 575.19 165.7V70H623.19V151C623.19 159.2 623.39 165.7 623.79 170.5C624.39 175.1 625.39 178.5 626.79 180.7C628.19 182.9 630.29 184.3 633.09 184.9C635.89 185.3 639.69 185.5 644.49 185.5C649.69 185.5 653.79 185 656.79 184C659.99 182.8 662.29 180.9 663.69 178.3C665.09 175.7 665.99 172.1 666.39 167.5C666.99 162.7 667.29 156.8 667.29 149.8V70H715.59V223H669.69L668.49 204.4H665.79C662.99 209.6 659.39 213.8 654.99 217C650.59 220 645.59 222.1 639.99 223.3C634.39 224.7 628.29 225.4 621.69 225.4ZM767.736 223V106.6H739.836V70H767.736V25.6H816.336V70H849.636V106.6H816.336V223H767.736Z" fill="#FEF0BB" />
                </g>
                <defs>
                    <filter id="filter0_d_22_12" x="0.4" y="0.0999756" width="853.236" height="233.3" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix" />
                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                        <feOffset dy="4" />
                        <feGaussianBlur stdDeviation="2" />
                        <feComposite in2="hardAlpha" operator="out" />
                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_22_12" />
                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_22_12" result="shape" />
                    </filter>
                </defs>
            </svg>

            <svg class="w-full max-w-[700px] md:w-[700px]" viewBox="0 0 1089 620" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid meet">
                <foreignObject x="211" y="11" width="97" height="91">
                    <div xmlns="http://www.w3.org/1999/xhtml" style="backdrop-filter:blur(2px);clip-path:url(#bgblur_0_0_1_clip_path);height:100%;width:100%"></div>
                </foreignObject>
                <ellipse opacity="0.5" data-figma-bg-blur-radius="4" cx="259.5" cy="56.5" rx="44.5" ry="41.5" fill="#D9D9D9" fill-opacity="0.22" />
                <foreignObject x="-35" y="-35" width="1159" height="690">
                    <div xmlns="http://www.w3.org/1999/xhtml" style="backdrop-filter:blur(17.5px);clip-path:url(#bgblur_1_0_1_clip_path);height:100%;width:100%"></div>
                </foreignObject>
                <g opacity="0.5" data-figma-bg-blur-radius="35">
                    <mask id="path-2-inside-1_0_1" fill="white">
                        <path d="M1023 0C1059.45 1.06303e-06 1089 29.5492 1089 66V513.206C1089 529.775 1075.57 543.206 1059 543.206H963C946.431 543.206 933 556.638 933 573.206V590C933 606.569 919.569 620 903 620H66C29.5492 620 9.34299e-07 590.451 0 554V176.484C0 148.87 22.3858 126.484 50 126.484H278C305.614 126.484 328 104.099 328 76.4844V50C328 22.3858 350.386 0 378 0H1023Z" />
                    </mask>
                    <path d="M1023 0C1059.45 1.06303e-06 1089 29.5492 1089 66V513.206C1089 529.775 1075.57 543.206 1059 543.206H963C946.431 543.206 933 556.638 933 573.206V590C933 606.569 919.569 620 903 620H66C29.5492 620 9.34299e-07 590.451 0 554V176.484C0 148.87 22.3858 126.484 50 126.484H278C305.614 126.484 328 104.099 328 76.4844V50C328 22.3858 350.386 0 378 0H1023Z" fill="#D9D9D9" fill-opacity="0.15" />
                    <path d="M1023 0L1023 -4H1023V0ZM0 554L-4 554L-4 554L0 554ZM1023 0L1023 4C1057.24 4 1085 31.7583 1085 66H1089H1093C1093 27.3401 1061.66 -4 1023 -4L1023 0ZM1089 66H1085V513.206H1089H1093V66H1089ZM1059 543.206V539.206H963V543.206V547.206H1059V543.206ZM933 573.206H929V590H933H937V573.206H933ZM903 620V616H66V620V624H903V620ZM66 620V616C31.7583 616 4 588.242 4 554L0 554L-4 554C-4 592.66 27.3401 624 66 624V620ZM0 554H4V176.484H0H-4V554H0ZM0 176.484H4C4 151.079 24.5949 130.484 50 130.484V126.484V122.484C20.1766 122.484 -4 146.661 -4 176.484H0ZM50 126.484V130.484H278V126.484V122.484H50V126.484ZM278 126.484V130.484C307.823 130.484 332 106.308 332 76.4844H328H324C324 101.889 303.405 122.484 278 122.484V126.484ZM328 76.4844H332V50H328H324V76.4844H328ZM328 50H332C332 24.5949 352.595 4 378 4V0V-4C348.177 -4 324 20.1766 324 50H328ZM378 0V4H1023V0V-4H378V0ZM933 590H929C929 604.359 917.359 616 903 616V620V624C921.778 624 937 608.778 937 590H933ZM963 543.206V539.206C944.222 539.206 929 554.428 929 573.206H933H937C937 558.847 948.641 547.206 963 547.206V543.206ZM1089 513.206H1085C1085 527.565 1073.36 539.206 1059 539.206V543.206V547.206C1077.78 547.206 1093 531.984 1093 513.206H1089Z" fill="#FEF0BB" mask="url(#path-2-inside-1_0_1)" />
                </g>
                <foreignObject x="100" y="150" width="889" height="400">
                    <div xmlns="http://www.w3.org/1999/xhtml" class="flex items-center justify-center h-full w-full">
                        <p class="w-[80%] text-center text-white text-[29px] leading-relaxed">
                            <strong>Tentang Kami</strong><br>
                            UMKarya adalah platform digital yang dirancang untuk menampilkan dan memperkenalkan UMKM lokal Indonesia secara lebih kreatif dan profesional. Kami percaya bahwa setiap usaha kecil punya cerita dan potensi besar — dan UMKarya hadir untuk menjadi panggungnya.
                            Lewat galeri produk, kisah inspiratif, dan edukasi sederhana, kami ingin membantu UMKM naik kelas dan lebih dikenal oleh masyarakat luas.
                        </p>
                    </div>
                </foreignObject>
                <defs>
                    <clipPath id="bgblur_0_0_1_clip_path" transform="translate(-211 -11)">
                        <ellipse cx="259.5" cy="56.5" rx="44.5" ry="41.5" />
                    </clipPath>
                    <clipPath id="bgblur_1_0_1_clip_path" transform="translate(35 35)">
                        <path d="M1023 0C1059.45 1.06303e-06 1089 29.5492 1089 66V513.206C1089 529.775 1075.57 543.206 1059 543.206H963C946.431 543.206 933 556.638 933 573.206V590C933 606.569 919.569 620 903 620H66C29.5492 620 9.34299e-07 590.451 0 554V176.484C0 148.87 22.3858 126.484 50 126.484H278C305.614 126.484 328 104.099 328 76.4844V50C328 22.3858 350.386 0 378 0H1023Z" />
                    </clipPath>
                </defs>
            </svg>
        </section>

        <!-- line -->
        <div class="flex p-5 md:p-10 gap-5 md:gap-10 text-white items-center">
            <i class="fa-solid fa-plus text-2xl md:text-4xl"></i>
            <div class="w-full h-1 bg-white"></div>
            <i class="fa-solid fa-plus text-2xl md:text-4xl"></i>
        </div>


        <section class="w-full min-h-screen relative flex items-center py-16 px-4">
            <div class="absolute w-[400px] h-[400px] bg-primary rounded-full left-[-130px] blur-2xl -z-10 bg-gradient-to-b from-primary via-primary via-40% to-white/30 animate-float-glow"></div>

            <div class="absolute w-52 h-62 md:w-62 md:h-96 bg-primary rounded-full bottom-[-100px] right-[-130px] blur-2xl -z-10 bg-gradient-to-b from-primary via-primary via-40% to-white/30 animate-float-glow"></div>

            <div class="w-full max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-center gap-12 md:gap-20">
                <img src="{{ asset('images/about1.jpg') }}" alt="Banner UMGrow"
                    class="object-cover w-full md:w-1/2 h-72 md:h-96 rounded-3xl shadow-lg  border border-white/30">

                <div class="w-full md:w-1/2 text-white grid grid-cols-1 sm:grid-cols-2 gap-10 text-center md:text-left">
                    <div>
                        <h1 class="text-5xl md:text-6xl font-bold">100+</h1>
                        <p class="text-lg md:text-xl font-semibold">UMKM Telah Terdaftar</p>
                    </div>
                    <div>
                        <h1 class="text-5xl md:text-6xl font-bold">300+</h1>
                        <p class="text-lg md:text-xl font-semibold">Micro Bisnis Terbantu</p>
                    </div>
                    <div>
                        <h1 class="text-5xl md:text-6xl font-bold">150+</h1>
                        <p class="text-lg md:text-xl font-semibold">UMKM Berkolaborasi</p>
                    </div>
                    <div>
                        <h1 class="text-5xl md:text-6xl font-bold">12+</h1>
                        <p class="text-lg md:text-xl font-semibold">Sertifikat Penghargaan</p>
                    </div>
                </div>
            </div>
        </section>


        <!-- line -->
        <div class="flex p-5 md:p-10 gap-5 md:gap-10 text-white items-center">
            <i class="fa-solid fa-plus text-2xl md:text-4xl"></i>
            <div class="w-full h-1 bg-white"></div>
            <i class="fa-solid fa-plus text-2xl md:text-4xl"></i>
        </div>

        <section class="w-full min-h-screen p-6 md:p-10 flex justify-center items-center relative">

            <div class="absolute w-64 h-64 md:w-[400px] md:h-[400px] bg-primary rounded-full top-24 left-[-80px] md:left-[-130px] blur-2xl -z-10 bg-gradient-to-b from-primary via-primary via-40% to-white/30 animate-float-glow"></div>

            <div class="absolute w-32 h-40 md:w-62 md:h-96 bg-primary rounded-full bottom-[-80px] right-[-80px] md:right-[-130px] blur-2xl -z-10 bg-gradient-to-b from-primary via-primary via-40% to-white/30 animate-float-glow"></div>

            <div class="w-full max-w-5xl h-[600px] bg-cover bg-center rounded-[100px] border border-white/30 relative bg-[url(/public/images/about2.jpg)]">
                <div class="absolute inset-0 backdrop-blur-xs backdrop-brightness-50 rounded-[100px] flex flex-col justify-center items-center text-center gap-6 p-8 md:p-20 text-white font-bold">
                    <p class="text-lg md:text-xl">Ayo Gabung Sekarang!</p>
                    <h1 class="text-3xl md:text-5xl leading-snug">
                        Mulai Kolaborasi Pertama Anda<br> dan Buat Perubahan
                    </h1>
                    <a href="#" class="text-base md:text-lg px-8 md:px-10 py-3 md:py-5 bg-white text-black rounded-full  hover:text-white hover:bg-primary transition-all hover:shadow-primary hover:shadow-2xl">
                        Gabung Sekarang
                    </a>
                </div>
            </div>
        </section>


        <!-- line -->
        <div class="flex p-5 md:p-10 gap-5 md:gap-10 text-white items-center">
            <i class="fa-solid fa-plus text-2xl md:text-4xl"></i>
            <div class="w-full h-1 bg-white"></div>
            <i class="fa-solid fa-plus text-2xl md:text-4xl"></i>
        </div>

        <!-- Contact Section -->
        <section class="w-full min-h-screen p-6 md:p-10 flex justify-center items-center relative">
            <div class="absolute w-64 h-64 md:w-[400px] md:h-[400px] bg-primary rounded-full top-16 left-[-100px] blur-2xl -z-10 opacity-70 animate-float-glow"></div>
            <div class="absolute w-40 h-52 md:w-72 md:h-96 bg-primary rounded-full bottom-[-120px] right-[-100px] blur-2xl -z-10 opacity-70 animate-float-glow"></div>

            <div class="w-full max-w-6xl bg-white/10 backdrop-blur-md backdrop-brightness-75 rounded-[40px] border border-white/30 p-10 md:p-16 flex flex-col md:flex-row gap-10 text-white ">

                <div class="flex-1 flex flex-col justify-center gap-6">
                    <h2 class="text-4xl font-bold mb-4">Contact Us</h2>
                    <p class="text-lg leading-relaxed">
                        Punya pertanyaan, ide kolaborasi, atau ingin bergabung dengan UMGrow?
                        Kami siap mendengarkan dan membantu!
                        Isi form di samping atau hubungi langsung melalui kontak di bawah ini.
                    </p>
                    <div class="grid grid-cols-[auto_auto_1fr] gap-x-4 gap-y-4 mt-6 text-white text-lg items-center">
                        <i class="fas fa-phone-alt text-primary w-6"></i>
                        <span class="font-semibold">Telepon </span>
                        <span> : +62 812 3456 7890</span>

                        <i class="fas fa-envelope text-primary w-6"></i>
                        <span class="font-semibold">Email </span>
                        <span> : UMgrow@gmail.com</span>

                        <i class="fas fa-map-marker-alt text-primary w-6"></i>
                        <span class="font-semibold">Alamat </span>
                        <span> : Jl. Darussalam No. 99, Lhokseumawe, Indonesia</span>
                    </div>



                </div>

                <form class="flex-1 flex flex-col gap-6" action="#" method="POST">
                    <input type="text" name="nama" placeholder="Nama Lengkap" required
                        class="p-4 rounded-xl bg-white/20 border border-white/40 text-white placeholder-white focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white/30 transition" />
                    <input type="email" name="email" placeholder="Email" required
                        class="p-4 rounded-xl bg-white/20 border border-white/40 text-white placeholder-white focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white/30 transition" />
                    <textarea name="pesan" rows="5" placeholder="Pesan Anda" required
                        class="p-4 rounded-xl bg-white/20 border border-white/40 text-white placeholder-white focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white/30 transition resize-none"></textarea>

                    <button type="submit" class="py-4 bg-white text-black rounded-full  hover:text-white hover:bg-primary transition-all hover:shadow-primary hover:shadow-2xl">
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </section>

        <!-- line -->
        <div class="flex p-5 md:p-10 gap-5 md:gap-10 text-white items-center">
            <i class="fa-solid fa-plus text-2xl md:text-4xl"></i>
            <div class="w-full h-1 bg-white"></div>
            <i class="fa-solid fa-plus text-2xl md:text-4xl"></i>
        </div>

     
    </main>

    <x-partials.footer-guest/>
</x-layouts.guest.guest>

  