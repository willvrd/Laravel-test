import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

export default new Router({
    routes: [
        {
            path: '',
            name: 'home',
            component: require('./views/home.vue').default
        },
        {
            path: '/page-2',
            name: 'page.2',
            component: require('./views/page-2.vue').default
        },
        {
            path: '/page-3',
            name: 'page.3',
            component: require('./views/page-3.vue').default
        },
    ]
});
