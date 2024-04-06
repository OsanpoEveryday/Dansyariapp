<template>
    <v-main>
        <v-container>
            <v-card :loading="loading" class="mx-auto my-12" max-width="374">
                <template v-slot:loader="{ isActive }">
                    <v-progress-linear :active="isActive" color="deep-purple" height="4" indeterminate></v-progress-linear>
                </template>

                <v-img cover height="250" :src="selected_item.image_path"></v-img>

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
        </v-container>
    </v-main>
</template>

<script>
export default {
    data: () => ({
        loading: false,
        selection: 1,
        items: [],
        n: 0,
    }),
    computed: {
        selected_item() {
            return this.items[this.n]
        }
    },
    methods: {
        getItems() {
            axios.get('/api/home')
                .then((res) => {
                    this.items = res.data;
                    // console.log(this.items);
                });
        },
        recordTime() {
            console.log(this.items);
            console.log(this.selected_item);
            axios.post('/api/home', {
                item_id: this.selected_item.id
            }).then(() => {
                if (this.n <= this.items.length) {
                    this.n++;
                } else {
                    // nはitemの数を超えない
                    console.log("error");
                };
            }).catch((err) => {
                console.log(err);
            });
        },
        recordNull() {
            axios.post('/api/home/null', {
                item_id: this.selected_item.id
            }).then(() => {
                if (this.n <= this.items.length) {
                    this.n++;
                } else {
                    console.log("error");
                };
            }).catch((err) => {
                console.log(err);
            });
        },
    },
    mounted() {
        this.getItems();
    },
}
</script>
