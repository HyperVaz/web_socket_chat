<template>
    <div class="max-w-2xl mx-auto py-8 px-4">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <!-- Заголовок -->
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Чат</h2>

            <!-- Форма отправки -->
            <div class="mb-8">
                <div class="mb-4">
                    <input
                        type="text"
                        v-model="body"
                        class="w-full px-4 py-3 rounded-full border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200 shadow-sm"
                        placeholder="Напишите сообщение..."
                    >
                </div>
                <div class="flex justify-center">
                    <button
                        @click="store"
                        class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-3 px-8 rounded-full shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200"
                    >
                        Отправить
                    </button>
                </div>
            </div>

            <!-- Список сообщений -->
            <div v-if="messages.length > 0" class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4 pb-2 border-b border-gray-100">Сообщения</h3>
                <div class="space-y-4 max-h-96 overflow-y-auto pr-2">
                    <div
                        v-for="message in messages"
                        :key="message.id"
                        class="bg-gray-50 rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-200 border border-gray-100"
                    >
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-xs font-medium text-blue-600 bg-blue-50 px-2 py-1 rounded">
                                ID: {{ message.id }}
                            </span>
                            <span class="text-xs text-gray-500">{{ message.time }}</span>
                        </div>
                        <p class="text-gray-800 leading-relaxed">{{ message.body }}</p>
                    </div>
                </div>
            </div>

            <!-- Состояние пустого списка -->
            <div v-else class="text-center py-8">
                <div class="text-gray-400 mb-2">
                    <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </div>
                <p class="text-gray-500">Сообщений пока нет</p>
                <p class="text-sm text-gray-400 mt-1">Напишите первое сообщение!</p>
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
    created(){
        window.Echo.channel('store_message').listen('.store_message', res =>{
            this.messages.unshift(res.message);
        })
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
