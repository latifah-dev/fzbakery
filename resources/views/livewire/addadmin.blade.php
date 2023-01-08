@extends('layouts.dash')
@section('title','Add Admin')

@section('content')
<script>
  Alpine.data("regist", ()=>({
    show:false,
    payload: {
      firstname:'',
      lastname:'',
      email:'',
      password:'',
      roleid:'',
    },
    users:[],
    toggle: '0',
    respon: '',
    async register() {
      const data = new FormData()
      data.append('firstname', this.payload.firstname)
      data.append('lastname', this.payload.lastname)
      data.append('email', this.payload.email)
      data.append('password', this.payload.password)
      data.append('roleid', 2)
      const respon = fetch('https://friendzone-bakery.fly.dev/api/register',{
            method: 'POST',
            body: data
            });
            window.location.replace('http://127.0.0.1:3000/dashboard')

    }
  }))
</script>
<main x-data="regist" class="ml-60 pt-16 max-h-screen overflow-auto">
    <div class="px-6 py-8">
        <div class="max-w-4xl mx-auto">
          <div class="bg-white rounded-3xl p-8 mb-5">
    <form x-on:submit.prevent="register()" class="w-full">
        <div class="flex items-center border-b border-secondary-600 py-2">
            <p class="text-m md:w-8/12">First Name</p>
            <input x-model="payload.firstname" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Jane" aria-label="firstname">
        </div>
        <hr class="bg-secondary-700 mb-12 opacity-100 w-3/12 md:w-2/12">
        
        <div class="flex items-center border-b border-secondary-600 py-2">
            <p class="text-m md:w-8/12">Last Name</p>
            <input x-model="payload.lastname" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Doe" aria-label="lastname">
        </div>
        <hr class="bg-secondary-700 mb-12 opacity-100 w-3/12 md:w-2/12">
        
        <div class="flex items-center border-b border-secondary-600 py-2">
            <p class="text-m md:w-8/12">Email</p>
            <input x-model="payload.email" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="JaneDoe@gmail.com" aria-label="email">
        </div>
        <hr class="bg-secondary-700 mb-12 opacity-100 w-3/12 md:w-2/12">
      
        <div class="flex items-center border-b border-secondary-600 py-2">
            <p class="text-m md:w-8/12">Password</p>
            <input x-model="payload.password" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="password" placeholder="******" aria-label="password">
        </div>
      <hr class="bg-secondary-700 mb-12 opacity-100 w-3/12 md:w-2/12">
      <div class="mb-12">
        <button type="submit" class="bg-black text-white font-normal hover:bg-secondary-600 inline-block leading-relaxed px-6 py-2 text-sm">Register</button>
      </div>
    </form>
          </div>
        </div>
    </div>
</main>
@endsection