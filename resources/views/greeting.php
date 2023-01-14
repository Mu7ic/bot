<html>

<head>
    <title>Set Webhooks</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.0/css/bulma.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.14/dist/vue.js"></script>
</head>

<body>
<div class="container">
    <div id="app" class="section">
        <form :action="set_webhook" method="post" enctype="multipart/form-data">
            <label class="label">Enter your Token</label>
            <p class="control">
                <input class="input" type="text" v-model="token" />
            </p>
            <label class="label">Enter your Host</label>
            <p class="control">
                <input class="input" type="text" v-model="host" />
            </p>
            <label class="label">Enter your Port</label>
            <p class="control">
                <input class="input" type="text" v-model="port" />
            </p>

            <input type="hidden" name="url" v-model="bot_url">
            <br/>
            <label class="label">Maximum Connections?</label>
            <p style="color:blue">{{ get_webhook_info }}</p>
            <br/>
            <div class="control is-grouped">
                <p class="control">
                    <button class="button is-primary" name="submit">Set Webhook</button>
                </p>
                <br/>
                <p class="control">
                    <a :href="get_webhook_info" target="_blank" class="button is-info">Get Webhook Info</a>
                </p>
            </div>
    </div>
</div>
<script>
    new Vue({
            el: '#app',
            data: {
                token: '5854202283:AAHGlrPZ75dPIQaTD8sqriXtKw7izVjWnWQ',
                port: 88,
                host: 'https://botmig.ru',
            },
            computed: {
                get_webhook_info: function () {
                    return 'https://api.telegram.org/bot' + this.token + '/getwebhookinfo'
                },
                set_webhook: function () {
                    return 'https://api.telegram.org/bot' + this.token + '/setwebhook'
                },
                bot_url: function () {
                    return 'https://' + this.host + ':' + this.port + '/' + this.token
                }
            }
        }

    )
</script>
</body>

</html>
