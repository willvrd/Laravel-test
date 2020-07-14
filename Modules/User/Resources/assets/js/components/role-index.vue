<template>
    <div class="container">

        <section v-if="loading"><loading></loading></section>

        <div v-if="success" class="row justify-content-center">

            <div class="col-md-9">

                <section>

                    <div class="card">
                        <div class="card-header text-uppercase font-weight-bold">{{title}}</div>

                        <div class="card-body">

                            <table v-if="data.length>0" class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th  v-for="(col, index) in columns" :key="index"
                                        scope="col"
                                        @click="changeOrderBy(col.name)"
                                        class="pointer"
                                        :class="{ active: params.filter.order.field == col.name }">
                                            {{col.title}}
                                            <span class="arrow" :class="sortOrders[col.name] > 0 ? 'asc' : 'dsc'">
                                            </span>
                                        </th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr  v-for="(item, index) in data" :key="index">
                                        <td>{{item.id}}</td>
                                        <td>{{item.name}}</td>
                                        <td>{{item.createdAt}}</td>
                                        <td>
                                            <button type="button"
                                                class="btn btn-outline-primary"
                                                @click="editForm(item)">
                                            Edit
                                            </button>
                                            <button type="button"
                                                class="btn btn-outline-danger"
                                                @click="deleteItem(item, index)">
                                            Delete
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Errors Table -->
                            <alert :alert="alertTable"></alert>

                        </div>

                        <div class="card-footer">

                            <!-- Pagination -->
                            <div v-if="pagination.total > 1" class="row">

                                <div class="col-12 col-sm-4">
                                    <div class="records-pages form-group row d-flex justify-content-center">
                                        <label for="selectRecordsPages" class="mx-2">Records per Page:</label>
                                        <select name="selectRecordsPages" v-model="selectedRecords" @change="changeRecordsPerPage()">
                                            <option  v-for="(num,index) in recordsPerPage" :key="index"
                                                :value="num"
                                                >
                                                {{num}}
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination d-flex justify-content-center">

                                            <!-- First -->
                                            <li class="page-item pointer" v-if="pagination.currentPage!=1">
                                                <a class="page-link" @click="changePage('first')" title="First Page">
                                                    <span aria-hidden="true">&laquo;</span>
                                                    <span class="sr-only">First</span>
                                                </a>
                                            </li>

                                            <!-- Back -->
                                            <li class="page-item pointer" v-if="pagination.currentPage != 1">
                                                <a class="page-link" @click="changePage('back')" title="Previous">
                                                    <span aria-hidden="true">Previous</span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                            </li>

                                            <!-- Next -->
                                            <li class="page-item pointer" v-if="pagination.currentPage < pagination.lastPage">
                                                <a class="page-link" v-on:click="changePage('next')" title="Next">
                                                    <span aria-hidden="true">Next</span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </li>

                                            <!-- Last -->
                                            <li class="page-item pointer" v-if="pagination.currentPage!=pagination.lastPage">
                                                <a class="page-link" v-on:click="changePage('last')" title="Last Page">
                                                    <span aria-hidden="true">&raquo;</span>
                                                    <span class="sr-only">Last</span>
                                                </a>
                                            </li>

                                        </ul>
                                    </nav>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="pagination-pages form-group row d-flex justify-content-center">
                                    <label for="selectCurrentPage" class="mx-2">Current Page:</label>
                                    <select name="selectCurrentPage" v-model="selectedPage" @change="changePage('page')">
                                        <option  v-for="(num,index) in pagination.lastPage" :key="index"
                                            :value="num"
                                            >
                                            {{num}}
                                        </option>
                                    </select>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </section>

            </div>

            <div class="col-md-3">

                <section class="forms">

                    <form @submit.prevent="updateItem(item)" v-if="modeUpdate">
                        <div class="card">
                            <div class="card-header text-uppercase font-weight-bold">Update Role</div>
                            <div class="card-body">
                                <label for="inputName">Name</label>
                                <input type="text" class="form-control mb-2"
                                    placeholder="Name" v-model="item.name">
                                <button class="btn btn-primary" type="submit">Update</button>
                                <button class="btn btn-danger" type="submit"
                                    @click="cancelUpdate">Cancel</button>
                            </div>
                        </div>
                    </form>

                    <form @submit.prevent="addItem" v-else>
                        <div class="card">
                            <div class="card-header text-uppercase font-weight-bold">Add Role</div>
                            <div class="card-body">
                                 <label for="inputName">Name</label>
                                <input type="text" class="form-control mb-2"
                                    placeholder="Name" v-model="item.name">
                                <button class="btn btn-primary" type="submit">Add</button>
                            </div>
                        </div>
                    </form>

                    <!-- Errors Form -->
                    <section v-if="Object.keys(errors).length>0" class="errorsForm">
                        <div v-for="(error, index) in errors" :key="index">
                            <alert :alert="{status:true,type:'alert-danger',text: error}"></alert>
                        </div>
                    </section>

                </section>

            </div>

        </div>

    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        title: String,
        path: String
    },
    mounted() {
        this.$nextTick(function () {
            this.init();
        })
    },
    data() {
        return {
            success: false,
            loading: true,
            errors: [],
            modeUpdate: false,
            data: [],
            alertTable:{
                status: false,
                type: 'alert-danger',
                text: 'Error - Sorry :('
            },
            item:{
                name: ''
            },
            params:{
                page: 1,
                filter:{
                    order:{
                        field:"id",
                        way:"asc"
                    }
                }
            },
            columns: [
                {title:"Id",name: "id"},
                {title:"Name",name: "name"},
                {title:"Created At",name: "created_at"}
            ],
            sortOrders: {},
            pagination:{},
            selectedPage: 1,
            recordsPerPage:[12,25,50,100],
            selectedRecords: 12
        }
    },
    methods:{

        init(){
            this.getData()
            this.setSortOrders()

            this.success = true
        },
        getData(){

            this.loading = true
            this.params.take = this.selectedRecords

            axios.get(this.path, {params:this.params})
            .then(response => {
                this.data = response.data.data;
                this.pagination = response.data.meta.page
                this.selectedPage = this.pagination.currentPage
            })
            .catch(error => {
                console.log(error)
                this.alertTable.status = true
            })
            .finally(() => this.loading = false)

        },
        addItem(){

            if(this.item.name.trim() === ''){
                alert('Debes completar todos los campos antes de guardar');
                return;
            }

            this.loading = true
            axios.post(this.path, {attributes:this.item})
            .then((response) =>{
                alert("Item Added :)")
                this.cleanValues()
                this.data.push(response.data.data);
            }).catch(error => {
                this.catchErrors(error)
                console.log(error)
            })
            .finally(() => this.loading = false)
        },
        editForm(item){
            this.item.id = item.id;
            this.item.name = item.name;
            this.modeUpdate = true;
        },
        updateItem(itemUp){

            let attributes = {
                attributes:{
                    name: itemUp.name
                }
            };

            this.loading = true
            axios.put(this.path+`/${itemUp.id}`,attributes)
            .then(response=>{
                this.modeUpdate = false;
                let index = this.data.findIndex(
                    item => item.id === itemUp.id
                );
                this.data[index] = response.data.data;
                this.cleanValues();
                alert("Item Updated :)")
            }).catch(error=>{
                this.catchErrors(error)
                console.log(error)
            })
            .finally(() => this.loading = false)

        },
        deleteItem(item,index){
            let resp = confirm(`Delete item:" ${item.name} " ?`);
            if(resp){
                this.loading = true
                axios.delete(this.path+`/${item.id}`)
                .then((response)=>{
                    this.data.splice(index, 1);
                    alert(response.data.data);
                }).catch(error=>{
                    alert("Error :(")
                    console.log(error)
                })
                .finally(() => this.loading = false)
            }
        },
        cancelUpdate(){
            this.modeUpdate = false;
            this.cleanValues()
        },
        cleanValues(){
            this.item = {
                name: ''
            };
            this.errors = []
        },
        catchErrors(error){
            if (error.response){
                this.errors = JSON.parse(error.response.data.errors);
            }
        },
        setSortOrders(){
            var sortOrders = {}
            this.columns.forEach(function (key) {
                sortOrders[key.name] = 1
            })
            this.sortOrders = sortOrders
        },
        changeOrderBy(field){

            this.params.filter.order.field = field

            if(this.params.filter.order.way=="asc")
                this.params.filter.order.way="desc"
            else
                this.params.filter.order.way="asc"

            this.sortOrders[field] = this.sortOrders[field] * -1

            this.getData()
        },
        changePage(type){

            if(type=="first"){
                this.params.page = 1;
            }else if(type=="last"){
                this.params.page = this.pagination.lastPage;
            }else if(type=="next"){
                this.params.page = this.pagination.currentPage+1;
            }else if(type=="back"){
                  if(this.pagination.currentPage>1)
                    this.params.page = this.pagination.currentPage-1;
                  else
                    return false;
            }else if(type=="page"){
                this.params.page = this.selectedPage;
            }

            this.getData();
        },
        changeRecordsPerPage(){

            this.params.take = this.selectedRecords
            this.params.page = 1
            this.getData();

        }


    }
}
</script>

<style scoped>

    .pointer{
       cursor: pointer;
    }

    th {
        color: rgba(255,255,255,0.5) !important;
    }

    th.active {
        color: #fff !important;
    }

    th.active .arrow {
        opacity: 1;
    }

    .arrow {
        display: inline-block;
        vertical-align: middle;
        width: 0;
        height: 0;
        margin-left: 5px;
        opacity: 0.5;
    }

    .arrow.asc {
        border-left: 4px solid transparent;
        border-right: 4px solid transparent;
        border-bottom: 4px solid #fff;
    }

    .arrow.dsc {
        border-left: 4px solid transparent;
        border-right: 4px solid transparent;
        border-top: 4px solid #fff;
    }

    .pagination .page-link{
        font-size: 1rem;
    }

</style>
