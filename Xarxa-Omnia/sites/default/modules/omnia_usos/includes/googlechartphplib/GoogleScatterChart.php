<?php

/** @file
 * This file is part of Google Chart PHP library.
 *
 * Copyright (c) 2010 Rémi Lanvin <remi@cloudconnected.fr>
 *
 * Licensed under the MIT license.
 *
 * For the full copyright and license information, please view the LICENSE file.
 */
 
require_once 'GoogleChart.php';

/**
 * A scatter chart as a weird way of handling data series.
 *
 * Pass de data as an array of arrays, each representing a point (x, y, size).
 */
class GoogleScatterChart extends GoogleChart
{
	protected $_multiple_legends = true;

	public function __construct($width, $height)
	{
		$this->type = 's';
		$this->width = $width;
		$this->height = $height;
	}

	/**
	 * This function needs to do some funky stuffs with the data series, because
	 * the chd parameter of scatter charts work quite differently.
	 * chd=<x_values>|<y_values>[|<optional_point_sizes>]
	 *
	 * So basically each point must be split into 3 values, placed on 3 GoogleChartData objects.
	 */
	protected function compute(array & $q)
	{
		$old_data = $this->data;

		$colors = array();

		// rebuild a set of 3 GoogleChartData
		$series_x = array();
		$series_y = array();
		$series_size = array();
		$legends = array();
		foreach ( $this->data as $i => $data ) {
			$colors[] = $data->computeChco();
			$legends[] = $data->getLegend();

			$data_x = array();
			$data_y = array();
			$data_size = array();

			foreach ( $data->getValues() as $d ) {
				$data_x[] = $d[0];
				$data_y[] = $d[1];
				$data_size[] = isset($d[2]) ? $d[2] : 10;
			}

			$series_x[] = $data_x;
			$series_y[] = $data_y;
			$series_size[] = $data_size;
		}

		$series_x = self::interlace($series_x);
		$series_y = self::interlace($series_y);
		$series_size = self::interlace($series_size);

		$series_x = new GoogleChartData($series_x);
		$series_y = new GoogleChartData($series_y);
		$series_size = new GoogleChartData($series_size);

		$this->data = array($series_x,$series_y,$series_size);

		$this->setAutoScale(false);
		
		// rebuild the legends
		$series_x->setLegends($legends);
		
		// compute
		parent::compute($q);
		unset($q['chds']); // DEBUG

		$this->chco = implode('|',$colors);

		$this->data = $old_data;
	}
	
	/**
	 * Take an array of arrays, and return a single array with the columns interlaced.
	 */
	static public function interlace($array)
	{
		$result = array();

		$size = 0;
		foreach ( $array as $sub_array ) {
			$sub_size = sizeof($sub_array);
			if ( $sub_size > $size ) {
				$size = $sub_size;
			}
		}
		
		for ( $i = 0; $i < $size; $i++ ) {
			foreach ( $array as $sub_array ) {
				$result[] = isset($sub_array[$i]) ? $sub_array[$i] : null;
			}
		}
		return $result;
	}
}
