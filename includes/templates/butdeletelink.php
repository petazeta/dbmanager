<template id="butdeletelinktp">
  <a href="" class="butdellink">
    <img src="includes/css/images/trashrel.png"/>
  </a>
  <script>
    //Normalize
    var launcher=thisNode;
    var thisNode=launcher.thisNode;
    thisElement.addEventListener("click", function(ev) {
      ev.preventDefault();
      var myresult=new NodeMale();
      thisNode.loadfromhttp({action:"delete my link", user_id: webuser.properties.id}, function(){
	this.parentNode.removeChild(this);
	//for no children add a eventlistener to refreshChildrenView event
	if (this.parentNode.childContainer) this.parentNode.refreshChildrenView();
	this.parentNode.dispatchEvent("deleteNode", [this]);
	this.dispatchEvent("deleteNode");
      });
    });
  </script>
</template>