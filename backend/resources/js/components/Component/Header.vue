<template>
    <v-app-bar app color="white" flat>
        <v-container class="py-0 fill-height">
            <v-avatar class="mr-10" color="grey darken-1" size="32"></v-avatar>
            <router-link v-bind:to="{ name: 'ownitems', params: { id: 1 } }">
                <v-btn text>
                    持ちモノ
                </v-btn>
            </router-link>
            <router-link v-bind:to="{ name: 'wantitems', params: { id: 1 } }">
                <v-btn text>
                    欲しいモノ
                </v-btn>
            </router-link>
            <router-link v-bind:to="{ name: 'disuseitems', params: { id: 1 } }">
                <v-btn text>
                    使わなかったモノ
                </v-btn>
            </router-link>
            <router-link v-bind:to="{ name: 'select', params: { id: 1 } }">
                <v-btn text>
                    仕分け
                </v-btn>
            </router-link>
            <v-spacer></v-spacer>
            <v-btn text @click="logout()">Logout</v-btn>
            <v-responsive max-width="260">
                <v-text-field dense flat hide-details rounded solo-inverted></v-text-field>
            </v-responsive>
        </v-container>
    </v-app-bar>
</template>

<script>
import axios from 'axios';

export default {
    data: () => ({
    }),
    methods: {
        logout() {
            axios.post("api/logout")
                .then((res) => {
                    this.$router.push('/login');
                    console.log(res);
                }).catch((err) => {
                    console.log(err);
                })
        }
    },
}
</script>
