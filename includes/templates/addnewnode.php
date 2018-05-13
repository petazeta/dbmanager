<li style="position:relative;">
		<table>
			<tbody>
				<tr>
					<td>
						<table>
								<tr>
									<td style="padding-left:5px" data-js='
										if (!(thisNode.parentNode.properties.childtablelocked==1)) {
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
									<td data-js='
										if (thisNode.parentNode.partnerNode) {
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
								</tr>
							</table>
					</td>
				</tr>
			</tbody>
		</table>
</li>