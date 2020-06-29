<template>
<div>
    <h2>Select Payment Method</h2>
    <v-container grid-list-xl fluid>
        <v-layout wrap>
            <v-radio-group v-model="account.payment">
                <v-radio label="Cash On Delivery" value="Cash On Delivery"></v-radio>
                <v-radio label="Stripe" value="Stripe"></v-radio>
            </v-radio-group>
            <!-- <myStripe v-if="account.payment == 'Stripe'"/> -->
        </v-layout>
    </v-container>
</div>
</template>

<script>
// import myStripe from './stripe'
export default {
    props: ['user', 'account'],
    components: {
        // myStripe,
    },
}
</script>

<style>

</style>
