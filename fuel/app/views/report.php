<?php

	$html .= '<table><tbody>';
	$html .= '<tr>';
	$html .= 	'<th>Status</th>';
	$html .= 	'<th>Location</th>';
	$html .= 	'<th>Latency</th>';
	$html .= 	'<th>Time</th>';
	$html .= '</tr>';

	foreach ($data as $server)
	{
		$latency = ($server['latency'] > 0 ? $server['latency'] * 1000 : false);

		if ($latency)
		{
			$latency = substr($latency, 2, 2).'ms';
		}

		$html .= '<tr>';
		$html .= 	'<td '.($server['up'] ? 'style="background-color: rgb(51, 102, 0); width: 50px; height: 50px;"' : 'style="background-color: rgb(255, 0, 0); width: 50px; height: 50px;"').'>&nbsp;</td>';
		$html .= 	'<td>'.$server['location'].'</td>';
		$html .= 	'<td>'.$latency.'</td>';
		$html .=	'<td>'.date('h:i:s a').'</td>';
		$html .= '</tr>';
	}

	$html .= '</tbody></table>';