<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="w-full bg-white rounded-lg border shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <div id="fullWidthTabContent" class="border-t border-gray-200 dark:border-gray-600">
                        <div class="p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="stats" role="tabpanel"
                            aria-labelledby="stats-tab">
                            <dl
                                class="grid grid-cols-2 gap-8 p-4 mx-auto max-w-screen-xl text-gray-900 sm:grid-cols-3 xl:grid-cols-6 dark:text-white sm:p-8">
                                <div class="flex flex-col justify-center items-center">
                                    <dt class="mb-2 text-3xl font-extrabold">{{ $product }}</dt>
                                    <dd class="font-light text-gray-500 dark:text-gray-400">Produk</dd>
                                </div>
                                <div class="flex flex-col justify-center items-center">
                                    <dt class="mb-2 text-3xl font-extrabold">{{ $transaction }}</dt>
                                    <dd class="font-light text-gray-500 dark:text-gray-400">Transaksi</dd>
                                </div>
                                <div class="flex flex-col justify-center items-center">
                                    <dt class="mb-2 text-3xl font-extrabold">{{ $user }}</dt>
                                    <dd class="font-light text-gray-500 dark:text-gray-400">User</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
