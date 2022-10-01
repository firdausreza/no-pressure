<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Pins
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="w-full flex justify-between p-4 sm:p-0">
                    <h1 class="text-xl">Create your pins</h1>
                    <button @click="createPins" class="px-4 py-2 bg-purple-500 text-white rounded-md hover:bg-purple-700">
                        Create
                    </button>
                </div>
                <div class="w-full flex flex-col mt-8 p-4 sm:p-0">
                    <!-- Insert Code here -->
                    <h1 v-if="pins.length === 0" class="text-xl font-bold text-center mt-8">Pins goes here...</h1>
                    <div v-else class="flex flex-col">
                        <!-- I made a component called PinTemplate.vue, you can find it on Components/Pins -->
                        <pin-template
                            v-for="(pin, index) in pins"
                            :key="pins.id" :index="index"
                            :pin="pin"
                            @delete-pin="deletePin"
                            @detect-validation="detectValidation"
                            :show-title-error="validator[index].isTitleInvalid"
                            :show-desc-error="validator[index].isDescInvalid"
                        />
                        <button @click.prevent="submitPins" class="px-4 py-2 bg-purple-500 text-white rounded-md hover:bg-purple-700 mt-4 w-max self-start cursor-pointer">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import PinTemplate from "@/Components/Pins/PinTemplate.vue";
import { Inertia } from "@inertiajs/inertia";

export default {
    setup() {

    },
    components: {
        AppLayout,
        Welcome,
        PinTemplate
    },
    data() {
        return {
            pins: [],
            isPinValid: false,
            validator: []
        }
    },
    methods: {
        createPins() {
            this.pins.push({
                user_id: this.$attrs.user.id,
                title: '',
                description: ''
            })
            this.validator.push({
                isTitleInvalid: false,
                isDescInvalid: false
            })
        },
        deletePin(idx) {
            // Simply filtering the pins array
            this.pins = this.pins.filter((item, index) => index !== idx)
            this.validator = this.validator.filter((item, index) => index !== idx)
        },
        // Handler for detect-validation emit events from PinTemplate components, with default object as params
        detectValidation(validate) {
            if (validate.ref === 'title') {
                this.validator[validate.index].isTitleInvalid = false
            }
            if (validate.ref === 'desc') {
                this.validator[validate.index].isDescInvalid = false
            }
        },
        // Validate pin data
        validatePin() {
            this.isPinValid = true // Validator on submit button clicked
            this.pins.forEach((item, index) => {
                if (item.title === '') {
                    this.isPinValid = false
                    this.validator[index].isTitleInvalid = true
                }
                if (item.description === '') {
                    this.isPinValid = false
                    this.validator[index].isDescInvalid = true
                }
            })
        },
        submitPins() {
            this.validatePin()
            if (this.isPinValid) Inertia.post('/pins/store', this.pins)
        }
    }
}
</script>
