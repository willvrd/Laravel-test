<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <div v-if="loading" class="text-center mt-5">
                    <div class="spinner-border text-success" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

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
                                        <button type="button" class="btn btn-outline-primary">
                                           Edit
                                        </button>
                                        <button type="button" class="btn btn-outline-danger">
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
            loading : true,
            errored: false,
            data: [],
            modeUpdate: false,
            row:{
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

        }
    }
}
</script>
