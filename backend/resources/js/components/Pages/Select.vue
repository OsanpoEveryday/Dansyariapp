<template>
    <div>
        <Header></Header>
        <v-main>
            <v-container>
                <v-row>
                    <v-col cols="3">
                        <v-card rounded="lg">
                            <v-list color="transparent">
                                <v-list-item>
                                    <v-list-item-content>
                                        <div class="d-flex">
                                            <v-list-item-title>カテゴリ一覧</v-list-item-title>
                                        </div>
                                    </v-list-item-content>
                                </v-list-item>
                                <v-divider class="my-2"></v-divider>
                                <v-list-item v-for="category in categories" :key="category.id">
                                    <v-list-item-content>
                                        <div class="parent">
                                            <router-link v-bind:to="{ name: 'select', params: { id: category.id } }">
                                                <v-btn text>
                                                    {{ category.name }}
                                                </v-btn>
                                            </router-link>
                                            <v-btn text class="child" @click="openViewDialog(category)">
                                                <i class="fa-regular fa-window-restore"></i>
                                            </v-btn>
                                        </div>
                                    </v-list-item-content>
                                </v-list-item>
                            </v-list>
                        </v-card>
                    </v-col>
                    <v-dialog v-model="dialog_view" persistent max-width="500px">
                        <v-card min-height="70vh" rounded="lg">
                            <v-toolbar dark>
                                <v-toolbar-title>
                                    {{ modalCategory.name }}
                                </v-toolbar-title>
                                <v-spacer></v-spacer>
                            </v-toolbar>
                            <v-list-item>
                                <v-list-item-content>
                                    <v-textarea color="grey-darken-1" class="mt-3" label="メモ" outlined
                                        :value="modalCategory.memo" readonly="true">
                                    </v-textarea>
                                    <v-list-item-title>
                                        ルール１: {{ modalCategory.rule1 }}
                                    </v-list-item-title>
                                    <v-divider class="my-4"></v-divider>
                                    <v-list-item-title>
                                        ルール２: {{ modalCategory.rule2 }}
                                    </v-list-item-title>
                                    <v-divider class="my-4"></v-divider>
                                    <v-list-item-title>
                                        ルール３: {{ modalCategory.rule3 }}
                                    </v-list-item-title>
                                    <v-divider class="my-4"></v-divider>
                                    <v-list-item-title>
                                        ルール４: {{ modalCategory.rule4 }}
                                    </v-list-item-title>
                                    <v-list-item-title>
                                    </v-list-item-title>
                                    <v-divider class="my-4"></v-divider>
                                    <v-list-item-title>
                                        ルール５: {{ modalCategory.rule5 }}
                                    </v-list-item-title>
                                    <v-divider class="my-4"></v-divider>
                                </v-list-item-content>
                            </v-list-item>
                            <v-card-actions class="d-flex justify-end">
                                <v-btn text @click="dialog_view = false">
                                    閉じる
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                    <v-col>
                        <v-card v-if="selected_item" :loading="loading" class="mx-auto my-12" max-width="374">
                            <template v-slot:loader="{ isActive }">
                                <v-progress-linear :active="isActive" color="deep-purple" height="4"
                                    indeterminate></v-progress-linear>
                            </template>
                            <!-- image_pathが空だとv-imgをレンダリングできない -->
                            <!-- <v-img cover height="250" :src="selected_item.image_path"></v-img> -->
                            <img cover height="250" :src="selected_item.image_path"></img>
                            <v-card-title>{{ selected_item.name }}</v-card-title>
                            <v-card-subtitle>
                                <span class="me-1"></span>
                                <v-icon color="error" icon="mdi-fire-circle" size="small"></v-icon>
                            </v-card-subtitle>
                            <v-card-text>
                                <v-row align="center" class="mx-0">
                                    <div class="text-grey ms-4">
                                    </div>
                                </v-row>
                                <div class="my-4 text-subtitle-1">
                                </div>
                            </v-card-text>
                            <v-divider class="mx-4 mb-1"></v-divider>
                            <v-card-actions class="d-flex justify-center">
                                <v-btn @click="recordTime">使った</v-btn>
                                <v-btn @click="recordNull">使ってない</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
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
</style>

<script>
import Header from '../Component/Header.vue';

export default {
    components: {
        Header,
    },
    data: () => ({
        loading: false,
        selection: 1,
        categories: [],
        modalCategory: {},
        items: [],
        n: 0,
        dialog_view: false,
    }),
    watch: {
        $route: function () {
            this.getItems();
        }
    },
    computed: {
        selected_item() {
            return this.items[this.n]
        }
    },
    methods: {
        getCategories() {
            axios.get('/api/categories')
                .then((res) => {
                    this.categories = res.data;
                });
        },
        getItems() {
            axios.get('/api/select/' + this.$route.params.id)
                .then((res) => {
                    this.items = res.data;
                    // console.log(this.items);
                });
        },
        recordTime() {
            this.n++;
            axios.post('/api/select/recordtime', {
                // selected_item.idを使うと、最後にnがitems.lenthと同じになるためエラーが生じる
                item_id: this.items[this.n - 1].id
            }).then(() => {
                console.log(this.n)
                console.log(this.items.length)
                console.log(this.n < this.items.length)
                if (this.n < this.items.length) {
                } else {
                    // nはitemの数を超えない
                    window.alert("これで最後です。");
                    console.log("error");
                };
            }).catch((err) => {
                console.log(err);
            });
        },
        recordNull() {
            this.n++;
            axios.post('/api/select/recordnull', {
                item_id: this.items[this.n - 1].id
            }).then(() => {
                console.log(this.n)
                console.log(this.items.length)
                console.log(this.n < this.items.length)
                if (this.n < this.items.length) {
                } else {
                    window.alert("これで最後です。");
                    console.log("error");
                };
            }).catch((err) => {
                console.log(err);
            });
        },
        openViewDialog(category) {
            this.modalCategory = category;
            this.dialog_view = true;
        },
    },
    mounted() {
        this.getCategories();
        this.getItems();
    },
}
</script>
