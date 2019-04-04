<template id="buteditlinktp">
  <template>
    <div class="alert">
      <p>The list of candidates is printed below</p>
      <form>
	<select name="newid"></select>
	<script>
	  //normalize
	  var launcher=thisNode;
	  var thisNode=launcher.thisNode;
	  var loadCandidatesNode=thisNode.parentNode.cloneNode(0, 0);
	  
	  var parameters={user_id: webuser.properties.id};
	  if (thisNode.parentNode.properties.parentunique!=0) parameters.action="load unlinked";
	  else parameters.action="load all";
	  loadCandidatesNode.loadfromhttp(parameters, function() {
	    loadCandidatesNode.refreshChildrenView(thisElement, "templates/reloption.php");
	  });
	</script>
	<table class="mytable" style="margin-top:11px;">
	  <tr>
	    <td>
	      <input type="button" class="form-btn" value="Cancel" name="exit">
	    </td>
	    <td><input type="submit" class="form-btn" value="Replace Element"></td>
	  </tr>
	</table>
      </form>
      <script>
	//normalize
	var launcher=thisNode;
	var thisNode=launcher.thisNode;
	var myselect=thisElement.getElementsByTagName("select")[0];
	
	thisElement.addEventListener("submit", function(ev) {
	  ev.preventDefault();
	  var replaceelement=myselect.options[myselect.selectedIndex].thisNode;
	  var selectedid=myselect.options[myselect.selectedIndex].value;
	  thisNode.loadfromhttp({action: "replace myself", newid: selectedid, user_id: webuser.properties.id}, function(){
	    replaceelement.sort_order=thisNode.sort_order;
	    this.parentNode.replaceChild(thisNode, replaceelement);
	    if (this.parentNode.childContainer) this.parentNode.refreshChildrenView();
	  });
	  launcher.hidealert();
	});
	thisElement.elements.exit.onclick=function(){
	  launcher.hidealert();
	}
      </script>
    </div>
  </template>

  <a title="Edit Node Link" href="" class="buteditlink">
    <img src="css/images/penrel.png"/>
  </a>
  <script>
    // Onclick the + image we display the rel options pop up
    //normalize
    var launcher=thisNode;
    var thisNode=launcher.thisNode;
    thisElement.addEventListener("click", function(ev) {
      ev.preventDefault();
      var launcher=new Alert();
      launcher.myTp=thisElement.parentElement.querySelector("template").content.cloneNode(true);
      launcher.thisNode=thisNode;
      launcher.showalert();
    });
  </script>

</template>