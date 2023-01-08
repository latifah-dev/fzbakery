
@extends('layouts.dash')
@section('title','Product')
@section('content')
<script>
    Alpine.data('transaksi', () => ({
        transaksi:[],
    fetchtransaksi() {
      fetch('https://friendzone-bakery.fly.dev/api/itemtransaksi')
        .then(response => response.json())
        .then(data => {
          this.transaksi = data.data;
        });
    },
     hapus: (id) => {
        console.log(id);
        const respon = fetch(`https://friendzone-bakery.fly.dev/api/itemtransaksi/${id}/delete`,{
            method: 'POST',
        })
        .then( (response) => {
            window.location.replace('http://127.0.0.1:3000/dashboard/tasklist')
        });
    }
    }))
    
  </script>
<main x-data="transaksi" x-init="fetchtransaksi()" class="ml-60 pt-16 overflow-auto">
<!-- component -->
<div class="sm:px-6 w-full">
                <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
                    <div class="sm:flex items-center justify-between">
                        <div class="flex items-center">
                            <a class="rounded-full focus:outline-none focus:ring-2  focus:bg-indigo-50 focus:ring-indigo-800" href=" javascript:void(0)">
                                <div class="py-2 px-8 bg-indigo-100 text-indigo-700 rounded-full">
                                    <p>All</p>
                                </div>
                            </a>
                            <a class="rounded-full focus:outline-none focus:ring-2 focus:bg-indigo-50 focus:ring-indigo-800 ml-4 sm:ml-8" href="javascript:void(0)">
                                <div class="py-2 px-8 text-gray-600 hover:text-indigo-700 hover:bg-indigo-100 rounded-full ">
                                    <p>Done</p>
                                </div>
                            </a>
                            <a class="rounded-full focus:outline-none focus:ring-2 focus:bg-indigo-50 focus:ring-indigo-800 ml-4 sm:ml-8" href="javascript:void(0)">
                                <div class="py-2 px-8 text-gray-600 hover:text-indigo-700 hover:bg-indigo-100 rounded-full ">
                                    <p>Pending</p>
                                </div>
                            </a>
                        </div>
                       
                    </div>
                    <div class="mt-7 overflow-x-auto">
                        <table class="w-full whitespace-nowrap">
                            <tbody>
                                <template x-for="trans in transaksi">
                                <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                                    <td class="">
                                        <div class="flex items-center pl-5">
                                            <p x-text="trans.productId"  class="text-base font-medium leading-none text-gray-700 mr-2">Marketing Keynote Presentation</p>
                                            
                                        </div>
                                    </td>
                                    <td class="pl-24">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                <path d="M9.16667 2.5L16.6667 10C17.0911 10.4745 17.0911 11.1922 16.6667 11.6667L11.6667 16.6667C11.1922 17.0911 10.4745 17.0911 10 16.6667L2.5 9.16667V5.83333C2.5 3.99238 3.99238 2.5 5.83333 2.5H9.16667" stroke="#52525B" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <circle cx="7.50004" cy="7.49967" r="1.66667" stroke="#52525B" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></circle>
                                            </svg>
                                            <p x-text="trans.status" class="text-sm leading-none text-gray-600 ml-2">Urgent</p>
                                        </div>
                                    </td>
                                    <td class="pl-5">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                <path d="M7.5 5H16.6667" stroke="#52525B" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M7.5 10H16.6667" stroke="#52525B" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M7.5 15H16.6667" stroke="#52525B" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M4.16669 5V5.00667" stroke="#52525B" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M4.16669 10V10.0067" stroke="#52525B" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M4.16669 15V15.0067" stroke="#52525B" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                            <p x-text="trans.shipingDate" class="text-sm leading-none text-gray-600 ml-2">04/07</p>
                                        </div>
                                    </td>
                                    <td class="pl-5">
                                        <button class="py-3 px-3 text-sm focus:outline-none leading-none text-red-700 bg-red-100 rounded">Due today at 18:00</button>
                                    </td>
                                    <td class="pl-4">
                                        <button class="focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-gray-600 py-3 px-5 bg-gray-100 rounded hover:bg-gray-200 focus:outline-none">View</button>
                                    </td>
                                </tr>
                                <tr class="h-3"></tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </main>
@endsection