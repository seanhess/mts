config.shadowTiddlers.MTSLoginPanel += '\nAutoLogin:<<option chkAutoLogin>>';
config.options.chkAutoLogin = false;

config.macros.mtsAutoLogin = {};
config.macros.mtsAutoLogin.init = function () {
    if ( loggedIn == false && config.options.txtUserName != "UserName" && config.options.chkAutoLogin )
        login();
}