<template id="butdeletelinktp">
  <template>
    <form action="dbrequest.php" style="display:none">
      <input type="hidden" name="json">
      <script>
	var mydata=new NodeMale();
	mydata.properties.id=thisNode.properties.id;
	mydata.sort_order=thisNode.sort_order;
	mydata.parentNode=new NodeFemale();
	mydata.parentNode.loadasc(thisNode.parentNode, 1);
	thisElement.value=JSON.stringify(mydata);
      </script>
      <input type="hidden" name="parameters" value="" data-js='thisElement.value=JSON.stringify({action:"delete my link", user_id: webuser.properties.id});'>
    </form>
  </template>
  <a href="" class="butdellink">
    <img src="includes/css/images/trashrel.png"/>
  </a>
  <script>
    //Normalize
    var launcher=thisNode;
    var thisNode=launcher.myNode;
    var myFormTp=thisElement.parentElement.querySelector("template").content.cloneNode(true);
    thisNode.setView(myFormTp);
    thisElement.parentElement.insertBefore(myFormTp, thisElement.parentElement.querySelector("template"));
      
    var thisParent=thisNode.parentNode;
    var myForm=thisElement.parentElement.getElementsByTagName("form")[0];
    thisElement.onclick=function() {
      var myresult=new NodeMale();
      myresult.loadfromhttp(myForm, function(){
	if (myresult.extra && myresult.extra.error===true) {
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