<template>
  <option></option>
  <script>
    var fields=[];
    thisNode.parentNode.childtablekeys.forEach(function(tableKey) {
      key=tableKey.Field;
      if(thisNode.properties.hasOwnProperty(key)) {
	var value=thisNode.properties[key];
	if (value.length > 40) value=value.substring(0, 10) + "...";
	fields.push(key + ": " + value);
      }
    });
    thisElement.value=thisNode.properties.id;
    thisElement.innerHTML=fields.join();
    thisElement.myNode=thisNode;
  </script>
</template>