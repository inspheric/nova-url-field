<template>
    <PanelItem :field="field">
        <template #value>
            <Url :field="field" :clickable="field.clickable"></Url>
        </template>
    </PanelItem>
</template>

<script>
import Url from './Url'

export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],

    components: {
      Url
    },
}
</script>
