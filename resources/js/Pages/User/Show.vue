<template>
    <div class="max-w-md mx-auto p-6">
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
            <!-- Заголовок карточки -->
            <div class="text-center mb-2">
                <h2 class="text-xl font-bold text-gray-800">Профиль пользователя</h2>
            </div>

            <!-- Информация о пользователе -->
            <div class="mb-6 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-100">
                <div class="flex items-center justify-center space-x-3">
                    <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold text-sm">{{ user.name.charAt(0).toUpperCase() }}</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Пользователь:</p>
                        <p class="text-lg font-semibold text-gray-800">{{ user.name }}</p>
                    </div>
                </div>
            </div>

            <!-- Кнопка отправки лайка -->
            <div class="mb-6 text-center">
                <button
                    @click.prevent="sendLike"
                    class="bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white font-semibold py-3 px-8 rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center mx-auto"
                >
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"/>
                    </svg>
                    Отправить лайк
                </button>
            </div>

            <!-- Блок с уведомлением о лайке -->
            <div
                v-if="like_str"
                class="p-4 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl animate-pulse"
            >
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <p class="text-green-800 font-medium">{{ like_str }}</p>
                </div>
            </div>

            <!-- Декоративный элемент -->
            <div class="mt-6 pt-4 border-t border-gray-100 text-center">
                <p class="text-xs text-gray-500">Нажмите кнопку, чтобы отправить лайк</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Show",
    props: [
        'user'
    ],
    data(){
        return{
            like_str: ''
        }
    },
    created() {
        window.Echo.private(`send_like_${this.$page.props.auth.user.id}`)
            .listen('.send_like', res=>{
                this.like_str = res.like_str;
            })
    },
    methods: {
        sendLike() {
            axios.post(`/users/${this.user.id}`, {from_id: this.$page.props.auth.user.id}).then(res=>{
                this.like_str = res.data.like_str
            })
        },
    }

}
</script>



<style scoped>

</style>
