export default async function addition(currentNode, myParams, languages, currentLanguage) {
  const newNode= await addNewNode(currentNode, languages, currentLanguage);
  if (myParams.onAdded) await myParams.onAdded(newNode);
  else if (newNode.parentNode.children.length<=1) await newNode.parentNode.setChildrenView(null, null, myParams); //to remove the single addition button
  else await newNode.parentNode.appendChildView(newNode, myParams);
  return newNode;
}
//currentNode can be previousSibling (then it contains id) or the actual newNode
async function addNewNode(currentNode, languages, currentLanguage) {
  //************
  //maybe we could avoid parameter languages y currentLanguage and load it at the function script
  const parentNode=currentNode.parentNode;
  const isNewNode = !currentNode.props.id;
  let parameters=null;
  const datarel = currentNode.relationships.find(rel => rel.syschildtablekeysinfo.some( syskey => syskey.type=='foreignkey' && syskey.parenttablename=='TABLE_LANGUAGES' ) );
  if (languages && datarel) parameters={extraParents: currentLanguage.getRelationship(datarel.props.name)};
  if (!isNewNode) {
    const skey=parentNode.getMySysKey('sort_order');
    let position;
    if (skey && parentNode.children.length) {
      position=currentNode.props[skey]+1;
    }
    if (languages) currentNode=await parentNode.createInstanceChildText(position);
    else currentNode=parentNode.createInstanceChild(position);
  }

  await currentNode.loadRequest("add my tree", parameters);
  //We copy the data row to any language
  if (languages && languages.children.length>1) {
    const restLanguages=languages.children.filter(lang => lang.props.id!=currentLanguage.props.id);
    const candidates=currentNode.arrayFromTree();
    for (const lang of restLanguages) {
      for (const candidate of candidates) {
        if (candidate.detectMyGender() == "female") {
          for (const syskey of candidate.syschildtablekeysinfo) {
            if (syskey.parenttablename==languages.props.parenttablename
              && syskey.type=='foreignkey') {
                candidate.request("add my children", {extraParents: lang.getRelationship(candidate.props.name)});
                break;
            }
          }
        }
      }
    }
  }
  parentNode.addChild(currentNode);
  parentNode.dispatchEvent("addNewNode", currentNode);
  return currentNode;
}