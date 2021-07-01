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
                    <option v-for="material in materials">{{ material.material }}</option>
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
    },
    data() {
        return {
            material: "",
            price: 0,
            quantity: 0,
            products: [],
            provider: "",
            serial_number: ""
        }
    },
    methods: {
        addItem(e) {
            e.preventDefault();

            if (this.material === "" || this.quantity === 0 || this.price === 0) {

                alert("Vérifier les champs")

            } else {
                const product = {
                    material: this.material,
                    price: this.price,
                    quantity: this.quantity
                }

                this.products = [...this.products, product]

                this.material = ''
                this.price = 0
                this.quantity = 0
            }
        },
        async addInvoice() {
            window.axios = require('axios');

            // For adding the token to axios header (add this only one time).
            window.axios.defaults.headers.common = {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': this.csrf_token
            };

            await axios.post(
                '/invoice',
                {
                    products: this.products,
                    provider: this.provider,
                    serial_number: this.serial_number
                },
            ).then(res => console.log(res.data))
                .catch(err => console.log(err))
        },
    }
}
</script>

<style scoped>

</style>
