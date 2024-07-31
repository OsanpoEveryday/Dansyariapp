<template>
    <div>
        <v-card rounded="lg">
            <v-list color="transparent">
                <v-list-item>
                    <v-list-item-content>
                        <div class="d-flex">
                            <v-list-item-title>カテゴリ一覧</v-list-item-title>
                            <v-btn text @click="dialog_add = true">
                                <i class="fa-solid fa-plus"></i>
                            </v-btn>
                        </div>
                    </v-list-item-content>
                </v-list-item>
                <!-- <v-list-item>
                    <v-list-item-content class="d-flex justify-center">
                        <v-list-item-title class="d-inline-block">
                            カテゴリ一覧
                        </v-list-item-title>
                        <v-btn text class="d-inline-block">
                            <i class="fa-solid fa-gear"></i>
                        </v-btn>
                    </v-list-item-content>
                </v-list-item> -->
                <v-divider class="my-2"></v-divider>
                <v-list-item v-for="category in categories" :key="category.id">
                    <v-list-item-content>
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
            <!-- v-ifで現在のURLによって遷移先を切り替えるような条件分岐をする -->
            <!-- $route.path === '/foo' -->
            <!-- v-slotはv-forで回している１つ１つのcategoryが子コンポーネントに引き継がれるわけではないため、使えない -->
            <!-- v-slotを適用する場合は、v-list-item-content以下をコンポーネントにする -->
            <!-- <template v-if="$route.path === '/ownitems/category/' + $route.params.id"> -->
            <!-- v-if="$route.path.includes('ownitems/category')"で特定文字列を含むものを指定可能 -->
        </v-card>
        <!-- カテゴリ詳細ダイアログ -->
        <v-dialog v-model="dialog_view" persistent max-width="600px">
            <v-card rounded="lg">
                <v-toolbar dark>
                    <v-toolbar-title class="parent" v-show="uneditable">
                        {{ modalCategory.name }}
                        <!-- <v-btn class="child" text @click="switchView_name()">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </v-btn> -->
                    </v-toolbar-title>
                    <v-text-field color="grey-darken-1" class="my-auto" v-show="editable" v-model="modalCategory.name">
                    </v-text-field>
                    <div v-if="errors.name" class="error_validation">{{ errors.name[0] }}</div>
                    <div v-if="errors.name" class="error_validation">{{ errors.name[1] }}</div>
                    <v-spacer></v-spacer>
                </v-toolbar>
                <v-list-item>
                    <v-list-item-content>
                        <v-list-item-title>
                            ━ メモ ━
                        </v-list-item-title>
                        <v-textarea color="grey-darken-1" class="mt-3" label="モノに対する考え方を自由に書いてみましょう" outlined
                            v-model="modalCategory.memo">
                        </v-textarea>
                        <div v-if="errors.memo" class="error_validation">{{ errors.memo[0] }}</div>

                        <v-list-item-title class="mb-4">
                            ━ ルール ━
                        </v-list-item-title>
                        <!-- ルール追加 -->
                        <v-list-item-title>
                            <v-row v-show="editable">
                                <v-col cols="9">
                                    <v-text-field color="grey-darken-1" label="＋新しいルール" v-model="newrule_text">
                                    </v-text-field>
                                    <div v-if="errors.rule1" class="error_validation"></div>
                                </v-col>
                                <v-col cols="3">
                                    <v-btn class="gray" @click="addRule()">追加</v-btn>
                                </v-col>
                            </v-row>
                        </v-list-item-title>
                        <!-- ルール表示 -->
                        <div v-for="rule in modalCategory.rules" :key="rule.id">
                            <div v-show="uneditable">
                                <v-list-item-title>
                                    ルール:{{ rule.text }}
                                </v-list-item-title>
                            </div>
                            <v-divider class="my-4"></v-divider>
                            <v-list-item-title>
                                <v-row v-show="editable">
                                    <v-col cols="8">
                                        <v-text-field color="grey-darken-1" label="ルール" v-model="rule.text">
                                        </v-text-field>
                                        <div v-if="errors.rule1" class="error_validation">{{ errors.rule1[0] }}</div>
                                    </v-col>
                                    <v-col cols="2">
                                        <v-btn class="gray" @click="updateRule(rule)">更新</v-btn>
                                    </v-col>
                                    <v-col cols="2">
                                        <v-btn class="gray" @click="deleteRule(rule)">削除</v-btn>
                                    </v-col>
                                </v-row>
                            </v-list-item-title>
                        </div>
                        <!-- <div class="parent" v-show="uneditable_1">
                            <v-list-item-title>
                                ルール１: {{ modalCategory.rule1 }}
                            </v-list-item-title>
                            <v-btn class="child" text @click="switchView1()">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </v-btn>
                        </div>
                        <v-list-item-title>
                            <v-row v-show="editable_1">
                                <v-col cols="12">
                                    <v-text-field color="grey-darken-1" label="ルール１" v-model="modalCategory.rule1">
                                    </v-text-field>
                                    <div v-if="errors.rule1" class="error_validation">{{ errors.rule1[0] }}</div>
                                </v-col>
                            </v-row>
                        </v-list-item-title>
                        <v-divider class="my-4"></v-divider>
                        <div class="parent" v-show="uneditable_2">
                            <v-list-item-title>
                                ルール２: {{ modalCategory.rule2 }}
                            </v-list-item-title>
                            <v-btn class="child" text @click="switchView2()">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </v-btn>
                        </div>
                        <v-list-item-title>
                            <v-row v-show="editable_2">
                                <v-col cols="12">
                                    <v-text-field color="grey-darken-1" label="ルール２" v-model="modalCategory.rule2">
                                    </v-text-field>
                                    <div v-if="errors.rule2" class="error_validation">{{ errors.rule2[0] }}</div>
                                </v-col>
                            </v-row>
                        </v-list-item-title>
                        <v-divider class="my-4"></v-divider>
                        <div class="parent" v-show="uneditable_3">
                            <v-list-item-title>
                                ルール３: {{ modalCategory.rule3 }}
                            </v-list-item-title>
                            <v-btn class="child" text @click="switchView3()">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </v-btn>
                        </div>
                        <v-list-item-title>
                            <v-row v-show="editable_3">
                                <v-col cols="12">
                                    <v-text-field color="grey-darken-1" label="ルール３" v-model="modalCategory.rule3">
                                    </v-text-field>
                                    <div v-if="errors.rule3" class="error_validation">{{ errors.rule3[0] }}</div>
                                </v-col>
                            </v-row>
                        </v-list-item-title>
                        <v-divider class="my-4"></v-divider>
                        <div class="parent" v-show="uneditable_4">
                            <v-list-item-title>
                                ルール４: {{ modalCategory.rule4 }}
                            </v-list-item-title>
                            <v-btn class="child" text @click="switchView4()">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </v-btn>
                        </div>
                        <v-list-item-title>
                            <v-row v-show="editable_4">
                                <v-col cols="12">
                                    <v-text-field color="grey-darken-1" label="ルール４" v-model="modalCategory.rule4">
                                    </v-text-field>
                                    <div v-if="errors.rule4" class="error_validation">{{ errors.rule4[0] }}</div>
                                </v-col>
                            </v-row>
                        </v-list-item-title>
                        <v-divider class="my-4"></v-divider>
                        <div class="parent" v-show="uneditable_5">
                            <v-list-item-title>
                                ルール５: {{ modalCategory.rule5 }}
                            </v-list-item-title>
                            <v-btn class="child" text @click="switchView5()">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </v-btn>
                        </div>
                        <v-list-item-title>
                            <v-row v-show="editable_5">
                                <v-col cols="12">
                                    <v-text-field color="grey-darken-1" label="ルール５" v-model="modalCategory.rule5">
                                    </v-text-field>
                                    <div v-if="errors.rule5" class="error_validation">{{ errors.rule5[0] }}</div>
                                </v-col>
                            </v-row>
                        </v-list-item-title>
                        <v-divider class="my-4"></v-divider> -->
                    </v-list-item-content>
                </v-list-item>
                <v-card-actions class="d-flex justify-end">
                    <v-btn text v-show="editable" @click="deleteCategory(modalCategory.id)">
                        削除
                    </v-btn>
                    <v-btn text v-show="uneditable" @click="switchViewToUneditable(); dialog_view = false">
                        閉じる
                    </v-btn>
                    <v-btn text v-show="editable" @click="updateCategory(modalCategory.id); getCategories()">
                        保存
                    </v-btn>
                    <v-btn text v-show="editable" @click.stop="switchView()">
                        戻る
                    </v-btn>
                    <v-btn text v-show="uneditable" @click="switchView()">
                        編集
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <!-- カテゴリ追加ダイアログ -->
        <v-dialog v-model="dialog_add" persistent max-width="600px">
            <v-card>
                <v-toolbar dark>
                    <v-toolbar-title>
                        カテゴリ追加
                    </v-toolbar-title>
                </v-toolbar>
                <v-list-item>
                    <v-list-item-content>
                        <v-list-item-title>
                            <v-text-field color="grey-darken-1" label="カテゴリ名" v-model="newCategory.name">
                            </v-text-field>
                            <div v-if="errors.name" class="error_validation">{{ errors.name[0] }}</div>
                            <div v-if="errors.name" class="error_validation">{{ errors.name[1] }}</div>
                        </v-list-item-title>
                        <v-list-item-title class="mt-2">
                            <v-textarea class="mt-2" color="grey-darken-1" label="メモ：モノに対する考え方を自由に書いてみましょう" outlined
                                v-model="newCategory.memo">
                            </v-textarea>
                            <div v-if="errors.memo" class="error_validation">{{ errors.memo[0] }}</div>
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-card-actions class="d-flex justify-end">
                    <v-btn text @click="clearNewCategory()">
                        クリア
                    </v-btn>
                    <v-btn text @click="addCategory()">
                        保存
                    </v-btn>
                    <v-btn text @click="closeDialogAdd()">
                        閉じる
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<style scoped>
.child {
    display: inline-block;
    visibility: hidden;
    opacity: 0;
    transition: .3s;
}

.parent:hover .child {
    visibility: visible;
    opacity: 1;
    transition: .3s;
}

.parent {
    display: flex;
}

.error_validation {
    background-color: transparent;
    color: red;
}
</style>

<script>
import axios from 'axios';

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
            newrule_text: "",
            newCategory: {},
            errors: {},
            id: this.$route.params.id,
            dialog_add: false,
            dialog_view: false,
            editable: false,
            uneditable: true,

            editable_name: false,
            uneditable_name: true,
            editable_1: false,
            uneditable_1: true,
            editable_2: false,
            uneditable_2: true,
            editable_3: false,
            uneditable_3: true,
            editable_4: false,
            uneditable_4: true,
            editable_5: false,
            uneditable_5: true,

            update_category_name: '',
            update_rule_text: '',
        }
    },
    computed: {
        // isVisible(ruleId) {
        //     return false;
        // },
    },
    methods: {
        // 変数名の中に変数を入れる
        // const test = '変数名';
        // this[test] = '代入したいもの'
        // this.変数名 = '代入したいもの'
        switchView() {
            this.uneditable = !this.uneditable;
            this.editable = !this.editable;
        },
        switchToEditingRuleView(ruleId) {
            // const index = this.modalCategory.rules.findIndex(rule => rule.id === ruleId);
            // this.isVisible(ruleId) = true;
        },
        switchView_name() {
            this.editable_name = !this.editable_name;
            this.uneditable_name = !this.uneditable_name;
        },
        switchView1() {
            this.editable_1 = !this.editable_1;
            this.uneditable_1 = !this.uneditable_1;
        },
        switchView2() {
            this.editable_2 = !this.editable_2;
            this.uneditable_2 = !this.uneditable_2;
        },
        switchView3() {
            this.editable_3 = !this.editable_3;
            this.uneditable_3 = !this.uneditable_3;
        },
        switchView4() {
            this.editable_4 = !this.editable_4;
            this.uneditable_4 = !this.uneditable_4;
        },
        switchView5() {
            this.editable_5 = !this.editable_5;
            this.uneditable_5 = !this.uneditable_5;
        },
        switchViewToUneditable() {
            this.getCategories();
            this.editable_name = false;
            this.editable_1 = false;
            this.editable_2 = false;
            this.editable_3 = false;
            this.editable_4 = false;
            this.editable_5 = false;
            this.uneditable_name = true;
            this.uneditable_1 = true;
            this.uneditable_2 = true;
            this.uneditable_3 = true;
            this.uneditable_4 = true;
            this.uneditable_5 = true;
            this.errors = {};
            this.newrule_text = "";
        },
        getCategories() {
            axios.get('/api/categories')
                .then((res) => {
                    this.categories = res.data;
                });
        },
        updateCategory(categoryId) {
            axios.post('/api/categoryedit/' + categoryId, {
                name: this.modalCategory.name,
                memo: this.modalCategory.memo,
                rule1: this.modalCategory.rule1,
                rule2: this.modalCategory.rule2,
                rule3: this.modalCategory.rule3,
                rule4: this.modalCategory.rule4,
                rule5: this.modalCategory.rule5
            }).then((res) => {
                this.switchViewToUneditable();
            }).catch((err) => {
                this.errors = err.response.data.errors;
            });
        },
        addRule() {
            axios.post('/api/storerule/' + this.modalCategory.id, {
                text: this.newrule_text
            }).then((res) => {
                console.log(res);
                this.modalCategory.rules.push(res.data);
                this.newrule_text = "";
            }).catch((err) => {
                this.errors = err.response.data.errors;
            });
        },
        updateRule(rule) {
            axios.post('/api/editrule/' + rule.id, {
                text: rule.text,
            }).then((res) => {
                this.switchViewToUneditable();
            }).catch((err) => {
                this.errors = err.response.data.errors;
            });
        },
        deleteRule(rule) {
            axios
                .post('api/deleterule/' + rule.id)
                .then((res) => {
                    this.modalCategory.rules = this.modalCategory.rules.filter(r => r.id !== rule.id);
                })
                .catch((err) => {
                    alert(err.response.data.message);
                })
        },
        deleteCategory(id) {
            axios
                .delete("api/deletecategory/" + id)
                .then((res) => {
                    this.categories = this.categories.filter(category => category.id !== id);
                    this.dialog_view = false;
                    this.editable = false;
                    this.uneditable = true;
                    this.$router.push({
                        name: this.$route.name,
                        params: { ...this.$route.params, id: this.categories[0].id }
                    });
                })
                .catch((err) => {
                    alert(err.response.data.message);
                });
        },
        clearNewCategory() {
            this.newCategory = {}
        },
        addCategory() {
            axios.post('api/categories', {
                name: this.newCategory.name,
                memo: this.newCategory.memo,
                rule1: this.newCategory.rule1,
                rule2: this.newCategory.rule2,
                rule3: this.newCategory.rule3,
                rule4: this.newCategory.rule4,
                rule5: this.newCategory.rule5,
            })
                .then((res) => {
                    this.dialog_add = false;
                    this.getCategories();
                    this.clearNewCategory();
                })
                .catch((err) => {
                    this.errors = err.response.data.errors;
                    console.log(this.errors);
                });
        },
        closeDialogAdd() {
            this.dialog_add = false;
            this.errors = {};
        },
        openViewDialog(category) {
            this.modalCategory = category;
            this.dialog_view = true;
        },

    },
    mounted() {
        this.getCategories();
    },
}
</script>
