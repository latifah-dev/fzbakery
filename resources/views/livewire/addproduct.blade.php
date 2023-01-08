@extends('layouts.dash')
@section('title','Add Product')

@section('content')
<script>
  Alpine.data("add", ()=>({
    show:false,
    payload: {
      nameProduct:'',
      price:'',
      description:'',
      size:'',
    },
    files:'',
    products:[],
    toggle: '0',
    respon: '',
    async create() {
      let photo = this.files[0]
      const data = new FormData()
      data.append('photo', photo)
      data.append('nameProduct', this.payload.nameProduct)
      data.append('price', this.payload.price)
      data.append('description', this.payload.description)
      data.append('size', this.payload.size)
      const respon = fetch('https://friendzone-bakery.fly.dev/api/product',{
            method: 'POST',
            body: data
            });
            window.location.replace('https://fzbakery.fly.dev/dashboard/product')

    }
  }))
</script>
<main x-data="add" class="ml-60 pt-16 max-h-screen overflow-auto">
    <div class="px-6 py-8">
        <div class="max-w-4xl mx-auto">
          <div class="bg-white rounded-3xl p-8 mb-5">
    <form x-on:submit.prevent="create()" class="w-full">
        <div class="flex items-center border-b border-secondary-600 py-2">
            <p class="text-m md:w-8/12">Image</p>
            <input x-on:change="files = Object.values($event.target.files)" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="file" placeholder="image" aria-label="Image">
        </div>
        <hr class="bg-secondary-700 mb-12 opacity-100 w-3/12 md:w-2/12">
        
        <div class="flex items-center border-b border-secondary-600 py-2">
            <p class="text-m md:w-8/12">Nama Product</p>
            <input x-model="payload.nameProduct" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Cake Black Forest" aria-label="nameProduct">
        </div>
        <hr class="bg-secondary-700 mb-12 opacity-100 w-3/12 md:w-2/12">
        
        <div class="flex items-center border-b border-secondary-600 py-2">
            <p class="text-m md:w-8/12">Price</p>
            <input x-model="payload.price" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="2000000" aria-label="price">
        </div>
        <hr class="bg-secondary-700 mb-12 opacity-100 w-3/12 md:w-2/12">
      
        <div class="flex items-center border-b border-secondary-600 py-2">
            <p class="text-m md:w-8/12">Size</p>
            <input x-model="payload.size" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="small, medium, large" aria-label="size">
        </div>
      <hr class="bg-secondary-700 mb-12 opacity-100 w-3/12 md:w-2/12">
      <div class="flex items-center border-b border-secondary-600 py-2">
        <p class="text-m md:w-8/12">Deskripsi</p>
      
        <textarea x-model="payload.description" cols="30" rows="10" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" aria-label="description"></textarea>
    </div>
  <hr class="bg-secondary-700 mb-12 opacity-100 w-3/12 md:w-2/12">
  
      <div class="mb-12">
        <button type="submit" class="bg-black text-white font-normal hover:bg-secondary-600 inline-block leading-relaxed px-6 py-2 text-sm">Create</button>
      </div>
    </form>
          </div>
        </div>
    </div>
</main>
@endsection