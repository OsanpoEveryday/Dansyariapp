<template>
    <div>
        <v-list-item-group class="d-flex flex-wrap">
            <!-- ブレークポイント設定 -->
            <v-col v-for="disuse_item in disuse_items" :key="disuse_item.id" lg="3" md="4" sm="6" xs="12">
                <v-list-item class="with">
                    <v-list-item-content>
                        <v-card class="mx-auto" outlined>
                            <v-list-item three-line>
                                <v-list-item-content>
                                    <div class="text-overline mb-4">

                                    </div>
                                    <v-list-item-title class="text-h6 mb-1">

                                        {{ disuse_item.name }}

                                    </v-list-item-title>
                                    <v-list-item-subtitle></v-list-item-subtitle>
                                </v-list-item-content>

                                <v-list-item-avatar tile size="80" color="grey"><img :src="disuse_item.image_path" alt="">
                                </v-list-item-avatar>
                            </v-list-item>
                            <v-card-actions>
                                <v-btn outlined rounded text @click="deleteItem(disuse_item.id)">
                                    削除
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
                                    <v-text-field v-model="disuse_item.name" label="アイテム名" required>
                                    </v-text-field>
                                    <v-text-field v-model="disuse_item.disuse_month" label="非使用期間" required>
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
                        <!-- <v-btn color="gray" text @click="upload">
                            追加
                        </v-btn> -->
                    </v-card-actions>
                </form>
            </v-card>
        </v-dialog>

    </div>
</template>

<script>
export default {
    props: ['category'],
    data() {
        return {
            disuse_items: [],
            disuse_item: {},
            id: this.$route.params.id,
            dialog: false,
            fileInfo: '',
            // image_path: this.want.image_path
        }
    },
    methods: {
        getItems() {
            axios.get('api/disuseitems/category/' + this.id)
                .then((res) => {
                    this.disuse_items = res.data;
                    console.log("got");
                });
        },
        fileSelected(event) {
            this.fileInfo = event.target.files[0]
        },
        deleteItem(id) {
            axios.delete('api/items/' + id).then((res) => {
                console.log(res);
                this.disuse_items.splice(id, 1)
            });
        },
    },
    mounted() {
        this.getItems();
    },
    beforeRouteUpdate(to, from, next) {
        const id = to.params.id;
        axios.get('api/disuseitems/category/' + id)
            .then((res) => {
                this.disuse_items = res.data;
            });
        next()
    },

}
</script>
