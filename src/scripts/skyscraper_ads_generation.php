<?php
function insert_skyscraper_adunit_script() {
?>
	<script async>
		function createSidebanners() {

			var contentElement = document.querySelector('main');
			let body = document.querySelector('body')

			var leftSticky = document.createElement("div");
			leftSticky.id = "bg-Skyscraper_L";
			leftSticky.style.position = "absolute";
            leftSticky.style.top = "20px";
			leftSticky.style.height = contentElement.clientHeight - 375 + "px";
			leftSticky.style.transition = 'transform 0.3s ease';
			
			var rightSticky = document.createElement("div");
			rightSticky.id = "bg-Skyscraper_R";
			rightSticky.style.position = "absolute";
            rightSticky.style.top = "20px";
			rightSticky.style.height = contentElement.clientHeight - 375 + "px";
			rightSticky.style.transition = 'transform 0.3s ease';
			
			if(body.clientWidth >= contentElement.clientWidth + 600) {
				leftSticky.style.width = "300px";
				rightSticky.style.width = "300px";
				rightSticky.style.right = "-310px";
				leftSticky.style.left = "-310px";
			} else {
				leftSticky.style.width = "160px";
				rightSticky.style.width = "160px";
				rightSticky.style.right = "-170px";
				leftSticky.style.left = "-170px";
			}

			var div160x600L = document.createElement("div");
			div160x600L.dataset.adUnitId = "/23209726049/OpdateretDK/Skyscraper_L";
			div160x600L.style.position = "sticky";
			div160x600L.style.top = "150px";
			div160x600L.style.height = "600px";
			div160x600L.style.float = "right";
			leftSticky.appendChild(div160x600L);

			var div160x600R = document.createElement("div");
			div160x600R.dataset.adUnitId = "/23209726049/OpdateretDK/Skyscraper_R";
			div160x600R.style.position = "sticky";
			div160x600R.style.top = "150px";
			div160x600R.style.height = "600px";
			div160x600R.style.float = "left";
			rightSticky.appendChild(div160x600R);

			contentElement.appendChild(leftSticky);
			contentElement.appendChild(rightSticky);

			var listenerSidebarSizeUpdater = function() {
				leftSticky.style.height = contentElement.clientHeight - 375 + "px";
				rightSticky.style.height = contentElement.clientHeight - 375 + "px";
			};

			try {
				window.addEventListener("scroll", listenerSidebarSizeUpdater, {
					passive: true,
				});
			} catch (err) {
				window.addEventListener("scroll", listenerSidebarSizeUpdater);
			}
		}

		if (window.innerWidth >= 1420) {
			createSidebanners();
		}
</script>
<?php
    }
add_action('wp_footer', 'insert_skyscraper_adunit_script');
?>