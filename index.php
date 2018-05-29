<?php
//Includes
require('includes/config.php');
require('includes/phpclasses/nodes.php');
require('includes/database_tables.php');
?>
<!DOCTYPE html>
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
    <script type="text/javascript" src="includes/javascript/nodes.js"></script>
    <script type="text/javascript" src="includes/javascript/dommethods.js"></script>
    <script type="text/javascript" src="includes/javascript/alert.js"></script>
    <link rel="stylesheet" type="text/css" href="includes/css/main.css">
    <?php include("includes/templates.php"); ?>
  </head>
  <body>
    <div>
      <div id="tablescontainer">
      </div>
    </div>
    <ul id="treecontainer" class=""></ul>
<script type="text/javascript">
var webuser=new NodeMale();
webuser.loadedses=true;
webuser.isWebAdmin=function(){
  return true;
}
webuser.addEventListener=function(){};
var myalert=new Alert();
var tablesmother=new NodeFemale();

var stdTables=JSON.parse('<?php echo json_encode($standardTables); ?>');
stdTables.forEach(function(tableName){
  var myTable=new NodeMale();
  myTable.properties.tableName=tableName;
  tablesmother.children.push(myTable);
});

tablesmother.refreshChildrenView(document.getElementById("tablescontainer"), "includes/templates/table.php");
//just created the relationship we start again the function


function showtree(tablename) {
  myrootmother=new NodeFemale();
  myrootmother.properties.childtablename="TABLE_" + tablename.toUpperCase();
  myrootmother.properties.parenttablename="TABLE_" + tablename.toUpperCase();
  var FD = new FormData();
  FD.append("json", JSON.stringify(myrootmother));
  FD.append("parameters", JSON.stringify({action:"load this relationship"}));
  myrootmother.loadfromhttp(FD, function(){
    //Now that we have the relationship we have to load the root element
    if (myrootmother.properties.id) var jsonparameters={action: "load unlinked"};
    else var jsonparameters={action: "load all"};
    var FD = new FormData();
    FD.append("json", JSON.stringify(myrootmother));
    FD.append("parameters", JSON.stringify(jsonparameters));
    myrootmother.loadfromhttp(FD, function(){
      myrootmother.refreshChildrenView(document.getElementById("treecontainer"), "includes/templates/maletp.php");
    });
  });
}
</script>
  </body>
</html>