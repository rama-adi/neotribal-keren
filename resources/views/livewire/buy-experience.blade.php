<div class="max-w-3xl py-4 mx-auto space-y-4">

    @switch($page)
        @case('listing')
            <div class="bg-indigo-700 shadow rounded-lg">
                <div class="max-w-2xl mx-auto text-center py-16 px-4 sm:py-20 sm:px-6 lg:px-8">
                    <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                        <span class="block">Get new ✨ experiences</span>
                        <span class="block">And find Indonesia's hidden gems!</span>
                    </h2>
                    <p class="mt-4 text-lg leading-6 text-indigo-200">
                        There's always something new to discover. We have a lot of hidden gems in Indonesia. Let's find
                        them
                        together!
                    </p>
                </div>
            </div>
            <div>
                <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">Purchase new experiences</h2>

                <div class="grid mt-4 grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                    @foreach($unsoldExperiences as $index => $unsoldExperience)
                        <div class="group relative">
                            <div
                                class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                                <img src="{{asset('storage/'.$unsoldExperience->photo)}}"
                                     alt="Front of men&#039;s Basic Tee in black."
                                     class="w-full h-full object-center object-cover lg:w-full lg:h-full">
                            </div>
                            <div class="mt-4 flex justify-between">
                                <div>
                                    <h3 class="text-sm text-gray-700">
                                        <button wire:click="selectOne('{{$index}}')">
                                            <span aria-hidden="true" class="absolute inset-0"></span>
                                            {{$unsoldExperience->name}}
                                        </button>
                                    </h3>
                                    <p class="text-sm text-gray-900 font-bold">{{$unsoldExperience->coins}} coins</p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            @break

        @case('single')
            @if($selectedExperience)
                <div
                    class="max-w-2xl mx-auto lg:grid lg:grid-cols-2 lg:gap-x-8">
                    <!-- Product details -->
                    <div class="lg:max-w-lg lg:self-end">

                        <div class="mt-4">
                            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                                {{$selectedExperience->name}}
                            </h1>
                        </div>

                        <section aria-labelledby="information-heading" class="mt-4">
                            <h2 id="information-heading" class="sr-only">Location information</h2>

                            <div class="flex items-center">
                                <p class="text-lg text-gray-900 sm:text-xl">{{$selectedExperience->coins}} Coins</p>

                            </div>

                            <div class="mt-4 space-y-6">
                                <p class="text-base text-gray-500">
                                    {{$selectedExperience->description}}
                                </p>
                            </div>

                            @if(auth()->user()->coins >= $selectedExperience->coins)
                                <div class="mt-6 flex items-center">
                                    <!-- Heroicon name: solid/check -->
                                    <svg class="flex-shrink-0 w-5 h-5 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                    <p class="ml-2 text-sm text-gray-500">
                                        Ready to be purchased!
                                    </p>
                                </div>
                            @else
                                <div class="mt-6 flex items-center">
                                    <!-- Heroicon name: solid/check -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor"
                                         class="flex-shrink-0 w-5 h-5 text-red-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    <p class="ml-2 text-sm text-gray-500">
                                        You need {{$selectedExperience->coins - auth()->user()->coins}} more coins to
                                        purchase
                                        this experience.
                                    </p>
                                </div>
                            @endif
                        </section>
                    </div>

                    <!-- Product image -->
                    <div class="mt-10 lg:mt-0 lg:col-start-2 lg:row-span-2 lg:self-center">
                        <div class="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden">
                            <img
                                src="{{asset('storage/'.$selectedExperience->photo)}}"
                                alt="Model wearing light green backpack with black canvas straps and front zipper pouch."
                                class="w-full h-full object-center object-cover">
                        </div>
                    </div>

                    <!-- Product form -->
                    <div class="mt-10 lg:max-w-lg lg:col-start-1 lg:row-start-2 lg:self-start">
                        <div class="mt-10">
                            @if(auth()->user()->coins >= $selectedExperience->coins)
                                <button wire:click="buyExperience"
                                        class="w-full bg-indigo-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500">
                                    Buy
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
            @break
    @endswitch


</div>
