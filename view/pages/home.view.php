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
                <div class="inputs">
                    <input type="text" name="name" id="name" placeholder="Name*">
                    <input type="text" name="email" id="email" placeholder="Email*">
                </div>
                <div class="inputs">
                    <textarea name="comment" id="comment" placeholder="Comment*"></textarea>
                </div>
                <div class="inputs">
                    <button type="submit" name="submit" id="submit">Submit</button>
                </div>
                
            </form>
        </div>
        <div class="commentContainer">
            <template v-for="(e, index) in response">
                <div class="comment">
                    <span class="username">{{e.username}} </span>
                    <span class="timestamp">{{e.time}}</span>
                    <p>{{e.comment}}</p>
                    <button v-on:click="showForm(e.id)" class="replyButton">Reply</button>
                    <div class="container">
                    <div :id="'form' + e.id" class="hidden">
                        <form method="post" :id="e.id" @submit.prevent="onReplySubmit(e.id)" action="reply.php">
                        <div class="inputs">
                            <input type="text" name="replyName" id="replyName" placeholder="Name*">
                            <input type="text" name="replyEmail" id="replyEmail" placeholder="Email*">
                        </div>
                        <div class="inputs">
                            <textarea name="replyComment" id="replyComment" placeholder="Comment*"></textarea>
                        </div>
                            <input type="hidden" name="commentid" id="commentid" :value="e.id">
                            <div class="inputs">
                            <button type="submit" name="submitReply" id="submitReply">Submit</button>
                            </div>
                        </form>
                    </div>
                    </div>

                    <template v-for="(k, index) in replies">
                        <template v-if="e.id == k.commentid">
                            <div class="replies">
                                <span class="username">{{k.username}}</span>
                                <span class="timestamp">{{k.time}}</span>
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
.hidden { display: none; }
.visible { display: block; }

html, body {
    background: url(https://wallpaperbat.com/img/289216-free-download-simple-bright-colorful-wallpaper-colorful-desktop.jpg);
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
    width: 100%;
    overflow-x: hidden;
}

.container {    
    display: flex;
    flex-flow: column wrap;
    justify-content: center;
    align-items: center;
    margin-top: 2em;
}

.inputs {
    display: flex;
    justify-content: center;
}

.inputs > input, textarea {
    border-radius: 4px;
    border: solid 1px black;
    margin: 0.3em;
    outline: none;
    background-color: rgba(0, 0, 0, 0);
}

#comment, #replyComment {
    width: 100%;
    height: 7em;
}

#submit {
    background-color: rgba(0, 0, 0, 0);
    outline: none;
    border-radius: 4px;
    border: solid 1px black;
    padding: 0.3em;
}

#submitReply, .replyButton {
    background-color: rgba(0, 0, 0, 0);
    outline: none;
    border: solid 1px black;
    border-radius: 4px;
    padding: 0.4em;
}

.commentContainer {
    margin-top: 3em;
    display: flex;
    flex-flow: column;
    align-items: center;

}

.comment {
    margin-top: 2em;
    margin-bottom: 2em;
    background-color: rgba(0, 0, 0, 0);
    border: solid 2px black;
    padding: 2em;
    border-radius: 5%;
    width: 40%;
}

.replies {
    background-color: white;
    padding: 1em;
    margin-top: 1em;
    border-radius: 5%;
    border: solid 2px black;
    margin-left: 4em;
}

.username {
    font-weight: bold;
    font-size: 1.2em;
}

.timestamp {
    font-size: 0.9em;
    color: gray;
}
</style>