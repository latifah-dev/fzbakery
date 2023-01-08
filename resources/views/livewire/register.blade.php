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
      data.append('roleid', 3)
      const respon = fetch('https://friendzone-bakery.fly.dev/api/register',{
            method: 'POST',
            body: data
            });
            window.location.replace('http://127.0.0.1:3000/login')

    }
  }))
</script>
<main class="poster" x-data="regist">
  <div class="bg-opacity-95 bg-white max-w-3xl px-4 py-12 mb-8 rounded rounded-bl-lg shadow-xl sm:px-6 md:px-12 lg:w-8/12 xl:w-7/12">
      <header class="border-b border-opacity-20 border-secondary-600 mb-12 pb-4">
        <a href="#" class="font-bold font-serif hover:text-secondary-600 inline-flex items-center leading-none mr-auto text-secondary-500 text-xl uppercase">
        <img src="images/logo.png" alt="" width="75">
          <span>Register</span>
        </a>
      </header>
      <form x-on:submit.prevent="register()" class="w-full max-w-sm">
        <p class="mb-4 text-xl md:w-8/12">First Name</p>
          <div class="flex items-center border-b border-secondary-600 py-2">
            <input x-model="payload.firstname" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Jane" aria-label="firstname">
          </div>
          <hr class="bg-secondary-700 mb-12 opacity-100 w-3/12 md:w-2/12">
          <p class="mb-4 text-xl md:w-8/12">Last Name</p>
          <div class="flex items-center border-b border-secondary-600 py-2">
            <input x-model="payload.lastname" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Doe" aria-label="lastname">
          </div>
          <hr class="bg-secondary-700 mb-12 opacity-100 w-3/12 md:w-2/12">
          <p class="mb-4 text-xl md:w-8/12">Email</p>
          <div class="flex items-center border-b border-secondary-600 py-2">
            <input x-model="payload.email" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="JaneDoe@gmail.com" aria-label="email">
          </div>
          <hr class="bg-secondary-700 mb-12 opacity-100 w-3/12 md:w-2/12">
        <p class="mb-4 text-xl md:w-8/12">Password</p>
          <div class="flex items-center border-b border-secondary-600 py-2">
            <input x-model="payload.password" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="password" placeholder="******" aria-label="password">
          </div>
        <hr class="bg-secondary-700 mb-12 opacity-100 w-3/12 md:w-2/12">
        <div class="mb-12">
          <button type="submit" class="bg-secondary-500 font-normal hover:bg-secondary-600 inline-block leading-relaxed px-6 py-2 text-sm text-white">Register</button>
        </div>
      </form>
      Sudah memiliki akun ? silahkan <a href="{{route('login')}}" rel="noopener" class="hover:text-primary-700 hover:underline text-primary-600">Login </a>
      <footer class="border-opacity-20 border-secondary-600 border-t mt-16 pt-6">Created by Friendzone Bakery for you!</footer>
  </div>
</main>