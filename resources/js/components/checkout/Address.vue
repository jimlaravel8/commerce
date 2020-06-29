<template>
<div>
    <h2>Billing Address</h2>
    <v-container grid-list-xl fluid>
        <v-layout wrap v-if="user && user.shipping">
            <v-flex xs12 sm6>
                <v-text-field v-model="user.shipping.name" color="blue darken-2" label="Full name" required></v-text-field>
            </v-flex>
            <v-flex xs12 sm6>
                <v-text-field v-model="user.shipping.email" color="blue darken-2" label="Email" required></v-text-field>
            </v-flex>
            <v-flex xs12 sm6>
                <v-text-field v-model="user.shipping.street_address" color="blue darken-2" label="Address" required></v-text-field>
            </v-flex>
            <v-flex xs12 sm6>
                <v-text-field v-model="user.shipping.town" color="blue darken-2" label="City/Town" required></v-text-field>
            </v-flex>
            <v-flex xs12 sm6>
                <v-text-field v-model="user.shipping.country" color="blue darken-2" label="Country" required></v-text-field>
            </v-flex>
            <v-flex xs12 sm6>
                <v-text-field v-model="user.shipping.county" color="blue darken-2" label="County" required></v-text-field>
            </v-flex>
            <v-flex xs12 sm6>
                <v-text-field v-model="user.shipping.phone" color="blue darken-2" label="Phone" required></v-text-field>
            </v-flex>
            <v-flex xs12 sm6>
                <v-text-field v-model="user.shipping.postal_code" color="blue darken-2" label="Zip/Postcode" required></v-text-field>
            </v-flex>
            <!-- <v-btn text color="primary">Save address</v-btn> -->
        </v-layout>


        <v-layout wrap v-else>
            <v-flex xs12 sm6>
                <v-text-field v-model="form.name" color="blue darken-2" label="Full name" required></v-text-field>
            </v-flex>
            <v-flex xs12 sm6>
                <v-text-field v-model="form.email" color="blue darken-2" label="Email" required></v-text-field>
            </v-flex>
            <v-flex xs12 sm6>
                <v-text-field v-model="form.street_address" color="blue darken-2" label="Address" required></v-text-field>
            </v-flex>
            <v-flex xs12 sm6>
                <v-text-field v-model="form.town" color="blue darken-2" label="City/Town" required></v-text-field>
            </v-flex>
            <v-flex xs12 sm6>
                <v-text-field v-model="form.country" color="blue darken-2" label="Country" required></v-text-field>
            </v-flex>
            <v-flex xs12 sm6>
                <v-text-field v-model="form.county" color="blue darken-2" label="County" required></v-text-field>
            </v-flex>
            <v-flex xs12 sm6>
                <v-text-field v-model="form.phone" color="blue darken-2" label="Phone" required></v-text-field>
            </v-flex>
            <v-flex xs12 sm6>
                <v-text-field v-model="form.postal_code" color="blue darken-2" label="Zip/Postcode" required></v-text-field>
            </v-flex>
        </v-layout>
    </v-container>
</div>
</template>

<script>
export default {
    props: ['user', 'form'],
    data() {
        return {

        }
    },


}
</script>

<style>

</style>
