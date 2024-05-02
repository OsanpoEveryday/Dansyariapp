<template>
    <v-main class="blue-grey lighten-3">
        <v-container>
            <v-row>
                <v-col cols="3">
                    <v-sheet rounded="lg">
                        <v-list color="transparent">
                            <v-list-item>
                                <v-list-item-content>
                                    <v-list-item-title>カテゴリ設定</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                            <v-divider class="my-2"></v-divider>
                            <v-list-item v-for="category in categories" :key="category.id">
                                <v-list-item-content>
                                    <template>
                                        <router-link v-bind:to="{ name: 'categoryedit', params: { id: category.id } }">
                                            <v-btn text>
                                                {{ category.name }}
                                            </v-btn>
                                        </router-link>
                                    </template>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list>
                    </v-sheet>
                </v-col>
                <!-- カテゴリ詳細 -->
                <v-col>
                    <v-card min-height="70vh" rounded="lg">
                        <v-toolbar dark>
                            <v-toolbar-title>
                                {{ category_edit.name }}
                            </v-toolbar-title>
                            <v-spacer></v-spacer>
                        </v-toolbar>
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>
                                    メモ
                                </v-list-item-title>
                                <v-textarea color="grey-darken-1" class="mt-2" label="モノに対する考え方を自由に書いてみましょう" outlined
                                    v-model="category_edit.memo">
                                </v-textarea>
                                <div class="parent" v-show="uneditable_1">
                                    <v-list-item-title>
                                        ルール１: {{ category_edit.rule1 }}
                                    </v-list-item-title>
                                    <v-btn class="child" text @click="switchView1()">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </v-btn>
                                </div>
                                <v-list-item-title>
                                    <v-row v-show="editable_1">
                                        <v-col cols="12">
                                            <v-text-field label="ルール１" v-model="category_edit.rule1">
                                            </v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-list-item-title>
                                <v-divider class="my-4"></v-divider>
                                <div class="parent" v-show="uneditable_2">
                                    <v-list-item-title>
                                        ルール２: {{ category_edit.rule2 }}
                                    </v-list-item-title>
                                    <v-btn class="child" text @click="switchView2()">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </v-btn>
                                </div>
                                <v-list-item-title>
                                    <v-row v-show="editable_2">
                                        <v-col cols="12">
                                            <v-text-field label="ルール２" v-model="category_edit.rule2">
                                            </v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-list-item-title>
                                <v-divider class="my-4"></v-divider>
                                <div class="parent" v-show="uneditable_3">
                                    <v-list-item-title>
                                        ルール３: {{ category_edit.rule3 }}
                                    </v-list-item-title>
                                    <v-btn class="child" text @click="switchView3()">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </v-btn>
                                </div>
                                <v-list-item-title>
                                    <v-row v-show="editable_3">
                                        <v-col cols="12">
                                            <v-text-field label="ルール３" v-model="category_edit.rule3">
                                            </v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-list-item-title>
                                <v-divider class="my-4"></v-divider>
                                <div class="parent" v-show="uneditable_4">
                                    <v-list-item-title>
                                        ルール４: {{ category_edit.rule4 }}
                                    </v-list-item-title>
                                    <v-btn class="child" text @click="switchView4()">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </v-btn>
                                </div>
                                <v-list-item-title>
                                    <v-row v-show="editable_4">
                                        <v-col cols="12">
                                            <v-text-field label="ルール４" v-model="category_edit.rule4">
                                            </v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-list-item-title>
                                <v-divider class="my-4"></v-divider>
                                <div class="parent" v-show="uneditable_5">
                                    <v-list-item-title>
                                        ルール５: {{ category_edit.rule5 }}
                                    </v-list-item-title>
                                    <v-btn class="child" text @click="switchView5()">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </v-btn>
                                </div>
                                <v-list-item-title>
                                    <v-row v-show="editable_5">
                                        <v-col cols="12">
                                            <v-text-field label="ルール５" v-model="category_edit.rule5">
                                            </v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-list-item-title>
                                <v-divider class="my-4"></v-divider>
                            </v-list-item-content>
                        </v-list-item>
                        <v-card-actions class="d-flex justify-end">
                            <v-btn text @click="updateCategory(category_edit.id)">
                                保存
                            </v-btn>
                            <v-btn text @click="getCategoryEditing(); switchViewToUneditable()">
                                戻る
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </v-main>
</template>

<style>
.child {
    visibility: hidden;
    opacity: 0;
}

.parent:hover .child {
    visibility: visible;
    opacity: 1;
    transition: 1s;
}
</style>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            categories: [],
            category_edit: {},
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
        }
    },
    watch: {
        $route: function () {
            this.getCategoryEditing();
        }
    },
    methods: {
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
            this.editable_1 = false;
            this.editable_2 = false;
            this.editable_3 = false;
            this.editable_4 = false;
            this.editable_5 = false;
            this.uneditable_1 = true;
            this.uneditable_2 = true;
            this.uneditable_3 = true;
            this.uneditable_4 = true;
            this.uneditable_5 = true;
        },
        getCategories() {
            axios.get('/api/categories')
                .then((res) => {
                    this.categories = res.data;
                });
        },
        getCategoryEditing() {
            axios.get('/api/categoryedit/' + this.$route.params.id)
                .then((res) => {
                    this.category_edit = res.data;
                });
        },
        updateCategory(categoryId) {
            axios.post('/api/categoryedit/' + categoryId, {
                memo: this.category_edit.memo,
                rule1: this.category_edit.rule1,
                rule2: this.category_edit.rule2,
                rule3: this.category_edit.rule3,
                rule4: this.category_edit.rule4,
                rule5: this.category_edit.rule5
            }).then((res) => {
                this.switchViewToUneditable();
            });
        }
    },
    mounted() {
        this.getCategories();
        this.getCategoryEditing();
    },
}
</script>
