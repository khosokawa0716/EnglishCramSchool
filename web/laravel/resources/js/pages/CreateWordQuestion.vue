<template>
  <div>
    <span>問題作成画面</span>
    <div v-if="page === 1">
      <v-form @submit.prevent="createWordQuestion">
        <v-text-field
          v-model="createWordQuestionForm.group"
          :rules="groupRules"
          :counter="20"
          label="グループ"
          required
        ></v-text-field>
        <v-text-field
          v-model="createWordQuestionForm.japanese"
          :rules="japaneseRules"
          :counter="20"
          label="日本語"
          required
        ></v-text-field>
        <v-text-field
          v-model="createWordQuestionForm.choice1"
          :rules="choicesRules"
          :counter="30"
          label="選択肢1"
          required
        ></v-text-field>
        <v-text-field
          v-model="createWordQuestionForm.choice2"
          :rules="choicesRules"
          :counter="30"
          label="選択肢2"
          required
        ></v-text-field>
        <v-text-field
          v-model="createWordQuestionForm.choice3"
          :rules="choicesRules"
          :counter="30"
          label="選択肢3"
          required
        ></v-text-field>
      </v-form>
      <v-container class="px-0" fluid>
        <h5>正解の選択肢</h5>
        <v-radio-group v-model="createWordQuestionForm.answer">
          <v-radio
            v-for="n in 3"
            :key="n"
            :label="`選択肢 ${n}`"
            :value="n"
          ></v-radio>
        </v-radio-group>
      </v-container>
      <v-btn type="submit" color="secondary" @click="clearForm">クリア</v-btn>
      <v-btn type="submit" color="primary" @click="nextPage">次へ</v-btn>
    </div>
    <div v-else>
      <div v-if="registerErrors" class="errors">
        <ul v-if="registerErrors.group">
          <li v-for="msg in registerErrors.group" :key="msg">
            {{ msg }}
          </li>
        </ul>
        <ul v-if="registerErrors.japanese">
          <li v-for="msg in registerErrors.japanese" :key="msg">
            {{ msg }}
          </li>
        </ul>
        <ul v-if="registerErrors.choice1">
          <li v-for="msg in registerErrors.choice1" :key="msg">
            {{ msg }}
          </li>
        </ul>
        <ul v-if="registerErrors.choice2">
          <li v-for="msg in registerErrors.choice2" :key="msg">
            {{ msg }}
          </li>
        </ul>
        <ul v-if="registerErrors.choice3">
          <li v-for="msg in registerErrors.choice3" :key="msg">
            {{ msg }}
          </li>
        </ul>
        <ul v-if="registerErrors.answer">
          <li v-for="msg in registerErrors.choice1" :key="msg">
            {{ msg }}
          </li>
        </ul>
      </div>
      <v-container>
        <dl>
          <dt>グループ</dt>
          <dd>{{ createWordQuestionForm.group }}</dd>
          <dt>日本語</dt>
          <dd>{{ createWordQuestionForm.japanese }}</dd>
          <dt>選択肢1</dt>
          <dd>{{ createWordQuestionForm.choice1 }}</dd>
          <dt>選択肢2</dt>
          <dd>{{ createWordQuestionForm.choice2 }}</dd>
          <dt>選択肢3</dt>
          <dd>{{ createWordQuestionForm.choice3 }}</dd>
          <dt>正解の選択肢</dt>
          <dd>{{ createWordQuestionForm.answer }}</dd>
        </dl>
        <v-btn type="submit" color="secondary" @click="prePage">戻る</v-btn>
        <v-btn type="submit" color="primary" @click="register">登録</v-btn>
      </v-container>
    </div>
  </div>
</template>

<script>
import { OK, UNPROCESSABLE_ENTITY } from '../util'

export default {
  data() {
    return {
      page: 1,
      createWordQuestionForm: {
        group: '',
        japanese: '',
        choice1: '',
        choice2: '',
        choice3: '',
        answer: 1,
      },
      groupRules: [
        (v) => !!v || 'グループは必ず入れてください',
        (v) => v.length <= 20 || 'グループは２０もじ以下で入れてください',
      ],
      japaneseRules: [
        (v) => !!v || '日本語は必ず入れてください',
        (v) => v.length <= 20 || '日本語は２０もじ以下で入れてください',
      ],
      choicesRules: [
        (v) => !!v || '選択肢３つは必ず入れてください',
        (v) => v.length <= 30 || '選択肢は３０もじ以下で入れてください',
      ],
      registerErrors: null,
    }
  },
  methods: {
    async register() {
      // 入力内容で、WordQuestionController@createを起動
      // 返却されたオブジェクトをresponseに代入
      const response = await axios.post(
        '/api/create-word-question/register',
        this.createWordQuestionForm
      )
      // バリデーションエラー
      if (response.status === UNPROCESSABLE_ENTITY) {
        this.registerErrors = response.data.errors
        return false
      } else if (response.status !== OK) {
        // その他のエラー
        this.$store.commit('error/setCode', response.status)
        return false
      }
      this.$router.push('/')
    },
    clearError() {
      this.$store.commit('error/setCode', null)
    },
    nextPage() {
      this.page = 2
    },
    prePage() {
      this.page = 1
    },
    clearForm() {
      this.createWordQuestionForm.group = ''
      this.createWordQuestionForm.japanese = ''
      this.createWordQuestionForm.choice1 = ''
      this.createWordQuestionForm.choice2 = ''
      this.createWordQuestionForm.choice3 = ''
      this.createWordQuestionForm.answer = ''
    },
  },
  created() {
    this.clearError()
  },
}
</script>
