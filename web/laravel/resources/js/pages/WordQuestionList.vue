<template>
  <div>
    <span>問題一覧画面</span>
    <div>
      <v-container>
        <v-simple-table>
          <thead>
            <tr>
              <th>id</th>
              <th>グループ</th>
              <th>日本語</th>
              <th>選択肢1</th>
              <th>選択肢2</th>
              <th>選択肢3</th>
              <th>正解の選択肢</th>
              <th>作成日時</th>
            </tr>
          </thead>
          <tbody>
            <template v-for="question in questions">
              <tr :key="question.id">
                <td>
                  <router-link :to="`/edit-word-question/${question.id}`">{{
                    question.id
                  }}</router-link>
                </td>
                <td>{{ question.group }}</td>
                <td>{{ question.japanese }}</td>
                <td>{{ question.choice1 }}</td>
                <td>{{ question.choice2 }}</td>
                <td>{{ question.choice3 }}</td>
                <td>{{ question.answer }}</td>
                <td>{{ question.created_at }}</td>
              </tr>
            </template>
          </tbody>
        </v-simple-table>
        <div class="text-center">
          <v-pagination
            v-model="page"
            :length="last_page"
            @input="fetch"
          ></v-pagination>
        </div>
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
      page: 1,
      last_page: 1,
    }
  },
  methods: {
    // 問題をとってくる
    async fetch(page) {
      const response = await axios.get(`/api/word-question-list`, {
        params: {
          page: parseInt(page),
        },
      })
      // エラーの処理
      if (response.status !== OK) {
        this.$store.commit('error/setCode', response.status)
        return false
      }
      // 成功の場合、問題の情報をプロパティに代入
      console.log(response.data)
      this.questions = response.data.data
      this.page = response.data.current_page
      this.last_page = response.data.last_page
      // URL変更
      let url = '/word-question-list?page=' + this.page
      window.history.pushState(null, null, url)
    },
  },
  created() {
    this.fetch(this.page)
  },
}
</script>
