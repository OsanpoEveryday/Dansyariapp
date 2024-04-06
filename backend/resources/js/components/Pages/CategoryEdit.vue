<template>
    <v-container>
        <h1>カテゴリ編集</h1>

        <v-list-item three-line>
            <v-list-item-content>
                <div class="text-overline mb-1">
                    カテゴリ名
                </div>
                <v-list-item-title class="text-h6 mb-1">
                    {{ category.name }}
                </v-list-item-title>
            </v-list-item-content>
        </v-list-item>

        <v-dialog v-model="category_dialog" persistent max-width="600px">
            <template v-slot:activator="{ on, attrs }">
                <v-btn color="gray" dark v-bind="attrs" v-on="on">
                    編集
                </v-btn>
            </template>
            <v-card>
                <v-card-title>
                    <span class="text-h5">カテゴリ編集</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="12">
                                <form>
                                    <v-text-field v-model="category.name" label="カテゴリ名">
                                    </v-text-field>
                                </form>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="category_dialog = false">
                        閉じる
                    </v-btn>
                    <v-btn color="blue darken-1" text @click="updateCategory">
                        保存
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>



        <v-list-item v-for="rule in rules" :key="rule.id">
            <v-list-item-content>
                <v-col>
                    <v-list-item-title>
                        {{ rule.text }}
                    </v-list-item-title>
                </v-col>
                <v-col>
                    <v-btn color="gray" dark @click.stop="openDialog(rule.id)">
                        編集
                    </v-btn>
                    <!-- <button color="gray" dark @click="openDialog" :data-sample='rule.id'>
                        編集
                    </button> -->
                </v-col>
            </v-list-item-content>
        </v-list-item>
        <v-dialog v-model="rule_dialog" persistent max-width="600px">
            <v-card>
                <v-card-title>
                    <span class="text-h5">ルール編集</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="12">
                                <form>
                                    <v-text-field v-model="selected_rule.text" label="ルール名">
                                    </v-text-field>
                                </form>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="rule_dialog = false">
                        閉じる
                    </v-btn>
                    <v-btn color="blue darken-1" text @click="updateRule">
                        保存
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            category: {},
            rules: [],
            rule: {},
            selected_rule: {},
            category_dialog: false,
            rule_dialog: false,
        };
    },
    methods: {
        openDialog(ruleId) {
            console.log(ruleId);
            const rule = this.rules.find(r => r.id === ruleId);
            this.selected_rule = rule;
            this.rule_dialog = true;
        },

        getCategoryAndRules() {
            axios.get('/api/categoryedit/' + this.$route.params.categoryId)
                .then((res) => {
                    this.category = res.data;
                    this.rules = this.category.rules;
                });
        },
        updateCategory() {
            axios.put('api/categories/' + this.category.id, {
                name: this.category.name
            }).then((res) => {
                this.category = res.data;
                this.$emit('catchCategory', this.category)
                this.category_dialog = false;
                console.log(this.category);
            });
        },
        updateRule() {
            axios.put('api/categoryedit/rules/' + this.selected_rule.id, {
                text: this.selected_rule.text
            }).then((res) => {
                console.log(this.category)
                this.rule_dialog = false;
            });
        }
    },
    mounted() {
        this.getCategoryAndRules();
    },
}
</script>
