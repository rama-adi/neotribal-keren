<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/resources/css/components-v2.css">
    <script src="/resources/js/components-v2.js"></script>
    <script src="/js/iframe.js" defer=""></script>
    <script src="/resources/js/alpine.js" defer=""></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Spectral:wght@200;400&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    @vite('css/app.css')
</head>
<body class="antialiased font-sans overflow-hidden bg-gray-800">
<div class="relative" x-data="starSlider()">
    <div x-data="{ open: false }" @keydown.window.escape="open = false"
         x-show="open" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" x-ref="dialog"
         aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 x-description="Background overlay, show/hide based on modal state."
                 class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="open = false"
                 aria-hidden="true"></div>
            <!-- This element is to trick the browser into centering the modal contents. --> <span
                class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
            <div x-show="open" x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-description="Modal panel, show/hide based on modal state."
                 class="relative inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6">
                <div>
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6 text-green-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/>
                        </svg>

                    </div>
                    <div class="mt-3 text-center sm:mt-5">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Tipes</h3>
                        <div class="mt-2 text-gray-500">
                            <ol class="list-decimal pl-4 text-left space-y-2">
                                <li>Click the stars to get new information or bonus coins or vouchers!</li>
                                <li>The location of bonus coins will change every time.</li>
                                <li>Turn on your volume to hear the guidance of the culture.</li>
                                <li>If you get the coupons, scan your barcode to the village.</li>
                                <li>Enjoy the beauty of Indonesia only through Neotribal!</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-6">
                    <button type="button"
                            class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm"
                            @click="open = false"> Go back to dashboard
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="h-screen max-w-md mx-auto relative"
         style="background-image: url('{{asset('storage'. $location->photo)}}'); background-size: cover;">
        <svg :style="`top: ${topPos}%; left: ${leftPos}%`" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10 text-red-600 absolute">
            <path fill-rule="evenodd"
                  d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                  clip-rule="evenodd"/>
        </svg>
    </div>

    <div class="absolute flex flex-col right-10 top-10">
        <h1 class="text-white">Position TheStar</h1>
        <div>
            <p class="text-white">Top position</p>
            <input type="range" min="1" max="100" x-model="topPos" class="slider" id="myRange">
        </div>
        <div>
            <p class="text-white">Left Position</p>
            <input type="range" min="1" max="90" x-model="leftPos" class="slider" id="myRange">
        </div>
        <div>
            <p class="text-white">Final position</p>
            <p class="text-white" style="font-family: monospace">Left: <span x-text="leftPos"></span>% Top: <span x-text="topPos"></span>%</p>
        </div>
    </div>
</div>

<script>
    function starSlider() {
        return {
            topPos: 50,
            leftPos: 50,
        }
    }
</script>
</body>
</html>
