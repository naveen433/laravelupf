<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Loan Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="w-full border border-gray-300 dark:border-gray-600 divide-y divide-gray-300 dark:divide-gray-600">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 font-bold text-left">Client ID</th>
                                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 font-bold text-left">Number of Payments</th>
                                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 font-bold text-left">First Payment Date</th>
                                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 font-bold text-left">Last Payment Date</th>
                                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 font-bold text-left">Loan Amount</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-300 dark:divide-gray-600">
                                @foreach($loans as $loan)
                                    <tr>
                                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ $loan->clientid }}</td>
                                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ $loan->num_of_payment }}</td>
                                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ $loan->first_payment_date }}</td>
                                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ $loan->last_payment_date }}</td>
                                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ number_format($loan->loan_amount, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>