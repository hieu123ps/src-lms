//Check user change tab 



dt = new Date()

var h = dt.getHours();
var m = dt.getMinutes();
var s = dt.getMilliseconds();

    if (document.hidden !== undefined) { // Opera 12.10 and Firefox 18 and later support     
      visibilityChange = "visibilitychange";
    } else if (document.mozHidden !== undefined) {      
      visibilityChange = "mozvisibilitychange";
    } else if (document.msHidden !== undefined) {      
      visibilityChange = "msvisibilitychange";
    } else if (document.webkitHidden !== undefined) {      
      visibilityChange = "webkitvisibilitychange";
    } else if (document.oHidden !== undefined) {      
      visibilityChange = "ovisibilitychange";
    }
    
    document.addEventListener(visibilityChange, function(event) {
      handleVisibilityChange();
    }, false);