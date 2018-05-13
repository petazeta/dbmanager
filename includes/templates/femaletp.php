<template>
  <li>
    <a style="margin:2px" href="">
      <img src="includes/css/images/expander.png"/>
    </a>
    <script>
      var myform=document.getElementById("formgeneric").cloneNode(true);
      myform.elements.parameters.value=JSON.stringify({action:"load my children"});
      thisNode.setView(myform);
      thisElement.onclick=function() {
	this.style.display="none";
	this.parentElement.querySelectorAll("a")[1].style.display="inline";
	thisNode.loadfromhttp(myform, function() {
	  this.addEventListener("refreshChildrenView", function() {
	    if (this.children==0){
	      var element=this.addChild(new NodeMale());
	      element.refreshView(thisElement.parentElement.querySelector("UL"), document.getElementById("nochildrentp"));
	    }
	  });
	  thisNode.refreshChildrenView(thisElement.parentElement.querySelector("UL"), "includes/templates/maletp.php");
	  if (thisElement.parentElement.lastElementChild.style.display=="none") {
	    thisElement.parentElement.lastElementChild.style.display="block";
	  }
	});
	return false;
      }
    </script>
    <a style="margin:2px; display: none;" href="">
      <img src="includes/css/images/reducer.png"/>
    </a>
    <script>
      thisElement.onclick=function() {
	this.style.display="none";
	this.parentElement.querySelector("a").style.display="inline";
	thisElement.parentElement.lastElementChild.style.display="none";
	return false;
      }
    </script>
    Relationship: <span data-js='thisElement.innerHTML=thisNode.properties.name;'></span>
    <ul>
    </ul>
  </li>
</template>