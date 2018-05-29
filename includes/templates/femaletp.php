<template>
  <li>
    <a style="margin:2px" href="">
      <img src="includes/css/images/expander.png"/>
    </a>
    <script>
      thisElement.onclick=function() {
	this.style.display="none";
	this.parentElement.querySelectorAll("a")[1].style.display="inline";
	thisNode.loadfromhttp({action:"load my children"}, function() {
	  this.addEventListener("refreshChildrenView", function() {
	    if (this.children==0 || !this.children[0].properties.id){
	      this.children=[];
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