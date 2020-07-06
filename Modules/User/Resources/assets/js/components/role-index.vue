<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div v-if="loading">Cargando...</div>

                <section v-if="errored && !loading" >
                    <div class="alert alert-danger my-5" role="alert">
                        Lo sentimos, no es posible obtener la información en este momento.
                    </div>
                </section>

                <section v-else>

                    <div v-if="!loading" class="card">
                        <div class="card-header">
                            {{title}}
                        </div>

                        <div class="card-body">

                           <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr  v-for="(item, index) in data" :key="index">
                                    <th scope="row">{{item.id}}</th>
                                    <td>{{item.name}}</td>
                                    <td>{{item.createdAt}}</td>
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
                    nombre: '',
                    descripcion: ''
                }
        }
    },
    methods:{

        async init(){

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
