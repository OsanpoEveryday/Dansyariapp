<template>
    <div>
        <v-card min-height="70vh">
            <v-toolbar dark>
                <v-toolbar-title>持ちモノ</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn color="grey lighten-3" class="black--text" @click.stop="dialog_newitem = true">アイテム追加</v-btn>
            </v-toolbar>
            <v-list-item-group class="d-flex flex-wrap">
                <v-col v-for="item in items" :key="item.id" lg="3" md="4" sm="6" xs="12">
                    <!-- コンポーネントで分けるもしくはdialogを外出しして内容を切り替える -->
                    <v-list-item class="with">
                        <v-list-item-content>
                            <v-card class="mx-auto" outlined>
                                <v-list-item three-line @click="openViewDialog(item)">
                                    <v-list-item-content>
                                        <div class="text-overline mb-4">
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
                            <v-divider class="mx-4 my-2"></v-divider>
                            <div class="my-3 text-subtitle-1">収納場所</div>
                            <v-list-item-title v-show="uneditable">
                                {{ modalItem.place }}
                            </v-list-item-title>
                            <v-text-field v-model="update_place" required v-show="editable">
                            </v-text-field>
                            <v-divider class="mx-4 my-2"></v-divider>
                            <div class="my-3 text-subtitle-1">購入場所</div>
                            <v-list-item-title v-show="uneditable">
                                {{ modalItem.purchase_from }}
                            </v-list-item-title>
                            <v-text-field v-model="update_purchase_from" required v-show="editable">
                            </v-text-field>
                            <v-divider class="mx-4 my-2"></v-divider>
                            <div class="my-3 text-subtitle-1">購入日</div>
                            <v-list-item-title v-show="uneditable">
                                {{ modalItem.purchase_date }}
                            </v-list-item-title>
                            <v-text-field type="date" v-model="update_purchase_date" required v-show="editable">
                            </v-text-field>
                            <v-divider class="mx-4 my-2"></v-divider>
                            <div class="my-3 text-subtitle-1">いらないものに移行するまでの非使用期間</div>
                            <v-list-item-title v-show="uneditable">
                                {{ modalItem.disuse_month }}ヶ月
                            </v-list-item-title>
                            <v-text-field v-model="update_disuse_month" required v-show="editable">
                            </v-text-field>
                            <v-divider class="mx-4 my-2"></v-divider>
                            <div class="my-3 text-subtitle-1">URL</div>
                            <v-list-item-title v-show="uneditable">
                                {{ modalItem.url }}
                            </v-list-item-title>
                            <v-text-field v-model="update_url" v-show="editable">
                            </v-text-field>
                            <v-divider class="mx-4 my-2"></v-divider>
                            <div class="my-3 text-subtitle-1">メモ</div>
                            <v-list-item-content v-show="uneditable">
                                {{ modalItem.memo }}
                            </v-list-item-content>
                            <v-textarea v-model="update_memo" :value="modalItem.memo" required v-show="editable">
                            </v-textarea>
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
                            <input type="file" @change="fileSelected">
                            <div class="my-3 text-subtitle-1">購入金額</div>
                            <v-text-field type="number" v-model="newitem.amount">
                            </v-text-field>
                            <div class="my-3 text-subtitle-1">収納場所</div>
                            <v-text-field v-model="newitem.place" required>
                            </v-text-field>
                            <div class="my-3 text-subtitle-1">購入場所</div>
                            <v-text-field v-model="newitem.purchase_from" required>
                            </v-text-field>
                            <div class="my-3 text-subtitle-1">購入日</div>
                            <v-text-field type="date" v-model="newitem.purchase_date">
                            </v-text-field>
                            <div class="my-3 text-subtitle-1">いらないものに移行するまでの非使用期間（1〜24ヶ月）</div>
                            <v-text-field v-model="newitem.disuse_month">
                            </v-text-field>ヶ月
                            <div class="my-3 text-subtitle-1">URL</div>
                            <v-text-field v-model="newitem.url">
                            </v-text-field>
                            <div class="my-3 text-subtitle-1">メモ</div>
                            <v-textarea v-model="newitem.memo" :value="modalItem.memo">
                            </v-textarea>
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
        <!-- ここまでアイテム追加ダイアログ -->
        <!-- <v-dialog v-model="dialog_edit" persistent max-width="500px">
                    https://ja.vuejs.org/guide/components/attrs
                    <v-card>
                        <form @submit.prevent="">
                            <v-card-title>
                                <span class="text-h5">編集</span>
                            </v-card-title>
                            <v-card-text>
                                <v-container>
                                    <v-row>
                                        <v-col cols="12">
                                            <v-text-field v-model="update_name" label="アイテム名" required>
                                            </v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="gray" text @click.stop="dialog_edit = false">
                                    閉じる
                                </v-btn>
                                <v-btn color="gray" text @click="editItem(modalItemId)">
                                    編集
                                </v-btn>
                            </v-card-actions>
                        </form>
                    </v-card>
                </v-dialog> -->

        <!-- <v-dialog v-model="dialog" persistent max-width="600px">
            <template v-slot:activator="{ attrs }">
                常に表示しておくもの
                <v-btn color="gray" dark v-bind="attrs">
                    アイテム追加
                </v-btn> -->
        <!-- </template> -->
        <!-- <v-card>
                <form @submit.prevent="">
                    <v-card-title>
                        <span class="text-h5">アイテム追加</span>
                    </v-card-title>
                    <v-card-text>
                        <v-container>
                            <v-row>
                                <v-col cols="12">
                                    <v-text-field v-model="newitem.name" label="アイテム名" required>
                                    </v-text-field>
                                    <v-text-field v-model="newitem.disuse_month" label="非使用期間" required>
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
        </v-dialog> -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            items: [],
            newitem: {
                // 最初に定義しないとundefindが表示される
                name: '',
            },
            modalItem: {},
            modalItemId: '',
            modalItemText: '',
            id: this.$route.params.id,
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
    },
    methods: {
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
            formData.append('name', this.newitem.name)
            formData.append('amount', this.newitem.amount)
            formData.append('place', this.newitem.place)
            formData.append('purchase_from', this.newitem.purchase_from)
            formData.append('purchase_date', this.newitem.purchase_date)
            formData.append('disuse_month', this.newitem.disuse_month)
            formData.append('url', this.newitem.url)
            formData.append('memo', this.newitem.memo)
            axios
                .post("api/storeownitem/" + this.id, formData)
                .then((res) => {
                    console.log(res);
                    this.dialog_newitem = false;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        openViewDialog(item) {
            this.modalItem = item;
            this.dialog_view = true;
        },
        switchView() {
            this.uneditable = !this.uneditable;
            this.editable = !this.editable;
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
                    console.log(err);
                });
        }
        // openDialog(id) {
        //     this.dialog_edit = true;
        //     this.modalItemId = id;
        //     console.log(this.modalItemId);
        // },
        // editItem(id) {
        //     axios
        //         .post("api/edititem/" + id, {
        //             name: this.update_name,
        //         })
        //         .then((res) => {
        //             console.log(res);
        //             this.dialog = false;
        //         })
        //         .catch((err) => {
        //             console.log(err);
        //         });
        // },
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
