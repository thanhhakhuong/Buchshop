<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buchshop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>
    <div id="app">
        <h1 class="text-center pt-3">Mein Buchshop Gruppe 16</h1>
        <p class="text-center">{{ timestamp }}</p>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- SUCHEN -->
                    <div class="d-flex w-100">
                        <input type="text" class="form-control" v-model="search" placeholder="Buchtitle"/>
                        <button type="button" class="btn btn-dark ml-1" @click=filter()>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg></button>
                    </div>
                    <!-- KATALOG -->
                    <table class="table table-hover mt-3">
                        <thead class="thead-light">
                            <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Preis</th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(product, index) in filteredProducts">
                            <th>{{ product.title }}</th>
                            <td>{{ product.autor }}</td>
                            <td>{{ product.PreisBrutto }}€</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#buchModal" @click=details(index)>
                                    Details
                                </button>
                                <button class="btn btn-sm btn-warning" @click=order(index)>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z"/>
                                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                                    </svg>
                                </button>
                            </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <!-- GALLERIE -->
                    <!--
                        <div class="d-flex flex-wrap align-content-start p-1">
                        <div class="card m-1" style="width: 30%; min-width:150px; max-height: 400px;" v-for="(product, index) in filteredProducts">
                            <img class="card-img-top" style="height:250px;" :src="product.LinkGrafikdatei">
                            <div class="card-body">
                                <p class="card-title">{{ product.title }}</p>
                                <p class="card-text">{{ product.autor }}</p>
                                <div class="mw-100 d-flex">
                                    <button type="button" class="btn btn-sm btn-light w-75" data-toggle="modal" data-target="#buchModal" @click=details(index)> Details </button>
                                    <button class="btn btn-sm btn-warning w-25" @click=order(index)>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z"/>
                                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                                    </svg>
                                </button>
                                </div>
                                
                            </div>
                        </div>
                        </div> 
                    -->

                </div>

                <!-- WARENKORB -->
                <div class="col-md-4">
                    <div class="card bg-light p-3">
                        <h3> Warenkorb </h3>
                            <ul class="ml-0 pl-0" v-for="(product, index) in cart.products">
                                <li class="d-flex justify-content-between align-items-center ml-0">{{ product.title }}
                                    <span>
                                        <span class="badge badge-secondary">{{ product.quantity }}</span>
                                        <span type="button" class="badge badge-secondary" @click=increase(index)>+</span>
                                        <span type="button" class="badge badge-secondary" @click=decrease(index)>-</span>
                                    </span>
                                </li>
                            </ul>
                            <h6> Gesamtpreis {{ cart.gesamtpreis }}€ </h6>
                            <h6> Gesamtanzahl {{ cart.gesamtanzahl }} </h6>
                            <form action="checkout.php" method="post">
                                <span v-for="product in cart.products">
                                    <input type="hidden" class="h-0" name="name[]" v-bind:value="product.title">
                                    <input type="hidden" class="h-0" name="quantity[]" v-bind:value="product.quantity">
                                    <input type="hidden" class="h-0" name="amount[]" v-bind:value="product.PreisBrutto">
                                </span>
                                <button type="submit" class="btn btn-warning btn-block">Bezahlen</button>   
                            </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- DETAILS -->
        <div class="modal fade" id="buchModal" tabindex="-1" aria-labelledby="buchModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="buchModalLabel">{{selectedProduct.title}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <img class="rounded mx-auto mb-3 d-block" style="height:200px;" :src="selectedProduct.LinkGrafikdatei" >                
                <table class="table table-hover">
                <tbody>
                    <tr><th scope="row">Title</th><td>{{selectedProduct.title}}</td></tr>
                    <tr><th scope="row">Autor</th><td>{{selectedProduct.autor}}</td></tr>
                    <tr><th scope="row">Verlag</th><td>{{selectedProduct.Verlagsname}}</td></tr>
                    <tr><th scope="row">Bruttopreis</th><td>{{selectedProduct.PreisBrutto}}</td></tr>
                    <tr><th scope="row">Lagerbestand</th><td>{{selectedProduct.Lagerbestand}}</td></tr>
                    <tr><th scope="row">Kurzinhalt</th><td>{{selectedProduct.Kurzinhalt}}</td></tr>
                </tbody>
                </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
                </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <!-- <script src="main.js"></script> -->
    <?php require('main.php')?>
</body>
</html>