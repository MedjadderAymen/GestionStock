<template>
    <div class="table-responsive">
        <table id="stocks" class="table align-items-center table-flush text-center">
            <thead class="thead-light">
            <tr>
                <th scope="col" class="sort" data-sort="name">Désignation <a v-on:click="sortBy('designation')"><i
                    class="fas fa-sort"></i></a></th>
                <th scope="col" class="sort" data-sort="budget">Emplacement <a v-on:click="sortBy('site')"><i
                    class="fas fa-sort"></i></a></th>
                <th scope="col" class="sort" data-sort="status">Adresse IP<a v-on:click="sortBy('ip')"><i
                    class="fas fa-sort"></i></a></th>
                <th scope="col" class="sort" data-sort="status">Date Affectation</th>
                <th v-if="role==='help desk'" scope="col">Modifier</th>
                <th v-if="role==='help desk'" scope="col">Supprimer</th>
                <th scope="col">Gérer</th>
            </tr>
            </thead>
            <tbody class="list">
            <tr v-for="printer in printers_list" :key="printer.id">
                <th scope="row">
                    <div class="media align-items-center">
                        <div class="media-body">
                            <span class="name mb-0 text-sm">{{ printer.designation }}</span>
                        </div>
                    </div>
                </th>
                <td class="budget">
                    {{ printer.site }}
                </td>
                <td class="budget">
                    <i v-on:click="visitPrinter(printer.ip)">
                        {{ printer.ip }}
                    </i>
                </td>
                <td class="budget">
                    {{ printer.affectation }}
                </td>
                <td v-if="role==='help desk'" class="">
                    <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" v-on:click="edit(printer.id)"
                           role="button">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                </td>
                <td v-if="role==='help desk'" class="">
                    <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" v-on:click="destroy(printer.id)"
                           role="button">
                            <i class="ni ni-scissors"></i>
                        </a>
                    </div>
                </td>
                <td class="">
                    <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" v-on:click="show(printer.id)"
                           role="button">
                            <i class="fas fa-arrow-alt-circle-right"></i>
                        </a>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>

export default {
    name: "printers",
    props: {
        csrf_token: String,
        printers: Array,
        role: String,
    },
    data() {
        return {
            printers_list: this.printers,
        }
    },
    methods: {
        sortBy(prop) {
            this.printers_list.sort((a, b) => (a[prop] < b[prop] ? -1 : 1));
        },
        async show(id) {

            window.axios = require('axios');

            // For adding the token to axios header (add this only one time).
            window.axios.defaults.headers.common = {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': this.csrf_token
            };

            await axios.get(
                `/printer/showRedirect/${id}`,
            ).then(res => this.success(res))
                .catch(err => alert(err.message))

        },
        async edit(id) {

            window.axios = require('axios');

            // For adding the token to axios header (add this only one time).
            window.axios.defaults.headers.common = {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': this.csrf_token
            };

            await axios.get(
                `/printer/${id}/edit`,
            ).then(res => this.success(res))
                .catch(err => alert(err.message))

        },
        async destroy(id) {

            if (confirm("Êtes-vous sûr ?")) {

                window.axios = require('axios');

                // For adding the token to axios header (add this only one time).
                window.axios.defaults.headers.common = {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': this.csrf_token
                };

                await axios.delete(
                    `/printer/${id}`,
                ).then(res => this.success(res))
                    .catch(err => alert(err.message))

            }

        },
        async visitPrinter(url) {

            if (confirm("Êtes-vous sûr ?")) {

                window.open(`http://${url}`, '_blank');

            }
        },
        success(response) {
            window.location = response.data.redirect;
        },
    },
}
</script>

<style scoped>

i {
    cursor: pointer;
}

i:hover {
    color: #ea637c;
}

</style>
