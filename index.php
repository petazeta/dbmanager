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
    <script type="text/javascript" src="includes/javascript/nodesextra.js"></script>
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
document.body.appendChild(document.getElementById("formgenerictp").content.querySelector("form").cloneNode(true));
var webuser=new NodeMale();
webuser.loadedses=true;
webuser.isWebAdmin=function(){
  return true;
}
webuser.addEventListener=function(){};
var myalert=new Alert();
var tablesmother=new NodeFemale();
var myForm=document.getElementById("formgeneric").cloneNode(true);
myForm.setAttribute("action","dbrequesttbrecords.php");
myForm.elements.parameters.value=JSON.stringify({action: "load tables"});
tablesmother.setView(myForm);
document.body.appendChild(myForm);
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
  //We must load the root node.
  //To do it correctly we will get the data from the relationship that it comes from
  //We will do it by emulating a father and then loading its relationship
  //The relationship that is a relationship between its table will be the one we are searching for
  var myForm=document.getElementById("formgeneric").cloneNode(true);
  myForm.setAttribute("action","dbrequesttbrecords.php");
  myForm.elements.parameters.value=JSON.stringify({action:"load this relationship"});
  myrootmother.setView(myForm); //footfather's mother has the information of the table: that is needed for the loading
  myrootmother.loadfromhttp(myForm, function(){
    //Now that we have the relationship we have to load the root element
    if (myrootmother.properties.id) var jsonparameters={action: "load unlinked"};
    else var jsonparameters={action: "load all"};
    var myForm=document.getElementById("formgeneric").cloneNode(true);
    myForm.setAttribute("action","dbrequesttbrecords.php");
    myForm.elements.parameters.value=JSON.stringify(jsonparameters);
    myrootmother.setView(myForm);
    myrootmother.loadfromhttp(myForm, function(){
      myrootmother.refreshChildrenView(document.getElementById("treecontainer"), "includes/templates/maletp.php");
    });
  });
}
function showtree_old(tablename) {
 /*  It displays the table registers and it relationship tree
      If the table is indexed within itself it will show just the unlinked registers, that is: the root registers
 */
  myalert.getTp("includes/templates/alert.php", function() {
    myalert.myTp=myalert.xmlTp; //For error alerts
    myrootmother=new NodeFemale();
    myrootmother.properties.childtablename=tablename;
    myrootmother.properties.parenttablename=tablename;
    //Loading the template for relationships node
    myrootmother.getTp("includes/templates/femaletp.php", function(){
      myrootmother.relTp=myrootmother.xmlTp;
      //Loading the template for normal node
      myrootmother.getTp("includes/templates/nodepolifields.php", function(){
        myrootmother.childTp=myrootmother.xmlTp;
        myrootmother.getTp("includes/templates/singlefield.php", function() {
          myrootmother.colTp=myrootmother.xmlTp;
          myrootmother.getTp("includes/templates/addnewnode.php", function(){
          myrootmother.addnewnodeTp=myrootmother.xmlTp;
          //while childTp is template for the complet row. colTp is template for every column/database field
            //We must load the root node.
            //To do it correctly we will get the data from the relationship that it comes from
            //We will do it by emulating a father and then loading its relationship
            //The relationship that is a relationship between its table will be the one we are searching for
            var myForm=document.getElementById("formgenerictp").content.querySelector("form").cloneNode(true);
	    myForm.action="dbrequesttbrecords.php";
            myForm.elements.parameters.value=JSON.stringify({action:"load this relationship"});
            myrootmother.setView(myForm); //footfather's mother has the information of the table: that is needed for the loading
            myrootmother.loadfromhttp(myForm, function(){
              var loadedroot=function(){
                myrootmother.refreshChildrenView(document.getElementById("treecontainer"), myrootmother.childTp);
              };
              //Now that we have the relationship we have to load the root element
              if (myrootmother.properties.id) var jsonparameters={action: "load unlinked"};
              else var jsonparameters={action: "load all"};
	      var myForm=document.getElementById("formgenerictp").content.querySelector("form").cloneNode(true);
	      myForm.action="dbrequesttbrecords.php";
              myForm.elements.parameters.value=JSON.stringify(jsonparameters);
              myrootmother.setView(myForm);
              myrootmother.loadfromhttp(myForm, loadedroot);
            });
          });
        });
      });
    });
  });
};
</script>
  </body>
</html>