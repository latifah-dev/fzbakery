<script>
	Alpine.data('keranjang', () => ({
	url: window.location.href.split('/'),
	totalAkhir:0,
	transaksi: {
		buktiPembayaran:'',
        status:'',
	},
    files:'',
    cart:[],
  		fetchitem() {
    		const id = this.url[this.url.length-1]
            const data = new FormData()
            const respon = fetch(`https://friendzone-bakery.fly.dev/api/transaksi/${id}`)
            .then(response => response.json())
            .then(data => {
            let cart = this.cart = data.data;
			this.totalAkhir = this.cart.reduce((total, item) => total + item.itemTransaction.subTotal, 0)
        })
  	},
	uploadBukti() {
	const idtrans = this.url[this.url.length-1]
    let photo = this.files[0]
    const data = new FormData()
    data.append('photo', photo)
    data.append('status', "Terbayar")
      const edit = fetch(`https://friendzone-bakery.fly.dev/api/transaksi/${idtrans}/edit`, {
		method: 'POST',
        body: data
            });
            
			
    }
}));
</script>
{{-- x-data untuk memasukkan data agar dapat diolah --}}
<main x-data="keranjang" x-init="fetchitem()" class="poster">
<div x-data="auth" class="bg-opacity-95 bg-white max-w-3xl px-4 py-12 mb-8 rounded rounded-bl-lg shadow-xl sm:px-6 md:px-12 lg:w-8/12 xl:w-7/12">
    <header class="border-b border-opacity-20 border-secondary-600 mb-12 pb-4">
      <a href="#" class="font-bold font-serif hover:text-secondary-600 inline-flex items-center leading-none mr-auto text-secondary-500 text-xl uppercase">
      <img src="images/logo.png" alt="" width="75">
        <span>Berikut transaksi anda. terimakasih telah melakukan transaksi</span>
      </a>
    </header>
      <p class="mb-4 text-xl md:w-8/12">
        nominal transaksi sebesar : Rp. <span x-text="totalAkhir"></span> </p>
        <hr class="bg-secondary-700 mb-12 opacity-100 w-3/12 md:w-2/12">
      <p x-text="cart.status" class="mb-4 text-xl md:w-8/12"></p>
   
    <footer class="border-opacity-20 border-secondary-600 border-t mt-16 pt-6">Created by Friendzone Bakery for you!</footer>
</div>
</main>

