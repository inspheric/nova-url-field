<template>
        <div>
            <a :href="field.value"
                :title="field.value"
                v-if="field.value && clickable"
                class="cursor-pointer dim no-underline text-primary inline-flex items-center"
                target="_blank"
            >
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="fill-current mr-2"
                    :style="{ color: '#'+field.icon.hex }"
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    role="presentation"
                    v-html="field.icon.svg"></svg>

                <span>
                    {{ field.icon.title }}
                </span>
            </a>
            <span v-else-if="field.value">{{ field.value }}</span>
            <span v-else>&mdash;</span>
        </div>
</template>

<script>

export default {
    props: ['resource', 'resourceName', 'resourceId', 'field', 'clickable'],
}
</script>
