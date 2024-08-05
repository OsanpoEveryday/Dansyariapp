<template>
    <div>
        <v-card min-height="70vh">
            <v-toolbar dark>
                <v-toolbar-title>持ちモノ:{{ current_category.name }}</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn color="grey lighten-3" class="black--text" @click.stop="dialog_newitem = true">アイテム追加</v-btn>
            </v-toolbar>
            <v-list-item-group class="d-flex flex-wrap">
                <v-col v-for="item in items" :key="item.id" lg="12" md="12" sm="12" xs="12">
                    <!-- コンポーネントで分けるもしくはdialogを外出しして内容を切り替える -->
                    <v-list-item class="with">
                        <v-list-item-content>
                            <v-card class="mx-auto" outlined>
                                <v-list-item three-line @click="openViewDialog(item)">
                                    <v-list-item-content>
                                        <div class="text-overline">
                                        </div>
                                        <v-list-item-title class="text-h6 mb-1">
                                            {{ item.name }}
                                        </v-list-item-title>
                                        <v-list-item-subtitle></v-list-item-subtitle>
                                    </v-list-item-content>
                                    <v-list-item-avatar tile size="80" color="grey"><img :src="item.image_path" alt="">
                                    </v-list-item-avatar>
                                </v-list-item>
                            </v-card>
                        </v-list-item-content>
                    </v-list-item>
                </v-col>
            </v-list-item-group>
        </v-card>
        <!-- ここまでコンポーネント -->
        <!-- アイテム詳細ダイアログ -->
        <v-dialog v-model="dialog_view" persistent max-width="500px" scrollable>
            <v-card outlined color="#EEEEEE">
                <v-card-text style="height: 600px;" class="m-3">
                    <v-list-item>
                        <v-list-item-content>
                            <v-list-item-title v-show="uneditable" class="text-h5">
                                {{ modalItem.name }}
                            </v-list-item-title>
                            <v-text-field v-model="update_name" required v-show="editable">
                            </v-text-field>
                            <div v-if="errors.name" class="error_validation">
                                <div v-for="e in errors.name">
                                    {{ e }}
                                </div>
                            </div>
                            <v-list-item-subtitle v-if="modalItem.category">
                                <!-- modalItemがnullの時にmodalItem.category.nameは表示できない=>modalItemに値がある時に表示 -->
                                {{ modalItem.category.name }}
                            </v-list-item-subtitle>
                            <v-list-item-avatar size="150" tile>
                                <v-img max-height="150" max-width="150" :src="modalItem.image_path" alt=""></v-img>
                            </v-list-item-avatar>
                            <v-divider class="mx-4 my-2"></v-divider>
                            <div class="my-3 text-subtitle-1">購入金額</div>
                            <v-list-item-title v-show="uneditable">
                                {{ modalItem.amount }}
                            </v-list-item-title>
                            <v-text-field type="number" v-model="update_amount" required v-show="editable">
                            </v-text-field>
                            <div v-if="errors.amount" class="error_validation">{{ errors.amount[0] }}</div>
                            <v-divider class="mx-4 my-2"></v-divider>
                            <div class="my-3 text-subtitle-1">収納場所</div>
                            <v-list-item-title v-show="uneditable">
                                {{ modalItem.place }}
                            </v-list-item-title>
                            <v-text-field v-model="update_place" required v-show="editable">
                            </v-text-field>
                            <div v-if="errors.place" class="error_validation">{{ errors.place[0] }}</div>
                            <v-divider class="mx-4 my-2"></v-divider>
                            <div class="my-3 text-subtitle-1">購入場所</div>
                            <v-list-item-title v-show="uneditable">
                                {{ modalItem.purchase_from }}
                            </v-list-item-title>
                            <v-text-field v-model="update_purchase_from" required v-show="editable">
                            </v-text-field>
                            <div v-if="errors.purchase_from" class="error_validation">{{ errors.purchase_from[0] }}
                            </div>
                            <v-divider class="mx-4 my-2"></v-divider>
                            <div class="my-3 text-subtitle-1">購入日</div>
                            <v-list-item-title v-show="uneditable">
                                {{ modalItem.purchase_date }}
                            </v-list-item-title>
                            <v-text-field type="date" v-model="update_purchase_date" required v-show="editable">
                            </v-text-field>
                            <v-divider class="mx-4 my-2"></v-divider>
                            <div class="my-3 text-subtitle-1">URL</div>
                            <v-list-item-title v-show="uneditable">
                                {{ modalItem.url }}
                            </v-list-item-title>
                            <v-text-field v-model="update_url" v-show="editable">
                            </v-text-field>
                            <div v-if="errors.url" class="error_validation">{{ errors.url[0] }}</div>
                            <v-divider class="mx-4 my-2"></v-divider>
                            <div class="my-3 text-subtitle-1">メモ</div>
                            <v-list-item-content v-show="uneditable">
                                {{ modalItem.memo }}
                            </v-list-item-content>
                            <v-textarea v-model="update_memo" :value="modalItem.memo" required v-show="editable">
                            </v-textarea>
                            <div v-if="errors.memo" class="error_validation">{{ errors.memo[0] }}</div>
                            <v-divider class="mx-4 my-2"></v-divider>
                        </v-list-item-content>
                    </v-list-item>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="gray" text @click.stop="dialog_view = false" v-show="uneditable">
                        閉じる
                    </v-btn>
                    <v-btn color="gray" text @click.stop="switchView()" v-show="uneditable">
                        編集
                    </v-btn>
                    <v-btn color="gray" text @click.stop="moveToDisuseItem(modalItem.id)" v-show="editable">
                        使わないものへ
                    </v-btn>
                    <v-btn color="gray" text @click.stop="deleteItem(modalItem.id)" v-show="editable">
                        削除
                    </v-btn>
                    <v-btn color="gray" text @click.stop="switchView()" v-show="editable">
                        戻る
                    </v-btn>
                    <v-btn color="gray" text @click.stop="editItem(modalItem.id)" v-show="editable">
                        保存
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- ここまでアイテム詳細ダイアログ -->
        <!-- アイテム追加ダイアログ -->
        <v-dialog v-model="dialog_newitem" persistent max-width="500px" scrollable>
            <v-card outlined color="#EEEEEE">
                <v-card-text style="height: 600px;" class="m-3">
                    <v-list-item>
                        <v-list-item-content>
                            <div class="my-3 text-h6">アイテム名</div>
                            <v-text-field v-model="newitem.name" required>
                            </v-text-field>
                            <div v-if="errors.name" class="error_validation">
                                <div v-for="e in errors.name">
                                    {{ e }}
                                </div>
                            </div>
                            <input type="file" @change="fileSelected">
                            <div v-if="errors.item_image" class="error_validation">
                                <div v-for="e in errors.item_image">
                                    {{ e }}
                                </div>
                            </div>
                            <div class="my-3 text-subtitle-1">購入金額</div>
                            <v-text-field type="number" v-model="newitem.amount">
                            </v-text-field>
                            <div v-if="errors.amount" class="error_validation">{{ errors.amount[0] }}</div>
                            <div class="my-3 text-subtitle-1">収納場所</div>
                            <v-text-field v-model="newitem.place" required>
                            </v-text-field>
                            <div v-if="errors.place" class="error_validation">{{ errors.place[0] }}</div>
                            <div class="my-3 text-subtitle-1">購入場所</div>
                            <v-text-field v-model="newitem.purchase_from" required>
                            </v-text-field>
                            <div v-if="errors.purchase_from" class="error_validation">{{ errors.purchase_from[0] }}
                            </div>
                            <div class="my-3 text-subtitle-1">購入日</div>
                            <v-text-field type="date" v-model="newitem.purchase_date">
                            </v-text-field>
                            <div class="my-3 text-subtitle-1">URL</div>
                            <v-text-field v-model="newitem.url">
                            </v-text-field>
                            <div v-if="errors.url" class="error_validation">{{ errors.url[0] }}</div>
                            <div class="my-3 text-subtitle-1">メモ</div>
                            <v-textarea v-model="newitem.memo" :value="modalItem.memo">
                            </v-textarea>
                            <div v-if="errors.memo" class="error_validation">{{ errors.memo[0] }}</div>
                            <v-divider class="mx-4 my-2"></v-divider>
                        </v-list-item-content>
                    </v-list-item>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="gray" text @click.stop="dialog_newitem = false">
                        閉じる
                    </v-btn>
                    <v-btn color="gray" text @click.stop="upload">
                        追加
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<style scoped>
.error_validation {
    background-color: transparent;
    color: red;
}
</style>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            items: [],
            current_category: {},
            newitem: {
                // 最初に定義しないとundefindが表示される
                name: '',
                item_image: '',
                amount: '',
                place: '',
                purchase_date: '',
                purchase_from: '',
                url: '',
                memo: '',
            },
            modalItem: {},
            modalItemId: '',
            modalItemText: '',
            // id: this.$route.params.id,
            dialog: false,
            dialog_view: false,
            dialog_edit: false,
            dialog_newitem: false,
            fileInfo: '',

            test: "test",

            // 更新するItem
            update_name: '',
            update_amount: '',
            update_place: '',
            update_purchase_from: '',
            update_purchase_date: '',
            update_disuse_month: '',
            update_url: '',
            update_memo: '',

            renderKey: 0,

            uneditable: true,
            editable: false,
            errors: {},
        }
    },
    // Item編集ダイアログのフォーム初期値を設定する
    watch: {
        editable: function () {
            this.update_name = this.modalItem.name;
            this.update_amount = this.modalItem.amount;
            this.update_place = this.modalItem.place;
            this.update_purchase_from = this.modalItem.purchase_from;
            this.update_purchase_date = this.modalItem.purchase_date;
            this.update_disuse_month = this.modalItem.disuse_month;
            this.update_url = this.modalItem.url;
            this.update_memo = this.modalItem.memo;
        },

        $route: function () {
            this.getItems();
            this.getCurrentCategory();
        }
    },
    methods: {
        getItems() {
            axios.get('api/ownitems/category/' + this.$route.params.id)
                .then((res) => {
                    this.items = res.data;
                });
        },
        getCurrentCategory() {
            axios.get('api/getcurrentcategory/' + this.$route.params.id)
                .then((res) => {
                    this.current_category = res.data;
                });
        },
        fileSelected(event) {
            this.fileInfo = event.target.files[0]
        },
        upload() {
            const formData = new FormData()
            formData.append('item_image', this.fileInfo)
            formData.append('name', this.newitem.name)
            formData.append('amount', this.newitem.amount)
            formData.append('place', this.newitem.place)
            formData.append('purchase_from', this.newitem.purchase_from)
            formData.append('purchase_date', this.newitem.purchase_date)
            formData.append('url', this.newitem.url)
            formData.append('memo', this.newitem.memo)
            axios
                .post("api/storeownitem/" + this.$route.params.id, formData)
                .then((res) => {
                    this.dialog_newitem = false;
                    this.getItems();
                })
                .catch((err) => {
                    this.errors = err.response.data.errors;
                });
        },
        openViewDialog(item) {
            this.modalItem = item;
            this.dialog_view = true;
        },
        switchView() {
            this.uneditable = !this.uneditable;
            this.editable = !this.editable;
            this.errors = {};
        },
        editItem(id) {
            axios
                .post("api/edititem/" + id, {
                    name: this.update_name,
                    amount: this.update_amount,
                    place: this.update_place,
                    purchase_from: this.update_purchase_from,
                    purchase_date: this.update_purchase_date,
                    disuse_month: this.update_disuse_month,
                    url: this.update_url,
                    memo: this.update_memo,
                })
                .then((res) => {
                    console.log(res);
                    // modalItemをデータベースと合わせる オブジェクトのプロパティの変更をVueは検出できないため、Object.assin()を使用
                    Object.assign(this.modalItem, {
                        name: this.update_name,
                        amount: this.update_amount,
                        place: this.update_place,
                        purchase_from: this.update_purchase_from,
                        purchase_date: this.update_purchase_date,
                        disuse_month: this.update_disuse_month,
                        url: this.update_url,
                        memo: this.update_memo,
                    });
                    this.dialog_view = false;
                    this.editable = false;
                    this.uneditable = true;
                })
                .catch((err) => {
                    this.errors = err.response.data.errors;
                });
        },
        deleteItem(id) {
            axios
                .delete("api/items/" + id)
                .then((res) => {
                    this.items = this.items.filter(item => item.id !== id);
                    this.dialog_view = false;
                    this.editable = false;
                    this.uneditable = true;
                })
                .catch((err) => {
                    alert(err.response.data.message);
                });
        },
        moveToDisuseItem(id) {
            axios
                .patch("api/items/todisuse/" + id)
                .then(() => {
                    this.modalItem.is_unnecessary = true;
                    this.getItems();
                })
        },
    },
    mounted() {
        this.getItems();
        this.getCurrentCategory();
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
