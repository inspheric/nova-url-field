<template>
    <component :is="component" :field="field" :clickable="field.clickableOnIndex"></component>
</template>

<script>
import Url from './Url'
import SocialUrl from './SocialUrl'

export default {
    props: ['resourceName', 'field'],

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
