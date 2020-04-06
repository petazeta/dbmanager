<?php
require('includes/config.php');
require('includes/phpclasses/nodes.php');
require('includes/database_tables.php');
?>
<!DOCTYPE html>
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
    <script type="text/javascript" src="javascript/config.js"></script>
    <script type="text/javascript" src="javascript/iesp.js"></script>
    <script type="text/javascript" src="javascript/nodes.js"></script>
    <script type="text/javascript" src="javascript/dommethods.js"></script>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="icon" href="favicon.ico">
  </head>
  <body>
    <div id="langscontainer"></div>
    <hr>
    <div id="tablescontainer"></div>
    <ul id="treecontainer" class=""></ul>
    <script>
      //history facility
      window.onpopstate = function(event) {
        if (!event.state) return;
        var link=document.querySelector("a[href='" + event.state.url + "']");
        if (link) link.click();
      };
      function loadTemplates(callback) {
        //We load all the templates at once
        var tpLoader=new Node();
        tpLoader.appendThis(document.body, "templates.php", function(){
          if (callback) callback();
        });
      }
      var languagesmother=new NodeFemale();
      languagesmother.properties.childtablename="TABLE_LANGUAGES";
      languagesmother.properties.parenttablename="TABLE_LANGUAGES";
      var webuser=new NodeMale();
      var languages=null;

      webuser.isWebAdmin=function(){
        return true;
      }
      webuser.addEventListener=function(){};
      var myalert=new Alert();
      var tablesmother=new NodeFemale();

      tablesmother.loadfromhttp({action: "load tables"<?php if ($tablePrefix) echo ', prefix:"' . $tablePrefix . '"'; ?>}, function(){
        tablesmother.refreshChildrenView(document.getElementById("tablescontainer"), "templates/table.php");

          var languageSensitive=false;
          for (var i=0; i<tablesmother.children.length; i++) {
            if (tablesmother.children[i].properties.name=="<?php if (defined('TABLE_LANGUAGES')) { echo TABLE_LANGUAGES;  }?>") {
              languageSensitive=true;
              break;
            }
          }
          if (languageSensitive) {
            languagesmother.loadfromhttp({action:"load root"}, function(){
              var langsroot=this.children[0];
              langsroot.loadfromhttp({action:"load my relationships"}, function(){
                var langrelkey=0;
                for (var i=0; i<langsroot.relationships.length; i++) {
                  if (this.relationships[i].properties.childtablename=="TABLE_LANGUAGES") {
                      langrelkey=i;
                      break;
                  }
                }
                languages=langsroot.relationships[langrelkey];
                languages.loadfromhttp({action:"load my children"}, function(){
                  this.refreshChildrenView(document.getElementById("langscontainer"), "templates/language.php");
                  webuser.extra={language:  this.children[0]};
                });
              });
            });
          }
      });
      //just created the relationship we start again the function

      function showtree(tablename) {
        myrootmother=new NodeFemale();
        myrootmother.properties.childtablename='TABLE_' + tablename.toUpperCase();
        myrootmother.properties.parenttablename='TABLE_' + tablename.toUpperCase();
        myrootmother.loadfromhttp({action:"load this relationship"}, function(){
          //Now that we have the relationship we have to load the root element
          if (this.properties.name) var jsonparameters={action: "load unlinked"};
          else var jsonparameters={action: "load all"};
          myrootmother.loadfromhttp(jsonparameters, function(){
            var newNode=new NodeMale();
            newNode.parentNode=new NodeFemale();
            newNode.parentNode.load(myrootmother, 1, 0, "id");
            //new node comes with datarelationship attached

            myrootmother.newNode=newNode;
            myrootmother.appendThis(document.getElementById("treecontainer"), "templates/admnlisteners.php", function() {
              myrootmother.refreshChildrenView(document.getElementById("treecontainer"), "templates/maletp.php");
            });
          });
        });
      }
    </script>
  </body>
</html>
