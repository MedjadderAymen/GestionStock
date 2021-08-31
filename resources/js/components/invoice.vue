<template>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-lg-6 col-sm-12">
                <label for="provider" class="form-control-label">Fourniseur</label>
                <input class="form-control" type="text" placeholder="Fourniseur" name="provider" v-model="provider"
                       id="provider" required>
            </div>
            <div class="form-group col-lg-6 col-sm-12">
                <label for="serial_number" class="form-control-label">Numéro Facture</label>
                <input class="form-control" type="text" placeholder="Numéro Facture" v-model="serial_number"
                       name="serial_number"
                       id="serial_number" required>
            </div>
        </div>
        <hr class="my-1"/>
        <h6 class="heading-small text-muted mb-4">Ajouter list des toners</h6>
        <div class="row" v-for="toner in toners_list">
            <div class="form-group col-lg-6 col-sm-12">
                <label class="form-control-label">Référence</label>
                <input class="form-control" type="text" placeholder="Numéro Facture" name="serial_number"
                       :value="toner.reference" disabled>
            </div>
            <div class="form-group col-lg-4 col-sm-12">
                <label class="form-control-label">prix</label>
                <input class="form-control" type="text" placeholder="prix" name="provider" :value="toner.price"
                       disabled>
            </div>
            <div class="form-group col-lg-2 col-sm-12">
                <label class="form-control-label">Quantité</label>
                <input class="form-control" type="text" placeholder="Quantité" name="provider" :value="toner.quantity"
                       disabled>
            </div>
            <hr class="my-1"/>
        </div>
        <div class="row">
            <div class="form-group col-lg-6 col-sm-12">
                <label for="toner_name" class="form-control-label">Référence toner</label>
                <select v-model="toner" class="form-control" id="toner_name" required>
                    <option v-for="toner in toners" :value="toner">{{ toner.reference }} - {{toner.color}}</option>
                </select>
            </div>
            <div class="form-group col-lg-3 col-sm-12">
                <label for="toner_price" class="form-control-label">prix</label>
                <input v-model="toner_price" class="form-control" type="text" placeholder="prix" name="price"
                       id="toner_price" required>
            </div>
            <div class="form-group col-lg-2 col-sm-12">
                <label for="toner_quantity" class="form-control-label">Quantité</label>
                <input v-model="toner_quantity" class="form-control" type="text" placeholder="Quantité" name="quantity"
                       id="toner_quantity" required>
            </div>
            <div class="form-group col-lg-1 col-sm-12">
                <label class="form-control-label">Ajouter</label>
                <a v-on:click="addToner" class="btn btn-block btn-neutral"><i class="fas fa-plus"></i> </a>
            </div>
            <hr class="my-1"/>
        </div>
        <hr class="my-1"/>
        <h6 class="heading-small text-muted mb-4">Ajouter list des produit</h6>
        <div class="row" v-for="product in products">
            <div class="form-group col-lg-6 col-sm-12">
                <label class="form-control-label">Produit</label>
                <input class="form-control" type="text" placeholder="Numéro Facture" name="serial_number"
                       :value="product.material" disabled>
            </div>
            <div class="form-group col-lg-4 col-sm-12">
                <label class="form-control-label">prix</label>
                <input class="form-control" type="text" placeholder="prix" name="provider" :value="product.price"
                       disabled>
            </div>
            <div class="form-group col-lg-2 col-sm-12">
                <label class="form-control-label">Quantité</label>
                <input class="form-control" type="text" placeholder="Quantité" name="provider" :value="product.quantity"
                       disabled>
            </div>
            <hr class="my-1"/>
        </div>
        <div class="row">
            <div class="form-group col-lg-6 col-sm-12">
                <label for="Produit" class="form-control-label">Nouveau produit</label>
                <select v-model="material" class="form-control" id="Produit" required>
                    <option v-for="material in materials" :value="material">{{ material.material }}</option>
                </select>
            </div>
            <div class="form-group col-lg-3 col-sm-12">
                <label for="prix" class="form-control-label">prix</label>
                <input v-model="price" class="form-control" type="text" placeholder="prix" name="price"
                       id="prix" required>
            </div>
            <div class="form-group col-lg-2 col-sm-12">
                <label for="Quantité" class="form-control-label">Quantité</label>
                <input v-model="quantity" class="form-control" type="text" placeholder="Quantité" name="quantity"
                       id="Quantité" required>
            </div>
            <div class="form-group col-lg-1 col-sm-12">
                <label class="form-control-label">Ajouter</label>
                <a v-on:click="addItem" class="btn btn-block btn-neutral"><i class="fas fa-plus"></i> </a>
            </div>
            <hr class="my-1"/>
        </div>
        <a v-on:click="addInvoice" class="btn btn-neutral">Ajouter facture</a>
    </div>

</template>

<script type="text/javascript">

export default {
    name: "invoice",
    props: {
        csrf_token: String,
        materials: Array,
        toners: Array,
    },
    data() {
        return {
            material: {
                id: 0,
                material: ""
            },
            price: 0,
            quantity: 0,
            products: [],

            toner: {
                id: 0,
                reference: "",
                color:""
            },
            toner_price: 0,
            toner_quantity: 0,
            toners_list: [],

            provider: "",
            serial_number: ""
        }
    },
    methods: {
        addToner(e) {
            e.preventDefault();

            if (this.toner.reference === "" ||  this.toner_quantity === 0 || this.toner_price === 0) {

                alert("Vérifier les champs pour ajouter toner")

            } else {

                const toner = {
                    id: this.toner.id,
                    reference: this.toner.reference+ " - " +this.toner.color,
                    price: this.toner_price,
                    quantity: this.toner_quantity,
                }

                this.toners_list = [...this.toners_list, toner]

                this.toner = {
                    id: 0,
                    reference: ""
                }
                this.toner_price = 0
                this.toner_quantity = 0

            }

        },
        addItem(e) {
            e.preventDefault();

            if (this.material.material === "" || this.quantity === 0 || this.price === 0) {

                alert("Vérifier les champs")

            } else {
                const product = {
                    id: this.material.id,
                    material: this.material.material,
                    price: this.price,
                    quantity: this.quantity
                }

                this.products = [...this.products, product]

                this.material = {
                    id: 0,
                    material: ""
                }
                this.price = 0
                this.quantity = 0
            }
        },
        async addInvoice() {

            if (this.provider === "" || this.serial_number === "") {

                alert("remplir la facture");

            } else {
                if (this.products.length === 0 && this.toners_list.length === 0) {
                    alert("facture vide")
                } else {
                    window.axios = require('axios');

                    // For adding the token to axios header (add this only one time).
                    window.axios.defaults.headers.common = {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': this.csrf_token
                    };

                    await axios.(
                        '/invoice',
                        {
                            products: this.products,
                            toners_list: this.toners_list,
                            provider: this.provider,
                            serial_number: this.serial_number
                        },
                    ).then(res => this.success(res))
                        .catch(err => alert(err.message))
                }
            }

        },
        success(response) {
            window.location = response.data.redirect;
        }
    }
}
</script>

<style scoped>

</style>
