<template>
    <panel-item :field="field">
        <template slot="value">
            <url-field :field="field" :clickable="field.clickable"></url-field>
        </template>
    </panel-item>
</template>

<script>
import Url from './Url'

export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],

    components: {
        'url-field': Url
    }
}
</script>
