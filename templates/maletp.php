<template>
  <template id="listtable">
    <table class="formtable">
      <tr>
	<td>
	</td>
      </tr>
    </table>
  </template>
  <li style="position:relative;">
    <div class="adminlauncher" data-hbutton="true" data-button="true">
      <table>
	<tbody>
	  <tr>
	    <td>
	      <a style="margin:2px" href="">
		<img src="css/images/expander.png">
	      </a>
	      <script>
		var liPointer=DomMethods.closesttagname(thisElement, "LI");
		
		thisElement.onclick=function() {
		  this.style.display="none";
		  this.parentElement.querySelectorAll("a")[1].style.display="inline";
		  thisNode.loadfromhttp({action: "load my relationships"}, function() {
		    thisNode.refreshChildrenView(liPointer.getElementsByTagName("ul")[0], "templates/femaletp.php");
		    if (liPointer.lastElementChild.style.display=="none") {
		      liPointer.lastElementChild.style.display="block";
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
		  this.parentElement.querySelectorAll("a")[0].style.display="inline";
		  var liPointer=DomMethods.closesttagname(thisElement, "LI");
		  liPointer.lastElementChild.style.display="none";
		  return false;
		}
	      </script>
	    </td>
	    <td style="position:relative;">
	      <div></div>
	      <script>
		thisNode.editable=true;
		thisNode.appendProperties(thisElement,"templates/singlefield.php", function(){
		  thisElement.appendChild(DomMethods.intoColumns(getTpContent(document.getElementById("listtable")).querySelector("table").cloneNode(true), thisElement));
		});

		var admnlauncher=new Node();
		admnlauncher.thisNode=thisNode;
		admnlauncher.editElement = thisElement;
		admnlauncher.btposition="btmiddleright";
		admnlauncher.elementsListPos="vertical";
		admnlauncher.newNode=thisNode.parentNode.newNode.cloneNode(0, null); // we duplicate it so newNode can be reused
		admnlauncher.newNode.loadasc(thisNode, 2, "id"); //the parent is not the same
		admnlauncher.newNode.sort_order=thisNode.sort_order + 1;
		admnlauncher.appendThis(thisElement, "templates/addadmnbutsextra.php");
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