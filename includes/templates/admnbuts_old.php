<table class="adminedit">
	<tr>
		<td  style="vertical-align:top;" data-js='
			if (thisNode.sort_order && thisNode.parentNode.children.length>1) {
				var myContainer=thisElement;
				var myTp=document.getElementById("buthchpostp").cloneNode(true);
				if (thisNode.butadminposition=="horizontal") myTp=document.getElementById("butvchpostp").cloneNode(true);
				var refreshAdminButon=function() {
					if (!webuser.isWebAdmin()) {
						while (myContainer.firstChild) myContainer.removeChild(myContainer.firstChild);
					}
					else {
						thisNode.setView(myTp);
						myContainer.appendChild(myTp);
					}
				}
				//For when load first time and there is user logged in
				if (webuser.loadedses) {
					refreshAdminButon();
				}
				webuser.addEventListener("onLoadFromHTTP", refreshAdminButon);
			}
		'>
		</td>
		<td style="padding-left:5px" data-js='
			if (!(thisNode.parentNode.properties.childunique==1 && thisNode.properties.id) && !(thisNode.parentNode.properties.childtablelocked==1)) {
				var myContainer=thisElement;
				var myTp=document.getElementById("butaddnodetp").cloneNode(true);
				var refreshAdminButon=function() {
					if (!webuser.isWebAdmin()) {
						while (myContainer.firstChild) myContainer.removeChild(myContainer.firstChild);
					}
					else {
						thisNode.setView(myTp);
						myContainer.appendChild(myTp);
					}
				}
				//For when load first time and there is user logged in
				if (webuser.loadedses) {
					refreshAdminButon();
				}
				webuser.addEventListener("onLoadFromHTTP", refreshAdminButon);
			}
		'>
		</td>
		<td style="padding-left:5px" data-js='
			if (!thisNode.parentNode.properties.childtablelocked==1) {
				var myContainer=thisElement;
				var myTp=document.getElementById("butdeletetp").cloneNode(true);
				var refreshAdminButon=function() {
					if (!webuser.isWebAdmin()) {
						while (myContainer.firstChild) myContainer.removeChild(myContainer.firstChild);
					}
					else {
						thisNode.setView(myTp);
						myContainer.appendChild(myTp);
					}
				}
				//For when load first time and there is user logged in
				if (webuser.loadedses) {
					refreshAdminButon();
				}
				webuser.addEventListener("onLoadFromHTTP", refreshAdminButon);
			}
		'>
		</td>
		<td data-js='
			if (thisNode.parentNode.partnerNode) {
				var myContainer=thisElement;
				var myTp=document.getElementById("butdeletelinktp").cloneNode(true);
				var refreshAdminButon=function() {
					if (!webuser.isWebAdmin()) {
						while (myContainer.firstChild) myContainer.removeChild(myContainer.firstChild);
					}
					else {
						thisNode.setView(myTp);
						myContainer.appendChild(myTp);
					}
				}
				//For when load first time and there is user logged in
				if (webuser.loadedses) {
					refreshAdminButon();
				}
				webuser.addEventListener("onLoadFromHTTP", refreshAdminButon);
			}
			'>
		</td>
		<td data-js='
			if (!(thisNode.parentNode.properties.childunique==1 && thisNode.properties.id) && thisNode.parentNode.partnerNode) {
				var myContainer=thisElement;
				var myTp=document.getElementById("butaddnodelinktp").cloneNode(true);
				var refreshAdminButon=function() {
					if (!webuser.isWebAdmin()) {
						while (myContainer.firstChild) myContainer.removeChild(myContainer.firstChild);
					}
					else {
						thisNode.setView(myTp);
						myContainer.appendChild(myTp);
					}
				}
				//For when load first time and there is user logged in
				if (webuser.loadedses) {
					refreshAdminButon();
				}
				webuser.addEventListener("onLoadFromHTTP", refreshAdminButon);
			}
		'>
		</td>
		<td data-js='
			if (thisNode.parentNode.partnerNode) {
				var myContainer=thisElement;
				var myTp=document.getElementById("buteditlinktp").cloneNode(true);
				var refreshAdminButon=function() {
					if (!webuser.isWebAdmin()) {
						while (myContainer.firstChild) myContainer.removeChild(myContainer.firstChild);
					}
					else {
						thisNode.setView(myTp);
						myContainer.appendChild(myTp);
					}
				}
				//For when load first time and there is user logged in
				if (webuser.loadedses) {
					refreshAdminButon();
				}
				webuser.addEventListener("onLoadFromHTTP", refreshAdminButon);
			}
		'>
		</td>
	</tr>
</table>