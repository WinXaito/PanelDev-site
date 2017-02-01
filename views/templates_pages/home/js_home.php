<?php
	/**
	 * Project: PanelDev
	 * License: GPL3.0 ©All right reserved
	 * User: WinXaito
	 */

	return '
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

		<script>
			var config = {
				data: {
					datasets: [{
						data: [
							1000,
							780,
							100,
							50
						],
						backgroundColor: [
							"#EEE",
							"#5c92c1",
							"#337AB7",
							"#7e9bb4"
						]
					}],
					labels: [
						"200",
						"404",
						"500",
						"autres"
					]
				}
			};

			window.onload = function() {
				var ctx = document.getElementById("chart-area").getContext("2d");
				window.myDoughnut = Chart.Doughnut(ctx, config);
				console.log(window.myDoughnut);
			};
		</script>
	';
