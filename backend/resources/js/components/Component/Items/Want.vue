<template>
    <div>
        <v-list-item-group class="d-flex flex-wrap">
            <!-- ブレークポイント設定 -->
            <v-col v-for="want in wants" :key="want.id" lg="3" md="4" sm="6" xs="12">
                <v-list-item class="with">
                    <v-list-item-content>
                        <v-card class="mx-auto" outlined>
                            <v-list-item three-line>
                                <v-list-item-content>
                                    <div class="text-overline mb-4">

                                    </div>
                                    <v-list-item-title class="text-h6 mb-1">

                                        {{ want.name }}

                                    </v-list-item-title>
                                    <v-list-item-subtitle></v-list-item-subtitle>
                                </v-list-item-content>

                                <v-list-item-avatar tile size="80" color="grey"><img :src="want.image_path" alt="">
                                </v-list-item-avatar>
                            </v-list-item>
                            <v-card-actions>
                                <v-btn outlined rounded text>
                                    Button
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
                                    <v-text-field v-model="want.name" label="アイテム名" required>
                                    </v-text-field>
                                    <v-text-field v-model="want.disuse_month" label="非使用期間" required>
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
</template>

<script>
export default {
    props: ['category'],
    data() {
        return {
            wants: [],
            want: {},
            id: this.$route.params.id,
            dialog: false,
            fileInfo: '',
            // image_path: this.want.image_path
        }
    },
    methods: {
        getWants() {
            axios.get('api/wantitems/category/' + this.id)
                .then((res) => {
                    this.wants = res.data;
                    console.log("items got");
                });
        },
        fileSelected(event) {
            this.fileInfo = event.target.files[0]
        },
        upload() {
            const formData = new FormData()
            formData.append('item_image', this.fileInfo)
            formData.append('name', this.want.name)
            formData.append('disuse_month', this.want.disuse_month)
            axios
                .post("api/storewantitem/" + this.id, formData)
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
        console.log("mounted");
        this.getWants();
    },
    beforeRouteUpdate(to, from, next) {
        const id = to.params.id;
        axios.get('api/wantitems/category/' + id)
            .then((res) => {
                this.wants = res.data;
            });
        next()
    },

}
</script>
