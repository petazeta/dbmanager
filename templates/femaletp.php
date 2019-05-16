<template>
  <li>
    <a style="margin:2px" href="javascript:">
      <img src="css/images/expander.png"/>
    </a>
    <script>
      //mod for the navigation facility
      var url='?menu=' + thisNode.properties.id;
      thisElement.href=url;
      //this mod is not finished
      thisElement.onclick=function() {
        this.style.display="none";
        this.parentElement.querySelectorAll("a")[1].style.display="inline";
        thisNode.children=[];
        thisNode.loadfromhttp({action:"load my children"}, function() {
          thisNode.refreshChildrenView(thisElement.parentElement.querySelector("UL"), "templates/maletp.php");
          if (thisElement.parentElement.lastElementChild.style.display=="none") {
            thisElement.parentElement.lastElementChild.style.display="block";
          }
        });
        return false;
      }
    </script>
    <a style="margin:2px; display: none;" href="">
      <img src="css/images/reducer.png"/>
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
    <script>
      thisNode.writeProperty(thisElement, "name");
	    var newNode=new NodeMale();
	    newNode.parentNode=new NodeFemale();
	    newNode.parentNode.load(thisNode, 1, 0, "id");
	    //new node comes with datarelationship attached

	    thisNode.newNode=newNode;
	    thisNode.appendThis(thisElement, "templates/admnlisteners.php", function() {
	    });
    </script>
    <ul>
    </ul>
  </li>
</template>
