<div class="space-y-6">
    <!-- Import Section -->
    <form wire:submit.prevent="import" class="bg-gray-100 p-6 rounded-lg shadow-md space-y-4">
        <div class="flex items-center space-x-4">
            <input type="file" wire:model="file" class="border border-gray-300 p-2 rounded-lg w-full md:w-2/3 hover:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-lg shadow-md transition duration-300 transform hover:scale-105">Import</button>
        </div>
    </form>
    <a href="{{ route('download-sample') }}" class="text-xs bg-gray-600 hover:bg-gray-700 text-white py-3 px-6 rounded-lg shadow-md transition duration-300 transform hover:scale-105 mt-4 block">
        Download Sample Excel
         </a>
    <!-- Download Sample File -->
    
    <!-- Success Message -->
    @if(session()->has('message'))
        <p class="text-green-600 font-semibold mt-4">{{ session('message') }}</p>
    @endif
</div>

