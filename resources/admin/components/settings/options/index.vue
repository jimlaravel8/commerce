<template>
<v-content>
    <v-container fluid fill-height>
        <v-layout justify-center align-center wrap>
            <v-flex sm12>
                <v-card style="padding: 20px 0;">
                    <el-breadcrumb separator-class="el-icon-arrow-right">
                        <el-breadcrumb-item :to="{ path: '/' }">Dashboard</el-breadcrumb-item>
                        <el-breadcrumb-item>Options</el-breadcrumb-item>
                    </el-breadcrumb>
                </v-card>
            </v-flex>
            <v-flex sm12>
                <!-- <myFilter :form="form" :user="user" style></myFilter> -->
            </v-flex>
            <v-flex sm12>
                <v-card style="padding: 10px 0;">
                    <v-layout row>
                        <v-flex sm1 style="margin-left: 10px;">
                            <v-tooltip right>
                                <template v-slot:activator="{ on }">
                                    <v-btn icon v-on="on" slot="activator" class="mx-0" @click="getOptions">
                                        <v-icon color="blue darken-2" small>refresh</v-icon>
                                    </v-btn>
                                </template>
                                <span>Refresh</span>
                            </v-tooltip>
                        </v-flex>
                        <v-flex sm2>
                            <h3 style="margin-left: 30px !important;margin-top: 10px;">Options</h3>
                        </v-flex>
                        <v-flex offset-sm8 sm2>
                            <v-btn color="info" @click="openCreate" text>Create Option</v-btn>
                        </v-flex>
                    </v-layout>
                </v-card>
            </v-flex>
            <v-flex sm12>
                <vue-good-table class="table-hover" :columns="columns" :rows="options" :search-options="{ enabled: true }" :pagination-options="{enabled: true,mode: 'pages'}" v-loading="isLoading" :sort-options="{enabled: true, initialSortBy: {field: 'id', type: 'asc'}}">
                    <template slot="table-row" slot-scope="props">
                        <span v-if="props.column.field == 'created_at'">
                            <span>
                                <el-tag type="success">{{props.formattedRow.created_at}}</el-tag>
                            </span>
                        </span>
                        <span v-else-if="props.column.field == 'actions'">
                            <v-tooltip bottom>
                                <template v-slot:activator="{ on }">
                                    <v-btn v-on="on" icon class="mx-0" @click="openEdit(props.row)" slot="activator">
                                        <v-icon small color="blue darken-2">edit</v-icon>
                                    </v-btn>
                                </template>
                                <span>Edit {{ props.row.name }}</span>
                            </v-tooltip>
                            <v-tooltip bottom>
                                <template v-slot:activator="{ on }">
                                    <v-btn icon v-on="on" class="mx-0" @click="confirm_delete(props.row)" slot="activator">
                                        <v-icon small color="pink darken-2">delete</v-icon>
                                    </v-btn>
                                </template>
                                <span>Delete {{ props.row.name }}</span>
                            </v-tooltip>
                        </span>
                        <span v-else>{{ props.formattedRow[props.column.field] }}</span>
                    </template>
                </vue-good-table>
            </v-flex>
        </v-layout>
    </v-container>
    <Create></Create>
    <Edit></Edit>
</v-content>
</template>

<script>
import Create from "./create";
import Edit from "./edit";

export default {
    props: ['user'],
    components: {
        Create,
        Edit,
    },
    data() {
        return {
            form: {},
            loader: false,
            search: "",
            option_det: {
                data: []
            },
            option_search: [],
            temp: "",
            checkedRows: [],
            columns: [{
                    label: "Id#",
                    field: "id",
                    type: "number"
                },
                {
                    label: "Option",
                    field: "option_name"
                },
                {
                    label: "Created On",
                    field: "created_at",
                    // type: "date",
                    // dateInputFormat: "YYYY-MM-DD",
                    // dateOutputFormat: "Do MMMM YYYY"
                },
                {
                    label: "Actions",
                    field: "actions",
                    sortable: false
                }
            ]
        };
    },
    methods: {
        openCreate() {
            eventBus.$emit("openCreateOption");

        },
        openEdit(data) {
            eventBus.$emit("openEditOption", data);
        },

        confirm_delete(item) {
            this.$confirm('This will permanently delete the file. Continue?', 'Warning', {
                confirmButtonText: 'OK',
                cancelButtonText: 'Cancel',
                type: 'warning'
            }).then(() => {
                this.deleteItem(item)
            }).catch(() => {
                this.$message({
                    type: 'error',
                    message: 'Delete canceled'
                });
            });
        },

        deleteItem(item) {
            this.$store.dispatch("deleteItem", "option/" + item.id).then(response => {
                this.$message({
                    type: 'success',
                    message: 'Delete completed'
                });
                this.getOptions();
            });
        },
        openShow(data) {
            eventBus.$emit("openShowOption", data);
        },
        getOptions() {

            var payload = {
                model: 'product_options',
                update: 'updateOptionsList'
            }
            this.$store.dispatch("getItems", payload);
        },
        updateSelected(url) {
            // alert('test')
            if (this.checkedRows.length < 1) {
                eventBus.$emit("errorEvent", "Please select atleast one row");
                return;
            }

            this.$store
                .dispatch("updateSelected", {
                    url,
                    checked: this.checkedRows
                })
                .then(response => {
                    eventBus.$emit("alertRequest", "Updated");
                    this.checkedRows = [];
                    this.getOptions();
                });
        },
        selectionChanged(params) {
            this.checkedRows = params.selectedRows;
        },

        next_page(path, page) {
            var payload = {
                path: path,
                page: page,
                update: 'updateOptionsList'
            }
            this.$store.dispatch("nextPage", payload);
        },
    },
    computed: {
        options() {
            return this.$store.getters.options;
        },
        isLoading() {
            return this.$store.getters.loading;
        }
    },
    mounted() {
        // this.$store.dispatch('getOptions');
        eventBus.$emit("LoadingEvent");
        this.getOptions();
    },
    created() {
        eventBus.$on("optionEvent", data => {
            this.getOptions();
        });

        eventBus.$on("responseChooseEvent", data => {
            console.log(data);
            if (data == "Excel") {
                eventBus.$emit("openEditOption");
            } else {
                eventBus.$emit("openCreateOption");
            }
        });
    },

    //   beforeRouteEnter(to, from, next) {
    //     next(vm => {
    //       if (vm.user.can["view option"]) {
    //         next();
    //       } else {
    //         next("/");
    //       }
    //     });
    //   }
};
</script>

<style scoped>
.el-input--prefix .el-input__inner {
    border-radius: 50px !important;
}

.v-toolbar__content,
.v-toolbar__extension {
    height: auto !important;
}

.v-avatar {
    height: 10px !important;
    width: 10px !important;
    margin-left: 40% !important;
}
</style>
