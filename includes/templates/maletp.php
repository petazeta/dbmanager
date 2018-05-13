<template>
  <li style="position:relative;">
    <div class="adminlauncher">
      <table>
	<tbody>
	  <tr>
	    <td>
	      <a style="margin:2px" href="">
		<form style="display:none" action="dbrequest.php">
		  <input type="hidden" name="json">
		  <script>
		    var mydata=new NodeMale();
		    mydata.properties.id=thisNode.properties.id;
		    mydata.parentNode=new NodeFemale();
		    mydata.parentNode.loadasc(thisNode.parentNode, 1);
		    thisElement.value=JSON.stringify(mydata);
		  </script>
		  <input type="hidden" name="parameters">
		</form>
		<img src="includes/css/images/expander.png"/>
	      </a>
	      <script>
		var myform=thisElement.getElementsByTagName("form")[0];
		myform.elements.parameters.value=JSON.stringify({action: "load my relationships"});
		var liPointer=closesttagname.call(thisElement, "LI");
		
		thisElement.onclick=function() {
		  this.style.display="none";
		  this.parentElement.querySelectorAll("a")[1].style.display="inline";
		  thisNode.loadfromhttp(myform, function() {
		    thisNode.refreshChildrenView(liPointer.getElementsByTagName("ul")[0], "includes/templates/femaletp.php");
		    if (liPointer.lastElementChild.style.display=="none") {
		      liPointer.lastElementChild.style.display="block";
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
		  this.parentElement.querySelectorAll("a")[0].style.display="inline";
		  var liPointer=closesttagname.call(thisElement, "LI");
		  liPointer.lastElementChild.style.display="none";
		  return false;
		}
	      </script>
	    </td>
	    <td style="position:relative;">
	      <table>
		<tr></tr>
		<script>
		  thisNode.getTp("includes/templates/singlefield.php", function(){
		    var celltp=thisNode.xmlTp.cloneNode(true);
		    thisNode.refreshPropertiesView(thisElement,celltp);
		  });
		</script>
	      </table>
	      <div class="btright">
	      </div>
	      <script>
		if (webuser.isWebAdmin()) {
		  var admnlauncher=new NodeMale();
		  admnlauncher.myNode=thisNode;
		  admnlauncher.buttons=[];
		  if (thisNode.sort_order && thisNode.parentNode.children.length>1) admnlauncher.buttons.push({template: document.getElementById("butvchpostp")});
		  if (!(thisNode.parentNode.properties.childunique==1 && thisNode.properties.id) && !(thisNode.parentNode.properties.childtablelocked==1)) admnlauncher.buttons.push({template: document.getElementById("butaddnodetp")});
		  if (!thisNode.parentNode.properties.childtablelocked==1) admnlauncher.buttons.push({template: document.getElementById("butdeletetp")});
		  if (thisNode.parentNode.partnerNode) admnlauncher.buttons.push({template: document.getElementById("butdeletelinktp")});
		  if (!(thisNode.parentNode.properties.childunique==1 && thisNode.properties.id) && thisNode.parentNode.partnerNode) admnlauncher.buttons.push({template: document.getElementById("butaddnodelinktp")});
		  if (thisNode.parentNode.partnerNode) admnlauncher.buttons.push({template: document.getElementById("buteditlinktp")});
		  admnlauncher.refreshView(thisElement, document.getElementById("admnbutstp"));
		}
	      </script>
	    </td>
	  </tr>
	</tbody>
      </table>
    </div>
    <ul>
    </ul>
  </li>
</template>