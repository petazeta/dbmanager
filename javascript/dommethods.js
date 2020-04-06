//Some functions that will be applied to dom elements
DomMethods={
  setSelected: function(element) {
    element.className=element.className.replace(/ selected/g,"");
    element.className+=" selected";
  },
  setUnselected: function(element) {
    element.className=element.className.replace(/ selected/g,'');
  },
  closesttagname: function(element, tagname, limitElement){ //tagname capitals
    //if !myreturn.parentElement.tagName => document fragment
    var myreturn=element;
    while(myreturn && myreturn.parentElement && myreturn.parentElement.tagName && ( myreturn.parentElement.tagName.toLowerCase() != tagname.toLowerCase() )) {
      myreturn=myreturn.parentElement;
    }
    if (limitElement && myreturn.parentElement==limitElement) return false;
    else if (myreturn.parentElement && (myreturn.parentElement.tagName.toLowerCase()==tagname.toLowerCase())) return myreturn.parentElement;
    else return false;
  },
  intoColumns: function(tableElement, elements, cellsNumber) {
    if (!cellsNumber) cellsNumber=0;
    // columns distribution applied to a row
    // tableElement a table template, elements a document fragment o dom element containing elements
    var myRow=tableElement.rows[0].cloneNode();
    var myCell=tableElement.rows[0].cells[0].cloneNode();
    tableElement.innerHTML='';
    while (elements.firstElementChild) {
      if (!elements.firstElementChild.tagName) continue;
      var newRow=myRow.cloneNode();
      tableElement.appendChild(newRow);
      if (cellsNumber == 0) {
	while (elements.firstElementChild) {
	  var newCell=myCell.cloneNode();
	  newCell.style.width=cellsWidth;
	  newCell.appendChild(elements.firstElementChild);
	  newRow.appendChild(newCell);
	}
	return tableElement;
      }
      var i=cellsNumber;
      while(i--) {
	var cellsWidth=Math.round(100/cellsNumber) + "%";
	if (elements.firstElementChild) {
	  var newCell=myCell.cloneNode();
	  newCell.style.width=cellsWidth;
	  newCell.appendChild(elements.firstElementChild);
	  //don't forget the element script
	  if (elements.firstElementChild && elements.firstElementChild.tagName=="SCRIPT") {
	    newCell.appendChild(elements.firstElementChild);
	  }
	  newRow.appendChild(newCell);
	}
	else {
	  var newCell=myCell.cloneNode();
	  newCell.style.width=cellsWidth;
	  newRow.appendChild(newCell);
	}
      }
    }
    return tableElement;
  },
  validateEmail: function(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
  },
  checklength: function(value, min, max){
    if (typeof value=="number") value=value.toString();
    if (typeof value == "string") {
      if (value.length >= min && value.length <= max) return true;
    }
    return false;
  },
  unsetActiveChild: function(thisNode) {
    thisNode.selected=false;
    var doms=thisNode.getMyDomNodes();
    var hbutton=null;
    if (doms) {
      for (var j=0; j<doms.length; j++) {
        if (doms[j].getAttribute("data-hbutton")) hbutton=doms[j];
        else hbutton=doms[j].querySelector("[data-hbutton]");
        if (hbutton) {
          DomMethods.setUnselected(hbutton);
          break;
        }
      }
    }
  },
  unsetActive: function(thisNode) {
    thisNode.activeChildren=null;
    //unselect brothers
    var i= thisNode.children.length;
    while(i--) {
      if (thisNode.children[i].selected) {
        DomMethods.unsetActiveChild(thisNode.children[i]);
        var myRel=thisNode.children[i].getRelationship(thisNode.properties.name);
        DomMethods.unsetActive(myRel);
      }
    }
  },
  setActiveChild: function(thisNode) {
    if (thisNode.parentNode) {
      DomMethods.unsetActive(thisNode.parentNode);
      thisNode.parentNode.activeChildren=thisNode;
    }
    //selection of the node
    thisNode.selected=true;
    var doms=thisNode.getMyDomNodes();
    var hbutton=null;
    if (doms) {
      for (var i=0; i<doms.length; i++) {
        if (doms[i].getAttribute("data-hbutton")) hbutton=doms[i];
        else hbutton=doms[i].querySelector("[data-hbutton]");
        if (hbutton) {
          DomMethods.setSelected(hbutton);
          break;
        }
      }
    }
  },
  setActive: function(thisNode) {
    DomMethods.setActiveChild(thisNode);
    var myRoot=thisNode.getrootnode();
    var myPointer=thisNode;
    while (myPointer && myPointer!=myRoot) {
      myParent=myPointer.parentNode;
      if (myParent) myPointer=myParent.partnerNode;
      if (myPointer && !myPointer.selected) {
        //uselect selecteds children
        //find the selected
        var mySelected=false;
        var i= myParent.children.length;
        while(i--) {
          if (myParent.children[i].selected==true) {
            mySelected=myParent.children[i];
          }
        }
        if (mySelected) {
          DomMethods.unsetActive(mySelected.getRelationship(myParent.properties.name));
        }
        DomMethods.setActiveChild(myPointer);
      }
    }
  }
}

function Alert() {
  NodeMale.call(this);
}
Alert.prototype=Object.create(NodeMale.prototype);
Alert.prototype.constructor=Alert;

Alert.prototype.showalert=function(text, tp, listener) {
  if (tp == null) tp="templates/alert.php";
  if (text) this.properties.alertmsg=text;
  var alertcontainer=document.createElement("div");
  document.body.appendChild(alertcontainer);
  this.myContainer=alertcontainer;
  this.refreshView(null, tp, listener);
};
Alert.prototype.hidealert=function() {
  var remove=function(element){
    element.parentElement.removeChild(element);
  };
  var myContainer=this.myContainer;
  if (this.properties.timeout>0) {
    window.setTimeout(function(){remove(myContainer);},this.properties.timeout);
  }
  else remove(myContainer);
};

//Change the size of a file
//var file = fileInput.files[0];  fd.append(filename, blob, filename + ".png");
function resizeImage(imageFile, imageSizeX, blobResult) {
  var imageType = /image.*/;

  if (imageFile.type.match(imageType)) {
    var reader = new FileReader();
    reader.onload = function() {
      // Create a new image.
      var img = new Image();
      // Set the img src property using the data URL.
      img.src = reader.result;
      img.onload = function() {
        var image=this;
        var max_width=imageSizeX;
	var width = image.width;
	var height = image.height;
	
	if (width > max_width) {
	  height *= max_width / width;
	  width = max_width;
	}
	var canvas = document.createElement("canvas");
	canvas.width = width;
	canvas.height = height;

	canvas.getContext("2d").drawImage(image, 0, 0, width, height);
	var dataUrl = canvas.toDataURL("image/png");
	
	blobResult.push(dataURLtoBlob(dataUrl));

        function dataURLtoBlob(dataURL) {
	  // convert base64/URLEncoded data component to raw binary data held in a string
	  var byteString;
          if (dataURL.split(",")[0].indexOf("base64") >= 0) byteString = atob(dataURL.split(",")[1]);
          else byteString = unescape(dataURL.split(",")[1]);
	  // separate out the mime component
	  var mimeString = dataURL.split(",")[0].split(":")[1].split(";")[0];
	  // write the bytes of the string to a typed array
	  var ia = new Uint8Array(byteString.length);
	  for (var i = 0; i < byteString.length; i++) {
	    ia[i] = byteString.charCodeAt(i);
	  }
          return new Blob([ia], {type:mimeString});
        }
      };
    }
    reader.readAsDataURL(imageFile); 
  }
  else {
    return false;
  }
}
