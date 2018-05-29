<template id="butdeletelinktp">
  <a href="" class="butdellink">
    <img src="includes/css/images/trashrel.png"/>
  </a>
  <script>
    //Normalize
    var launcher=thisNode;
    var thisNode=launcher.myNode;
    var thisParent=thisNode.parentNode;
    thisElement.onclick=function() {
      var myresult=new NodeMale();
      thisNode.loadfromhttp({action:"delete my link", user_id: webuser.properties.id}, function(){
	if (thisNode.extra && thisNode.extra.error===true) {
	  alert("error deleting link");
	  return false;
	}
	thisParent.removeChild(thisNode);
	thisParent.refreshChildrenView();
	thisParent.dispatchEvent("deleteNode", [thisNode]);
	thisNode.dispatchEvent("deleteNode");
      });
      return false;
    }
  </script>
</template>