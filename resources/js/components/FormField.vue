<template>
    <default-field :field="field" :errors="errors">
        <template slot="field">
            <input
                class="w-full form-control form-input form-input-bordered"
                :id="field.attribute"
                :dusk="field.attribute"
                v-model="value"
                v-bind="extraAttributes"
                :disabled="isReadonly"
            />
        </template>
    </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
    mixins: [HandlesValidationErrors, FormField],

    computed: {
        defaultAttributes() {
            return {
                type: this.field.type || 'url',
                placeholder: this.field.placeholder || this.field.name,
                class: this.errorClasses,
            }
        },

        extraAttributes() {
            const attrs = this.field.extraAttributes

            return {
                ...this.defaultAttributes,
                ...attrs,
            }
        },
    },
}
</script>
