<template>
  <div>
    <span>問題を解く</span>
    <div>
      <v-container>
        <h3>次の日本語に合う英語をえらんで、「解答」ボタンをおしてね。</h3>
        <p>{{ answer }}</p>
      </v-container>
    </div>
  </div>
</template>

<script>
import { OK } from '../util'

export default {
  data() {
    return {
      questions: [],
      answer: '',
      id: this.$route.params.id,
    }
  },
  // computed: {
  //   answer() {
  //     return this.questions[0].answer
  //   },
  // },
  methods: {
    // 問題をとってくる
    async fetch() {
      const response = await axios.get(`/api/answer-word-question/${this.id}`)
      // エラーの処理
      if (response.status !== OK) {
        this.$store.commit('error/setCode', response.status)
        return false
      }
      // 成功の場合、問題の情報をプロパティに代入
      console.log(response.data)
      this.questions = response.data
      this.answer = response.data[0].answer
    },
  },
  created() {
    this.fetch()
  },
}
</script>
