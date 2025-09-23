<template>
    <div class="w-1/2 mx-auto py-6">
        <div v-if="messages.length > 0">
            <h3>Messages</h3>
            <div v-for="message in messages">
                <p>{{ message.id }}</p>
                <p>{{ message.body }}</p>
                <p>{{ message.time }}</p>
            </div>
        </div>
        <div>
            <div class="mb-4">
                <input type="text" v-model="body" class="rounded-full border border-gray-400" placeholder="write a message">
            </div>
            <div class="mb-4">
                <a href="#" class="rounded-lg block w-48 bg-sky-400 text-white text-center py-2">Send me</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Index",
    props: [
        'messages'
    ],
    data(){
        return{
            body: ''
        }
    },
}
</script>

<style scoped>

</style>
