<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="icon" href="">
    <title>RSS Reader</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
</head>
<body>
<noscript>
    <strong>We're sorry but you need JavaScript enabled to use this app. Please enable it to continue.</strong>
</noscript>
<div id="app">
    <div class="header notification has-text-centered">
        <h1>RSS Reader</h1>
    </div>
    <br><br><br><br><br>
    <div class="container">
        <div class="columns">
            <div class="column is-8 is-offset-2">

                <div id="newFeed">
                    <div class="content"><blockquote><strong>Setup a Feed</strong></blockquote></div>
                    <form>
                        <div class="field">
                            <label class="label">Feed Name</label>
                            <div class="control">
                                <input class="input" v-model="newFeedName" name="name" type="text" placeholder="Feed Name" />
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Feed URL</label>
                            <div class="control">
                                <input class="input" v-model="newFeedURL" name="url" type="text" placeholder="Feed URL" />
                            </div>
                        </div>
                        <br>
                        <div class="field">
                            <div class="control">
                                <button class="button save-button is-fullwidth" @click.prevent="addFeed" type="submit">Add Feed</button>
                            </div>
                        </div>
                    </form>
                </div>

                <br><br>

                <div id="selectFeed">
                    <div class="content"><blockquote><strong>Select a Feed to Read, Edit or Delete</strong></blockquote></div>
                    <form>
                        <div class="field force-fullwidth has-addons">
                            <p class="selectBox control">
                                <span class="select">
                                    <select v-model="selectedFeedID" @change="changeFeed()">
                                        <option v-for="feed in feeds" :value="feed.id">{{ feed.name }}</option>
                                    </select>
                                </span>
                            </p>
                            <p class="editButton control">
                                <button class="button save-button is-fullwidth" @click.prevent="isModalActive = true">Edit Feed</button>
                            </p>
                            <p class="deleteButton control">
                                <button class="button save-button is-fullwidth" @click.prevent="deleteFeed()">Delete Feed</button>
                            </p>
                        </div>
                    </form>
                </div>

                <div v-if="feedContent" class="feedContent">
                    <br><hr><br>



                    <br><hr><br>
                </div>

            </div>
        </div>
    </div>

    <div :class="['modal', {'is-active': isModalActive}]">
        <div class="modal-background" @click="isModalActive = false"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Edit Feed</p>
            </header>
            <section class="modal-card-body">

                <div v-if="currentFeed">
                    <form method="POST">
                        <div class="field">
                            <label class="label">Feed Name</label>
                            <div class="control">
                                <input class="input" v-model="currentFeed.name" name="name" type="text" placeholder="Feed Name" />
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Feed URL</label>
                            <div class="control">
                                <input class="input" v-model="currentFeed.url" name="url" type="text" placeholder="Feed URL" />
                            </div>
                        </div>
                        <br>
                        <div class="field">
                            <div class="control">
                                <button class="button save-button is-fullwidth" @click.prevent="editFeed" type="submit">Edit Feed</button>
                            </div>
                        </div>
                    </form>
                </div>

            </section>
            <footer class="modal-card-foot">
                <button class="button" @click="isModalActive = false">Close</button>
            </footer>
        </div>
        <button class="modal-close is-large" aria-label="close" @click="isModalActive = false"></button>
    </div>

    <div class="status-bar notification has-text-centered">
        <p v-if="currentFeed">Currently Viewing : {{ currentFeed.name }}</p>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.5.1/vue-resource.min.js"></script>
<script>
    Vue.http.options.emulateJSON = true;
    new Vue({
        el: '#app',
        data: {
            newFeedName: '',
            newFeedURL: '',
            feeds: [],
            selectedFeedID: null,
            currentFeed: null,
            isModalActive: false,
            feedContent: null
        },
        methods: {
            getFeeds() {
                this.$http.get('/feeds').then((response) => {
                    this.feeds = response.body
                }, error => {
                    console.log(error)
                })
            },
            changeFeed() {
                this.feeds.forEach((feed) => {
                    if (feed.id == this.selectedFeedID) {
                        this.currentFeed = feed
                    }
                })
            },
            addFeed() {
                let data = {
                    name: this.newFeedName,
                    url: this.newFeedURL
                }
                this.$http.post('/feeds', data).then((response) => {
                    this.newFeedName = ''
                    this.newFeedURL = ''
                    this.getFeeds()
                }, error => {
                    console.log(error)
                })
            },
            editFeed() {
                let data = {
                    name: this.currentFeed.name,
                    url: this.currentFeed.url
                }
                this.$http.put('/feed?id='+this.currentFeed.id, data).then((response) => {
                    this.getFeeds()
                    this.isModalActive = false
                }, error => {
                    console.log(error)
                })
            },
            deleteFeed() {
                this.$http.delete('/feed?id='+this.currentFeed.id).then((response) => {
                    this.currentFeed = null
                    this.getFeeds()
                }, error => {
                    console.log(error)
                })
            }
        },
        created() {
            this.getFeeds()
        }
    });
</script>

<style>
    html{
        height:100%;
    }
    body{
        min-height: 100%;
    }
    .header{
        border-radius: 0;
        background-color: #B61D4F;
        color:white;
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 10;
    }
    .status-bar{
        border-radius: 0;
        background-color: #575757;
        color:white;
        position: fixed;
        width: 100%;
        bottom: 0;
    }
    .save-button{
        background-color: #B61D4F;
        color:white;
    }
    .container{
        padding-left:10px;
        padding-right:10px;
    }
    .tag:not(body).is-danger-muted{
        background-color: #B61D4F;
        color:white;
    }
    .force-fullwidth, .force-fullwidth span, .force-fullwidth select {
        width: 100% !important;
    }
    .selectBox{
        width: 50% !important;
    }
    .editButton{
        width: 25% !important;
    }
    .deleteButton{
        width: 25% !important;
    }
</style>
</body>
</html>