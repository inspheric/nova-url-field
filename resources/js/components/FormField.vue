<template>
  <DefaultField :field="currentField" :errors="errors" :show-help-text="showHelpText">
    <template #field>
      <input v-bind="extraAttributes" class="w-full form-control form-input form-input-bordered"
        @input="handleChange" :value="value" :id="currentField.uniqueKey" :dusk="field.attribute"
        :disabled="currentlyIsReadonly" :list="`${field.attribute}-list`" />

      <datalist v-if="currentField.suggestions && currentField.suggestions.length > 0" :id="`${field.attribute}-list`">
        <option :key="suggestion" v-for="suggestion in currentField.suggestions" :value="suggestion" />
      </datalist>
    </template>
  </DefaultField>
</template>

<script>
import { DependentFormField, HandlesValidationErrors } from 'laravel-nova'

export default {
  mixins: [HandlesValidationErrors, DependentFormField],

  computed: {
    defaultAttributes() {
      return {
        type: this.currentField.type || 'url',
        placeholder: this.currentField.placeholder || this.field.name,
        class: this.errorClasses,
      }
    },

    extraAttributes() {
      const attrs = this.field.extraAttributes

      return {
        // Leave the default attributes even though we can now specify
        // whatever attributes we like because the old number field still
        // uses the old field attributes
        ...this.defaultAttributes,
        ...attrs,
      }
    },
  },
}
</script>
