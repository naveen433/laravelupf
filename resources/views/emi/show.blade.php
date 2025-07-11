<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('EMI Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container">
                        <style>
                            table, th, td {
                                border: 1px solid black;
                                border-collapse: collapse;
                                padding: 8px;
                                text-align: center;
                            }
                            table {
                                width: 100%;
                                margin-top: 20px;
                            }
                            th {
                                background-color: #f2f2f2;
                                font-weight: bold;
                            }
                            .btn-primary {
                                background-color: #2563eb;
                                color: white;
                                padding: 10px 20px;
                                border: none;
                                border-radius: 5px;
                                cursor: pointer;
                                transition: background-color 0.3s;
                            }
                            .btn-primary:hover {
                                background-color: #1e40af;
                            }
                            .alert-success {
                                background-color: #10b981;
                                color: white;
                                padding: 10px;
                                border-radius: 5px;
                                margin-bottom: 15px;
                            }
                        </style>

                        <form action="{{ route('emi.process') }}" method="POST">
                            @csrf
                            <button class="btn btn-primary mb-3">Process Data</button>
                        </form>

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if(!empty($data) && !empty($columns))
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Month</th>
                                        @foreach($data as $row)
                                            <th>Client {{ $row->clientid }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($columns as $column)
                                        @php $field = $column->Field; @endphp
                                        @if($field !== 'clientid')
                                            <tr>
                                                <td>{{ $field }}</td>
                                                @foreach($data as $row)
                                                    <td>{{ number_format($row->$field, 2) }}</td>
                                                @endforeach
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>