<template>
    <panel-item :field="field">
        <template slot="value">
            <component :is="component" :field="field" :clickable="field.clickable"></component>
        </template>
    </panel-item>
</template>

<script>
import Url from './Url'
import SocialUrl from './SocialUrl'

export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],

    components: {
        'url-field': Url,
        'social-url-field': SocialUrl,
    },

    computed: {
        component() {
            if (this.field.social) {
                return 'social-url-field';
            }

            return 'url-field';
        }
    }
}
</script>
