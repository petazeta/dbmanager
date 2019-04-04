<template>
  <option></option>
  <script>
    var fields=[];
    thisNode.parentNode.childtablekeys.forEach(function(tableKey) {
      if(thisNode.properties.hasOwnProperty(tableKey)) {
	var value=thisNode.properties[tableKey];
	if (value.length > 40) value=value.substring(0, 10) + "...";
	fields.push(tableKey + ": " + value);
      }
    });
    thisElement.value=thisNode.properties.id;
    thisElement.textContent=fields.join();
    thisElement.thisNode=thisNode;
  </script>
</template>