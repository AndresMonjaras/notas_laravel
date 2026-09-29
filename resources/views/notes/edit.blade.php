<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Nota
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('notes.update', $note) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="title">Título</label>
                    <input id="title" name="title" type="text" class="w-full border-gray-300 rounded" value="{{ old('title', $note->title) }}">
                    @error('title') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="content">Contenido</label>
                    <textarea id="content" name="content" class="w-full border-gray-300 rounded">{{ old('content', $note->content) }}</textarea>
                    @error('content') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                    Actualizar
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
