// router-viewの中身を設定
// childrenは親コンポーネントの中にあるrouter-viewの中身を設定

import Vue from "vue";
import VueRouter from "vue-router";
import Home from './components/Pages/Home.vue';
import Rule from './components/Rule.vue';
import Select from './components/Pages/Select.vue';
import Example from './components/ExampleComponent.vue';

Vue.use(VueRouter);

const router = new VueRouter({
    mode:'history',
    routes:[
        {
            path:'/select/:id',
            name:'select',
            component:Select,
        },
        {
            path:'/ownitems/category/:id',
            name:'ownitems',
            component:Home,
        },
        {
            path:'/wantitems/category/:id',
            name:'wantitems',
            component:Home,
        },
        {
            path:'/disuseitems/category/:id',
            name:'disuseitems',
            component:Home,
        },
        {
            path:'/rules',
            name:'rule.list',
            component:Rule,
        },
        {
            path:'/example',
            name: 'example',
            component: Example,
        }
    ]
})
export default router
