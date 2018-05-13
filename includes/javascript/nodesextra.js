// Set relationship htmlNode from the given arguments and refresh the view. It uses this.relTp and this.relContainer
// Equivalent to RefreshChildrenView but for relationships
NodeMale.prototype.setRelView=function (tp) {
  if (!tp) tp=this.myTp;
  var myreturn=[];
  for (var i=0; i<this.relationships.length; i++) {
    myreturn.push(this.relationships[i].setView(tp.cloneNode(true)));
  }
  return myreturn;
};

NodeMale.prototype.refreshRelView=function (container, tp, reqlistener) {
  if (!container) container=this.myContainer;
  else this.myContainer=container;
  if (!tp) tp=this.myTp;
  else this.myTp=tp;
  var refresh=function(){
    var htmlNodes=this.setRelView();
    for (var i=0; i<htmlNodes.length; i++) {
      this.relationships[i].htmlNode=htmlNodes[i]; //It will improve performance by not clonning but we prefer by now to have a template for each children
      container.appendChild(htmlNodes[i]);
    }
    if (reqlistener) reqlistener();
  };
  while (container.firstChild) container.removeChild(container.firstChild);
  if (typeof tp=="string") {
    var loadedtp=function() {
      refresh.call(this);
    };
    this.getTp(tp, loadedtp);
  }
  else {
    if (tp) {
      if (tp.tagName && tp.tagName=="TEMPLATE") tp=tp.content;
      this.childTp=tp;
    }
    refresh.call(this);
  }
};