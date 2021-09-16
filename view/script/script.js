new Vue({
    el: '#app',
    data: {
        response: '',
        replies: '',
        err: ''
    },
    methods: {
        onSubmit: function () {
            axios({
                method: 'post',
                url: 'comment',
                data: new FormData(document.getElementById("commentForm")),
                config: {
                    headers: { 'Content-Type': 'multipart/form-data' }
                }
            })
                .then((data) => { this.err = data.data })
                .then(setTimeout(() => this.fetchData(), 1000))
                .catch(function (response) { console.log('error', response); });
        },
        onReplySubmit: function (e) {
            let show = document.getElementById('form'+e)
            show.className = 'hidden';
            axios({
                method: 'post',
                url: 'reply',
                data: new FormData(document.getElementById(e)),
                config: {
                    headers: { 'Content-Type': 'multipart/form-data' }
                }
            })
                .then((data) => { this.err = data.data })
                .then(setTimeout(() => this.fetchReplies(), 1000))
                .catch(function (response) { console.log('error', response); });

        },
        fetchData: function () {
            fetch('api')
                .then(response => response.json())
                .then((data) => {
                    this.response = data;
                })
        },
        fetchReplies: function () {
            axios.get('repliesapi').then((response) => {
                this.replies = response.data;
            }).catch((error) => {
                console.log(error);
            });
        },
        showForm: function(e) {
            let show = document.getElementById('form'+e)
            show.className = 'visible';
        }
    },
    created() {
        this.fetchData();
        this.fetchReplies();
    },
});




