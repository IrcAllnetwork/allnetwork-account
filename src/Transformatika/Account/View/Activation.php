{{header}}
<div class="ui container" style="padding-top: 40px;">
    <div class="ui three columns stackable grid">
        <div class="column"></div>
        <div class="column">
            <div style="text-align:center">
                <img src="<?php echo BASE_URL;?>img/logo.png" style="width:120px;height:auto;margin:5px auto;"/>
            </div>
            <h1 class="ui center aligned header" style="margin-bottom:40px;">
                Activate your account
                <div class="sub header">
                    Setting up your basic profile
                </div>
            </h1>
            <form class="ui form" method="post" action="javascript:void()" onsubmit="activate(event);">
                <input type="hidden" id="code" value="<?php echo $code;?>"/>
                <div class="field">
                    <label for="firstName">User Name:</label>
                    <div class="ui input">
                        <input id="userName" type="text" required/>
                    </div>
                </div>
                <div class="field">
                    <label for="firstName">First Name:</label>
                    <div class="ui input">
                        <input id="firstName" type="text" required/>
                    </div>
                </div>
                <div class="field">
                    <label for="lastName">Last Name:</label>
                    <div class="ui input">
                        <input id="lastName" type="text" required/>
                    </div>
                </div>
                <div class="field">
                    <label for="password">Password:</label>
                    <div class="ui input">
                        <input id="password" type="password" required/>
                    </div>
                </div>
                <div class="field">
                    <div class="ui checkbox">
                        <input type="checkbox" id="agreement" value="y" checked="checked" required/>
                        <label class="hidden" for="agreement">I agree with Transformatika Term of Services</label>
                    </div>
                </div>
                <div style="text-align: center;padding-top:20px;">
                    <button class="ui large primary button">Submit</button>
                </div>
            </form>
        </div>
        <div class="column"></div>
    </div>
</div>
<script type="text/javascript">
    function activate(event) {
        console.log(event);
        event.defaultPrevented = true;
        $.ajax({
            url: '<?php echo BASE_URL;?>do-activate',
            type: 'post',
            data: {
                code: $('#code').val(),
                firstName: $('#firstName').val(),
                lastName: $('#lastName').val(),
                password: $('#password').val(),
                userName: $('#userName').val()
            },
            success: function(res){
                if (res.error) {
                    $.growl.error({
                        message: res.msg
                    });
                } else {
                    window.location.href = '<?php echo BASE_URL;?>my-account';
                }
            }
        });
    }
</script>
{{footer}}
