<script>
var app = new Vue({
    el: "#app",
    data: {
		products: [],
		timestamp : "",
		search: "",
		filteredProducts: [],
		cart: {
			products: [],
			gesamtanzahl: 0,
			gesamtpreis: 0
		},
		selectedProduct: [],
		checkoutCart: {
            amount: '',
            quantity: '',
			currency: 'eur',
			name: 'Bookshop Gruppe 16'
        }
    },
    methods: {
		now(){
			const today = new Date();
			const date = today.getDate()
							+ '.'+(today.getMonth()+1)
							+ '.'+today.getFullYear();
			const time = today.getHours() 
							+ ":" + today.getMinutes()
							+ ":" + today.getSeconds();
			const dateTime = date +' '+ time;
			this.timestamp  = dateTime;
		},
		fetchData(){
			fetch("buecher.json")
			.then(response => response.json())
			.then((data) => {
			  this.products = data;
			  this.filteredProducts = this.products;
			})
		},
		filter() {
			console.log(this.search);
			this.filteredProducts = this.products.filter(book => {
				return book.title.toLowerCase().includes(this.search.toLowerCase())
			});
			console.log(this.filteredProducts);
		},
		details(index) {
			this.selectedProduct = this.products[index];
			console.log(this.selectedProduct);
		},
		order(index){
			console.log("ORDER " + index + " " + this.products[index].title);
			if (this.cart["products"].includes(this.products[index])) {
				this.products[index].quantity++
			}
			else {
				this.products[index].quantity = 1;
				this.cart["products"].push(this.products[index]);
			}
			this.cart.gesamtanzahl++;
			this.cart.gesamtpreis+= parseFloat(this.products[index].PreisBrutto);
		},
        reset(index){
			this.products[index].quantity = 0;
		},
		decrease(index){
			console.log("DECREASE CART " + index + ' ' + this.cart.products[index].title);
			if (this.cart.products[index].quantity > 0) {
				this.cart.products[index].quantity--;
				this.cart.gesamtanzahl--;
				this.cart.gesamtpreis-= parseFloat(this.cart.products[index].PreisBrutto);
			}
		},
		increase(index){
			console.log("DECREASE CART " + index + ' ' + this.cart.products[index].title);
			this.cart.products[index].quantity++;
			this.cart.gesamtanzahl++;
			this.cart.gesamtpreis+= parseFloat(this.cart.products[index].PreisBrutto);
		},
		/*
		checkout() {
			this.checkoutCart.amount = this.cart.gesamtpreis;
			this.checkoutCart.quantity = this.cart.gesamtanzahl;
			console.log("CHECKOUT " + this.checkoutCart.amount + "€ " + this.checkoutCart.quantity);
			
			axios.post('checkout.php', this.checkoutCart)
			.then(response => {
				console.log(response.data);
			})
			.catch(error => {
				console.log(error);
			});
			window.location = "checkout.php";
			}
		*/
	},
	created () {
		setInterval(this.now, 1000);
	},
	mounted () {
		this.fetchData();
	},
});

</script>

