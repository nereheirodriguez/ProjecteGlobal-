<div>
    <button wire:click="openModal" class="inline-flex items-center px-8 py-4 border border-transparent text-base font-bold rounded-xl text-gray-900 bg-lime-400 hover:bg-lime-500 transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-115 hover:brightness-110 ring-2 ring-lime-500">
        Crear una serie
    </button>

    <x-modal id="create-series-modal" wire:model="show" maxWidth="lg">
        <form wire:submit.prevent="save">
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                <input type="text" wire:model="title" id="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-lime-500 focus:border-lime-500 sm:text-sm" required>
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea wire:model="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-lime-500 focus:border-lime-500 sm:text-sm" rows="4"></textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">URL de la imagen</label>
                <input type="url" wire:model="image" id="image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-lime-500 focus:border-lime-500 sm:text-sm">
                @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="flex justify-end">
                <button type="button" wire:click="closeModal" class="mr-2 inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Cancelar</button>
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-gray-900 bg-lime-400 hover:bg-lime-500">Crear</button>
            </div>
        </form>
    </x-modal>
</div>
