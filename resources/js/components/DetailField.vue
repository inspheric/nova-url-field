<template>
  <PanelItem :index="index" :field="field">
    <template #value>
      <UrlField :field="field" :clickable="field.clickable" />
    </template>
  </PanelItem>
</template>

<script>
import UrlField from './UrlField'

export default {
  props: ['index', 'resource', 'resourceName', 'resourceId', 'field'],

  components: {
    UrlField
  }
}
</script>
