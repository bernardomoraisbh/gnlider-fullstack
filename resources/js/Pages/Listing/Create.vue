<template>
    <form @submit.prevent="create">
        <div>
            <div>
                <label for="beds">Beds</label>
                <input id="beds" v-model.number="form.beds" type="text" />
                <div v-if="form.errors.beds">
                    {{ form.errors.beds }}
                </div>
            </div>

            <div>
                <label for="baths">Baths</label>
                <input id="baths" v-model.number="form.baths" type="text" />
                <div v-if="form.errors.baths">
                    {{ form.errors.baths }}
                </div>
            </div>

            <div>
                <label for="area">Area</label>
                <input id="area" v-model.number="form.area" type="text" />
                <div v-if="form.errors.area">
                    {{ form.errors.area }}
                </div>
            </div>

            <div>
                <label for="city">City</label>
                <input id="city" v-model="form.city" type="text" />
                <div v-if="form.errors.city">
                    {{ form.errors.city }}
                </div>
            </div>

            <div>
                <label for="postCode">Post Code</label>
                <input id="postCode" v-model="form.code" type="text" />
                <div v-if="form.errors.code">
                    {{ form.errors.code }}
                </div>
            </div>

            <div>
                <label for="street">Street</label>
                <input id="street" v-model="form.street" type="text" />
                <div v-if="form.errors.street">
                    {{ form.errors.street }}
                </div>
            </div>

            <div>
                <label for="street_nr">Street Nr</label>
                <input id="street_nr" v-model.number="form.street_nr" type="text" />
                <div v-if="form.errors.street_nr">
                    {{ form.errors.street_nr }}
                </div>
            </div>

            <div>
                <label for="price">Price</label>
                <input id="price" v-model.number="form.price" type="text" />
                <div v-if="form.errors.price">
                    {{ form.errors.price }}
                </div>
            </div>

            <div>
                <button type="submit">Create</button>
            </div>
        </div>
    </form>
</template>

<script setup>
import { reactive } from 'vue'
import { useForm } from "@inertiajs/vue3"

const form = useForm({
    beds: 0,
    baths: 0,
    area: 0,
    city: null,
    street: null,
    code: null,
    street_nr: null,
    price: 0,
})

function create() {
    form.post('/listing');
}
</script>

<style scoped>
label {
    margin-right: 2em;
}

div {
    padding: 2px
}
</style>
