/* /////////////////////////////////////////////////////////////////////////////

    MiniTiddlyServer: A mini-server for TiddlyWikis
    Copyright (C) 2007  Sean Clark Hess and Saq Imtiaz
    
    MiniTiddlyServer is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.
    
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    
    You should have received a copy of the GNU General Public License along
    with this program; if not, write to the Free Software Foundation, Inc.,
    51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.

//////////////////////////////////////////////////////////////////////////////// */

function Response(rawData) {
    
    var data = null;
    
    try {
        eval (rawData);
    }
    catch (e) {
        displayMessage("Parsing Error! ~ The server's response was corrupted");
        alert(rawData);
        this.error = true;
        return;
    }
    
    if ( data ) {
        if ( data.error ) {
            displayMessage("Server Error! ~ "+data.message);
            this.error = true;
            this.errorMessage = data.message;
        }
        else {
            this.error = false;
            
            for (var i in data) {
                if ( data[i] == "false" )
                    this[i] = false;
                else if ( data[i] == "true" )
                    this[i] = true;
                this[i] = data[i];
            }
        }
    }
    else {
        displayMessage("Parsing Error! ~ The server's response was corrupted");
        alert(rawData);
        this.error = true;
        return;
    }
}


function AjaxRequest(url, callback, getParams, postParams) {
    
    var cb = callback;
    
    this.url = url;
    this.getParams = getParams;
    this.postParams = postParams;
    this.callback = function (rawData) {
        var response = new Response(rawData);
        if ( !response.error )
            cb(response);
        else
           cb({error:true});
    }
}

AjaxRequest.prototype.send = function () {
    if ( this.postParams ) {
        var getstr = "";
        for (var i in this.getParams) {
            getstr += i + "=" + this.getParams[i] + "&";
        }
        
        openAjaxRequestParams(this.url + "?" + getstr, this.postParams, this.callback, true);
        
    }
    
    else {
        openAjaxRequestParams(this.url, this.getParams, this.callback, false);
    }
}

var xmlHttp;

function openAjaxRequestParams(url, params, callback, usePost) {

    var datastr = "";

    for (var i in params) {
        if ( usePost ) {
            if ( params[i] )
                datastr += i + "=" + escape(params[i].replace(/\+/g,"&#43;")) + "&";
        }
            
        else
            datastr += i + "=" + params[i] + "&";
    }
    
    if ( usePost )
        openAjaxRequest(url, callback, true, datastr);
    
    else
        openAjaxRequest(url + "?" + datastr, callback);
    
}

function openAjaxRequest(url, callback, usePost, postData)
{
    var xmlHttp = GetXmlHttpObject();
    
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }
    
    var protocol;
    
    if (usePost) {
        protocol = "POST";
    }
    
    else            
        protocol = "GET";
    
    xmlHttp.onreadystatechange = function ()
    {
        if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
            callback(xmlHttp.responseText);
    }
    
    xmlHttp.open(protocol,url,true);
    
    if ( usePost ) 
        xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        
    xmlHttp.send(postData);
    
}


function GetXmlHttpObject()
{ 
    var objXMLHttp=null
    
    if (window.XMLHttpRequest)
        objXMLHttp=new XMLHttpRequest();

    else if (window.ActiveXObject)
        objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP");

    return objXMLHttp
} 


