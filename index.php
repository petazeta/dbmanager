<?php
require('includes/config.php');
$tablePrefix=DB_PREFIX;
?>
<!DOCTYPE html>
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
    <script type="text/javascript" src="javascript/config.js"></script>
    <script type="text/javascript" src="javascript/iesp.js"></script>
    <script type="text/javascript" src="javascript/nodes.js"></script>
    <script type="text/javascript" src="javascript/dommethods.js"></script>
    <link rel="stylesheet" type="text/css" href="css/main.css">
  </head>
  <body>
    <div>
      <div id="tablescontainer">
      </div>
    </div>
    <ul id="treecontainer" class=""></ul>
    <script>
      function loadTemplates(callback) {
	//We load all the templates at once
	var tpLoader=new Node();
	tpLoader.appendThis(document.body, "templates.php", function(){
	  if (callback) callback();
	});
      }
      var webuser=new NodeMale();
      var language=new Node();
      var languages=null;
      language.properties.id=1;
      webuser.extra={language: language};
      webuser.isWebAdmin=function(){
	return true;
      }
      webuser.addEventListener=function(){};
      var myalert=new Alert();
      var tablesmother=new NodeFemale();

      tablesmother.loadfromhttp({action: "load tables"
<?php
if ($tablePrefix) echo ', prefix:"' . $tablePrefix . '"';
?>
      }, function(){
	tablesmother.refreshChildrenView(document.getElementById("tablescontainer"), "templates/table.php");
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