
@extends('layouts.dash')
@section('title','Product')
@section('content')
<script>
    Alpine.data('product', () => ({
        products:[],
    fetchProducts() {
      fetch('https://friendzone-bakery.fly.dev/api/product')
        .then(response => response.json())
        .then(data => {
          this.products = data.data;
        });
    },
     hapus: (id) => {
        console.log(id);
        const respon = fetch(`https://friendzone-bakery.fly.dev/api/product/${id}/delete`,{
            method: 'POST',
        })
        .then( (response) => {
            window.location.replace('http://127.0.0.1:3000/dashboard/product')
        });
    }
    }))
    
  </script>
<main class="ml-60 pt-16 max-h-screen overflow-auto">
<!-- component -->
<!-- This is an example component -->
<div class="px-8 mx-auto">

	<div class="flex flex-col">
    <div class="overflow-x-auto shadow-md sm:rounded-lg">
        <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden "> 
                <a href="{{route('addproduct')}}" class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-indigo-700 hover:bg-indigo-600 focus:outline-none rounded">
                    <p class="text-sm font-medium leading-none text-white">Add Product</p>
                </a>
                <table id="product-list" x-data="product" x-init="fetchProducts()" class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="p-4">
                                <div class="flex items-center">
                                    <input id="checkbox-all" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-all" class="sr-only">checkbox</label>
                                </div>
                            </th>
                            <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                Product Name
                            </th>
                            <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                Picture
                            </th>
                            <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                Price
                            </th>
                            <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                Size
                            </th>
                            <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                Deskripsi
                            </th>
                            <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody  class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        <template x-for="product in products">
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700" >
                            <td class="p-4 w-4">
                                <div class="flex items-center">
                                    <input id="checkbox-table-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-table-1" class="sr-only">checkbox</label>
                                </div>
                            </td>
                            <td x-text="product.nameProduct" class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">Apple Imac 27"</td>
                            <td class="py-4 px-6 text-sm font-medium text-gray-500 whitespace-nowrap dark:text-white">
                                <img :src="'https://friendzone-bakery.fly.dev/storage/images/'+product.image" alt="">
                            </td>
                            <td x-text="product.price" class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">$1999</td>
                            <td x-text="product.size" class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">Small</td>
                            <td x-text="product.description" class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white columns-3xs whitespace-pre-line">
                                
                            </td>
                            <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                <a :href="`updateproduct/${product.id}`" class="text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                <button x-on:click="hapus(product.id)" class="text-blue-600 dark:text-blue-500 hover:underline">Delete</button>
                            </td>
                        </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</main>
@endsection