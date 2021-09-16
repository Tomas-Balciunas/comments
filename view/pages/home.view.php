<!DOCTYPE html>
<html>
<?php require "view/_partials/head.view.php"; ?>

<body>
    <div id="app">
        <template v-for="e in err">
            <p>{{e}}</p>
        </template>
        <div class="container">
            <form method="post" id="commentForm" @submit.prevent="onSubmit" action="comment.php">
                <input type="text" name="name" id="name" placeholder="Name">
                <input type="text" name="email" id="email" placeholder="Email">
                <textarea name="comment" id="comment" placeholder="Comment"></textarea>
                <button type="submit" name="submit" id="submit">Submit</button>
            </form>
        </div>
        <div class="commentContainer">
            <template v-for="(e, index) in response">
                <div class="comment">
                    <span>{{e.username}} </span>
                    <span>{{e.time}}</span>
                    <p>{{e.comment}}</p>
                    <button v-on:click="showForm(e.id)">reply</button>
            
                    <div :id="'form' + e.id" class="hidden">
                        <form method="post" :id="e.id" @submit.prevent="onReplySubmit(e.id)" action="reply.php">
                            <input type="text" name="replyName" id="replyName" placeholder="Name">
                            <input type="text" name="replyEmail" id="replyEmail" placeholder="Email">
                            <textarea name="replyComment" id="replyComment" placeholder="Comment"></textarea>
                            <input type="hidden" name="commentID" id="commentID" :value="e.id">
                            <button type="submit" name="submitReply" id="submitReply">Submit</button>
                        </form>
                    </div>

                    <template v-for="(k, index) in replies">
                        <template v-if="e.id == k.commentID">
                            <div class="replies">
                                <span>{{k.username}}</span>
                                <span>{{k.time}}</span>
                                <p>{{k.comment}}</p>
                            </div>
                        </template>
                    </template>
                </div>

            </template>
        </div>
    </div>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="module" src="view/script/script.js"></script>
</body>

</html>
<style>
.comment {
    border: solid 1px black;
    padding: 0.5em;
}

.replies {
    border: solid 1px green;
    padding: 0.5em;
}

.hidden {
    display: none;
}
.visible {
    display: block;
}
</style>