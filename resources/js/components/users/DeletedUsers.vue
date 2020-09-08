<template>
<v-layout row justify-center v-if="dialog">
    <v-dialog v-model="dialog" persistent max-width="1200px">
        <v-card>
            <v-card-title>
                Users

                <v-spacer></v-spacer>
                </v-card-title>
            <vue-good-table class="table-hover" :columns="columns" :rows="AllDelusers" :search-options="{ enabled: true }" :pagination-options="{enabled: true,mode: 'pages'}" v-loading="isLoading">
                <template slot="table-row" slot-scope="props">
                    <span v-if="props.column.field == 'created_at'">
                        <span>
                            <el-tag type="success">{{props.row.created_at}}</el-tag>
                        </span>
                    </span>
                    <span v-else-if="props.column.field == 'actions'">
                        <v-tooltip bottom>
                            <v-btn icon class="mx-0" @click="refresh(props.row)" slot="activator">
                                <v-icon small color="blue darken-2">refresh</v-icon>
                            </v-btn>
                            <span>Restore {{ props.row.name }}</span>
                        </v-tooltip>
                        <v-tooltip bottom>
                            <v-btn icon class="mx-0" @click="delete_user(props.row)" slot="activator">
                                <v-icon small color="pink darken-2">delete</v-icon>
                            </v-btn>
                            <span>permanently delete {{ props.row.name }}</span>
                        </v-tooltip>
                    </span>
                    <span v-else>
                        {{props.formattedRow[props.column.field]}}
                    </span>
                </template>
            </vue-good-table>

            <v-btn text @click="close">Close</v-btn>
        </v-card>
    </v-dialog>
</v-layout>
</template>

<script>
export default {
    data() {
        return {
            dialog: false,
            AllDelusers: [],
            loading: false,
            search: '',
            columns: [{
                    label: 'Id#',
                    field: 'id',
                    type: 'number',
                },
                {
                    label: 'User name',
                    field: 'name',
                },
                {
                    label: 'User Email',
                    field: 'email',
                },
                {
                    label: 'Phone Number',
                    field: 'phone',
                },
                {
                    label: 'Address',
                    field: 'address',
                },
                {
                    label: 'Status',
                    field: 'status',
                },
                {
                    label: 'Created On',
                    field: 'created_at',
                    type: 'date',
                    dateInputFormat: 'YYYY-MM-DD',
                    dateOutputFormat: 'MMM Do YYYY',
                },
                {
                    label: 'Actions',
                    field: 'actions',
                },
            ],
            json_fields: {
                Name: "name",
                Email: "email",
                Phone: "phone",
                City: "city",
                Address: "address",
                Country: "country"
            },
        };
    },
    methods: {
        refresh(item) {
            this.loading = true;
            axios.patch(`/undeletedUser/${item.id}`)
                .then(response => {
                    this.loading = false;
                    this.deletedUsers()
                    eventBus.$emit("alertRequest", "Successifully reactivated");
                    eventBus.$emit("userEvent", "Successifully reactivated");
                })
                .catch(error => {
                    this.loading = false;
                    this.errors = error.response.data.errors;
                });
        },
        deletedUsers() {
            this.loading = true;
            axios
                .get("/deletedUsers")
                .then(response => {
                    this.loading = false;
                    this.AllDelusers = response.data;
                })
                .catch(error => {
                    this.loading = false;
                    this.errors = error.response.data.errors;
                });
        },

        delete_user(item) {
            this.$confirm('This will permanently delete ' + item.name +'. Continue?', 'Warning', {
                confirmButtonText: 'OK',
                cancelButtonText: 'Cancel',
                type: 'warning',
                center: true
            }).then(() => {
                axios.delete(`/delete_user/${item.id}`)
                    .then((response) => {
                        this.$message({
                            type: 'success',
                            message: item.name + 'Deleted'
                        });
                        this.deletedUsers()
                    }).catch((error) => {
                        this.$message({
                            type: 'error',
                            message: 'Something went wrong'
                        });
                    })
            }).catch(() => {
                this.$message({
                    type: 'error',
                    message: 'Delete canceled'
                });
            });
        },
        close() {
            this.dialog = false;
        }
    },
    created() {
        eventBus.$on('openDeletedEvent', data => {
            this.dialog = true
            this.deletedUsers()
        })
    },

    computed: {
        isLoading() {
            return this.$store.getters.loading;
        },
    },
};
</script>
