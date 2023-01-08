<script>
  Alpine.data("add", ()=>({
    token: '',
    products: {
      id:'',
      nameProduct:'',
      price:'',
      description:'',
      size:'',
    },
    itemtransaksi: {
      productId:'',
      size:'',
      qty:'',
      subtotal:'',
      shipingdate:'',
      shipingaddress:'',
      postalCode:'',
      telp:'',
      greatingcart:'',
      transaksiId:'',
    },
    files:'',
    userId:'',

    url: window.location.href.split('/'),

    products:[],
    toggle: '0',
    respon: '',
    currentuser:'',
    tambah: '',
    async tampil(){
      const id = this.url[this.url.length-1]
            const data = new FormData()
            const respon = fetch(`https://friendzone-bakery.fly.dev/api/product/${id}`)
            .then(response => response.json())
            .then(data => {
            this.products = data.data;
            
            });
        },

    async getTkn() {
          let token = localStorage.getItem('token')
          this.token = token

        },

    async iduser(token) {
          const currentuser = fetch('https://friendzone-bakery.fly.dev/api/me',{
            method: 'get',
            headers: {
              'Authorization': `Bearer ${token}`
            },
          })
          .then(response => response.json())
          .then(data => {
            // Menetapkan ID pengguna ke dalam state `userId`
          let id = this.userId = data.data.id;
          console.log(id)
         });
        },
    async tambahItem() {
    const subtotal = document.querySelector('#subtotal').value
    const size = document.querySelector('input[name="radio"]:checked').value
      const data = new FormData()
      data.append('idUser', this.userId)
      data.append('productId', this.url[this.url.length-1])
      data.append('size', size)
      data.append('qty', this.itemtransaksi.qty)
      data.append('subTotal', subtotal)
      data.append('shipingDate', this.itemtransaksi.shipingdate)
      data.append('shipingAddress', this.itemtransaksi.shipingaddress)
      data.append('postalCode', this.itemtransaksi.postalCode)
      data.append('telp', this.itemtransaksi.telp)
      data.append('greatingCart', this.itemtransaksi.greatingcart)

      const tambah = fetch('https://friendzone-bakery.fly.dev/api/itemtransaksi', {
        method: 'POST',
        body: data,
      })
        .then(response => response.json())
        .then(data => {
          let idTransaksi = (this.itemtransaksi = data.data.transaksiId);
          window.location.replace(
            `https://fzbakery.fly.dev/transaksi/${idTransaksi}`
          );
        });
    },
  }));
</script>

<section x-data="add" x-init="tampil(), iduser(token), getTkn(token)" class="relative text-white mb-8">
        <div class="absolute bg-secondary-500 h-full right-0 top-0 w-full lg:w-7/12">
        </div>
        <form x-on:submit.prevent="tambahItem()">
            <div class="container mx-auto pb-24 pt-24 px-4 relative">
                <div class="-mx-4 flex flex-wrap space-y-6 lg:space-y-0">
                  <div class="px-4 w-full lg:w-6/12"> 
                    <div class="bg-secondary-500 lg:p-4">
                      <div class="relative" style="height: 50vh;">
                      <img :src="'https://friendzone-bakery.fly.dev/storage/images/'+products.image"  alt="" class="object-cover w-full h-full">
                      </div>
                    </div>               
                  </div>
                  <div class="px-4 w-full lg:w-6/12"> 

                    <h1 x-text="products.nameProduct" class="font-bold mb-4 text-5xl sm:text-6xl lg:text-7xl">CupCake Rainbow</h1>
                    <p x-text="products.price" class="border-opacity-50 border-white border-t border-b py-6 text-white text-2xl">Rp. 100.0000</p>
                    <p x-text="products.description" class="mb-6 text-opacity-50 text-white text-xl sm:pr-12">Deskripsi : Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet.</p>
                    <p class="text-white text-2xl">Size</p>
                    <div class="flex items-center w-screen">
                            <div>
                                <input x-model="itemtransaksi.size" class="hidden" value="small" id="radio_1" type="radio" name="radio">
                                <label class="flex flex-col p-4 border-2 border-gray-400 cursor-pointer" for="radio_1">
                                    <span class="text-xs font-semibold uppercase">Small</span>
                                </label>
                            </div>
                            <div>
                                <input x-model="itemtransaksi.size" class="hidden" value="medium" id="radio_2" type="radio" name="radio">
                                <label class="flex flex-col p-4 border-2 border-gray-400 cursor-pointer" for="radio_2">
                                    <span class="text-xs font-semibold uppercase">Medium</span>
                                </label>
                            </div>
                            <div>
                                <input x-model="itemtransaksi.size" class="hidden" value="large" id="radio_3" type="radio" name="radio">
                                <label class="flex flex-col p-4 border-2 border-gray-400 cursor-pointer" for="radio_3">
                                    <span class="text-xs font-semibold uppercase">Large</span>
                                </label>
                            </div>
                    </div>
                    <p class="text-white text-2xl pt-6 pb-2">Tanggal Pengiriman</p>
                    <input min={{now()}} x-model="itemtransaksi.shipingdate" class="appearance-none border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="date" placeholder="JaneDoe@gmail.com" aria-label="email">
                    <p class="text-white text-2xl pt-6 pb-2">Jumlah</p>
                    <div class="flex flex-row h-10 rounded-lg mt-1">
                        {{-- <button data-action="decrement" class="bg-white text-black w-20 rounded-l cursor-pointer outline-none">
                          <span class="m-auto text-2xl font-thin">−</span>
                        </button> --}}
                        <input type="number" x-model="itemtransaksi.qty" class="outline-none focus:outline-none text-center bg-white font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-black  outline-none" name="custom-input-number" value="1"/>
                      {{-- <button data-action="increment" class="bg-white text-black w-20 rounded-r cursor-pointer">
                        <span class="m-auto text-2xl font-thin">+</span>
                      </button> --}}
                    </div>
                    <p class="text-white text-2xl pt-6 pb-2">Total Biaya</p>
                    <input id="subtotal" x-model="itemtransaksi.subtotal" x-bind:value="itemtransaksi.qty * products.price" class="appearance-none border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" aria-label="email">
                    
                    <p class="text-white text-2xl pt-6 pb-2">Alamat Pengiriman</p>
                    <textarea x-model="itemtransaksi.shipingaddress" name="" id="" cols="30" rows="5" class="text-black w-full"></textarea>
                    
                    <p class="text-white text-2xl pt-6 pb-2">Kode Pos</p>
                    <input x-model="itemtransaksi.postalCode" class="appearance-none border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="50775" aria-label="email">
                    <p class="text-white text-2xl pt-6 pb-2">Nomor Telepon</p>
                    <input x-model="itemtransaksi.telp" class="appearance-none border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="08797545336" aria-label="email">
                    <p class="text-white text-2xl pt-6 pb-2">Ucapan</p>
                    <textarea x-model="itemtransaksi.greatingcart" name="" id="" cols="30" rows="5" class="text-black w-full"></textarea>
                    
                    <p class="border-opacity-50 py-2"></p>
                    <button type="submit" class="bg-color3-600 hover:bg-secondary-700 hover:text-white inline-block px-6 py-2 text-black">Tambah ke Keranjang</button> 
                  </div>
                </div>
              </div>
        </form>
        
      </section>