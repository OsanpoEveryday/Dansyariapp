<template>
    <div>
        <Header></Header>
        <v-sheet min-height="70vh" rounded="lg">
            <!-- ブレークポイント設定 -->
            <template v-if="$route.path.includes('ownitems/category')">
                <Own></Own>
                <!-- ルートパラメータが変更しても画面が再描画されない。カテゴリの選択によってOwnコンポーネントを再描画するため、keyでルートパラメータに変更があるたびに更新するようにする -->
            </template>

            <template v-if="$route.path.includes('wantitems/category')">
                <Want></Want>
            </template>

            <template v-if="$route.path.includes('disuseitems/category')">
                <Disuse></Disuse>
            </template>
            <!-- <v-list-item class="with">
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
                                        <v-list-item-avatar tile size="80" color="grey"><img :src="item.image_path" alt="">
                                        </v-list-item-avatar>
                                    </v-list-item>
                                    <v-card-actions>
                                        <v-btn outlined rounded text>
                                            編集
                                        </v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-list-item-content>
                        </v-list-item> -->
            <!-- <v-dialog v-model="dialog" persistent max-width="600px">
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
                    </v-card>
                </v-dialog> -->
        </v-sheet>
    </div>
</template>

<script>
import Header from '../Header.vue';
import Own from './Own.vue';
import Want from './Want.vue';
import Disuse from './Disuse.vue';

export default {
    components: {
        Header,
        Own,
        Want,
        Disuse,
    },
    mounted() {
    },
}

</script>
