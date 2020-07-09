<template>
    <div class="container">

        <div class="row justify-content-center">
            <div v-if="loading" class="text-center mt-5">
                <div class="spinner-border text-success" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">

            <div class="col-md-9">

                <section v-if="errored && !loading" >
                    <div class="alert alert-danger my-5" role="alert">
                       Sorry, no results available.
                    </div>
                </section>

                <section v-else>

                    <div v-if="!loading" class="card">
                        <div class="card-header text-uppercase font-weight-bold">{{title}}</div>

                        <div class="card-body">

                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr  v-for="(item, index) in data" :key="index">
                                        <th scope="row">{{item.id}}</th>
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

                        </div>

                        <div class="card-footer">
                            {{initMsj}} : {{moduleName}}
                        </div>

                    </div>

                </section>

            </div>

            <div class="col-md-3">

                <section v-if="!loading">

                    <form @submit.prevent="updateItem(item)" v-if="modeUpdate">
                        <div class="card">
                            <div class="card-header text-uppercase font-weight-bold">Update Role</div>
                            <div class="card-body">
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
                                <input type="text" class="form-control mb-2"
                                    placeholder="Name" v-model="item.name">
                                <button class="btn btn-primary" type="submit">Add</button>
                            </div>
                        </div>
                    </form>

                    <section v-if="errored2">
                        <div class="alert alert-danger mt-1" role="alert">
                            <p v-for="(error, index) in errors" :key="index">
                                {{error}}
                            </p>
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
        moduleName: String,
        initMsj: String,
        path: String
    },
    mounted() {
        this.init();
    },
    data() {
        return {
            success: false,
            loading: true,
            errored: false,
            errored2: false,
            errors: [],
            modeUpdate: false,
            data: [],
            item:{
                name: ''
            }
        }
    },
    methods:{

        init(){
            this.getData()
        },
        getData(){

            axios.get(this.path)
            .then(response => {
                this.data = response.data.data;
            })
            .catch(error => {
                console.log(error)
                this.errored = true
            })
            .finally(() => this.loading = false)

        },
        addItem(){

            if(this.item.name.trim() === ''){
                alert('Debes completar todos los campos antes de guardar');
                return;
            }

            axios.post(this.path, {attributes:this.item})
            .then((response) =>{
                alert("Item Added :)")
                this.cleanValues()
                this.data.push(response.data.data);
            }).catch(error => {
                this.catchErrors(error)
                console.log(error)
            })
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

        },
        deleteItem(item,index){
            let resp = confirm(`Delete item:" ${item.name} " ?`);
            if(resp){
                axios.delete(this.path+`/${item.id}`)
                .then((response)=>{
                    this.data.splice(index, 1);
                    alert(response.data.data);
                }).catch(error=>{
                    alert("Error :(")
                    console.log(error)
                })
            }
        },
        cancelUpdate(){
            this.modeUpdate = false;
            this.cleanValues()
            this.cleanErrors()
        },
        cleanValues(){
            this.item = {
                name: ''
            };
        },
        catchErrors(error){
            if (error.response){
                this.errors = JSON.parse(error.response.data.errors);
                this.errored2 = true
            }
        },
        cleanErrors(){
            this.errors = []
            this.errored2 = false;
        }

    }
}
</script>
