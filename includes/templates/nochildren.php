<template>
  <div class="adminlauncherfix"></div>
  <script>
    var launcher=thisNode;
    var thisNode=launcher.thisNode;
    var newNode=launcher.newNode;
      var admnlauncher=new Node();
      admnlauncher.thisNode=thisNode;
      admnlauncher.buttons=[
	{
	  template: "includes/templates/butaddnewnode.php",
	  args:{thisParent: thisNode, newNode: newNode}
	}
      ];
      if (thisNode.partnerNode && thisNode.partnerNode.properties.id) {
	admnlauncher.buttons.push(
	{
	  template: "includes/templates/butaddnodelink.php",
	  args:{thisParent: thisNode}
	});
      }
    admnlauncher.appendThis(thisElement, "includes/templates/admnbuts.php");
  </script>
</template>