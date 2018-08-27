<template>
    <url-field :field="field" :clickable="field.clickableOnIndex"></url-field>
</template>

<script>
import Url from './Url'

export default {
    props: ['resourceName', 'field'],

    components: {
        'url-field': Url
    }
}
</script>
