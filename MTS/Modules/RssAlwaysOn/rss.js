var oldDoRss = doRss;
doRss = function (response) {
    
    // call, but ignore // 
    oldDoRss.apply(this,arguments);
    
    return true;
}

