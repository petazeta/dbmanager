<template id="nochildrentp">
  <div style="text-align:center;" class="adminlauncherfix"></div>
  <script>
    if (webuser.isWebAdmin()) {
      var admnlauncher=new NodeMale();
      admnlauncher.myNode=thisNode;
      admnlauncher.buttons=[];
      if (!(thisNode.parentNode.properties.childtablelocked==1)) admnlauncher.buttons.push({template: document.getElementById("butaddnewnodetp")});
      admnlauncher.buttons.push({template: document.getElementById("butaddnodelinktp")});
      admnlauncher.refreshView(thisElement, document.getElementById("admnbutstp"));
    }
    else {
      thisElement.innerHTML='';
    }
  </script>
</template>