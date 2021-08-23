<template>
    <div class="table-responsive">
        <table id="stocks" class="table align-items-center table-flush text-center">
            <thead class="thead-light">
            <tr>
                <th scope="col" class="sort" data-sort="name">Désignation <a v-on:click="sortBy('designation')"><i
                    class="fas fa-sort"></i></a></th>
                <th scope="col" class="sort" data-sort="budget">Emplacement <a v-on:click="sortBy('site')"><i
                    class="fas fa-sort"></i></a></th>
                <th scope="col" class="sort" data-sort="status">Adresse IP</th>
                <th scope="col" class="sort" data-sort="status">Date Affectation</th>
                <th scope="col"></th>
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
                    {{ printer.ip }}
                </td>
                <td class="budget">
                    {{ printer.affectation }}
                </td>
                <td class="text-right">
                    <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" v-on:click="show(printer.id)" role="button">
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
        printers: Array
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
        success(response) {
            window.location = response.data.redirect;
        }
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
