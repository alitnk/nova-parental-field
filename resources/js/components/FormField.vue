<template>
<default-field :field="field" :errors="errors" :show-help-text="showHelpText">
    <template slot="field">
      <select-control
        :id="field.attribute"
        :dusk="field.attribute"
        @change="handleChange"
        :value="this.value"
        class="w-full form-control form-select"
        :class="errorClasses"
        :options="field.options"
        :disabled="isReadonly"
      >
        <option value="" selected :disabled="!field.nullable">
          {{ placeholder }}
        </option>
      </select-control>
    </template>
  </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
  mixins: [FormField, HandlesValidationErrors],

  props: ['resourceName', 'resourceId', 'field'],

  methods: {
    /*
     * Set the initial, internal value for the field.
     */
    setInitialValue() {
      this.value = this.field.value || ''
    },

    /**
     * Fill the given FormData object with the field's internal value.
     */
    fill(formData) {
      formData.append(this.field.attribute, this.value || '')
    },
  },
}
</script>
