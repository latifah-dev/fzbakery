<script>
	Alpine.data('keranjang', () => ({
	url: window.location.href.split('/'),
	totalAkhir:0,
	transaksi: {
		totalPrice:'',
		paymentMethod:'',
		shipingPrice:'',
		MessageForTim:'',
	},
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
  hapus: (id) => {
        console.log(id);
        const respon = fetch(`https://friendzone-bakery.fly.dev/api/itemtransaksi/${id}/delete`,{
            method: 'POST',
        })
        .then( (response) => {
            location.reload();
        });
	},
	checkout() {
	const idtrans = this.url[this.url.length-1]
    const data = new FormData()
      data.append('totalPrice', this.totalAkhir)
      data.append('paymentMethod', this.transaksi.paymentMethod)
      data.append('shipingPrice', this.transaksi.shipingPrice)
      data.append('MessageForTim', this.transaksi.MessageForTim)
	  data.append('status', "menunggu pembayaran")
      const edit = fetch(`https://friendzone-bakery.fly.dev/api/transaksi/${idtrans}/edit`, {
		method: 'POST',
        body: data
            });
			window.location.replace(`http://127.0.0.1:3000/upload/${idtrans}`)
    }
}));
</script>
<div x-data="keranjang" x-init="fetchitem()" class="bg-black">
	<div class="py-12">
    <div class="max-w-md mx-auto bg-gray-100 shadow-lg rounded-lg  md:max-w-5xl">
        <div class="md:flex ">
            <div class="w-full p-4 px-5 py-5">
            	<div class="md:grid md:grid-cols-3 gap-2 ">
            		<div class="col-span-2 p-5">
            			<h1 class="text-xl font-medium">Shopping Cart</h1>
					<template x-for="cartitem in cart">
            			<div class="flex justify-between items-center mt-6 pt-6">
            				<div class="flex  items-center">
            					<img :src="'https://friendzone-bakery.fly.dev/storage/images/'+cartitem.product.image" width="60" class="rounded-full ">
            					<div class="flex flex-col ml-3">
            						<span x-text="cartitem.product.nameProduct" class="md:text-md font-medium">Chicken momo</span>
            						<span x-text="cartitem.product.size" class="text-xs font-light text-gray-400">#41551</span>
            					</div>
            				</div>
            				<div class="flex justify-center items-center">
            					
            					<div class="pr-8 flex ">
            						<span class="font-semibold">-</span>
            						<input x-model="cartitem.itemTransaction.qty" type="text" class="focus:outline-none bg-gray-100 border h-6 w-8 rounded text-sm px-2 mx-2" :value="cartitem.qty">
            						<span class="font-semibold">+</span>
            					</div>

            					<div class="pr-8 ">
            						
            						<span x-text="cartitem.itemTransaction.subTotal" class="text-xs font-medium">$10.50</span>
            					</div>
								<div>
									<button class="text-xs font-medium text-red-500" @click="hapus(cartitem.itemTransaction.id)">Hapus</button>
								  </div>
            				</div>
            				
            			</div>
						</template>

            			<div class="flex justify-between items-center mt-6 pt-6 border-t"> 
            				<div class="flex items-center">
            					<i class="fa fa-arrow-left text-sm pr-2"></i>
            					<a href="{{route('displayproduct')}}" class="text-md  font-medium text-blue-500">Continue Shopping</a>
            				</div>
            				<div class="flex justify-center items-end">
            					<span class="text-sm font-medium text-gray-400 mr-1">Subtotal:</span>
            					<span x-text="totalAkhir" class="text-lg font-bold text-gray-800 "> $24.90</span>
            					
            				</div>
            				
            			</div>            			
            		</div>
					<form x-on:submit.prevent="checkout()">
						<div class="p-5 bg-gray-800 rounded overflow-visible">
						  <span class="text-xl font-medium text-gray-100 block pb-3">Detail Transaksi</span>
					  
						  <div class="flex justify-center flex-col pt-3">
							<label class="text-xs text-gray-400">Metode Pembayaran</label>
							<div class="relative rounded-md shadow-sm">
							  <select x-model="transaksi.paymentMethod" class="form-input py-3 px-4 block w-full leading-5 rounded-md transition duration-150 ease-in-out sm:text-sm sm:leading-5">
								<option value=""></option>
								<option value="credit_card">Credit Card</option>
								<option value="debit_card">Debit Card</option>
								<option value="bank_transfer">Bank Transfer</option>
								<option value="e-wallet">E-wallet</option>
							  </select>
							</div>
						  </div>
					  
						  <div class="flex justify-center flex-col pt-3">
							<label class="text-xs text-gray-400">Biaya Kirim</label>
							<div class="relative rounded-md shadow-sm">
							  <select x-model="transaksi.shipingPrice" class="form-input py-3 px-4 block w-full leading-5 rounded-md transition duration-150 ease-in-out sm:text-sm sm:leading-5">
								<option value=""></option>
								<option value="0">Free</option>
								<option value="25000">Standard</option>
								<option value="50000">Express</option>
							  </select>
							</div>
						  </div>
						  <div class="flex justify-center flex-col pt-3">
							<label class="text-xs text-gray-400">Pesan untuk Tim</label>
							<textarea  x-model="transaksi.MessageForTim" name="" id="" cols="30" rows="4" class="focus:outline-none w-full bg-gray-800 text-white placeholder-gray-300 text-sm border-b border-gray-600 py-4"></textarea>
						  </div>
					  
						  <div class="grid grid-cols-3 gap-2 pt-2 mb-3"></div>
						  <button type="submit" class="h-12 w-full bg-blue-500 rounded focus:outline-none text-white hover:bg-blue-600">Check Out</button>
						</div>
					  </form>
				</div>
           </div>
        </div>
    </div>
    </div>
</div>