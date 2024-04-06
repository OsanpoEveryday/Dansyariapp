<template>
    <v-app id="inspire">

        <v-main class="grey lighten-3">
            <v-container>
                <v-row>
                    <v-col cols="2">
                        <v-sheet rounded="lg">

                        </v-sheet>
                    </v-col>

                    <v-col>
                        <v-sheet min-height="70vh" rounded="lg">
                            <v-col>
                                <h1>Rules</h1>
                                <v-list-item class="with" v-for="category in categories" :key="category.id">
                                    <div v-for="rule in category.rules">{{ rule.text }}</div>
                                    <v-list-item-content>
                                        <v-card class="mx-auto" outlined>
                                            <v-list-item three-line>
                                                <v-list-item-content>
                                                    <div class="text-overline mb-4">

                                                    </div>
                                                    <v-list-item-title class="text-h6 mb-1">

                                                        {{ category.name }}

                                                    </v-list-item-title>
                                                    <v-list-item-subtitle>
                                                        <!-- {{ rule.text }} -->
                                                    </v-list-item-subtitle>
                                                </v-list-item-content>

                                            </v-list-item>
                                            <v-card-actions>
                                                <v-dialog v-model="dialog" persistent max-width="600px">
                                                    <template v-slot:activator="{ on, attrs }">
                                                        <v-btn color="gray" dark v-bind="attrs" v-on="on">
                                                            追加
                                                        </v-btn>
                                                    </template>
                                                    <v-card>
                                                        <form @submit.prevent="submit">
                                                            <v-card-title>
                                                                <span class="text-h5">ルール追加</span>
                                                            </v-card-title>
                                                            <v-card-text>
                                                                <v-container>
                                                                    <v-row>
                                                                        <v-col cols="12">
                                                                            <v-text-field label="ルール" required>
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
                                            </v-card-actions>
                                        </v-card>
                                    </v-list-item-content>
                                </v-list-item>
                            </v-col>
                        </v-sheet>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
export default {
    data() {
        return {
            categories: [],
            rules: [],
            dialog: false,
        };
    },
    methods: {
        getAllRules() {
            axios.get('/api/rules')
                .then((res) => {
                    this.categories = res.data;
                    console.log(this.categories)
                    for (let j = 0; j < this.categories.length; j++) {
                        for (let k = 0; k < this.categories[j].rules.length; k++) {
                            this.rules.push(this.categories[j].rules[k])
                        }
                    }
                    console.log(this.rules);
                });
        },
        getRules(i) {
            const list = this.rules.filter(rule => rule.category_id == i);
            console.log("finished");
        }


    },
    mounted() {
        this.getAllRules();
        this.getRules(1);
    },
}
</script>
