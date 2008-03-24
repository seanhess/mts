var rssOldSaveReturn = saveReturn;
saveReturn = function (response) {
    rssOldSaveReturn.apply(this,arguments);
    
    if ( !response.error && response.rss)
        displayMessage(config.messages.rssSaved,wrapperScriptName + ".xml");
    else if (response.rss === false)
        displayMessage(config.messages.rssFailed);
}


function doRss() {
    return config.options.chkGenerateAnRssFeed;
}

function generateRss()
{
    if (!doRss())
        return "";
    
	var s = [];
	var d = new Date();
	var u = store.getTiddlerText("SiteUrl");
	// Assemble the header
	s.push("<" + "?xml version=\"1.0\"?" + ">");
	s.push("<rss version=\"2.0\">");
	s.push("<channel>");
	s.push("<title" + ">" + wikifyPlain("SiteTitle").htmlEncode() + "</title" + ">");
	if(u)
		s.push("<link>" + u.htmlEncode() + "</link>");
	s.push("<description>" + wikifyPlain("SiteSubtitle").htmlEncode() + "</description>");
	s.push("<language>en-us</language>");
	s.push("<copyright>Copyright " + d.getFullYear() + " " + config.options.txtUserName.htmlEncode() + "</copyright>");
	s.push("<pubDate>" + d.toGMTString() + "</pubDate>");
	s.push("<lastBuildDate>" + d.toGMTString() + "</lastBuildDate>");
	s.push("<docs>http://blogs.law.harvard.edu/tech/rss</docs>");
	s.push("<generator>TiddlyWiki " + version.major + "." + version.minor + "." + version.revision + "</generator>");
	// The body
	var tiddlers = store.getTiddlers("modified","excludeLists");
	var n = config.numRssItems > tiddlers.length ? 0 : tiddlers.length-config.numRssItems;
	for (var t=tiddlers.length-1; t>=n; t--)
	    { if (! store.uploadError && mtsRssExists)
          {
          if (store.getValue(tiddlers[t],"temp.flagForUpload"))
		          s.push(tiddlers[t].saveToRss(u));
          }
        else
            s.push(tiddlers[t].saveToRss(u));
	    }
    // And footer
	s.push("</channel>");
	s.push("</rss>");
	// Save it all
	return convertUnicodeToUTF8(s.join("\n"));
}
