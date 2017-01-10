<?php
	/**
	 * Project: PanelDev
	 * License: GPL3.0 ©All right reserved
	 * User: WinXaito
	 */

	require_once __DIR__.'/../../../config.php';

	return '
		<div class="col-md-6 col-nopadding">
			<h3 style="border-bottom:1px solid #C8C8C8">Projets</h3>

			'.$projectManager->showAllProjectsTable($_User, true).'
		</div>
		<div class="col-md-6 col-nopadding">
			<h3 style="border-bottom:1px solid #C8C8C8">Analyse</h3>
			<div id="canvas-holder" style="width:150px;margin:auto">
				<canvas id="chart-area" width="100" height="100"></canvas>
			</div>
		</div>
	';
