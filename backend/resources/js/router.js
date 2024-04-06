// router-viewの中身を設定
// childrenは親コンポーネントの中にあるrouter-viewの中身を設定

import Vue from "vue";
import VueRouter from "vue-router";
import Rule from './components/Rule.vue';
import CategoryEdit from './components/Pages/CategoryEdit.vue';
import Sort from './components/Pages/Sort.vue';
import Home from './components/Pages/Home.vue';
// import Categories from './components/Components/Categories/Categories.vue';
// import CategoryEdit from './components/Components/Categories/CategoryEditComponent2.vue';

Vue.use(VueRouter);

const router = new VueRouter({
    mode:'history',
    routes:[
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
        // {
        //     path: '/categories',
        //     name: 'category.list',
        //     component: Categories,
        //     children:[
        //         {
        //             path: 'items/:id',
        //             name: 'item.list',
        //             component: Home,
        //             props:true,
        //         },
        //         // {
        //         //     path: 'wants/:id',
        //         //     name: 'want.list',
        //         //     component: Want,
        //         //     props:true,
        //         // },
        //         // {
        //         //     path: 'disuse/:id',
        //         //     name: 'disuse.list',
        //         //     component: Disuse,
        //         //     props:true,
        //         // },
        //     ]
        // },
        {
            path: '/home',
            name: 'home',
            component: Sort,
            children:[
                {
                    path: 'null',
                    name: 'home.null',
                    component: Sort,
                    props:true,
                },
            ]
        },
        {
            path:'/rules',
            name:'rule.list',
            component:Rule,
        },
        {
            // path:'/categoryedit',
            // name:'category.edit',
            // component:CategoryEdit,
            // children:[
                // {
                    path: '/categoryedit/:categoryId',
                    name: 'category.edit.detail',
                    component:CategoryEdit ,
                    props:true,
                // },
            // ]
        },
    ]
})

export default router
