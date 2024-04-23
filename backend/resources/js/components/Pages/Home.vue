<template>
    <v-main class="grey lighten-3">
        <v-container>
            <v-row>
                <v-col cols="3">
                    <!-- カテゴリ部分　コンポーネント化 -->
                    <Categories></Categories>
                    <!-- <v-sheet rounded="lg">
                        <v-list color="transparent">
                            <v-list-item v-for="category in categories" :key="category.id">
                                <v-list-item-content>
                                    <v-dialog v-model="dialog" persistent max-width="600px">
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-list-item-title class="d-flex justify-space-between">
                                                <p>
                                                    <router-link
                                                        v-bind:to="{ name: 'ownitems', params: { id: category.id } }">
                                                        {{ category.name }}
                                                    </router-link>
                                                </p>
                                                <v-btn color="gray" dark v-bind="attrs" v-on="on">編集</v-btn>
                                            </v-list-item-title>
                                        </template>
<v-card>
    <form @submit.prevent="updateCategory">
        <v-card-title>
            <span class="text-h5">カテゴリ編集</span>
        </v-card-title>
        <v-card-text>
            <v-container>
                <v-row>
                    <v-col cols="12">
                        <v-text-field v-model="category.name" label="カテゴリ名" required>
                        </v-text-field>
                    </v-col>
                </v-row>
            </v-container>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="gray" text @click="dialog = false">
                閉じる
            </v-btn>
            <v-btn color="gray" text @click="updateCategory">
                変更
            </v-btn>
            <v-btn color="gray" text @click="deleteCategory">
                削除
            </v-btn>
        </v-card-actions>
    </form>
</v-card>
</v-dialog>
</v-list-item-content>
</v-list-item>
<v-divider class="my-2"></v-divider>
<v-list-item link color="grey lighten-4">
    <v-list-item-content>
        <v-list-item-title>
            <v-dialog v-model="dialog" persistent max-width="600px">
                <template v-slot:activator="{ on, attrs }">
                                                <v-btn color="gray" dark v-bind="attrs" v-on="on">
                                                    カテゴリ追加
                                                </v-btn>
                                            </template>
                <v-card>
                    <form @submit.prevent="submit">
                        <v-card-title>
                            <span class="text-h5">カテゴリ追加</span>
                        </v-card-title>
                        <v-card-text>
                            <v-container>
                                <v-row>
                                    <v-col cols="12">
                                        <v-text-field v-model="category.name" label="カテゴリ名" required>
                                        </v-text-field>
                                    </v-col>
                                </v-row>
                            </v-container>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="gray" text @click="dialog = false">
                                閉じる
                            </v-btn>
                            <v-btn color="gray" text @click="submit">
                                追加
                            </v-btn>
                        </v-card-actions>
                    </form>
                </v-card>
            </v-dialog>
        </v-list-item-title>
    </v-list-item-content>
</v-list-item>
</v-list>
</v-sheet> -->
                    <!-- ここまでカテゴリ部分 -->
                </v-col>
                <v-col>
                    <!-- item部分　コンポーネント化 v-slotを使用-->
                    <Items></Items>
                    <!-- <v-sheet min-height="70vh" rounded="lg">
                        <div>
                            <v-list-item-group class="d-flex flex-wrap"> -->
                    <!-- ブレークポイント設定 -->
                    <!-- <v-col v-for="item in items" :key="item.id" lg="3" md="4" sm="6" xs="12">
                                    <v-list-item class="with">
                                        <v-list-item-content>
                                            <v-card class="mx-auto" outlined>
                                                <v-list-item three-line>
                                                    <v-list-item-content>
                                                        <div class="text-overline mb-4">
                                                        </div>
                                                        <v-list-item-title class="text-h6 mb-1">
                                                            {{ item.name }}
                                                        </v-list-item-title>
                                                        <v-list-item-subtitle></v-list-item-subtitle>
                                                    </v-list-item-content>
                                                    <v-list-item-avatar tile size="80" color="grey"><img
                                                            :src="item.image_path" alt="">
                                                    </v-list-item-avatar>
                                                </v-list-item>
                                                <v-card-actions>
                                                    <v-btn outlined rounded text>
                                                        編集
                                                    </v-btn>
                                                </v-card-actions>
                                            </v-card>
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-col>
                            </v-list-item-group>
                            <v-dialog v-model="dialog" persistent max-width="600px">
                                <template v-slot:activator="{ on, attrs }">
                                    <v-btn color="gray" dark v-bind="attrs" v-on="on">
                                        アイテム追加
                                    </v-btn>
                                </template>
                                <v-card>
                                    <form @submit.prevent="">
                                        <v-card-title>
                                            <span class="text-h5">アイテム追加</span>
                                        </v-card-title>
                                        <v-card-text>
                                            <v-container>
                                                <v-row>
                                                    <v-col cols="12">
                                                        <v-text-field v-model="item.name" label="アイテム名" required>
                                                        </v-text-field>
                                                        <v-text-field v-model="item.disuse_month" label="非使用期間" required>
                                                        </v-text-field>
                                                        <input type="file" @change="fileSelected">
                                                    </v-col>
                                                </v-row>
                                            </v-container>
                                        </v-card-text>
                                        <v-card-actions>
                                            <v-spacer></v-spacer>
                                            <v-btn color="gray" text @click="dialog = false">
                                                閉じる
                                            </v-btn>
                                            <v-btn color="gray" text @click="upload">
                                                追加
                                            </v-btn>
                                        </v-card-actions>
                                    </form>
                                </v-card>
                            </v-dialog>
                        </div>
                    </v-sheet> -->
                    <!-- ここまでitem部分 -->
                </v-col>
            </v-row>
        </v-container>
    </v-main>
</template>

<script>
// import CategoryEditComponent from "../CategoryComponentGroup/CategoryEditComponent.vue";
import Categories from '../Component/Categories/Categories.vue';
import Items from '../Component/Items/Items.vue';

export default {
    components: {
        Categories,
        Items,
    },
    data() {
        return {
            categoryValue: this.category,
            categories: [],
            category: {},
            items: [],
            item: {},
            id: this.$route.params.id,
            dialog: false,
            fileInfo: '',
            // image_path: this.want.image_path
        }
    },
    methods: {
        // getCategories() {
        //     axios.get('/api/categories')
        //         .then((res) => {
        //             this.categories = res.data;
        //         });
        // },
        // updateCategory() {
        //     axios.put('api/categories/' + this.category.id, {
        //         name: this.category.name
        //     }).then((res) => {
        //         this.categoryValue = res.data.category;
        //         this.dialog = false;
        //     });
        // },
        // deleteCategory() {
        //     axios.delete(`api/categories/${this.category.id}`).then((res) => {
        //         this.$emit('getCategoriesFromChild')
        //         // 表示側のみ変える
        //     })
        // },
        // submit() {
        //     axios.post('api/categories', {
        //         name: this.category.name,
        //     })
        //         .then((res) => {
        //             this.categories.push(res.data);
        //             this.category.name = "";
        //             this.dialog = false;
        //         })
        //         .catch((err) => {
        //             console.log(err);
        //         });
        // },
        getItems() {
            axios.get('api/ownitems/category/' + this.id)
                .then((res) => {
                    this.items = res.data;
                });
        },
        fileSelected(event) {
            this.fileInfo = event.target.files[0]
        },
        upload() {
            const formData = new FormData()
            formData.append('item_image', this.fileInfo)
            formData.append('name', this.item.name)
            formData.append('disuse_month', this.item.disuse_month)
            axios
                .post("api/items", formData)
                .then((res) => {
                    // console.log(res);
                    this.dialog = false;
                })
                .catch((err) => {
                    console.log(err);
                });
        }
    },
    mounted() {
        // this.getCategories();
        this.getItems();
    },
    // beforeRouteUpdate(to, from, next) {
    //     const id = to.params.id;
    //     axios.get('api/ownitems/category/' + id)
    //         .then((res) => {
    //             this.items = res.data;
    //         });
    //     next()
    // },

}
</script>
