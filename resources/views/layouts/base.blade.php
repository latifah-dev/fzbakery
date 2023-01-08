<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @hasSection('title')

            <title>@yield('title') - {{ config('app.name') }}</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif

        <!-- Favicon -->
		<link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
        <!-- memanggil tailwind -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        <link href="{{asset('tailwind_theme/tailwind.css')}}" rel="stylesheet" type="text/css">
        <!-- menggunakan livewire -->
        @livewireStyles
        <script  src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>/* Pinegrow Interactions, do not remove */ (function(){try{if(!document.documentElement.hasAttribute('data-pg-ia-disabled')) { window.pgia_small_mq=typeof pgia_small_mq=='string'?pgia_small_mq:'(max-width:767px)';window.pgia_large_mq=typeof pgia_large_mq=='string'?pgia_large_mq:'(min-width:768px)';var style = document.createElement('style');var pgcss='html:not(.pg-ia-no-preview) [data-pg-ia-hide=""] {opacity:0;visibility:hidden;}html:not(.pg-ia-no-preview) [data-pg-ia-show=""] {opacity:1;visibility:visible;display:block;}';if(document.documentElement.hasAttribute('data-pg-id') && document.documentElement.hasAttribute('data-pg-mobile')) {pgia_small_mq='(min-width:0)';pgia_large_mq='(min-width:99999px)'} pgcss+='@media ' + pgia_small_mq + '{ html:not(.pg-ia-no-preview) [data-pg-ia-hide="mobile"] {opacity:0;visibility:hidden;}html:not(.pg-ia-no-preview) [data-pg-ia-show="mobile"] {opacity:1;visibility:visible;display:block;}}';pgcss+='@media ' + pgia_large_mq + '{html:not(.pg-ia-no-preview) [data-pg-ia-hide="desktop"] {opacity:0;visibility:hidden;}html:not(.pg-ia-no-preview) [data-pg-ia-show="desktop"] {opacity:1;visibility:visible;display:block;}}';style.innerHTML=pgcss;document.querySelector('head').appendChild(style);}}catch(e){console&&console.log(e);}})()</script>
    </head>

    <body>
      <script>
        Alpine.data("auth", () => ({
            isOpen: false,
            islogin: false,
        ceklogin(){
        const token = localStorage.getItem('token')
        this.islogin = token ? true : false
        },
        async logout(){
            await localStorage.clear()
            window.location.replace('http://127.0.0.1:3000/')
        }
            }))
    </script>
    <header x-init="ceklogin()" x-data="auth">
      <div class="container mx-auto relative"> 
        <nav class="flex flex-wrap items-center p-4"> 
          <a href="#" class="font-bold font-serif hover:text-opacity-75 inline-flex items-center leading-none mr-auto text-secondary-500 text-xl uppercase">
              <img src="{{asset('images/logo.png')}}" alt="" width="75">
            <span>Friendzone<br>Bakery</span> </a> 
          <button class="hover:bg-white hover:text-secondary-500 lg:hidden px-3 py-2 rounded text-secondary-500" data-name="nav-toggler" data-pg-ia='{"l":[{"name":"NabMenuToggler","trg":"click","a":{"l":[{"t":"^nav|[data-name=nav-menu]","l":[{"t":"set","p":0,"d":0,"l":{"class.remove":"hidden"}}]},{"t":"#gt# span:nth-of-type(1)","l":[{"t":"tween","p":0,"d":0.2,"l":{"rotationZ":45,"yPercent":300}}]},{"t":"#gt# span:nth-of-type(2)","l":[{"t":"tween","p":0,"d":0.2,"l":{"autoAlpha":0}}]},{"t":"#gt# span:nth-of-type(3)","l":[{"t":"tween","p":0,"d":0.2,"l":{"rotationZ":-45,"yPercent":-300}}]}]},"pdef":"true","trev":"true"}]}' data-pg-ia-apply="$nav [data-name=nav-toggler]"> 
            <span class="block border-b-2 border-current my-1 w-6"></span> 
            <span class="block border-b-2 border-current my-1 w-6"></span> 
            <span class="block border-b-2 border-current my-1 w-6"></span> 
          </button>           
          <div class="lg:flex lg:space-x-4 lg:space-y-0 lg:w-auto space-y-2 w-full hidden lg:items-center" data-name="nav-menu"> 
            <div class="flex flex-col lg:flex-row"> 
              <a href="{{route('home')}}" class="hover:text-opacity-75 lg:px-6 lg:py-4 py-2 text-black">Home</a>
              <a href="#" class="hover:text-opacity-75 lg:px-6 lg:py-4 py-2 text-black">Custom Cakes</a>
              <a href="{{route('displayproduct')}}" class="hover:text-opacity-75 lg:px-6 lg:py-4 py-2 text-black">Product</a>
              <a href="#" class="hover:text-opacity-75 lg:px-6 lg:py-4 py-2 text-black">Keranjang</a>
              <a href="#" class="hover:text-opacity-75 lg:px-6 lg:py-4 py-2 text-black">Contact</a> 
            </div>
            <template x-if="islogin">
              <button x-on:click="logout()" class="bg-secondary-600 hover:bg-secondary-700 inline-block px-6 py-2 text-white">Logout</button> 
            </template>
            <template x-if="!islogin">
            <a href="{{route('login')}}" class="bg-secondary-600 hover:bg-secondary-700 inline-block px-6 py-2 text-white">Login</a> 
            </template>
          </div>           
        </nav>         
      </div>
    </header>

        @yield('body')

        <footer class="bg-black bg-opacity-90 pt-12 text-gray-300"> 
      <div class="container mx-auto px-4 relative"> 
        <div class="flex flex-wrap -mx-4"> 
          <div class="w-full p-4  xl:mr-auto xl:w-4/12"> 
            <a href="#" class="font-bold font-serif hover:text-opacity-75 inline-flex items-center leading-none mb-6 text-3xl text-secondary-700 uppercase">
                <img src="images/logo.png" alt="" width="75">
              <span>Friendzone<br>Bakery</span> </a> 
            <p class="mb-4 text-sm">Life is full of Memories, we make them Sweeter.</p> 
            <div class="mb-6"> 
              <a href="#" class="hover:text-color3-600">+62 895 2909 9027</a> 
              <br> 
              <a href="#" class="hover:text-color3-600">@friendzone_bakery</a> 
            </div>             
            <div class="flex-wrap inline-flex space-x-3"> 
              <a href="#" aria-label="facebook" class="hover:text-color3-600"> <svg viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5"> 
                  <path d="M14 13.5h2.5l1-4H14v-2c0-1.03 0-2 2-2h1.5V2.14c-.326-.043-1.557-.14-2.857-.14C11.928 2 10 3.657 10 6.7v2.8H7v4h3V22h4v-8.5z"/> 
                </svg></a> 
              <a href="#" aria-label="twitter" class="hover:text-color3-600"> <svg viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5"> 
                  <path d="M22.162 5.656a8.384 8.384 0 0 1-2.402.658A4.196 4.196 0 0 0 21.6 4c-.82.488-1.719.83-2.656 1.015a4.182 4.182 0 0 0-7.126 3.814 11.874 11.874 0 0 1-8.62-4.37 4.168 4.168 0 0 0-.566 2.103c0 1.45.738 2.731 1.86 3.481a4.168 4.168 0 0 1-1.894-.523v.052a4.185 4.185 0 0 0 3.355 4.101 4.21 4.21 0 0 1-1.89.072A4.185 4.185 0 0 0 7.97 16.65a8.394 8.394 0 0 1-6.191 1.732 11.83 11.83 0 0 0 6.41 1.88c7.693 0 11.9-6.373 11.9-11.9 0-.18-.005-.362-.013-.54a8.496 8.496 0 0 0 2.087-2.165z"/> 
                </svg></a> 
              <a href="#" aria-label="instagram" class="hover:text-color3-600"> <svg viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5"> 
                  <path d="M12 2c2.717 0 3.056.01 4.122.06 1.065.05 1.79.217 2.428.465.66.254 1.216.598 1.772 1.153a4.908 4.908 0 0 1 1.153 1.772c.247.637.415 1.363.465 2.428.047 1.066.06 1.405.06 4.122 0 2.717-.01 3.056-.06 4.122-.05 1.065-.218 1.79-.465 2.428a4.883 4.883 0 0 1-1.153 1.772 4.915 4.915 0 0 1-1.772 1.153c-.637.247-1.363.415-2.428.465-1.066.047-1.405.06-4.122.06-2.717 0-3.056-.01-4.122-.06-1.065-.05-1.79-.218-2.428-.465a4.89 4.89 0 0 1-1.772-1.153 4.904 4.904 0 0 1-1.153-1.772c-.248-.637-.415-1.363-.465-2.428C2.013 15.056 2 14.717 2 12c0-2.717.01-3.056.06-4.122.05-1.066.217-1.79.465-2.428a4.88 4.88 0 0 1 1.153-1.772A4.897 4.897 0 0 1 5.45 2.525c.638-.248 1.362-.415 2.428-.465C8.944 2.013 9.283 2 12 2zm0 5a5 5 0 1 0 0 10 5 5 0 0 0 0-10zm6.5-.25a1.25 1.25 0 0 0-2.5 0 1.25 1.25 0 0 0 2.5 0zM12 9a3 3 0 1 1 0 6 3 3 0 0 1 0-6z"/> 
                </svg></a>
              <a href="#" aria-label="linkedin" class="hover:text-color3-600"> <svg viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5"> 
                  <path d="M6.94 5a2 2 0 1 1-4-.002 2 2 0 0 1 4 .002zM7 8.48H3V21h4V8.48zm6.32 0H9.34V21h3.94v-6.57c0-3.66 4.77-4 4.77 0V21H22v-7.93c0-6.17-7.06-5.94-8.72-2.91l.04-1.68z"/> 
                </svg></a>
              <a href="#" aria-label="youtube" class="hover:text-color3-600"> <svg viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5"> 
                  <path d="M21.543 6.498C22 8.28 22 12 22 12s0 3.72-.457 5.502c-.254.985-.997 1.76-1.938 2.022C17.896 20 12 20 12 20s-5.893 0-7.605-.476c-.945-.266-1.687-1.04-1.938-2.022C2 15.72 2 12 2 12s0-3.72.457-5.502c.254-.985.997-1.76 1.938-2.022C6.107 4 12 4 12 4s5.896 0 7.605.476c.945.266 1.687 1.04 1.938 2.022zM10 15.5l6-3.5-6-3.5v7z"/> 
                </svg></a> 
            </div>             
          </div>           
          <div class="w-full p-4  xl:w-2/12 sm:w-4/12"> 
            <h2 class="font-bold mb-8 text-secondary-700  text-lg uppercase">                             About </h2> 
            <ul> 
              <li class="mb-4"> 
                <a href="#" class="hover:text-color3-600">Get Quote</a> 
              </li>
              <li class="mb-4"> 
                <a href="#" class="hover:text-color3-600">Business Deal</a> 
              </li>                              
              <li class="mb-4"> 
                <a href="#" class="hover:text-color3-600">Privacy Policy</a> 
              </li>
              <li class="mb-4"> 
                <a href="#" class="hover:text-color3-600">Terms of Service</a> 
              </li>                              
            </ul>             
          </div>           
          <div class="w-full p-4  xl:w-2/12 sm:w-4/12"> 
            <h2 class="font-bold mb-8 text-secondary-700  text-lg uppercase">                             Services </h2> 
            <ul> 
              <li class="mb-4"> 
                <a href="#" class="hover:text-color3-600">Custom Cakes</a> 
              </li>               
              <li class="mb-4"> 
                <a href="#" class="hover:text-color3-600">Special Cakes</a> 
              </li>               
              <li class="mb-4"> 
                <a href="#" class="hover:text-color3-600">Birthday Cakes</a> 
              </li>               
              <li class="mb-4"> 
                <a href="#" class="hover:text-color3-600">Wedding Cakes</a> 
              </li>               
              <li class="mb-4"> 
                <a href="#" class="hover:text-color3-600">Graduation Cakes</a> 
              </li>               
            </ul>             
          </div>           
          <div class="w-full p-4  xl:w-2/12 sm:w-4/12"> 
            <h2 class="font-bold mb-8 text-secondary-700  text-lg uppercase"> Other </h2> 
            <ul> 
              <li class="mb-4"> 
                <a href="#" class="hover:text-color3-600">Blog</a> 
              </li>               
              <li class="mb-4"> 
                <a href="#" class="hover:text-color3-600">Shipping</a> 
              </li>               
              <li class="mb-4"> 
                <a href="#" class="hover:text-color3-600">Experiences</a> 
              </li>               
              <li class="mb-4"> 
                <a href="#" class="hover:text-color3-600">Refund Policy</a> 
              </li>               
              <li class="mb-4"> 
                <a href="#" class="hover:text-color3-600">Terms of Service</a> 
              </li>               
            </ul>             
          </div>           
        </div>         
        <div class="py-4 text-center"> 
          <hr class="mb-4 opacity-25"> 
          <p class="text-sm">Copyright &copy; 2021 Friendzone Bakery</p> 
        </div>         
      </div>       
    </footer>
        <!-- menggunakan livewire -->
        @livewireScripts

    </body>
</html>
