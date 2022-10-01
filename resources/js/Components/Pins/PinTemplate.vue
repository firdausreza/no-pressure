<template>
    <div class="flex flex-col justify-start">
        <h1 class="text-xl font-bold">Pins {{ index }}</h1>
        <hr class="my-4 border-gray-500">
        <div class="input-wrapper w-full flex flex-col justify-start"> <!-- The input-wrapper class has nothing to do with specific styling -->
            <label for="title" class="text-lg font-bold">Title</label>
            <input @input="detectValidation('title')" type="text" id="title" class="rounded-md mt-2" v-model.trim="pin.title">
            <p v-show="showTitleError" class="text-red-500 font-bold text-md mt-2">Title should not be empty.</p>
        </div>
        <div class="input-wrapper w-full flex flex-col justify-start mt-4">
            <label for="description" class="text-lg font-bold">Description</label>
            <textarea @input="detectValidation('desc')" id="description" rows="5" class="rounded-md mt-2" v-model.trim="pin.description"></textarea>
            <p v-show="showDescError" class="text-red-500 font-bold text-md mt-2">Description should not be empty.</p>
        </div>
        <button @click="deletePin" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-700 self-end mt-4">Delete</button>
    </div>
</template>

<script>
export default {
    name: "PinTemplate",
    props: {
        index: {
            type: Number,
            default: 0
        },
        pin: {
            type: Object,
            default: {}
        },
        showTitleError: {
            type: Boolean,
            default: false
        },
        showDescError: {
            type: Boolean,
            default: false
        }
    },
    methods: {
        deletePin() {
            this.$emit('delete-pin', this.index)
        },
        detectValidation(inputRef) {
            this.$emit('detect-validation', { index: this.index, ref: inputRef })
        }
    }
}
</script>

