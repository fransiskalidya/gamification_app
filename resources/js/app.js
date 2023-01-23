require('./bootstrap');

import Vue from 'vue/dist/vue.js';

new Vue({
    el: "#interactive",
    data(){
      return {
          content: {
              title: null,
              id: null,
          },
          questions:[],
          user_answers:[],
      }
    },
    methods:{
        selectContent(id, title){
            this.content = {
                title: title,
                id: id
            };

            fetch('/api/questions/get_question_answers/'+id).then(data => data.json()).then(data => {
                this.questions = data.data
            })
        },
        changeAnswer(qIndex, value){
            this.user_answers[qIndex] = value
            console.log(this.user_answers)
        },
        checkAnswer(uid, content_id){
            let user_id = uid;
            fetch("/api/questions/check_answer/",{
                method: "POST",
                body: JSON.stringify({
                    user_id: user_id,
                    content_id: content_id,
                    answer_ids: this.user_answers,
                })
            }).then(res => res.json()).then(data => {
                if(data.success){
                    window.location.reload();
                }
            })
        }
    },
    mounted() {
        console.log("hallo");
    }
})

var editor = new Quill("#qeditor");
