<div class="h-screen w-screen overflow-hidden relative"
     style="background-image: url('{{asset('storage/'. $location->photo)}}'); background-size: cover"
>
    @switch($currentPage)
        @case('tutorial')
            <div class="flex h-full w-full items-center space-y-6 flex-col justify-center">

                @if($mode == 'desktop')
                    <div class="rounded-md bg-yellow-50 p-4" style="width: 350px">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor" class="w-5 h-5 text-yellow-400">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23-.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5"/>
                                </svg>
                            </div>
                            <div class="ml-3 flex-1 md:flex md:justify-between">
                                <p class="text-sm text-yellow-700">
                                    Desktop experience is still in experimental phase. Please use a mobile device for a
                                    better
                                    experience.
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="mx-auto" style="width: 350px">
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6 space-y-4">
                            <h2 class="text-2xl leading-6 font-bold text-gray-900">
                                How to play
                            </h2>
                            <ol class="mt-1 list-decimal pl-4 text-sm text-gray-500">
                                <li>
                                    Click on the stars to get new information or bonus coins or vouchers!
                                </li>
                                <li>
                                    The coupons can be redeemed at the physical location
                                </li>
                                <li>
                                    And don't forget: Enjoy the hidden gems of Indonesia!
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <x-primary-button style="width: 350px" wire:click="startGame">Let's play!</x-primary-button>
            </div>
            @break

        @case('game')
            @foreach($locationStars as $index => $locationStar)
                <button class="absolute" wire:click="explainStar({{$index}})"
                        style="top: {{$locationStar->top_offset}}%; left: {{$locationStar->left_offset}}%">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                         class="w-10 h-10 text-red-600">
                        <path fill-rule="evenodd"
                              d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                              clip-rule="evenodd"/>
                    </svg>
                </button>
            @endforeach
            @break

        @case('explain')
            <div class="flex h-full w-full items-center space-y-6 flex-col justify-center">

                <div class="mx-auto" style="width: 350px">
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6 space-y-4">
                            <h2 class="text-2xl leading-6 font-bold text-gray-900">
                                {{$selectedStar->name}}
                            </h2>
                            <p class="mt-1 text-sm text-gray-500">
                                {{$selectedStar->description}}
                            </p>
                        </div>
                    </div>
                </div>
                <x-primary-button style="width: 350px" wire:click="backToGame">
                    Back to game
                </x-primary-button>
            </div>
            @break
    @endswitch
</div>
