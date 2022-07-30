<template>
  <UrlField :field="field" :clickable="field.clickable" />
</template>

<script>
import UrlField from './UrlField'

export default {
  props: ['resourceName', 'field'],

  components: {
    UrlField
  }
}
</script>
