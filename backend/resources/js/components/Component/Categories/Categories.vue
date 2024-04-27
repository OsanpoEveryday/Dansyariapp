<template>
    <div>
        <v-sheet rounded="lg">
            <v-list color="transparent">
                <v-list-item>
                    <v-list-item-content>
                        <v-btn dark @click="dialog_add = true">
                            カテゴリ追加
                        </v-btn>
                    </v-list-item-content>
                </v-list-item>
                <v-divider class="my-2"></v-divider>
                <v-list-item v-for="category in categories" :key="category.id">
                    <v-list-item-content class="d-flex justify-space-between">
                        <template v-if="$route.path === '/ownitems/category/' + $route.params.id">
                            <div class="parent">
                                <router-link v-bind:to="{ name: 'ownitems', params: { id: category.id } }">
                                    <v-btn text>
                                        {{ category.name }}
                                    </v-btn>
                                </router-link>
                                <v-btn text class="child" @click="openViewDialog(category)">
                                    <i class="fa-regular fa-window-restore"></i>
                                </v-btn>
                            </div>
                        </template>
                        <template v-if="$route.path === '/wantitems/category/' + $route.params.id">
                            <div class="parent">
                                <router-link v-bind:to="{ name: 'wantitems', params: { id: category.id } }">
                                    <v-btn text>
                                        {{ category.name }}
                                    </v-btn>
                                </router-link>
                                <v-btn text class="child" @click="openViewDialog(category)">
                                    <i class="fa-regular fa-window-restore"></i>
                                </v-btn>
                            </div>
                        </template>
                        <template v-if="$route.path === '/disuseitems/category/' + $route.params.id">
                            <div class="parent">
                                <router-link v-bind:to="{ name: 'disuseitems', params: { id: category.id } }">
                                    <v-btn text>
                                        {{ category.name }}
                                    </v-btn>
                                </router-link>
                                <v-btn text class="child" @click="openViewDialog(category)">
                                    <i class="fa-regular fa-window-restore"></i>
                                </v-btn>
                            </div>
                        </template>
                        <!-- <template v-if="$route.path === '/wantitems/category/' + $route.params.id">
                            <v-btn text>
                                <router-link v-bind:to="{ name: 'wantitems', params: { id: category.id } }">
                                    {{ category.name }}
                                </router-link>
                            </v-btn>
                        </template> -->
                        <!-- <template v-if="$route.path === '/disuseitems/category/' + $route.params.id">
                            <v-btn>
                                <router-link v-bind:to="{ name: 'disuseitems', params: { id: category.id } }">
                                    {{ category.name }}
                                </router-link>
                            </v-btn>
                        </template> -->
                    </v-list-item-content>
                </v-list-item>
            </v-list>
            <!-- <v-list color="transparent">
                <v-list-item v-for="category in categories" :key="category.id">
                    <v-list-item-content>
                        <v-dialog v-model="dialog" persistent max-width="600px">
                            <template v-slot:activator="{ on, attrs }">
                                <v-list-item-title class="d-flex justify-space-between"> -->
            <!-- v-ifで現在のURLによって遷移先を切り替えるような条件分岐をする -->
            <!-- $route.path === '/foo' -->
            <!-- v-slotはv-forで回している１つ１つのcategoryが子コンポーネントに引き継がれるわけではないため、使えない -->
            <!-- v-slotを適用する場合は、v-list-item-content以下をコンポーネントにする -->
            <!-- <template v-if="$route.path === '/ownitems/category/' + $route.params.id"> -->
            <!-- v-if="$route.path.includes('ownitems/category')"で特定文字列を含むものを指定可能 -->
            <!-- <p>
                                            <router-link v-bind:to="{ name: 'ownitems', params: { id: category.id } }">
                                                <v-btn text>
                                                    {{ category.name }}
                                                </v-btn>
                                            </router-link>
                                        </p>
                                    </template>
    <template v-if="$route.path === '/wantitems/category/' + $route.params.id">
                                        <p>
                                            <router-link v-bind:to="{ name: 'wantitems', params: { id: category.id } }">
                                                {{ category.name }}
                                            </router-link>
                                        </p>
                                    </template>
    <template v-if="$route.path === '/disuseitems/category/' + $route.params.id">
                                        <p>
                                            <router-link v-bind:to="{ name: 'disuseitems', params: { id: category.id } }">
                                                {{ category.name }}
                                            </router-link>
                                        </p>
                                    </template>
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
    </v-list> -->
        </v-sheet>
        <!-- カテゴリ追加ダイアログ -->
        <v-dialog v-model="dialog_add" persistent max-width="500px">
            <v-card outlined>
                <v-card-title>
                    新規カテゴリ
                </v-card-title>
                <v-card-text>
                    <v-list-item>
                        <v-list-item-content>
                            <v-form>
                                <v-text-field v-model="category.name" label="カテゴリ名" required>
                                </v-text-field>
                                <v-text-field label="ルール1" required>
                                </v-text-field>
                                <v-text-field label="ルール2" required>
                                </v-text-field>
                                <v-text-field label="ルール3" required>
                                </v-text-field>
                            </v-form>
                        </v-list-item-content>
                    </v-list-item>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="gray" text @click="addCategory()">
                        追加
                    </v-btn>
                    <v-btn color="gray" text @click="dialog_add = false">
                        閉じる
                    </v-btn>
                </v-card-actions>
            </v-card>
            <!-- カテゴリ詳細ダイアログ -->
        </v-dialog>
        <v-dialog v-model="dialog_view" persistent max-width="500px">
            <v-card outlined>
                <v-card-title v-show="uneditable">
                    {{ modalCategory.name }}
                </v-card-title>
                <v-text-field v-model="update_category_name" v-show="editable"></v-text-field>
                <v-card-subtitle class="my-1">
                    ルール
                </v-card-subtitle>
                <v-card-text class="text-body-1" v-for="rule in modalCategory.rules" :key="rule.id" v-show="uneditable">
                    <i class="fa-solid fa-ruler"></i>
                    {{ rule.text }}
                </v-card-text>
                <v-text-field v-model="update_rule_text" v-show="editable"></v-text-field>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn text color="gray" @click="switchView()">
                        編集
                    </v-btn>
                    <v-btn text color="gray" @click="dialog_view = false">
                        閉じる
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<style>
.child {
    display: none;
}

.parent:hover .child {
    display: inline-block;
}

.parent {
    display: flex;
}
</style>

<script>
// import CategoryEditComponent2 from './CategoryEditComponent2.vue';

// import CategoryEditComponent from "./CategoryEditComponent.vue";

export default {
    // name:CategoryComponent,

    data() {
        return {
            categoryValue: this.category,
            categories: [],
            category: {},
            modalCategory: {},
            id: this.$route.params.id,
            dialog_add: false,
            dialog_view: false,
            editable: false,
            uneditable: true,

            update_category_name: '',
            update_rule_text: '',
        }
    },
    methods: {
        switchView() {
            this.uneditable = !this.uneditable;
            this.editable = !this.editable;
        },
        getCategories() {
            axios.get('/api/categories')
                .then((res) => {
                    this.categories = res.data;
                });
        },
        updateCategory() {
            axios.put('api/categories/' + this.category.id, {
                name: this.category.name
            }).then((res) => {
                this.categoryValue = res.data.category;
                this.dialog = false;
            });
        },
        deleteCategory() {
            axios.delete(`api/categories/${this.category.id}`).then((res) => {
                this.$emit('getCategoriesFromChild')
                // 表示側のみ変える
            })
        },
        addCategory() {
            axios.post('api/categories', {
                name: this.category.name,
            })
                .then((res) => {
                    this.categories.push(res.data);
                    this.category.name = "";
                    this.dialog = false;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        openViewDialog(category) {
            this.modalCategory = category;
            this.dialog_view = true;
        }

    },
    mounted() {
        this.getCategories();
    },
}
</script>
