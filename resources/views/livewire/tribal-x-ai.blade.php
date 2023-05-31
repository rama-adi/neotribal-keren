<div class="max-w-3xl mx-auto mt-8">
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="rounded-md bg-red-50 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <!-- Heroicon name: solid/x-circle -->
                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                     fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                          d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                          clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">
                    TribalX AI is currently in experimental testing. It may generate inaccurate or offensive content.
                    use with caution. It does not represent the final product of TribalX AI nor does it represent the
                    NeoTribal app.
                </h3>
            </div>
        </div>
    </div>

    <form wire:submit.prevent="ask" class="relative mt-8">
        <div
            class="border border-gray-300 rounded-lg shadow-sm overflow-hidden focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-indigo-500">
            <label for="title" class="sr-only">Title</label>
            <p class="block w-full border-0 p-4 text-lg font-medium bg-white focus:ring-0">
                TribalX AI
            </p>
            <div class="block w-full p-4 pb-8 bg-white focus:ring-0">
               {{$currentResponse}}
            </div>

            <!-- Spacer element to match the height of the toolbar -->
            <div aria-hidden="true">

                <div class="h-px"></div>
                <div class="py-2">
                    <div class="py-px">
                        <div class="h-9"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 inset-x-px">
            <!-- Actions: These are just examples to demonstrate the concept, replace/wire these up however makes sense for your project. -->

            <div class="border-t border-gray-200 px-2 py-2 flex justify-between items-center space-x-3 sm:px-3">
                <div class="flex grow">
                    <input wire:model.defer="input" type="text" placeholder="example: Hidden gems in ubud" class="text-left bg-white text-gray-900 w-full rounded">
                </div>
                <div class="flex-shrink-0">
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Ask
                    </button>
                </div>
            </div>
        </div>
    </form>



</div>
