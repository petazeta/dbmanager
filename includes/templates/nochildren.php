<template id="nochildrentp">
  <div style="text-align:center;" class="butvisible"></div>
  <script>
    if (webuser.isWebAdmin()) {
      var admnlauncher=new NodeMale();
      admnlauncher.myNode=thisNode;
      admnlauncher.buttons=[];
      if (!(thisNode.parentNode.properties.childtablelocked==1)) admnlauncher.buttons.push({template: document.getElementById("butaddnodetp")});
      if (thisNode.parentNode.partnerNode) admnlauncher.buttons.push({template: document.getElementById("butaddnodelinktp")});
      admnlauncher.refreshView(thisElement, document.getElementById("admnbutstp"));
    }
  </script>
</template>