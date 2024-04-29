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
                                        <router-link v-bind:to="{ name: 'ownitems', params: { id: category.id } }">
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
                    <v-sheet min-height="70vh" rounded="lg">
                        test
                    </v-sheet>
                </v-col>
            </v-row>
        </v-container>
    </v-main>
</template>

<script>
export default {
    data() {
        return {
            categories: [],
        }
    },
    methods: {
        getCategories() {
            axios.get('/api/categories')
                .then((res) => {
                    this.categories = res.data;
                });
        },
    },
    mounted() {
        this.getCategories();
    },
}
</script>
