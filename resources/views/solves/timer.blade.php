<x-layout title="timer">

    <div class="flex flex-col items-center justify-center min-h-[calc(100vh-5rem)] w-full bg-gray-900 text-white">

        <div class="max-w-5xl w-full text-center px-4">
            
            <div class="mb-16">
                <h2 class="text-gray-400 uppercase tracking-widest text-sm mb-4">Scramble</h2>
                <p id="scramble-display"
                   class="text-4xl md:text-5xl font-bold tracking-widest text-yellow-400 leading-relaxed min-h-[6rem] drop-shadow-md">
                    Loading scramble...
                </p>
            </div>

            <div class="mb-12">
                <h1 id="timer-display"
                    class="text-9xl md:text-[12rem] font-mono font-bold transition-colors duration-200">
                    0.00
                </h1>
                <p class="text-gray-500 mt-6 text-lg tracking-wide">
                    Hold <kbd class="bg-gray-800 text-gray-300 px-3 py-1 rounded-md border border-gray-700">Space</kbd>
                    to start, press any key to stop.
                </p>
            </div>

            <div id="action-area" class="h-20 flex justify-center items-center">
                <button id="save-btn"
                        class="hidden bg-blue-600 hover:bg-blue-700 text-white text-xl font-bold py-4 px-12 rounded-xl transition-all shadow-lg hover:shadow-blue-500/20 transform hover:scale-105">
                    Save Time
                </button>
                <p id="save-status" class="hidden text-green-400 text-2xl font-semibold"></p>
            </div>

        </div>

    </div>


</x-layout>
