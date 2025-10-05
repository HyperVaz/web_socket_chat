<template>
    <div class="w-1/2 mx-auto py-6">

        <div>
            <div class="mb-4">
                <input type="text" v-model="body" class="rounded-full border border-gray-400" placeholder="write a message">
            </div>
            <div class="mb-4">
                <a href="#" @click="store" class="rounded-lg block w-48 bg-sky-400 text-white text-center py-2">Send me</a>
            </div>
            <div v-if="messages.length > 0">
                <h3 class="pb-4">Messages</h3>
                <div class="text-sm pb-2 mb-4 border-b border-gray-300" v-for="message in messages">
                    <p>{{ message.id }}</p>
                    <p>{{ message.body }}</p>
                    <p class="text-right">{{ message.time }}</p>
                </div>
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
    methods:{
        store(){
            axios.post('/messages', {body: this.body})
                .then(res=>{
                    this.messages.unshift(res.data);
                    this.body = '';
                })
        }
    }
}
</script>

<style scoped>

</style>
