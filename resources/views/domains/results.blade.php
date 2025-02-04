<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Domain Search Results') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (!$results['success'])
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            {{ $results['message'] }}
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($results['domains'] as $result)
                                <div class="p-4 border rounded {{ $result['is_available'] ? 'border-green-500 bg-green-50' : 'border-red-500 bg-red-50' }}">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <h2 class="text-xl font-semibold">{{ $result['domain_name'] }}</h2>
                                            <p class="text-gray-600">
                                                @if($result['is_available'])
                                                    Available
                                                @else
                                                    Not Available
                                                @endif
                                            </p>
                                        </div>
                                        @if($result['is_available'])
                                            <form action="{{ route('domains.register.form') }}" method="GET">
                                                <input type="hidden" name="domain" value="{{ $domain }}">
                                                <input type="hidden" name="tld" value="{{ $tld }}">
                                                <button type="submit" 
                                                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                                    Register Now
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="mt-6 text-center">
                        <a href="{{ route('domains.search') }}" 
                           class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Search Another Domain
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
