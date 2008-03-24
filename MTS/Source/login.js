
    

// LOGIN SIDEBAR THINGY // 
// And add to SideBarOptions: <<login>> 
// Add to SideBarOptions: <<slider chkSliderOptionsPanel LoginPanel 'login »' 'Login to MiniTiddlyServer>>
// Add a Tiddler:  as a shadow tiddler

function adminLoggedIn() {};
function adminLoggedOut() {};

var regexp = /<<saveChanges>>/i;
config.shadowTiddlers.SideBarOptions = config.shadowTiddlers.SideBarOptions.replace(regexp, "<<mtslogin>> <<saveChanges>>");
config.shadowTiddlers.MTSLoginPanel = '<<option txtUserName>>\n<<option txtPassword password>>\n<<mtsLoginSubmit>>';//

// Add txtPassword option type // 
config.options.txtPassword = ""; 

// Add possibility of password // 2.1 and 2.2 compatible!
var oldOptionHandler = config.macros.option.handler;
config.macros.option.handler = function (place, macroName, params) {
    oldOptionHandler.apply(this,arguments);
    
     if (params[1] == "password") {
        try { // Doesn't work in IE // 
            place.lastChild.setAttribute("type","password");
        }
        catch (e) { }
    }
}


config.macros.mtslogin = {
	accessKey: "L"
};

//<<slider chkSliderOptionsPanel LoginPanel 'login »' 'Login to MiniTiddlyServer>>

// This only allows one instance!! // Should allow more than 1 (but then, how to do the editing... hmm)
config.macros.mtslogin.tops = [];
config.macros.mtslogin.logins = [];
config.macros.mtslogin.logouts = [];
config.macros.mtslogin.createLogin = function (topPanel) {
    this.label = "mts login Â»";
    this.prompt = "Login to MiniTiddlyServer";
    var panel = createTiddlyElement(topPanel,"div");
    config.macros.mtslogin.logins.push(panel);
    config.macros.slider.handler(panel, "slider", ["chkSliderMtsLoginPanel","MTSLoginPanel",this.label,this.prompt]);
}
config.macros.mtslogin.createLogout = function (topPanel) {
    this.label = config.options.txtUserName + ": logout";
    this.prompt = "logout of MTS";
    var panel = createTiddlyElement(topPanel,"div");
    config.macros.mtslogin.logouts.push(panel);
    createTiddlyButton(panel,this.label,this.prompt,this.onClick,null,null,this.accessKey);
}
config.macros.mtslogin.handler = function(place)
{
    var topPanel = createTiddlyElement(place,"div");
    config.macros.mtslogin.tops.push(topPanel);
    
    if ( loggedIn ) 
        config.macros.mtslogin.createLogout(topPanel);
    
    else
        config.macros.mtslogin.createLogin(topPanel);
};

// LOGOUT // 
config.macros.mtslogin.onClick = function(e)
{
    loginControl.logout();
    
    // LOGOUT HERE // 
	return false;
};

config.macros.mtsLoginSubmit = {
    label:"Login",
    prompt:"Submit Login Information to Server"
};

config.macros.mtsLoginSubmit.handler = function(place)
{
    createTiddlyButton(place,this.label,this.prompt,this.onClick,null,null,null);
};

// LOGIN // Logging it in, baby
config.macros.mtsLoginSubmit.onClick = function(e)
{
    // LOGIN HERE // 
        loginControl.login();
        
	return false;
};


function setLoggedIn() {
    // SET LOGGED IN FOR ALL OF THEM // 
    loggedIn = true;
    singleMessage("Login Successful");
    
    // CHANGE ALL LOGINS TO LOGOUTS // 
    var logins = config.macros.mtslogin.logins;
    var tops = config.macros.mtslogin.tops;
    
    for ( var i=0; i < logins.length; i++)
        logins[i].parentNode.removeChild(logins[i]);
    
    config.macros.mtslogin.logins = [];
    
    for ( var i=0; i < tops.length; i++ ) 
        config.macros.mtslogin.createLogout(tops[i]);
}

function setLoggedOut() {
    // SET LOGGED OUT FOR ALL OF THEM // 
    loggedIn = false;
    isAdmin = false;
    adminLoggedOut();
    singleMessage("Logout Successful");
    
    // CHANGE ALL LOGOUTS TO LOGINS // 
    var logouts = config.macros.mtslogin.logouts;
    var tops = config.macros.mtslogin.tops;
    
    for ( var i=0; i < logouts.length; i++)  {
        logouts[i].parentNode.removeChild(logouts[i]);
    }
    
    config.macros.mtslogin.logouts = [];
    
    for ( var i=0; i < tops.length; i++ )  {
        config.macros.mtslogin.createLogin(tops[i]);
    }
}


// LOGIN FUNCTIONS // 
    function login() {
        singleMessage("Logging in...");
        
        //~ // Hide Box // 
        //~ hideLogin();
        //~ hideHelp();
        
        var user = config.options.txtUserName;
        var password = config.options.txtPassword;
        
        var params = new Object();
        params.action = "login";
        params.get_user = user;
        params.get_pass = password;
        
        var loginRequest = new AjaxRequest(loginpath, this.loginReturn, params);
        loginRequest.send();
    }
    
    function loginReturn (response) {
    
        if (response.login) {
            setLoggedIn();
            isAdmin = response.admin;
            if ( isAdmin ) 
                {
                adminLoggedIn();
                mtsToggleBackstage();
                }
            config.options.chkHttpReadOnly = false;
            readOnly = false;
            refreshDisplay();
        }
        
        else {
            displayMessage("Login Failed:");
        }
    }
	
	var firstBackstage = true;
    
    function mtsToggleBackstage()
    {
		if (firstBackstage)
		{
			firstBackstage = false;
			return;
		}
	
	    if (backstage && backstage.area==null)
	        backstage.init();
    }
    
    old_mtslogin_restart = restart;
    restart = function()
    {
        old_mtslogin_restart.apply(this,arguments);
        if (loggedIn)
            {
            config.options.chkHttpReadOnly = false;
            readOnly = false;
            refreshDisplay();
            if (isAdmin)
              {
              mtsToggleBackstage();
              }
            }
    }

    //do we need refresh display here?
    //what about backstage?

    function logout() {
        // Send Logout Request // 
        singleMessage("Logging out...");
    
        var logoutRequest = new AjaxRequest(loginpath, this.logoutReturn, {action:"logout"});
        logoutRequest.send();
    }
    
    function logoutReturn(response) {

        if (response.logout) {
            setLoggedOut();
            readOnly = config.options.chkHttpReadOnly;
        }
        
        else {
            displayMessage("Logout Failed");
        }
    }
    
    


function LoginControl () {
    
}

LoginControl.prototype.login = login;
LoginControl.prototype.loginReturn = loginReturn;
LoginControl.prototype.logout = logout;
LoginControl.prototype.logoutReturn = logoutReturn;

var loginControl = new LoginControl();


  