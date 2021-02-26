window.addEventListener("load", function() {
	var tabs = document.querySelectorAll("ul.nav-tabs > li");
	//cách 2: var tabs = $("ul.nav-tabs > li");

	for (i = 0; i < tabs.length; i++) {	
		tabs[i].addEventListener("click", switchTab);
	}

	function switchTab(event){
		document.querySelector("ul.nav-tabs > li.active").classList.remove("active");
		document.querySelector(".tab-pane.active").classList.remove("active");

		var clickedTab = event.currentTarget;//<li class="active"><a href="#tab-1">Manage Settings</a></li>
		var anchor = event.target;//<a href="#tab-1">Manage Settings</a></li>
		var activePaneID = anchor.getAttribute("href");//#tab-1
		

		event.preventDefault();
		clickedTab.classList.add("active");
		document.querySelector(activePaneID).classList.add("active");
		//note 5
		
	}
});

