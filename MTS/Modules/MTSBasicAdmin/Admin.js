



// Create a shadow Tiddler // 
config.shadowTiddlers.MTSAdminPanel = "|bgcolor(white):<<mtsadduser>>|bgcolor(white):<<mtscreatewiki>>|\n|bgcolor(white):<<mtsuserlist>>| |\n|bgcolor(white):<<mtsrevert>>|bgcolor(white):<<mtsbackup>>|";

// Create a handle for the backstage //

if ( config.backstageTasks ) {

    config.backstageTasks.push("MTSAdmin");
    config.tasks.MTSAdmin = {
        text: "MTS Admin", 
        tooltip: "MTS Controls and Admin Panel", 
        content: ""
    }

    //config.backstageTasks = ["save", "tidy","sync","importTask","copy","tweak","plugins"];


  //  for (var i in config.backstageTasks) {
  //      if (config.backstageTasks[i] == "save")
  //          config.backstageTasks.splice(i,6);
  //  }
  // why on earth would we want to do that?:: Saq

    var adminOldIn = adminLoggedIn;
    adminLoggedIn = function () {
        adminOldIn.apply(this,arguments);
        config.tasks.MTSAdmin.content = config.shadowTiddlers.MTSAdminPanel
    }

    var adminOldOut = adminLoggedOut;
    adminLoggedOut = function () {
        adminOldOut.apply(this,arguments);
        config.tasks.MTSAdmin.content = "Please log in as an admin before accessing this panel";
    }

    if (isAdmin)
        adminLoggedIn();
    else
        adminLoggedOut();

}
