<template id="butaddnodelinktp">
  <a title="Add Node Link" href="" class="butaddlink">
    <img src="includes/css/images/plusrel.png"/>
  </a>
  <script>
    // Onclick the + image we display the rel options pop up
    //normalize
    thisElement.onclick=function() {
      var launcher=new Alert();
      launcher.thisNode=thisNode;
      launcher.myTp=thisElement.parentElement.querySelector("template").content.cloneNode(true);
      launcher.showalert();
      return false;
    }
  </script>
  <template>
    <div class="alert">
      <p>The list of candidates is printed below</p>
      <form>
	<select name="id"></select>
	<script>
	  //normalize
	  var launcher=thisNode.thisNode;
	  var loadCandidatesNode=launcher.thisParent.cloneNode(1, 0); //partner is necesary
	  loadCandidatesNode.loadfromhttp({user_id: webuser.properties.id, action: "load unlinked"}, function() {
	    this.refreshChildrenView(thisElement, "includes/templates/reloption.php");
	  });
	</script>
	<table class="mytable" style="margin-top:11px;">
	  <tr>
	    <td>
	      <input type="button" class="form-btn" value="Cancel" name="exit">
	    </td>
	    <td><input type="submit" class="form-btn" value="Add element link"></td>
	  </tr>
	</table>
      </form>
      <script>
	//normalize
	var launcher=thisNode;
	var thisParent=launcher.thisNode.thisParent;
	var myselect=thisElement.getElementsByTagName("select")[0];
	thisElement.addEventListener("submit", function(ev) {
	  ev.preventDefault();
	  var addelement=myselect.options[myselect.selectedIndex].thisNode;
	  addelement.loadfromhttp({action: "add my link", user_id: webuser.properties.id}, function(){
	    thisParent.addChild(addelement);
	    thisParent.refreshChildrenView();
	  });
	  launcher.hidealert();
	  return false;
	});
	thisElement.elements.exit.onclick=function(){
	  launcher.hidealert();
	}
      </script>
    </div>
  </template>
</template>