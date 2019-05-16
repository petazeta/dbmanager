<template>
  <div></div>
  <script>
    var launcher=thisNode;
    var thisParent=launcher.thisParent;
    var newNode=launcher.newNode;
    var btposition=launcher.btposition;
    
    if (btposition) thisElement.className=btposition;
    else thisElement.className=Config.defaultAdmnsButtonsPosition;

    function showAdmnButtons(){
      var admnlauncher=new Node();
      admnlauncher.buttons=[
        {
          template: "templates/butaddnewnodemaster.php",
          args:{thisParent: thisParent, newNode: newNode}
        }
      ];
      if (thisParent.partnerNode && thisParent.partnerNode.properties.id) {
        admnlauncher.buttons.push(
        {
          template: "templates/butaddnodelink.php",
          args:{thisParent: thisParent, thisNode: newNode}
        });
      }
      admnlauncher.refreshView(thisElement, "templates/admnbuts.php", function(){
        this.dispatchEvent("addAdmnButs");
      });
    }
    
    if (webuser.isWebAdmin()) {
      showAdmnButtons();
    }
  </script>
</template>
