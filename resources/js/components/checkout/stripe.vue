<template>
<div class="form-group">
    <div class='form-row'>
        <div class='col-xs-12 form-group card required' style="border: none ;">
            <label class='control-label'>Card Number</label>
            <input autocomplete='off' class='form-control card-number' size='20' type='text' v-model="card_data.card_no">
        </div>
    </div>
    <div class='form-row'>
        <div class='col-xs-4 form-group cvc required'>
            <label class='control-label'>CVV</label>
            <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text' v-model="card_data.cvvNumber">
        </div>
        <div class='col-xs-4 form-group expiration required'>
            <label class='control-label'>Expiration</label>
            <input class='form-control card-expiry-month' placeholder='MM' size='4' type='text' v-model="card_data.ccExpiryMonth">
        </div>
        <div class='col-xs-4 form-group expiration required'>
            <label class='control-label'> </label>
            <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text' v-model="card_data.ccExpiryYear">
            <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='hidden' v-model="card_data.amount" value="3">
        </div>
    </div>
    <div class='form-row'>
        <div class='col-md-12' style="margin-left:-10px;">
            <div class='form-control total btn btn-primary'>
                Total:
                <span class='amount'>${{ cart_total }}</span>
            </div>
        </div>
    </div>
    <div class='form-row'>
        <div class='col-md-12 form-group'>
            <button class='form-control btn btn-success submit-button' @click="stripe_pay">Pay »</button>
        </div>
    </div>
</div>
</template>

<script>
import {
    mapState
} from 'vuex'
export default {
    props: ['account', 'user', 'form'],
    data() {
        return {
            card_data: {
                card_no: null,
                cvvNumber: null,
                ccExpiryMonth: null,
                ccExpiryYear: null,
                amount: 3,
            }
        }
    },
    methods: {
        stripe_pay() {

            // var payload = {
            //     model: 'order',
            //     data: this.account,
            // }
            // this.$store.dispatch('postItems', payload)

            var payload = {
                model: 'postPaymentStripe',
                data: this.card_data
            }
            // var payload = {
            //     model: 'postPaymentStripe',
            //     data: {
            //         card_data: this.card_data,
            //         account: this.account,
            //         form: this.form,
            //     },
            // }
            this.$store.dispatch('postItems', payload).then((response) => {

                var payload = {
                    model: 'place_order',
                    data: {
                        card_data: this.card_data,
                        account: this.account,
                        form: this.form,
                    },
                }
                this.$store.dispatch('postItems', payload)
            })
        },
    },
    computed: {
        ...mapState(['cart_total'])
    },
}
</script>

<style scoped>
.form-control {
    border: 1px solid #dad5d5 !important;
}
</style>
