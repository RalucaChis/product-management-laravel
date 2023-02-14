<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">

                <form method="POST" action="/product/{{ $product->id }}" enctype="multipart/form-data">

                    <div class="form-group">
                        <textarea name="name"
                                  class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white">{{$product->name }}</textarea>
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                        <input type="file" name="file" required><br>
                        <br><textarea name="article_number"
                                      class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white">{{$product->article_number }}</textarea>
                        @if ($errors->has('article_number'))
                            <span class="text-danger">{{ $errors->first('article_number') }}</span>
                        @endif
                        <textarea name="description"
                                  class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white">{{$product->description }}</textarea>
                        @if ($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                        <table>
                            <tr>
                                <td>
                                    <fieldset>
                                        <select name="brand_selected">
                                            <option selected disabled>Please select a brand</option>
                                            @foreach (auth()->user()->brands as $brand)
                                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                </td>
                                <td>
                                    <fieldset>
                                        <select name="tags_selected[]" multiple>
                                            <option selected disabled>Please select tags</option>
                                            @foreach (auth()->user()->tags as $tag)
                                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                </td>

                                <td>
                                    <fieldset>
                                        <select name="categories_selected[]" multiple>
                                            <option selected disabled>Please select categories</option>
                                            @foreach (auth()->user()->categories as $cat)
                                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                </td>
                                <td>
                                    <fieldset>
                                        <select name="colors_selected[]" multiple>
                                            <option selected disabled>Please select colors</option>
                                            @foreach (auth()->user()->colors as $col)
                                                <option value="{{$col->id}}">{{$col->name}}</option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                </td>
                                <td>
                                    <fieldset>
                                        <select name="options_selected[]" multiple>
                                            <option selected disabled>Please select options</option>
                                            @foreach (auth()->user()->options as $opt)
                                                <option value="{{$opt->id}}">{{$opt->name}}</option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                </td>
                            </tr>
                        </table><br>
                    </div>

                    <div class="form-group">
                        <button type="submit" name="update"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update
                            product
                        </button>
                        <a href="/products"
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back</a>
                    </div>
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
