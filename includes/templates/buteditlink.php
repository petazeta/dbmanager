<template id="buteditlinktp">
  <a title="Edit Node Link" href="" class="buteditlink">
    <img src="includes/css/images/penrel.png"/>
  </a>
  <script>
    // Onclick the + image we display the rel options pop up
    //normalize
    var launcher=thisNode;
    var thisNode=launcher.myNode;
    thisElement.onclick=function() {
      var launcher=new Alert();
      launcher.myTp=thisElement.parentElement.querySelector("template").content.cloneNode(true);
      launcher.myNode=thisNode;
      launcher.showalert();launcher
      return false;
    }
  </script>
  <template>
    <div class="alert">
      <p>The list of candidates is printed below</p>
      <template>
	<form action="dbrequesttbrecords.php" style="display:none">
	  <input type="hidden" name="json">
	  <script>
	    var myparentdata=new NodeFemale();
	    myparentdata.loadasc(thisNode.parentNode, 1);
	    thisElement.value=JSON.stringify(myparentdata);
	  </script>
	  <input type="hidden" name="parameters" value="">
	</form>
	<form action="dbrequest.php">
	  <select name="newid"></select>
	  <script>
	    var loadCandidatesNode=new NodeFemale();
	    var loadCandidatesForm=closesttagname.call(thisElement, "FORM").previousElementSibling;
	    if (thisNode.parentNode.properties.parentunique!=0) var parameters={action: "load unlinked"};
	    else var parameters={action: "load all"};
	    parameters.user_id=webuser.properties.id;
	    loadCandidatesForm.elements.parameters.value=JSON.stringify(parameters);
	    loadCandidatesNode.loadfromhttp(loadCandidatesForm, function() {
	      loadCandidatesNode.refreshChildrenView(thisElement, "includes/templates/reloption.php");
	    });
	    
	  </script>
	  <input type="hidden" name="json">
	  <script>
	    var mydata=new NodeMale();
	    mydata.properties.id=thisNode.properties.id;
	    mydata.sort_order=thisNode.sort_order+1;
	    mydata.parentNode=new NodeFemale();
	    mydata.parentNode.loadasc(thisNode.parentNode, 1);
	    thisElement.value=JSON.stringify(mydata);
	  </script>
	  <input type="hidden" name="parameters" value="" data-js='thisElement.value=JSON.stringify({action:"replace myself", user_id: webuser.properties.id});'/>
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
	  thisElement.onsubmit=function() {
	    var myresult=new NodeMale();
	    var thisParent=thisNode.parentNode;
	    myresult.loadfromhttp(this, function(){
	      if (myresult.extra && myresult.extra.error===true) {
		alert("error editing link");
		return false;
	      }
	      var myselect=thisElement.getElementsByTagName("select")[0];
	      var replaceelement=myselect.options[myselect.selectedIndex].myNode;
	      replaceelement.sort_order=thisNode.sort_order;
	      thisParent.replaceChild(thisNode, replaceelement);
	      thisParent.refreshChildrenView();
	    });
	    thisNode.myAlert.hidealert();
	    return false;
	  };
	  thisElement.elements.exit.onclick=function(){
	    thisNode.myAlert.hidealert();
	  }
	</script>
      </template>
    </div>
    <script>
      //We normalize and parse the template to normal element
      //normalize
      var launcher=thisNode;
      var thisNode=launcher.myNode;
      thisNode.myAlert=launcher;
      var myFormTp=thisElement.querySelector("template").content.cloneNode(true);
      thisNode.setView(myFormTp);
      thisElement.insertBefore(myFormTp, thisElement.querySelector("template"));
    </script>
  </template>
</template>