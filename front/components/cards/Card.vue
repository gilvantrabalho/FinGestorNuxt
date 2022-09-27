<template>
    <div class="card shadow p-3 rounded border-0">
        <div class="card-header bg-white">
            <slot name="header"></slot>
        </div>
        <div class="card-body">
            <slot name="body"></slot>
        </div>
    </div>
</template>

<script>
export default {
    name: 'card'
}
</script>