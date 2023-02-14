<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <div class="flex">
                    <div class="flex-auto text-2xl mb-4">Products List</div>

                    <div class="flex-auto text-right mt-2">
                        <a href="/product" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add new product</a>
                    </div>
                </div>
                <table class="w-full text-md rounded mb-4">
                    <thead>
                    <tr class="border-b">
                        <th class="text-left p-3 px-5">Name</th>
                        <th class="text-left p-3 px-5">Image</th>
                        <th class="text-left p-3 px-5">Article Number</th>
                        <th class="text-left p-3 px-5">Description</th>
                        <th class="text-left p-3 px-5">Brand</th>
                        <th class="text-left p-3 px-5">Tags</th>
                        <th class="text-left p-3 px-5">Categories</th>
                        <th class="text-left p-3 px-5">Colors</th>
                        <th class="text-left p-3 px-5">Options</th>
                        <th class="text-left p-3 px-5">Actions</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(auth()->user()->products as $product)
                        <tr class="border-b hover:bg-orange-100">
                            <td class="p-3 px-5">
                                {{$product->name}}
                            </td>
                            <td class="p-3 px-5">
                                <img src="storage/images/{{ $product->image_path }}" width="100px" alt="{{ $product->image_path }}">
                            </td>
                            <td class="p-3 px-5">
                                {{$product->article_number}}
                            </td>
                            <td class="p-3 px-5">
                                {{$product->description}}
                            </td>
                            <td class="p-3 px-5">
                                {{$product->brand->name}}
                            </td>
                            <td class="p-3 px-5">
                                @foreach($product->tags as $tag)
                                    {{$tag->name}}
                                @endforeach
                            </td>
                            <td class="p-3 px-5">
                                @foreach($product->categories as $catg)
                                    {{$catg->name}}
                                @endforeach
                            </td>
                            <td class="p-3 px-5">
                                @foreach($product->colors as $col)
                                    {{$col->name}}
                                @endforeach
                            </td>
                            <td class="p-3 px-5">
                                @foreach($product->options as $opt)
                                    {{$opt->name}}
                                @endforeach
                            </td>
                            <td class="p-3 px-5">
                                <a href="/product/{{$product->id}}" name="edit" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Edit</a><br>
                                <br><form action="/product/{{$product->id}}" class="inline-block">
                                    <button type="submit" name="delete" formmethod="POST" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Delete</button>
                                    {{ csrf_field() }}
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
