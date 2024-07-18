<template>
    <v-app-bar app color="white" flat>
        <v-container class="py-0 fill-height">
            <v-avatar class="mr-10" color="grey darken-1" size="32"></v-avatar>
            <router-link v-bind:to=links.ownitems_link>
                <v-btn text>
                    持ちモノ
                </v-btn>
            </router-link>
            <router-link v-bind:to=links.wantitems_link>
                <v-btn text>
                    欲しいモノ
                </v-btn>
            </router-link>
            <router-link v-bind:to=links.disuseitems_link>
                <v-btn text>
                    使わなかったモノ
                </v-btn>
            </router-link>
            <router-link v-bind:to=links.select_link>
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
    data() {
        return {
            links: {
                ownitems_link: "",
                wantitems_link: "",
                disuseitems_link: "",
                select_link: "",
            },
        }
    },
    methods: {
        getLinks() {
            axios.get("api/getlinks")
                .then((res) => {
                    this.links = res.data;
                });
        },
        logout() {
            axios.post("api/logout")
                .then((res) => {
                    // this.$router.push('/login');
                    location.href = "/login";
                    console.log(res);
                }).catch((err) => {
                    console.log(err);
                })
        }
    },
    mounted() {
        this.getLinks();
    },
}
</script>
