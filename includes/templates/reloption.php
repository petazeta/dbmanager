<template>
  <option></option>
  <script>
    var fields=[];
    for(var i=0; i<thisNode.parentNode.childtablekeys.length; i++) {
      key=thisNode.parentNode.childtablekeys[i].Field;
      if(thisNode.properties.hasOwnProperty(key)) {
	var value=thisNode.properties[key];
	if (value.length > 40) value=value.substring(0, 10) + "...";
	fields.push(key + ": " + thisNode.properties[key]);
      }
    }
    thisElement.value=thisNode.properties.id;
    thisElement.innerHTML=fields.join();
    thisElement.myNode=thisNode;
  </script>
</template>