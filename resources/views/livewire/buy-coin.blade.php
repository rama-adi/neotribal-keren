<div class="max-w-3xl py-4 mx-auto space-y-4">


    @if(!$paying)
        <h1 class="text-xl font-bold text-gray-900">
            Buy Coins
        </h1>
        <div class="rounded-md bg-blue-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <!-- Heroicon name: solid/information-circle -->
                    <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                         fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                              d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                              clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3 flex-1 md:flex md:justify-between">
                    <p class="text-sm text-blue-700">
                        Special discount for tester at UC DEI Expo!
                    </p>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            @foreach($COIN_PACKAGES as $amount => $price)
                <div
                    wire:click="buyCoin('{{$amount}}')"
                    class="relative rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-gray-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                    <div class="flex-1 min-w-0">
                        <button class="focus:outline-none">
                            <span class="absolute inset-0" aria-hidden="true"></span>
                            <p class="text-sm font-medium text-gray-900">{{$amount}} Coins</p>
                            <p class="text-sm text-gray-500 truncate">Rp{{number_format($price, 0, ',', '.')}}</p>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @else

        <div class="bg-white overflow-hidden shadow rounded-lg divide-y divide-gray-200">
            <div class="px-4 py-5 sm:px-6">
                <h2 class="text-lg leading-6 font-medium text-gray-900">
                    Buy Coins
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Please complete the payment to get your coins.
                </p>
            </div>
            <div class="px-4 py-5 sm:p-6 space-y-4">
                <div>
                    <h2 class="text-lg leading-6 font-medium text-gray-900">
                        Transaction ID
                    </h2>
                    <h1 class="mt-1 text-2xl font-bold text-gray-900">
                        {{$transaction->code}}
                    </h1>
                </div>

                <div>
                    <h2 class="text-lg leading-6 font-medium text-gray-900">
                        Payable amount
                    </h2>
                    <h1 class="mt-1 text-2xl font-bold text-gray-900">
                        Rp{{number_format($transaction->amount, 0, ',', '.')}} ({{$transaction->coins}} coins)
                    </h1>
                </div>

                <div>
                    <h2 class="text-lg leading-6 font-medium text-gray-900">
                        Payment tutorial
                    </h2>
                    <ol class="list-decimal pl-4">
                        <li>Open your banking app</li>
                        <li>Go to transfer menu</li>
                        <li>Transfer to BCA 6485324678 (account name: Kevin Christian)</li>
                        <li>Input the payable amount Rp{{number_format($transaction->amount, 0, ',', '.')}}</li>
                        <li>For the transaction message, input the transaction id {{$transaction->code}}</li>
                        <li>Confirm the payment</li>
                        <li>
                            FOR DEI EXPO: Notify our staff on hand after the transaction to confirm your transaction from our side
                        </li>
                        <li>If after 3 days, you have not receive your coins, kindly contact us at this number
                            +6281249493830 (chat only - charlotte)"
                        </li>
                    </ol>
                </div>
            </div>
        </div>

        <a href="{{route('dashboard')}}"
           class="mt-4 w-full flex justify-center bg-blue-500 text-white font-bold py-2 px-4 rounded">
            Back to dashboard
        </a>

    @endif


</div>
