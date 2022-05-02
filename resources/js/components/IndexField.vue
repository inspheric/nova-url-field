<template>
    <div class="max-w-xs">
        <Url :field="field" :clickable="field.clickableOnIndex"></Url>
    </div>
</template>

<script>
import Url from './Url'

export default {
    props: ['resourceName', 'field'],

    components: {
      Url
    }
}
</script>
