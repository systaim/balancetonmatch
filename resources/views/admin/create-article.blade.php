@extends('layout')
@section('content')

    <div class="m-3 p-8 lg:w-6/12 mx-auto bg-primary rounded-md">
        <form action="{{ route('articles.store') }}" method="post">
            @csrf
            <div>
                <div>
                    <label for="title" class="block text-sm font-medium text-white">Titre</label>
                    <input type="text" name="title" id="title"
                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                        placeholder="Titre">
                </div>
                <div class="flex justify-between my-4">
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-white">categorie</label>
                        <select id="category_id" name="category_id"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option>Choisir une catégorie</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div>
                        <label for="active" class="block text-sm font-medium text-white">categorie</label>
                        <select id="active" name="active"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="">Choisir</option>
                            <option value="0">Non publié</option>
                            <option value="1">Publié</option>

                        </select>
                    </div>
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-white">Image</label>
                    <input type="text" name="image" id="image"
                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                        placeholder="lien unsplash">
                </div>
                <div>
                    <label for="body" class="block text-sm font-medium text-white">texte</label>
                    <div class="mt-1">
                        <textarea rows="4" name="body" id="body"
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                    </div>
                </div>

            </div>

            <div class="pt-5">
                <div class="flex justify-end">
                    <button type="button"
                        class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cancel
                    </button>
                    <button type="submit"
                        class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>





@endsection
